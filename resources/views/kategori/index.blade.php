@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-success">📁 Daftar Kategori</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <!-- Search Input -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari kategori...">
        </div>
    </div>

    <!-- Tabel dan Pagination -->
    <div id="kategoriTable">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $kategoris->withQueryString()->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#searchInput').on('keyup', function () {
        let keyword = $(this).val();
        $.ajax({
            url: '{{ route("kategori.index") }}',
            type: 'GET',
            data: { search: keyword },
            success: function (data) {
                // Ambil isi <div id="kategoriTable"> dari response
                let content = $('<div>').html(data).find('#kategoriTable').html();
                $('#kategoriTable').html(content);
            }
        });
    });
</script>
@endpush
