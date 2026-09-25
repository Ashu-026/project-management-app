<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LOGIN')</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @vite(['resources/js/login.js'])
</head>


<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark shadow py-2" style="background: linear-gradient(135deg, #811d95 0%, #7c3aed 100%); border-bottom: 2px solid #a78bfa;">
            <div class="container align-items-center justify-content-center">
                <a class="navbar-brand fw-bolder text-light fs-2" href="login.php">
                    <i class="bi bi-kanban-fill text-light me-2"></i>Project-Managment-App
                </a>
            </div>
        </nav>
    </header>
    <main class="container flex-grow-1 d-flex align-items-center  py-5">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card border-0 rounded-4 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex bg-info bg-opacity-25 text-primary rounded-circle p-3 mb-3">
                                <i class="bi bi-person-lock fs-1"></i>
                            </div>
                            <h1 class="h2 fw-bold">Welcome!</h1>
                            <p class="text-secondary">
                                Login to manage your projects and tasks
                            </p>
                        </div>
                        <!-- error  -->
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- Login Form -->
                        <form id="loginForm" method="POST" action="/login" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label fw-semibold">
                                    Email Address
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="loginEmail"
                                        class="form-control form-control-lg"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <small id="login-email-error" class="text-danger"></small>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label fw-semibold">
                                    Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="loginPassword"
                                        class="form-control form-control-lg"
                                        placeholder="Enter your password" required>

                                    <button type="button" class="btn btn-outline-secondary" id="showLoginPassword">
                                        <i class="bi bi-eye" id="loginEyeIcon"></i>
                                    </button>
                                </div>
                                <small id="login-password-error" class="text-danger"></small>
                            </div>
                            <button type="submit" name="login"
                                class="btn  btn-lg w-100 fw-semibold" style="color: #fbfafc; background-color: #7c3aed;">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                            <button
                                type="button"
                                id="showRegisterBtn"
                                class="btn  btn-lg mt-2 w-100 border-dark fw-semibold">
                                Register
                            </button>
                        </form>
                        <!-- Register User Modal -->
                        <form id="registerForm" method="POST" class="d-none" action="/register" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="registerName" class="form-label fw-semibold">
                                    Name
                                </label>
                                <input type="text" id="registerName" name="name" class="form-control form-control-lg" value="{{ old('name')}}" placeholder="Enter your name" autocomplete="name" required>
                                @error('name')

                                <small id="register-name-error" class="text-danger">{{$message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label fw-semibold">
                                    Email Address
                                </label>
                                <input type="email" id="registerEmail" name="email" class="form-control form-control-lg" placeholder="Enter your email" autocomplete="email" required>
                                <small id="register-email-error" class="text-danger"></small>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label fw-semibold">
                                    New Password
                                </label>
                                <input type="password" id="registerPassword" name="password" class="form-control form-control-lg" placeholder="Create a password" autocomplete="new-password" required>
                                <small id="register-password-error" class="text-danger"></small>
                            </div>
                            <div class="mb-3">
                                <label for="registerConfirmPassword" class="form-label fw-semibold">
                                    Confirm Password
                                </label>
                                <input type="password" id="registerConfirmPassword" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm your password" autocomplete="new-password" required>
                                <small id="register-confirm-password-error" class="text-danger"></small>
                            </div>
                            <button type="submit" name="register" class="btn  btn-lg w-100 fw-semibold" style="color: #fbfafc; background-color: #7c3aed;">
                                Register
                            </button>
                            <button type="button" id="showLoginBtn" class="btn btn-link w-100 mt-2 text-decoration-none"> Already have an account? Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>