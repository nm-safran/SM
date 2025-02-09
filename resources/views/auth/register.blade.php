@extends('layouts.app')

@section('content')
    <div class="login-wrapper">
        <div class="container">
            <div class="row justify-content-center min-vh-100 align-items-center">
                <div class="col-md-5">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="text-center mt-3">
                            <img src="{{ asset('images/images.jpeg') }}" alt="Logo" class="img-fluid mb-2"
                                style="max-width: 100px;">
                            <h4 class="text-primary font-weight-bold">Create Account</h4>
                        </div>

                        <div class="card-body p-3">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-2">
                                    <label for="name" class="form-label small text-muted">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Enter your full name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="email"
                                        class="form-label small text-muted">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Enter your email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="password" class="form-label small text-muted">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Create password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm"
                                        class="form-label small text-muted">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm password">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                                        {{ __('Back to Login') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .login-wrapper {
            background: linear-gradient(135deg, #4361ee 0%, #3046c5 100%);
            position: relative;
            min-height: 100vh;
            overflow: hidden;
        }

        .login-wrapper::before {
            content: '';
            position: absolute;
            width: 2000px;
            height: 2000px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            top: -1000px;
            right: -1000px;
            animation: float 20s infinite linear;
        }

        .login-wrapper::after {
            content: '';
            position: absolute;
            width: 1500px;
            height: 1500px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            bottom: -750px;
            left: -750px;
            animation: float 15s infinite linear reverse;
        }

        @keyframes float {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn-primary {
            background: #4361ee;
            border: none;
            transition: all 0.3s ease;
            padding: 8px 15px;
            box-shadow: 0 2px 4px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            background: #3046c5;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.4);
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            transition: all 0.3s ease;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.8);
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(108, 117, 125, 0.3);
        }

        .form-control {
            border: 1px solid #e9ecef;
            padding: 8px 12px;
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            background: rgba(255, 255, 255, 1);
        }

        .form-label {
            margin-bottom: 0.3rem;
            font-weight: 500;
        }

        .card img {
            transition: transform 0.3s ease;
        }

        .card img:hover {
            transform: scale(1.05);
        }
    </style>
@endsection
