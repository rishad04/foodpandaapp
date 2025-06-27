@extends('frontend.partials.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
        <x-breadcrumb :title="'Login'" />
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0" style="list-style: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.login') }}" method="POST" id="userLoginForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    
                    <div class="col-lg-12">
                        <input type="text" id="email_or_phone" value="{{ old('email_or_phone') }}" name="email_or_phone"   placeholder="Email Or Phone">
                    </div>
                    <div class="col-lg-12">
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="site-btn">LOGIN</button>
                    </div>
                    
                </div>
            </form>

            <div class="col-lg-12 text-center mt-3">
                <a href="{{ url('/social-signin-via-redirect/google') }}" class="btn btn-danger">
                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" style="width:20px; height:20px; margin-right:8px;">
                    Login with Google
                </a>
            </div>
            
        </div>
        <div class="col-lg-12 text-center mt-3">
            <p>Forgot Password? <a href="{{ route('frontend.forgot-password') }}">Recover here</a></p>
        </div>
        <div class="col-lg-12 text-center mt-3">
            <p>Don  't have an account? <a href="{{ route('frontend.register') }}">Register here</a></p>
        </div>
    </div>
    <!-- Contact Form End -->

@endsection

