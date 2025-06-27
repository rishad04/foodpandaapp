<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendAuthController;
use App\Http\Controllers\Frontend\FrontendHomePageController;


Route::get('/', [FrontendHomePageController::class, 'landingPageView'])->name('/');

Route::middleware(['guest', 'throttle:10,1'])->group(function () {
    Route::get('/user-login', [FrontendAuthController::class, 'showLoginForm'])->name('frontend.login');
    Route::get('/user-registration', [FrontendAuthController::class, 'showRegisterForm'])->name('frontend.register');
    Route::get('/user-forgot-password', [FrontendAuthController::class, 'showForgotPasswordForm'])->name('frontend.forgot-password');
});
