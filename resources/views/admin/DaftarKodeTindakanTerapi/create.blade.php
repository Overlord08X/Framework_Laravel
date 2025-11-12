@extends('admin.layouts.app')

@section('title', 'Tambah Kode Tindakan Terapi')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Tambah Kode Tindakan Terapi</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.DaftarKodeTindakanTerapi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan kode tindakan terapi" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi Tindakan Terapi</label>
                <textarea class="form-control" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" rows="3" placeholder="Masukkan deskripsi tindakan terapi" required></textarea>
            </div>

            <div class="mb-3">
                <label for="idkategori" class="form-label">Kategori</label>
                <select name="idkategori" id="idkategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($Kategori as $kategori)
                    <option value="{{ $kategori->idkategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="idkategori_klinis" class="form-label">Kategori Klinis</label>
                <select name="idkategori_klinis" id="idkategori_klinis" class="form-select" required>
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach ($KategoriKlinis as $kategoriKlinis)
                    <option value="{{ $kategoriKlinis->idkategori_klinis }}">{{ $kategoriKlinis->nama_kategori_klinis }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.DaftarKodeTindakanTerapi.index') }}" class="btn btn-secondary">
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