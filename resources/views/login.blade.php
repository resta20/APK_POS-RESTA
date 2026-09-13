@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    body {
        min-height: 100vh;
        background: linear-gradient(160deg, #FDF8F0 0%, #EFE7DF 50%, #E5DCD3 100%);
        background-attachment: fixed;
    }

    .login-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 100%;
        max-width: 360px;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 6px 20px rgba(74, 63, 53, 0.1);
    }

    .login-title {
        font-family: 'Fredoka', sans-serif;
        font-weight: 600;
        font-size: 1.5rem;
        color: #4A3F35;
        margin-bottom: 4px;
        text-align: center;
    }

    .login-badge {
        display: block;
        text-align: center;
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .login-subtitle {
        color: #8A7D72;
        font-size: 0.85rem;
        margin-bottom: 24px;
    }

    .login-card .form-label {
        color: #6B5F54;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .login-card .form-control {
        border: 1px solid rgba(229, 220, 211, 0.9);
        border-radius: 6px;
        padding: 10px 12px;
        background: rgba(255, 255, 255, 0.55);
    }

    .login-card .form-control:focus {
        border-color: #B98A8F;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 0 0.2rem rgba(185, 138, 143, 0.15);
    }

    .btn-login {
        background-color: rgba(185, 138, 143, 0.95);
        border: none;
        border-radius: 6px;
        color: #FFF;
        font-weight: 500;
        padding: 10px 0;
    }

    .btn-login:hover {
        background-color: #A3767B;
        color: #FFF;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 42px;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 4px;
        color: #8A7D72;
        cursor: pointer;
        line-height: 0;
    }

    .password-toggle:hover {
        color: #6B5F54;
    }
</style>

<div class="login-wrap">
    <div class="card login-card shadow-sm">
        <div class="card-body p-4">
            <span class="login-badge"></span>
            <h5 class="login-title">Login</h5>
            <p class="login-subtitle text-center"></p>


            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="username" placeholder="Masukkan email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" class="form-control" autocomplete="current-password" placeholder="Masukkan password">
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Tampilkan password">
                            <svg id="eyeIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login w-100">Masuk</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.86 21.86 0 0 1 5.06-6.06M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a21.86 21.86 0 0 1-3.22 4.5M14.12 14.12a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    });
</script>

@endsection