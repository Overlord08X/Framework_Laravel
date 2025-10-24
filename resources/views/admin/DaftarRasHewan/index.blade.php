@extends('site.layouts.app')

@section('title', 'Daftar Ras Hewan')

@section('content')
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ras Hewan</th>
            <th>Nama Jenis Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($RasHewan as $index => $rashewan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $rashewan->nama_ras }}</td>
            <td>{{ $rashewan->jenishewan->nama_jenis_hewan }}</td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection