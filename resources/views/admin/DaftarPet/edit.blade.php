@extends('admin.layouts.app')

@section('title', 'Edit Pet')

@section('content')
<div class="container mt-4">
    <h4>Edit Pet</h4>

    <form action="{{ route('admin.DaftarPet.update', $pet->idpet) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pet</label>
            <input type="text" class="form-control" id="nama" name="nama"
                value="{{ old('nama', $pet->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label for="warna_tanda" class="form-label">Warna / Tanda</label>
            <input type="text" class="form-control" id="warna_tanda" name="warna_tanda"
                value="{{ old('warna_tanda', $pet->warna_tanda) }}">
        </div>

        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                <option value="M" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'M' ? 'selected' : '' }}>Jantan</option>
                <option value="F" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'F' ? 'selected' : '' }}>Betina</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idpemilik" class="form-label">Pemilik</label>
            <select class="form-select" name="idpemilik" id="idpemilik">
                @foreach ($Pemilik as $pemilik)
                <option value="{{ $pemilik->idpemilik }}"
                    {{ old('idpemilik', $pet->idpemilik) == $pemilik->idpemilik ? 'selected' : '' }}>
                    {{ $pemilik->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="idras_hewan" class="form-label">Ras Hewan</label>
            <select class="form-select" name="idras_hewan" id="idras_hewan">
                @foreach ($RasHewan as $ras)
                <option value="{{ $ras->idras_hewan }}"
                    {{ old('idras_hewan', $pet->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>
                    {{ $ras->nama_ras }} ({{ $ras->nama_jenis_hewan }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="text-end">
            <a href="{{ route('admin.DaftarPet.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection