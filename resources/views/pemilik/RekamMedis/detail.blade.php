@extends('pemilik.layouts.lte.main')

@section('title', 'Detail Rekam Medis')

@section('content')
<br>

<div class="card mb-3">
    <div class="card-header">
        <strong>Informasi Rekam Medis</strong>
    </div>
    <div class="card-body">
        <p><strong>Anamnesa:</strong> {{ $rekamMedis->anamnesa }}</p>
        <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong>Detail Tindakan / Terapi</strong>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail as $d)
                <tr>
                    <td>{{ $d->kode }}</td>
                    <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $d->nama_kategori_klinis }}</td>
                    <td>{{ $d->detail }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada detail tindakan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
