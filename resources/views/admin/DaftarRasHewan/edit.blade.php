@extends('admin.layouts.lte.main')

@section('title', 'Edit Ras Hewan')

@section('content')
<div class="container mt-4">
    <h4>Edit Ras Hewan</h4>

    <form action="{{ route('admin.DaftarRasHewan.update', $rashewan->idras_hewan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_ras" class="form-label">Nama Ras <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama_ras') is-invalid @enderror" id="nama_ras" name="nama_ras"
                value="{{ old('nama_ras', $rashewan->nama_ras) }}" required>
            @error('nama_ras')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
            <select class="form-select @error('idjenis_hewan') is-invalid @enderror" name="idjenis_hewan" id="idjenis_hewan" required>
                <option value="">-- Pilih Jenis Hewan --</option>
                @foreach ($JenisHewan as $jenis)
                <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan', $rashewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                    {{ $jenis->nama_jenis_hewan }}
                </option>
                @endforeach
            </select>
            @error('idjenis_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.DaftarRasHewan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection