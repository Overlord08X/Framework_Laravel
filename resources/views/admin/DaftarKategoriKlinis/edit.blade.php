@extends('admin.layouts.lte.main')

@section('title', 'Edit Kategori Klinis')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Kategori Klinis</h2>

    <form action="{{ route('admin.DaftarKategoriKlinis.update', $KategoriKlinis->idkategori_klinis) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis</label>
            <input type="text"
                class="form-control"
                id="nama_kategori_klinis"
                name="nama_kategori_klinis"
                value="{{ old('nama_kategori_klinis', $KategoriKlinis->nama_kategori_klinis) }}"
                required>
        </div>

        <div class="text-end">
            <a href="{{ route('admin.DaftarKategoriKlinis.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection