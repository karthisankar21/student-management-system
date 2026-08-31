<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/pay-student/{id}', [StudentController::class, 'PayStudent']);
Route::get('/Check-pay-student/{id}', [StudentController::class, 'checkPayStudent']);


// Guest routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected routes
Route::middleware('auth')->group(function () {

    Route::resource('students', StudentController::class)->only(['index']);

    Route::get('/payment/{id}', [StudentController::class, 'Payment'])->name('payment');

    Route::post('/logout', [AuthController::class, 'logout']);
});