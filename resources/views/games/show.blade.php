@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success">📄 Detail Game</h2>

    <div class="card bg-body-tertiary shadow mt-3">
        <div class="row g-0">
            @if ($game->gambar)
    <div class="col-md-4">
        <img src="{{ asset('storage/app/public/games/' . $game->gambar) }}" class="img-fluid rounded-start" alt="{{ $game->judul }}">
    </div>
@endif
            <div class="col-md-8">
                <div class="card-body">
                    <h4>{{ $game->judul }}</h4>
                    <p><strong>Kategori:</strong> {{ $game->kategori->nama }}</p>
                    <p><strong>Developer:</strong> {{ $game->developer->name }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $game->tahun }}</p>
                    <p><strong>Deskripsi:</strong> {{ $game->deskripsi }}</p>
                    <a href="{{ route('games.index') }}" class="btn btn-secondary mt-3">⬅️ Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
