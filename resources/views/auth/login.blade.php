<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login - Ecommerce Laravel</title>
    
    @include('backend.layouts.head')
    
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #2e59d9;
            --secondary-color: #858796;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --danger-color: #e74a3b;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Nunito', sans-serif;
        }
        
        .login-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .logo-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 3px solid #f7941d;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 0 auto 15px;
        }
        
        .logo-circle img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            border-radius: 50%;
        }
        
        .login-illustration {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            min-height: 100%;
        }
        
        .login-illustration img {
            max-width: 100%;
            height: auto;
        }
        
        .login-form {
            padding: 50px;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo img {
            height: 50px;
            margin-bottom: 15px;
        }
        
        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 5px;
        }
        
        .login-subtitle {
            color: var(--secondary-color);
            font-size: 15px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            height: 45px;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d3e2;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-login {
            background: var(--primary-color);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            height: 45px;
            width: 100%;
            font-size: 1rem;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .forgot-password a {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .input-group-text {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            border-right: none;
            border-radius: 8px 0 0 8px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
        }
        
        .custom-control-label::before {
            border: 1px solid #d1d3e2;
        }
        
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .invalid-feedback {
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        @media (max-width: 991.98px) {
            .login-illustration {
                display: none;
            }
            
            .login-form {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="login-illustration">
                    <img src="https://img.freepik.com/free-vector/secure-login-password-abstract-concept-illustration_335657-3874.jpg" alt="Admin Login">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-card h-100">
                    <div class="login-form">
                        <div class="login-logo text-center mb-4">
                            @php
                                $settings=DB::table('settings')->first();
                            @endphp
                            <div class="logo-circle mx-auto mb-3">
                                <img src="{{ $settings->logo }}" alt="Logo" class="img-fluid">
                            </div>
                            <h1 class="login-title">Welcome Back!</h1>
                            <p class="login-subtitle">Please login to your admin account</p>
                        </div>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email Input -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input id="email" type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Enter your email" 
                                           required 
                                           autocomplete="email" 
                                           autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- Password Input -->
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-primary" style="font-size: 0.85rem;">
                                            Forgot Password?
                                        </a>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           placeholder="Enter your password" 
                                           required 
                                           autocomplete="current-password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- Remember Me -->
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" 
                                           class="custom-control-input" 
                                           name="remember" 
                                           id="remember" 
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-login">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </button>
                            </div>
                            
                            <!-- Back to Home -->
                            <div class="text-center mt-4">
                                <a href="{{ url('/') }}" class="text-primary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to Website
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.layouts.scripts')
</body>

</html>
