@extends('pemilik.layouts.lte.main')

@section('title', 'Jadwal Temu Dokter')

@section('content')
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pet</th>
            <th>No Antrian</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Resepsionis</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jadwal as $index => $j)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $j->nama_pet }}</td>
            <td>{{ $j->no_urut }}</td>
            <td>{{ $j->waktu_daftar }}</td>
            <td>
                @if($j->status == 'N')
                    <span class="badge badge-warning">Menunggu</span>
                @elseif($j->status == 'S')
                    <span class="badge badge-success">Selesai</span>
                @else
                    <span class="badge badge-secondary">-</span>
                @endif
            </td>
            <td>{{ $j->nama_resepsionis ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada jadwal</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
