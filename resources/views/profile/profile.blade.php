@extends('layouts.app')

@section('title', ' Profile')
@vite(['resources/js/profile.js'])
@section('content')

<div class="container-fluid px-0 mt-4">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="
                    background-image: url('{{ asset('images/profile1.jpeg') }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;">
                    
                <div class="card-body text-center p-4 text-white">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25" style="width: 100px; height: 100px;">
                        <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                    </div>
                    <h2 class="mt-2 mb-1 fw-bold">{{ $user->name }}</h2>
                    <p class="mb-3" style="opacity: 0.85;">
                        <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                    </p>
                    <span class="badge bg-white text-primary text-capitalize px-3 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-shield-check me-1"></i>{{ $user->role ?? 'User' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border-0  shadow " style="background-color: #FAF9F6;">
                <div class="card-body text-dark p-4">
                    <h3 class="mb-1">Profile settings</h3>
                    <p class="text-dark mb-4">Update your account details.</p>
                    <form id="profileForm" method="POST" action="{{ route('profile.update' )}}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="profileName" class="form-label">Full name</label>
                            <input type="text" id="profileName" name="name" class="form-control" value="{{ $user->name }}" required>
                            <small id="profile-name-error" class="text-danger"></small>
                        </div>
                        <div class="mb-3">
                            <label for="profileEmail" class="form-label">Email address</label>
                            <input type="email" id="profileEmail" name="email" class="form-control" value="{{ $user->email }}" required>
                            <small id="profile-email-error" class="text-danger"></small>
                        </div>
                        <hr class="my-4">
                        <h5>Change password</h5>
                        <p class="text-dark small">Leave both password fields blank to keep your current password.</p>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New password</label>
                            <input type="password" id="newPassword" name="new_password" class="form-control" minlength="6" autocomplete="new-password">
                            <small id="profile-password-error" class="text-danger"></small>
                        </div>
                        <div class="mb-4">
                            <label for="confirmNewPassword" class="form-label">Confirm new password</label>
                            <input type="password" id="confirmNewPassword" name="confirm_new_password" class="form-control" minlength="6" autocomplete="new-password">
                            <small id="profile-confirm-password-error" class="text-danger"></small>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <button type="submit" class="btn" style="color: #7c3aed; background-color: #ffffff; border: 1px solid #7c3aed;">
                                <i class="bi bi-check2-circle me-1"></i>Save changes
                            </button>
                            <a href="/dashboard" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>.profile-card {
    background-image: url('/images/profile1.jpeg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}</style>
@endsection