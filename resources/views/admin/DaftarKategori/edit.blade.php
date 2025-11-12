@extends('admin.layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Kategori</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.DaftarKategori.update', $kategori->idkategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.DaftarKategori.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection