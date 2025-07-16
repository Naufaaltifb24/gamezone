@extends('auth.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="text-center w-100" style="max-width: 400px;">
        <h2 class="mb-4">🔐 Login</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-success w-100">Login</button>
        </form>

        <p class="mt-3">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection
