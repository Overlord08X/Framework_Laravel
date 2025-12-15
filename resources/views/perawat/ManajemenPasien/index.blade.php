@extends('perawat.layouts.lte.main')

@section('title', 'Manajemen Pasien')

@section('content')
<br>

<div class="mb-3">
    <p>
        Di sini Anda dapat mengelola data pasien (pet).
        Untuk menambah, mengedit, atau menghapus data, silakan hubungi Administrator.
    </p>
</div>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pasien</th>
            <th>Jenis Hewan</th>
            <th>Ras</th>
            <th>Pemilik</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($manajemenPasien as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nama_jenis_hewan }}</td>
                <td>{{ $row->nama_ras }}</td>
                <td>{{ $row->nama_pemilik }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data pasien.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
