@extends('admin.layouts.lte.main')

@section('title', 'Tambah Role')

@section('content')
<div class="container mt-4">
    <h4>Tambah Role</h4>

    <form action="{{ route('admin.DaftarRole.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_role" class="form-label">Nama Role <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama_role') is-invalid @enderror" id="nama_role" name="nama_role"
                value="{{ old('nama_role') }}" placeholder="Masukkan nama role" required>
            @error('nama_role')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.DaftarRole.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection