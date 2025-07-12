@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold text-success">🎮 Selamat Datang di GameZone</h2>
        <p class="text-muted">Kelola game, kategori, dan developer dengan lebih mudah dan cepat!</p>
    </div>

    @if($recentGames->count())
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <strong><i class="bi bi-stars"></i> Game Terbaru</strong>
    </div>
    <div class="card-body">
        <div id="gameCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($recentGames as $index => $game)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                @if($game->gambar)
                                    <img src="{{ asset('storage/app/public/games/' . $game->gambar) }}" class="img-fluid rounded" style="max-height: 250px;" alt="{{ $game->judul }}">
                                @else
                                    <img src="https://via.placeholder.com/300x250?text=No+Image" class="img-fluid rounded" alt="No Image">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $game->judul }}</h4>
                                <p class="mb-1"><strong>Kategori:</strong> {{ $game->kategori->nama ?? '-' }}</p>
                                <p class="mb-1"><strong>Developer:</strong> {{ $game->developer->name ?? '-' }}</p>
                                <p class="mb-1"><strong>Tahun:</strong> {{ $game->tahun }}</p>
                                <p>{{ $game->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                <a href="{{ route('games.show', $game->id) }}" class="btn btn-sm btn-success">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#gameCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#gameCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</div>
@endif


    <form action="{{ route('dashboard') }}" method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="🔍 Nama Game..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="kategori_id" class="form-select">
            <option value="">📂 Semua Kategori</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="developer_id" class="form-select">
            <option value="">👨‍💻 Semua Developer</option>
            @foreach ($developers as $dev)
                <option value="{{ $dev->id }}" {{ request('developer_id') == $dev->id ? 'selected' : '' }}>
                    {{ $dev->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Cari 🔍</button>
    </div>
</form>

@if(request()->has('search') || request()->has('kategori_id') || request()->has('developer_id'))
    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <h5>Hasil Pencarian ({{ $filteredGames->count() }})</h5>
            <ul class="list-group list-group-flush mt-2">
                @forelse($filteredGames as $game)
                    <li class="list-group-item">
                        <strong>{{ $game->judul }}</strong> -
                        {{ $game->kategori->nama ?? '-' }} | 
                        {{ $game->developer->name ?? '-' }}
                    </li>
                @empty
                    <li class="list-group-item">Tidak ditemukan hasil</li>
                @endforelse
            </ul>
        </div>
    </div>
@endif

    <div class="recent-activity mt-5">
    <h4>🔔 Aktivitas Terbaru</h4>
    <ul class="list-group">
        @foreach ($recentLogs as $log)
<div class="activity-item d-flex justify-content-between align-items-center">
    <div>
        <strong>{{ $log->user->name ?? 'Guest' }}:</strong>
        <span>{{ $log->aktivitas }}</span>
    </div>
    <form action="{{ route('logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus log ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger">🗑️</button>
    </form>
</div>
@endforeach

    </ul>
</div>

@if($gamesPerKategori->count())
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        🎮 Jumlah Game per Genre
    </div>
    <div class="card-body">
        <div class="row">
            @foreach($gamesPerKategori as $kategori)
            <div class="col-md-4 mb-2">
                <a href="{{ route('search.results', ['search' => $kategori->nama]) }}" class="text-decoration-none">
                    <div class="border rounded px-3 py-2 d-flex justify-content-between align-items-center hover-shadow bg-light">
                        <span class="fw-bold">{{ $kategori->nama }}</span>
                        <span class="badge bg-success">{{ $kategori->total }} game</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif


    <div class="recent-activity mt-5">
    <h4>🆕 Daftar Game Terbaru</h4>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Developer</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentGames as $game)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $game->judul }}</td>
                        <td>{{ $game->kategori->nama }}</td>
                        <td>{{ $game->developer->name }}</td>
                        <td>{{ $game->tahun }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada game yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



</div>
@endsection
