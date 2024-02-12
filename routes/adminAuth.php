<?php

use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\adminAuth\AuthenticatedSessionController;
use App\Http\Controllers\adminAuth\ConfirmablePasswordController;
use App\Http\Controllers\adminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\adminAuth\EmailVerificationPromptController;
use App\Http\Controllers\adminAuth\NewPasswordController;
use App\Http\Controllers\adminAuth\PasswordController;
use App\Http\Controllers\adminAuth\PasswordResetLinkController;
use App\Http\Controllers\adminAuth\RegisteredUserController;
use App\Http\Controllers\adminAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    
    

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('admin')->group(function () {

    Route::delete('delete/{id}', [AdminsController::class, 'destroy'])->name('delete');

    Route::post('main/{admin}', [AdminsController::class, 'main'])->name('main');

    Route::get('admins', [AdminsController::class, 'index'])->name('admins.index');

    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
});
