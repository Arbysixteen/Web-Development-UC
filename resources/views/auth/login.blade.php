@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card-custom p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="section-title mb-2">Welcome Back</h2>
                            <p class="text-secondary">Login to your account</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger-custom mb-4">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control form-control-custom" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="background: var(--bg-tertiary); border-color: var(--border-color); color: var(--text-secondary);">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control form-control-custom" id="password"
                                        name="password" placeholder="Enter your password" required>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label text-secondary" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-primary-custom w-100 py-2">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-secondary mb-0">
                                Don't have an account?
                                <a href="{{ route('register') }}" style="color: var(--accent-color);">Register here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .alert-danger-custom {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
            border-radius: 8px;
            padding: 1rem;
        }
    </style>
@endpush