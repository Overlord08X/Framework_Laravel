@extends('site.layouts.app')

@section('title', 'Daftar Pet')

@section('content')
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pet</th>
            <th>Tanggal Lahir Pet</th>
            <th>Warna atau Tanda Pet</th>
            <th>Jenis Kelamin Pet</th>
            <th>Pemilik Pet</th>
            <th>Ras Pet</th>
            <th>Jenis Pet</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Pet as $index => $pet)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pet->nama }}</td>
            <td>{{ $pet->tanggal_lahir }}</td>
            <td>{{ $pet->warna_tanda }}</td>
            <td>{{ $pet->jenis_kelamin }}</td>
            <td>{{ $pet->pemilik->user->nama }}</td>
            <td>{{ $pet->rashewan->nama_ras }}</td>
            <td>{{ $pet->rashewan->jenishewan->nama_jenis_hewan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection