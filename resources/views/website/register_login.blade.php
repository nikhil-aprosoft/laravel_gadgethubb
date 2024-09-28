@extends('layouts.app')
@section('title', 'Login/Register')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var status = @json(session('status'));
            var statusType = @json(session('status_type'));

            if (status) {
                Swal.fire({
                    title: statusType === 'success' ? 'Success!' : 'Error!',
                    text: status,
                    icon: statusType === 'success' ? 'success' : 'error'
                });
            }
        });
    </script>
    <div class="container mt-5">
        <div class="login-popup mx-auto bordered">
            <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                <ul class="nav nav-tabs text-uppercase" role="tablist">
                    <li class="nav-item">
                        <a href="#sign-in" class="nav-link active">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a href="#sign-up" class="nav-link">Sign Up</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="sign-in">
                        <form id="login-form" method="POST" action="{{ route('user-login') }}">@csrf
                            <div class="form-group">
                                <label>Email address *</label>
                                <input type="text" class="form-control" name="email" id="username" required>
                            </div>
                            <div class="form-group mb-0">
                                <label>Password *</label>
                                <input type="text" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="form-checkbox d-flex align-items-center justify-content-between">
                                <input type="checkbox" class="custom-checkbox" id="remember" name="remember"="">
                                <label for="remember">Remember me</label>
                                <a href="#">Last your password?</a>
                            </div>
                            <button class="btn btn-primary">Sign In</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="sign-up">
                        <form action="{{ route('signup') }}" method="post">@csrf
                            <div class="form-group">
                                <label>Your Name*</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label>Your Email address *</label>
                                <input type="text" class="form-control" name="email" id="email_1" required>
                            </div>
                            <div class="form-group mb-5">
                                <label>Password *</label>
                                <input type="text" class="form-control" name="password" id="password_1" required>
                            </div>
                            <p>Your personal data will be used to support your experience
                                throughout this website, to manage access to your account,
                                and for other purposes described in our <a href="#" class="text-primary">privacy
                                    policy</a>.</p>
                            <a href="#" class="d-block mb-5 text-primary">Signup as a vendor?</a>
                            <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                <input type="checkbox" class="custom-checkbox" id="agree" name="agree">
                                <label for="agree" class="font-size-md">I agree to the <a href="#"
                                        class="text-primary font-size-md">privacy policy</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                    </div>
                </div>
                <p class="text-center">Sign in with social account</p>
                <div class="social-icons social-icon-border-color d-flex justify-content-center">
                    <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                    <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                    <a href="#" class="social-icon social-google fab fa-google"></a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .bordered {
            border: 2px solid #000;
            /* Adjust the color and thickness as needed */
            border-radius: 5px;
            /* Optional: add rounded corners */
        }
    </style>


@endsection
