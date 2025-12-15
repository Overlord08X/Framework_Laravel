@extends('dokter.layouts.lte.main')

@section('content')
<div class="container">

    <h2>Detail Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h2>
    <a href="{{ route('dokter.rekam-medis.index') }}">&larr; Kembali</a>

    <div class="card mt-3 p-3">
        <p><strong>Waktu Dibuat:</strong> {{ $rekamMedis->created_at }}</p>
        <p><strong>Dokter Pemeriksa:</strong> {{ $rekamMedis->dokter_pemeriksa }}</p>

        <hr>

        <p><strong>Anamnesa:</strong></p>
        <p>{!! nl2br(e($rekamMedis->anamnesa)) !!}</p>

        <p><strong>Temuan Klinis:</strong></p>
        <p>{!! nl2br(e($rekamMedis->temuan_klinis)) !!}</p>

        <p><strong>Diagnosa:</strong></p>
        <p>{!! nl2br(e($rekamMedis->diagnosa)) !!}</p>
    </div>

    <hr>

    <h3>Tindakan Terapi</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Deskripsi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailList as $d)
                <tr>
                    <td>{{ $d->kode }}</td>
                    <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                    <td>{!! nl2br(e($d->detail)) !!}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada tindakan terapi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
