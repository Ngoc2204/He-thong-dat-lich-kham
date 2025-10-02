<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::prefix('services')->group(function () {
    Route::view('/cleaning', 'services.cleaning')->name('services.cleaning');
    Route::view('/filling', 'services.filling')->name('services.filling');
    Route::view('/checkup', 'services.checkup')->name('services.checkup');
    Route::view('/braces', 'services.braces')->name('services.braces');
});
