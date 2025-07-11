@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="text-success">👨‍💻 Daftar Developer</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('developers.create') }}" class="btn btn-primary">+ Tambah Developer</a>
        <input type="text" id="searchDeveloper" class="form-control w-25" placeholder="Cari developer...">
    </div>
    <div id="developerTable">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($developers as $dev)
                <tr>
                    <td>{{ $loop->iteration + ($developers->currentPage() - 1) * $developers->perPage() }}</td>
                    <td>{{ $dev->name }}</td>
                    <td>
                        <a href="{{ route('developers.edit', $dev->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('developers.destroy', $dev->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3">Tidak ada data ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $developers->withQueryString()->links() }}
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#searchDeveloper').on('keyup', function () {
        let keyword = $(this).val();
        $.get("{{ route('developers.index') }}", { search: keyword }, function (res) {
            $('#developerTable').html($(res).find('#developerTable').html());
        });
    });
</script>
@endpush
