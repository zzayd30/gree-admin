<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Customer\CustomerPasswordResetController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);

    // OTP-based Password Reset Routes
    Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('admin/verify-otp', [PasswordResetLinkController::class, 'showVerifyOtpForm'])
        ->name('password.verify-otp.show');

    Route::post('admin/verify-otp', [PasswordResetLinkController::class, 'verifyOtp'])
        ->name('password.verify-otp');

    Route::get('admin/reset-password', [NewPasswordController::class, 'create'])
        ->name('password.reset.show');

    Route::post('admin/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.reset.store');

    // Customer Password Reset Routes
    Route::get('customer/set-password', [CustomerPasswordResetController::class, 'showSetPasswordForm'])
        ->name('customer.password.reset');

    Route::post('customer/set-password', [CustomerPasswordResetController::class, 'setPassword'])
        ->name('customer.password.update');
});

Route::middleware('auth')->group(function () {
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

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
