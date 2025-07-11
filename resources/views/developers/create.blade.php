@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="text-success">➕ Tambah Developer</h2>
    <form action="{{ route('developers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Developer</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('developers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
