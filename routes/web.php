<?php

declare(strict_types=1);

use App\Http\Controllers;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

Route::get('register', [Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [Auth\RegisteredUserController::class, 'store']);

Route::get('login', [Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [Auth\AuthenticatedSessionController::class, 'store']);

Route::get('password/forgot', [Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('password/forgot', [Auth\PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('password/reset/{token}', [Auth\NewPasswordController::class, 'create'])->name('password.reset');
Route::post('password/reset', [Auth\NewPasswordController::class, 'store'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('verification', [Auth\EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::get('verification/{id}/{hash}', [Auth\VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('verification/email', [Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('password/confirm', [Auth\ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('password/confirm', [Auth\ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::view('home', 'home')->name('home');

    Route::prefix('setting')->group(function () {
        Route::get('profile', [Controllers\ProfileController::class, 'index'])->name('profile.index');
        Route::post('profile/update', [Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/change-password', [Controllers\ProfileController::class, 'change_password'])->name('profile.change_password');
    });

    Route::get('access-codes', [Controllers\ImportAccessCodeController::class, 'index'])->name('access_codes.index');
    Route::post('access-codes/import', [Controllers\ImportAccessCodeController::class, 'store'])->name('access_codes.store');
});
