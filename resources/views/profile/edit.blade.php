@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<section class="py-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h1 class="section-title mb-1"><i class="bi bi-person-circle me-2"></i>Edit Profile</h1>
                    <p class="text-secondary mb-0">Update your account information</p>
                </div>

                <div class="card-custom p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="mb-4">Personal Information</h5>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control form-control-custom @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control form-control-custom @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="border-color: var(--border-color);" class="my-4">

                        <h5 class="mb-4">Change Password <small class="text-secondary">(Optional)</small></h5>

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control form-control-custom @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control form-control-custom @error('new_password') is-invalid @enderror" 
                                   id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control form-control-custom" 
                                   id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="bi bi-check-circle me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-custom">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
