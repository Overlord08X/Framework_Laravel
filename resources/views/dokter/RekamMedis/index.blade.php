@extends('dokter.layouts.lte.main')

@section('content')

<div class="container">

    <h2>Daftar Semua Rekam Medis</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($allRekamMedis->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID RM</th>
                    <th>Waktu</th>
                    <th>Anamnesa</th>
                    <th>Diagnosa</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allRekamMedis as $rm)
                    <tr>
                        <td>{{ $rm->idrekam_medis }}</td>
                        <td>{{ $rm->created_at }}</td>
                        <td>{{ Str::limit($rm->anamnesa, 70) }}</td>
                        <td>{{ Str::limit($rm->diagnosa, 70) }}</td>
                        <td>{{ $rm->dokter_pemeriksa }}</td>
                        <td>
                            <a href="{{ route('dokter.RekamMedis.show', $rm->idrekam_medis) }}">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada rekam medis yang tercatat.</p>
    @endif

</div>
@endsection
