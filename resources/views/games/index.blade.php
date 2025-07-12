@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success">🎮 Daftar Game</h2>

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('games.create') }}" class="btn btn-primary">+ Tambah Game</a>
        <input type="text" id="searchGame" class="form-control w-25" placeholder="🔍 Cari game...">
    </div>

    <div id="gameTable">
        <table class="table table-bordered table-hover bg-body-tertiary">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Game</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    <tr>
                        <td>{{ $loop->iteration + ($games->currentPage() - 1) * $games->perPage() }}</td>
                        <td>
                            @if($game->gambar)
                                <img src="{{ asset('storage/app/public/games/' . $game->gambar) }}" width="60" alt="Gambar Game">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $game->judul }}</td>
                        <td>{{ $game->kategori->nama }}</td>
                        <td>
                            <a href="{{ route('games.edit', $game->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('games.show', $game->id) }}" class="btn btn-sm btn-info">Detail</a>
                            <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada game ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $games->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#searchGame').on('keyup', function () {
        let keyword = $(this).val();
        $.ajax({
            url: "{{ route('games.index') }}",
            type: 'GET',
            data: { search: keyword },
            success: function (res) {
                $('#gameTable').html($(res).find('#gameTable').html());
            }
        });
    });
</script>
@endpush
