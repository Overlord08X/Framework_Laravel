@extends('admin.layouts.app')

@section('title', 'Daftar Kategori Klinis')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarKategoriKlinis.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis
        </button>
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori Klinis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($KategoriKlinis as $index => $kategoriklinis)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kategoriklinis->nama_kategori_klinis }}</td>
            <td>
                <form action="{{ route('admin.DaftarKategoriKlinis.edit', $kategoriklinis->idkategori_klinis) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>

                <form id="delete-form-{{ $kategoriklinis->idkategori_klinis }}"
                    action="{{ route('admin.DaftarKategoriKlinis.destroy', $kategoriklinis->idkategori_klinis) }}"
                    method="POST"
                    style="display:inline;">
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