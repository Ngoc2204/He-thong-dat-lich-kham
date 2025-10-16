<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DentistController as AdminDentistController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Dentist\DashboardController as DentistDashboardController;

// Home
Route::get('/', function () { return view('home'); })->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


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
});

// Admin area
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('dentists', AdminDentistController::class)->except(['show']);
    Route::resource('services', AdminServiceController::class)->except(['show']);
    Route::resource('schedules', AdminScheduleController::class)->except(['show']);
    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::post('appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('admin.appointments.status');
    Route::delete('appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
});
