@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="text-success">✏️ Edit Developer</h2>
    <form action="{{ route('developers.update', $developer->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Developer</label>
            <input type="text" name="name" class="form-control" value="{{ $developer->name }}" required>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('developers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection