<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\DentistController as AdminDentistController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Dentist\DashboardController as DentistDashboardController;
use App\Http\Controllers\Dentist\ScheduleController as DentistScheduleController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Dentist\DentistAppointmentController;
use App\Http\Controllers\Dentist\DentistPatientController;
use App\Http\Controllers\Dentist\DentistReportController;
use App\Http\Controllers\SocialAuthController;

// Home
Route::get('/', function () {
    return view('appointments.home');
})->name('appointments.home');

// About
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('appointments.about');

Route::get('/kien-thuc', function () {
    return view('appointments.knowledge');
})->name('knowledge.index');


// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//Google
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

//Facebook 
Route::get('auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

// Patient booking & my appointments
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/book', [AppointmentController::class, 'create'])->name('appointments.create'); // shows form & slots
    Route::post('/book', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.mine');
    Route::delete('/my-appointments/{appointment}', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
});

// Dentist area
Route::prefix('dentist')->middleware(['auth', 'role:dentist'])->group(function () {
    Route::get('/', [DentistDashboardController::class, 'index'])->name('dentist.dashboard');
    Route::post('/appointments/{appointment}/status', [DentistDashboardController::class, 'updateStatus'])->name('dentist.appointments.status');
    Route::get('/schedules', [DentistScheduleController::class, 'index'])->name('dentist.schedules.index');
    Route::get('/schedules/create', [DentistScheduleController::class, 'create'])->name('dentist.schedules.create');
    Route::post('/schedules', [DentistScheduleController::class, 'store'])->name('dentist.schedules.store');
    Route::get('/appointments', [DentistAppointmentController::class, 'index'])
        ->name('dentist.appointments.index');
    Route::post('/appointments/{appointment}/status', [DentistAppointmentController::class, 'updateStatus'])
        ->name('dentist.appointments.status');
    Route::get('/patients', [DentistPatientController::class, 'index'])->name('dentist.patients.index');
    Route::get('/reports', [DentistReportController::class, 'index'])->name('dentist.reports.index');
});

// Admin area
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('dentists', AdminDentistController::class)->except(['show']);
    Route::resource('services', AdminServiceController::class)->except(['show']);
    Route::resource('schedules', AdminScheduleController::class)->except(['show']);
    Route::resource('patients', AdminPatientController::class)->except(['show']);

    Route::get('/statistics', [StatisticsController::class, 'index'])->name('admin.statistics');


    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('appointments/create', [AdminAppointmentController::class, 'create'])->name('admin.appointments.create');
    Route::post('appointments', [AdminAppointmentController::class, 'store'])->name('admin.appointments.store');
    Route::post('appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('admin.appointments.status');
    Route::delete('appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
