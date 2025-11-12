@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Kategori</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.DaftarKategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                    placeholder="Masukkan nama kategori" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.DaftarKategori.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection