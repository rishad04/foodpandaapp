<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.login');
    }
    public function showRegisterForm()
    {
        return view('frontend.register');
    }
    public function showForgotPasswordForm()
    {
        return view('frontend.forgot-password');
    }
}
