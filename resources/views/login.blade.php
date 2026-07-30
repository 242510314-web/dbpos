<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai title -->
@section('title', 'Login POS')

<!-- batas isi konten -->
@section('content')

<style>
    body{
        background: linear-gradient(135deg, #EEF5FF, #DCEEFF, #F8FBFF);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card{
        width: 420px;
        border: none;
        border-radius: 25px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 15px 35px rgba(0, 123, 255, .15);
    }

    .login-header{
        background: #CFE8FF;
        padding: 30px;
        text-align: center;
    }

    .logo{
        width: 80px;
        height: 80px;
        margin: auto;
        background: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 38px;
        box-shadow: 0 5px 15px rgba(0,0,0,.08);
    }

    .login-header h2{
        margin-top: 15px;
        color: #355C7D;
        font-weight: bold;
    }

    .login-header p{
        color: #6c757d;
        margin-bottom: 0;
        font-size: 14px;
    }

    .card-body{
        padding: 35px;
    }

    .form-label{
        color: #355C7D;
        font-weight: 600;
    }

    .form-control{
        height: 48px;
        border-radius: 12px;
        border: 1px solid #d6e8ff;
        background: #f8fbff;
    }

    .form-control:focus{
        border-color: #7BB8FF;
        background: white;
        box-shadow: 0 0 0 .2rem rgba(123,184,255,.25);
    }

    .btn-login{
        width: 100%;
        height: 48px;
        border: none;
        border-radius: 12px;
        background: #8CC8FF;
        color: white;
        font-size: 17px;
        font-weight: bold;
        transition: .3s;
    }

    .btn-login:hover{
        background: #6FB6F5;
        transform: translateY(-2px);
    }

    .badge{
        margin-top: 6px;
    }

    .footer-text{
        text-align: center;
        margin-top: 20px;
        color: #9aa5b1;
        font-size: 13px;
    }
</style>

<div class="card login-card position-absolute top-50 start-50 translate-middle">

    <div class="login-header">

        <div class="logo">
            🛒
        </div>

        <h2>Login POS</h2>
        <p>Silakan masuk ke akun Anda</p>

    </div>

    <div class="card-body">

        <form action="{{ route('auth') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    placeholder="Masukkan email">

                @error('email')
                    <div class="badge text-bg-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    placeholder="Masukkan password">

                @error('password')
                    <div class="badge text-bg-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login">
                Login
            </button>

        </form>

        <div class="footer-text">
            © 2026 Point Of Sales System
        </div>

    </div>

</div>

@endsection