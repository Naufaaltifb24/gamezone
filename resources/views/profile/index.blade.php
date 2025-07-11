@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-success">👤 Edit Profile</h2>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="card bg-body-tertiary shadow">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email (tidak dapat diubah)</label>
                    <input type="email" value="{{ $user->email }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button class="btn btn-primary">Simpan Perubahan</button>

                <!-- Tombol Kembali -->
                <div class="text-start mt-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
