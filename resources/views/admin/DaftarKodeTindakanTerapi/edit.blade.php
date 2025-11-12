@extends('admin.layouts.app')

@section('title', 'Edit Kode Tindakan Terapi')

@section('content')
<div class="card">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0">Edit Kode Tindakan Terapi</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.DaftarKodeTindakanTerapi.update', $KodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ $KodeTindakanTerapi->kode }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi Tindakan Terapi</label>
                <textarea class="form-control" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" rows="3" required>{{ $KodeTindakanTerapi->deskripsi_tindakan_terapi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="idkategori" class="form-label">Kategori</label>
                <select name="idkategori" id="idkategori" class="form-select" required>
                    @foreach ($Kategori as $kategori)
                    <option value="{{ $kategori->idkategori }}" {{ $KodeTindakanTerapi->idkategori == $kategori->idkategori ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="idkategori_klinis" class="form-label">Kategori Klinis</label>
                <select name="idkategori_klinis" id="idkategori_klinis" class="form-select" required>
                    @foreach ($KategoriKlinis as $kategoriKlinis)
                    <option value="{{ $kategoriKlinis->idkategori_klinis }}" {{ $KodeTindakanTerapi->idkategori_klinis == $kategoriKlinis->idkategori_klinis ? 'selected' : '' }}>
                        {{ $kategoriKlinis->nama_kategori_klinis }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.DaftarKodeTindakanTerapi.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection