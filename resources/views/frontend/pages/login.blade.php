@extends('frontend.layouts.master')

@section('title','Ecommerce Laravel || Login Page')

@section('main-content')
    <!-- Login Section -->
    <section class="login-section" style="min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="login-card" style="background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden;">
                        <div class="row no-gutters">
                            <!-- Left Side - Illustration -->
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center" style="background: #f8f9fa; padding: 40px;">
                                <div class="text-center">
                                    <img src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-135.jpg" alt="Login" class="img-fluid" style="max-width: 90%;">
                                    <h4 class="mt-4" style="color: #333; font-weight: 600;">Welcome Back!</h4>
                                    <p class="text-muted">Login to access your account and continue shopping</p>
                                </div>
                            </div>
                            
                            <!-- Right Side - Login Form -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <h2 style="color: #4a4a4a; font-weight: 700; margin-bottom: 0.5rem;">Sign In</h2>
                                        <p class="text-muted">Sign in to continue to Ecommerce</p>
                                    </div>

                                    <form method="POST" action="{{route('login.submit')}}" class="mt-4">
                                        @csrf
                                        
                                        <!-- Email Input -->
                                        <div class="form-group mb-4">
                                            <label for="email" class="form-label" style="font-weight: 500; color: #4a4a4a;">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                                    <i class="ti-email" style="color: #6c757d;"></i>
                                                </span>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                    id="email" name="email" 
                                                    placeholder="Enter your email" 
                                                    value="{{ old('email') }}" 
                                                    required 
                                                    autocomplete="email" 
                                                    autofocus
                                                    style="border-left: none; padding-left: 0; height: 45px;">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Password Input -->
                                        <div class="form-group mb-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label for="password" class="form-label" style="font-weight: 500; color: #4a4a4a;">Password</label>
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.reset') }}" class="text-primary" style="font-size: 0.85rem;">
                                                        Forgot password?
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                                    <i class="ti-lock" style="color: #6c757d;"></i>
                                                </span>
                                                <input type="password" 
                                                    class="form-control @error('password') is-invalid @enderror" 
                                                    id="password" 
                                                    name="password" 
                                                    placeholder="Enter your password" 
                                                    required 
                                                    autocomplete="current-password"
                                                    style="border-left: none; padding-left: 0; height: 45px;">
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Remember Me & Submit -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember" style="font-size: 0.9rem; color: #6c757d;">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3" style="background: #4e73df; border: none; font-weight: 600; height: 45px; border-radius: 5px; font-size: 1rem; transition: all 0.3s;">
                                            Sign In
                                        </button>

                                        <!-- Register Link -->
                                        <div class="text-center mt-4">
                                            <p class="text-muted">Don't have an account? 
                                                <a href="{{route('register.form')}}" class="text-primary" style="font-weight: 500;">Create an account</a>
                                            </p>
                                        </div>

                                        <!-- Social Login -->
                                        <div class="text-center mt-4">
                                            <p class="divider-text">
                                                <span class="bg-white px-2" style="color: #6c757d; font-size: 0.85rem;">OR CONTINUE WITH</span>
                                            </p>
                                            <div class="d-flex justify-content-center gap-3">
                                                <a href="{{route('login.redirect','google')}}" class="btn btn-outline-light" style="border: 1px solid #dee2e6; width: 45px; height: 45px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="ti-google text-danger"></i>
                                                </a>
                                                <a href="{{route('login.redirect','facebook')}}" class="btn btn-outline-light" style="border: 1px solid #dee2e6; width: 45px; height: 45px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="ti-facebook text-primary"></i>
                                                </a>
                                                <a href="{{route('login.redirect','github')}}" class="btn btn-outline-light" style="border: 1px solid #dee2e6; width: 45px; height: 45px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="ti-github"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login Section -->
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .login-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .divider-text {
        position: relative;
        text-align: center;
        margin: 15px 0;
    }
    .divider-text::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background-color: #e0e0e0;
        z-index: -1;
    }
    .btn-primary {
        background: #4e73df;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: #2e59d9;
        transform: translateY(-1px);
    }
    .btn-outline-light:hover {
        background: #f8f9fa;
    }
    .form-control {
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: #4e73df;
    }
</style>
@endpush