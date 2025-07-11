@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>🔍 Hasil Pencarian: <strong>{{ $keyword }}</strong></h3>

            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                🔙 Kembali ke Dashboard
            </a>
        </div>

        {{-- Form pencarian ulang --}}
        <form action="{{ route('search.results') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari game..." value="{{ $keyword }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        @if ($games->count())
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Developer</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $game)
                            <tr>
                                <td>
                                    @if ($game->gambar)
                                        <img src="{{ asset('storage/games/' . $game->gambar) }}" alt="{{ $game->judul }}" width="80">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $game->judul }}</td>
                                <td>{{ $game->kategori->nama }}</td>
                                <td>{{ $game->developer->name }}</td>
                                <td>{{ $game->tahun }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $games->withQueryString()->links() }}
        @else
            <div class="alert alert-warning">Tidak ada hasil ditemukan untuk <strong>{{ $keyword }}</strong>.</div>
        @endif
    </div>
@endsection
