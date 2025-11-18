@extends('admin.layouts.app')

@section('title', 'Daftar Ras Hewan')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarRasHewan.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Ras Hewan
        </button>
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ras Hewan</th>
            <th>Jenis Hewan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($RasHewan as $index => $ras)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $ras->nama_ras }}</td>
            <td>{{ $ras->nama_jenis_hewan }}</td> {{-- FIX --}}
            <td>
                <form action="{{ route('admin.DaftarRasHewan.edit', $ras->idras_hewan) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>
                <form action="{{ route('admin.DaftarRasHewan.destroy', $ras->idras_hewan) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus ras hewan ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection