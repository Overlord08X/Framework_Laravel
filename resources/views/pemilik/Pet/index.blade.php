@extends('pemilik.layouts.lte.main')

@section('title', 'Daftar Pet')

@section('content')
<br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pet</th>
            <th>Jenis</th>
            <th>Ras</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Warna / Tanda</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pets as $index => $pet)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pet->nama }}</td>
            <td>{{ $pet->nama_jenis_hewan }}</td>
            <td>{{ $pet->nama_ras }}</td>
            <td>{{ $pet->jenis_kelamin }}</td>
            <td>{{ $pet->tanggal_lahir }}</td>
            <td>{{ $pet->warna_tanda }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Belum ada data pet</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
