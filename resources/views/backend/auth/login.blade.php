@extends('backend.auth.auth_master')

@section('auth_title')
    Login | Bromindo V2
@endsection

@section('auth-content')
    <style>
        /* CSS tambahan untuk pusatkan card */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Tinggi penuh layar */
            background-color: #f5f6f7; /* Warna latar belakang opsional */
        }

        .login-card {
            width: 100%;
            max-width: 400px; /* Maksimal lebar card */
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .login-card .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 100px; /* Ukuran logo */
            height: auto;
        }

        .submit-btn-area button {
            width: 100%;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn-area button:hover {
            background-color: #0056b3;
        }

        /* .form-gp label {
            font-weight: bold;
        } */

        .form-gp input {
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
        }
    </style>

    <div class="login-container">
        <div class="login-card">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <!-- <img src="{{ asset('images/bromindo.jpg') }}" alt="Logo" class="logo"> -->
                <h4 class="text-center mb-4">Login to your account</h4>
                @include('backend.layouts.partials.messages')

                <div class="form-gp mb-3">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-gp mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="submit-btn-area mt-4">
                    <button type="submit">Sign In <i class="ti-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection
