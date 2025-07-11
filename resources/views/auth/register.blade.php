@extends('auth.app')

@section('content')
<div class="container text-center py-5">
    <h2 class="mb-4">📝 Register</h2>

    <form action="{{ route('register.submit') }}" method="POST" class="w-50 mx-auto mt-4">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        </div>
        <button class="btn btn-primary w-100">Register</button>
    </form>

    <p class="mt-3">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
    </p>
</div>
@endsection
