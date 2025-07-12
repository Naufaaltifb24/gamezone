@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-warning">✏️ Edit Game</h2>

    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Game</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $game->judul) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $game->kategori_id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Developer</label>
            <select name="developer_id" class="form-select" required>
                @foreach ($developers as $developer)
                    <option value="{{ $developer->id }}" {{ $developer->id == $game->developer_id ? 'selected' : '' }}>
                        {{ $developer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $game->tahun) }}" min="1980" max="2099">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $game->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Game</label>
            @if ($game->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/app/public/games/' . $game->gambar) }}" width="100" class="img-thumbnail">
                </div>
            @endif
            <input type="file" name="gambar" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection