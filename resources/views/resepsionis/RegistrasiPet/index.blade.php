@extends('resepsionis.layouts.lte.main')

@section('content')
@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp

<div class="container">
    <h1>Registrasi Pet</h1>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('resepsionis.RegistrasiPet.store') }}">
        @csrf

        <div class="form-group">
            <label>Nama Pet</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama') }}" required>
        </div>

        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control"
                   value="{{ old('tanggal_lahir') }}" required>
        </div>

        <div class="form-group">
            <label>Warna / Tanda Khas</label>
            <input type="text" name="warna_tanda" class="form-control"
                   value="{{ old('warna_tanda') }}">
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="M" {{ old('jenis_kelamin') == 'M' ? 'selected' : '' }}>Jantan</option>
                <option value="F" {{ old('jenis_kelamin') == 'F' ? 'selected' : '' }}>Betina</option>
            </select>
        </div>

        <div class="form-group">
            <label>Pemilik</label>
            <select name="idpemilik" class="form-control" required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach ($pemilikList as $pemilik)
                    <option value="{{ $pemilik->idpemilik }}"
                        {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>
                        {{ $pemilik->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Ras Hewan</label>
            <select name="idras_hewan" class="form-control" required>
                <option value="">-- Pilih Ras --</option>
                @foreach ($rasHewanList as $ras)
                    <option value="{{ $ras->idras_hewan }}"
                        {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                        {{ $ras->nama_ras }} ({{ $ras->nama_jenis_hewan }})
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Daftar</button>
        <a href="{{ route('resepsionis.dashboard-resepsionis') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
</div>
@endsection
