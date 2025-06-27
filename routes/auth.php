<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\V1\Auth\SocialAuthController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::post('/register', [RegisteredUserController::class, 'store'])
  ->middleware('guest')
  ->name('user.register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
  ->middleware('guest')
  ->name('user.login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
  ->middleware('guest')
  ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
  ->middleware('guest')
  ->name('password.store');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
  ->middleware(['signed', 'throttle:6,1'])
  ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
  ->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
  ->middleware('auth')
  ->name('user.logout');

Route::post('/check-user', [PasswordResetLinkController::class, 'checkUser'])
  ->middleware('guest')
  ->name('check.user');

Route::post('/send-otp-email', [PasswordResetLinkController::class, 'sendForgotPassOtpToEmail']);
Route::post('/send-otp-phone', [PasswordResetLinkController::class, 'sendForgotPassOtpToPhone']);
Route::post('/verify-reset-password-otp', [PasswordResetLinkController::class, 'verifyResetPasswordOtp']);
Route::post('/reset-password', [PasswordResetLinkController::class, 'resetPassword']);


Route::controller(SocialAuthController::class)->group(function () {
  Route::post('/social-signin-via-access-token', 'appSignIn');
  Route::get('/social-signin-via-redirect/{provider}', 'webSignIn')->middleware('web');
  Route::post('/social-signin/{provider}/callback', 'handleProviderCallback');
  Route::get('/social-signin/{provider}/callback', 'handleProviderCallback')->middleware('web');
});
