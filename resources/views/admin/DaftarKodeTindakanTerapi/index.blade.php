@extends('admin.layouts.app')

@section('title', 'Daftar Kode Tindakan Terapi')

@section('content')
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kode Tindakan Terapi</th>
            <th>Deskripsi Tindakan Terapi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($KodeTindakanTerapi as $index => $kodetindakanterapi)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kodetindakanterapi->kode }}</td>
            <td>{{ $kodetindakanterapi->deskripsi_tindakan_terapi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection