@extends('admin.layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Kategori as $index => $kategori)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kategori->nama_kategori }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection