@extends('admin.layouts.lte.main')

@section('title', 'Tambah Pet')

@section('content')
<div class="container mt-4">
    <h4>Tambah Pet</h4>

    <form action="{{ route('admin.DaftarPet.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pet <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                id="nama" name="nama" value="{{ old('nama') }}"
                placeholder="Masukkan nama pet" required>
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                id="tanggal_lahir" name="tanggal_lahir"
                value="{{ old('tanggal_lahir') }}" required>
            @error('tanggal_lahir')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="warna_tanda" class="form-label">Warna / Tanda</label>
            <input type="text" class="form-control @error('warna_tanda') is-invalid @enderror"
                id="warna_tanda" name="warna_tanda"
                value="{{ old('warna_tanda') }}" placeholder="Masukkan warna atau tanda pet">
            @error('warna_tanda')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="M" {{ old('jenis_kelamin') == 'M' ? 'selected' : '' }}>Jantan</option>
                <option value="F" {{ old('jenis_kelamin') == 'F' ? 'selected' : '' }}>Betina</option>
            </select>
            @error('jenis_kelamin')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- PEMILIK --}}
        <div class="mb-3">
            <label for="idpemilik" class="form-label">Pemilik <span class="text-danger">*</span></label>
            <select class="form-select @error('idpemilik') is-invalid @enderror"
                name="idpemilik" id="idpemilik" required>
                <option value="">-- Pilih Pemilik --</option>

                @foreach ($pemilik as $p)
                <option value="{{ $p->idpemilik }}"
                    {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
                @endforeach

            </select>
            @error('idpemilik')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- RAS HEWAN --}}
        <div class="mb-3">
            <label for="idras_hewan" class="form-label">Ras Hewan <span class="text-danger">*</span></label>
            <select class="form-select @error('idras_hewan') is-invalid @enderror"
                name="idras_hewan" id="idras_hewan" required>
                <option value="">-- Pilih Ras Hewan --</option>

                @foreach ($rasHewan as $ras)
                <option value="{{ $ras->idras_hewan }}"
                    {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                    {{ $ras->nama_ras }} ({{ $ras->nama_jenis }})
                </option>
                @endforeach

            </select>
            @error('idras_hewan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.DaftarPet.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>

    </form>
</div>
@endsection