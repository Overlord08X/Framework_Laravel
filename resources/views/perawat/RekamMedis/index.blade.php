@extends('perawat.layouts.lte.main')

@section('title', 'Rekam Medis')

@section('content')
<br>

@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp

{{-- Flash Message --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM BUAT REKAM MEDIS --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Buat Rekam Medis</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('perawat.RekamMedis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Reservasi</label>
                <select name="idreservasi_dokter" class="form-control" required>
                    <option value="">-- Pilih Reservasi --</option>
                    @foreach ($daftarHariIni as $d)
                        <option value="{{ $d->idreservasi_dokter }}"
                            {{ old('idreservasi_dokter') == $d->idreservasi_dokter ? 'selected' : '' }}>
                            {{ $d->nama_pet }} ({{ $d->nama_pemilik }}) - No. Urut: {{ $d->no_urut }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Anamnesa</label>
                <textarea name="anamnesa" rows="4" class="form-control" required>{{ old('anamnesa') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Temuan Klinis</label>
                <textarea name="temuan_klinis" rows="4" class="form-control">{{ old('temuan_klinis') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea name="diagnosa" rows="4" class="form-control">{{ old('diagnosa') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Rekam Medis
            </button>

            <a href="{{ route('perawat.dashboard-perawat') }}" class="btn btn-secondary">
                Batal
            </a>
        </form>
    </div>
</div>

{{-- DAFTAR REKAM MEDIS --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Rekam Medis</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu</th>
                    <th>Anamnesa</th>
                    <th>Diagnosa</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Reservasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allRekamMedis as $index => $rm)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $rm->created_at }}</td>
                        <td>{{ Str::limit($rm->anamnesa, 50) }}</td>
                        <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                        <td>{{ $rm->dokter_pemeriksa }}</td>
                        <td>{{ $rm->idreservasi_dokter }}</td>
                        <td>
                            <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada rekam medis.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
