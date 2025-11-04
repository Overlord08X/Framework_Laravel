@extends('admin.layouts.app')

@section('title', 'Daftar Kategori Klinis')

@section('content')
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($KategoriKlinis as $index => $kategoriklinis)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kategoriklinis->nama_kategori_klinis }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection