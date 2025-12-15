@extends('perawat.layouts.lte.main')

@section('title', 'Daftar Reservasi')

@section('content')
<br>

<div class="container">
    <h2>Daftar Reservasi Hari Ini</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No. Urut</th>
                <th>Nama Pasien</th>
                <th>Pemilik</th>
                <th>Dokter</th>
                <th>Status Rekam Medis</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservasi as $row)
                <tr>
                    <td>{{ $row->no_urut }}</td>
                    <td>{{ $row->nama_pet }}</td>
                    <td>{{ $row->nama_pemilik }}</td>
                    <td>{{ $row->nama_dokter }}</td>
                    <td>
                        {{ $row->idrekam_medis ? 'Sudah Dibuat' : 'Belum Dibuat' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Tidak ada reservasi untuk hari ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
