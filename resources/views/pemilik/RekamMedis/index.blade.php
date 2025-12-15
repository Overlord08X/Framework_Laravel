@extends('pemilik.layouts.lte.main')

@section('title', 'Rekam Medis')

@section('content')
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pet</th>
            <th>Dokter</th>
            <th>Diagnosa</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rekamMedis as $index => $rm)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $rm->created_at }}</td>
            <td>{{ $rm->nama_pet }}</td>
            <td>{{ $rm->nama_dokter }}</td>
            <td>{{ $rm->diagnosa }}</td>
            <td>
                <a href="{{ route('pemilik.RekamMedis.detail', $rm->idrekam_medis) }}"
                   class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i> Detail
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada rekam medis</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
