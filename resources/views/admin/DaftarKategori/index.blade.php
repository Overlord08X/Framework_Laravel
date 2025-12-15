@extends('admin.layouts.lte.main')

@section('title', 'Daftar Kategori')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarKategori.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </form>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Kategori as $index => $kategori)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kategori->nama_kategori }}</td>
            <td>
                <form action="{{ route('admin.DaftarKategori.edit', $kategori->idkategori) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>
                <form id="delete-form-{{ $kategori->idkategori }}"
                    action="{{ route('admin.DaftarKategori.destroy', $kategori->idkategori) }}"
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