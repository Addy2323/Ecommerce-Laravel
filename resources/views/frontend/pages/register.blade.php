@extends('frontend.layouts.master')

@section('title','Ecommerce Laravel || Register Page')

@section('main-content')
    <!-- Register Section -->
    <section class="login-section" style="min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="login-card" style="background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden;">
                        <div class="row no-gutters">
                            <!-- Left Side - Illustration -->
                            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center" style="background: #f8f9fa; padding: 40px;">
                                <div class="text-center">
                                    <img src="https://img.freepik.com/free-vector/sign-up-concept-illustration_114360-7885.jpg" alt="Register" class="img-fluid" style="max-width: 90%;">
                                    <h4 class="mt-4" style="color: #333; font-weight: 600;">Join Us Today!</h4>
                                    <p class="text-muted">Create your account and start shopping with us</p>
                                </div>
                            </div>
                            
                            <!-- Right Side - Registration Form -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <h2 style="color: #4a4a4a; font-weight: 700; margin-bottom: 0.5rem;">Create Account</h2>
                                        <p class="text-muted">Fill in your details to register</p>
                                    </div>

                                    <form method="POST" action="{{route('register.submit')}}" class="mt-4">
                                        @csrf
                                        
                                        <!-- Name Input -->
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label" style="font-weight: 500; color: #4a4a4a;">Full Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                                    <i class="ti-user" style="color: #6c757d;"></i>
                                                </span>
                                                <input type="text" 
                                                    class="form-control @error('name') is-invalid @enderror" 
                                                    id="name" 
                                                    name="name" 
                                                    placeholder="Enter your full name" 
                                                    value="{{ old('name') }}" 
                                                    required 
                                                    autocomplete="name" 
                                                    autofocus
                                                    style="border-left: none; padding-left: 0; height: 45px;">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Email Input -->
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label" style="font-weight: 500; color: #4a4a4a;">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                                    <i class="ti-email" style="color: #6c757d;"></i>
                                                </span>
                                                <input type="email" 
                                                    class="form-control @error('email') is-invalid @enderror" 
                                                    id="email" 
                                                    name="email" 
                                                    placeholder="Enter your email" 
                                                    value="{{ old('email') }}" 
                                                    required 
                                                    autocomplete="email"
                                                    style="border-left: none; padding-left: 0; height: 45px;">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Password Input -->
                                        <div class="form-group mb-3">
                                            <label for="password" class="form-label" style="font-weight: 500; color: #4a4a4a;">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                                    <i class="ti-lock" style="color: #6c757d;"></i>
                                                </span>
                                                <input type="password" 
                                                    class="form-control @error('password') is-invalid @enderror" 
                                                    id="password" 
                                                    name="password" 
                                                    placeholder="Create a password" 
                                                    required 
                                                    autocomplete="new-password"
                                                    style="border-left: none; padding-left: 0; height: 45px;">
                                            </div>
                                            <small class="form-text text-muted">Use 8 or more characters with a mix of letters, numbers & symbols</small>
                                            @error('password')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password Input -->
                                        <div class="form-group mb-4">
                                            <label for="password-confirm" class="form-label" style="font-weight: 500; color: #4a4a4a;">Confirm Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: #f8f9fa; border-right: none;">
                                                    <i class="ti-lock" style="color: #6c757d;"></i>
                                                </span>
                                                <input type="password" 
                                                    class="form-control" 
                                                    id="password-confirm" 
                                                    name="password_confirmation" 
                                                    placeholder="Confirm your password" 
                                                    required 
                                                    autocomplete="new-password"
                                                    style="border-left: none; padding-left: 0; height: 45px;">
                                            </div>
                                        </div>

                                        <!-- Terms and Conditions -->
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                            <label class="form-check-label" for="terms" style="font-size: 0.9rem; color: #6c757d;">
                                                I agree to the <a href="#" class="text-primary">Terms & Conditions</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                            </label>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3" style="background: #4e73df; border: none; font-weight: 600; height: 45px; border-radius: 5px; font-size: 1rem; transition: all 0.3s;">
                                            Create Account
                                        </button>

                                        <!-- Login Link -->
                                        <div class="text-center mt-4">
                                            <p class="text-muted">Already have an account? 
                                                <a href="{{route('login.form')}}" class="text-primary" style="font-weight: 500;">Sign In</a>
                                            </p>
                                        </div>

                                        <!-- Social Login -->
                                        <div class="text-center mt-4">
                                            <p class="divider-text">
                                                <span class="bg-white px-2" style="color: #6c757d; font-size: 0.85rem;">OR SIGN UP WITH</span>
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
    <!--/ End Register Section -->
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
    /* Password strength indicator */
    .password-strength {
        height: 4px;
        background: #e9ecef;
        margin-top: 5px;
        border-radius: 2px;
        overflow: hidden;
    }
    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: width 0.3s ease, background-color 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    // Simple password strength indicator
    document.addEventListener('DOMContentLoaded', function() {
        const password = document.getElementById('password');
        const strengthBar = document.createElement('div');
        strengthBar.className = 'password-strength';
        strengthBar.innerHTML = '<div class="password-strength-bar"></div>';
        password.parentNode.insertBefore(strengthBar, password.nextSibling);

        password.addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            const bar = this.nextElementSibling.querySelector('.password-strength-bar');
            
            // Update the width and color of the strength bar
            bar.style.width = (strength * 25) + '%';
            
            // Update the color based on strength
            if (strength < 2) {
                bar.style.backgroundColor = '#dc3545'; // Red
            } else if (strength < 4) {
                bar.style.backgroundColor = '#ffc107'; // Yellow
            } else {
                bar.style.backgroundColor = '#28a745'; // Green
            }
        });

        function checkPasswordStrength(password) {
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength++;
            
            // Lowercase check
            if (password.match(/[a-z]+/)) strength++;
            
            // Uppercase check
            if (password.match(/[A-Z]+/)) strength++;
            
            // Number check
            if (password.match(/[0-9]+/)) strength++;
            
            // Special character check
            if (password.match(/[!@#$%^&*(),.?":{}|<>]+/)) strength++;
            
            return Math.min(strength, 5); // Cap at 5
        }
    });
</script>
@endpush