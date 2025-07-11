@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success">➕ Tambah Game Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan pada input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Judul -->
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Game</label>
            <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
        </div>

        <!-- Kategori -->
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Developer -->
        <div class="mb-3">
            <label for="developer_id" class="form-label">Developer</label>
            <select name="developer_id" class="form-control" required>
                <option value="">-- Pilih Developer --</option>
                @foreach($developers as $dev)
                    <option value="{{ $dev->id }}" {{ old('developer_id') == $dev->id ? 'selected' : '' }}>
                        {{ $dev->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tahun -->
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun" class="form-control" value="{{ old('tahun') }}" required>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
