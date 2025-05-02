@extends('layout/aplikasi')

@section('konten')

<style>
    body {
        background-color: #1c1c1c;
        color: white;
    }

    .register-container {
        max-width: 400px;
        margin: 80px auto;
        background-color: #2c2c2c;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    .register-container h1 {
        text-align: center;
        margin-bottom: 25px;
        color: yellowgreen;
    }

    .form-label {
        color: white;
    }

    .form-control {
        background-color: #444;
        color: white;
        border: none;
        border-radius: 8px;
    }

    .form-control:focus {
        background-color: #444;
        color: white;
        box-shadow: 0 0 0 2px yellowgreen;
        border: none;
    }

    .btn-register {
        background-color: yellowgreen;
        border: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-register:hover {
        background-color: #9acd32;
    }

    .alert {
        background-color: #ff4c4c;
        color: white;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 8px;
    }
    .register-link a {
        color: yellowgreen;
        text-decoration: none;
    }

    .register-link a:hover {
        color: #9acd32;
        text-decoration: underline;
    }
</style>

<div class="register-container">
    <h1>Register</h1>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/sesi/create" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" value="{{ old('name') }}" name="name" class="form-control" required>
        </div>
        <br>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="{{ old('email') }}" name="email" class="form-control" required>
        </div>
        <br>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <br>
        <div class="mb-3 d-grid">
            <button name="submit" type="submit" class="btn btn-register btn-block">Register</button>
        </div>
    </form>
    <div class="register-link">
        <span><a href="/sesi">Sudah punya akun?</a></span>
    </div>
</div>

@endsection
