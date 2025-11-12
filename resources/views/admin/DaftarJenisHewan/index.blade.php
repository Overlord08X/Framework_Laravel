@extends('admin.layouts.app')

@section('title', 'Daftar Jenis Hewan')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarJenisHewan.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jenis Hewan
        </button>
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Jenis Hewan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($JenisHewan as $index => $hewan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $hewan->nama_jenis_hewan }}</td>
            <td>
                <form action="{{ route('admin.DaftarJenisHewan.edit', $hewan->idjenis_hewan) }}" method="GET" style="display:inline;">
                    <button type="submit"
                        class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>
                <form id="delete-form-{{ $hewan->idjenis_hewan }}"
                    action="{{ route('admin.DaftarJenisHewan.destroy', $hewan->idjenis_hewan) }}"
                    method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection