@extends('admin.layouts.app')

@section('title', 'Edit Jenis Hewan')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Jenis Hewan</h2>

        <form action="{{ route('admin.DaftarJenisHewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                <input type="text" class="form-control" id="nama_jenis_hewan" name="nama_jenis_hewan"
                    value="{{ old('nama_jenis_hewan', $jenisHewan->nama_jenis_hewan) }}" required>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.DaftarJenisHewan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection