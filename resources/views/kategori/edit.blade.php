@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="text-success">✏️ Edit Kategori</h2>
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control" required>
        </div>
        <button class="btn btn-success">Perbarui</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

