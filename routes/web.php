<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/user/profile', [ProfileController::class, 'getProfile'])->name('user.profile');
    Route::get('/user/profile_form', [ProfileController::class, 'updateForm'])->name('profile.form');
    Route::put('/user/{id}/profile_update', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::resource('tour', TourController::class)->except(['update', 'destroy']);
    Route::get('/tour/{tour}/visit', [TourController::class, 'visit'])->name('tour.visit');
    Route::post('/tour/purchase', [TourController::class, 'purchase'])->name('tour.purchase');
    Route::get('/tour/{id}/startMatch', [TourController::class, 'startMatch'])->name('tour.startMatch');
    Route::post('/tour/{id}/match1/answers', [TourController::class, 'submitAnswers'])->name('tour.match1Answers');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/user/profile', [ProfileController::class, 'getProfile'])->name('user.profile');
// Route::get('/user/profile_form', [ProfileController::class, 'updateForm'])->name('profile.form');
// Route::put('/user/{id}/profile_update', [ProfileController::class, 'updateProfile'])->name('update.profile');
// Route::resource('tour', TourController::class)->except(['update', 'destroy']);
// Route::get('/tour/{tour}/visit', [TourController::class, 'visit'])->name('tour.visit');
// Route::post('/tour/purchase', [TourController::class, 'purchase'])->name('tour.purchase');
// Route::get('/tour/{id}/startMatch', [TourController::class, 'startMatch'])->name('tour.startMatch');
// Route::post('/tour/{id}/match1/answers', [TourController::class, 'submitAnswers'])->name('tour.match1Answers');
