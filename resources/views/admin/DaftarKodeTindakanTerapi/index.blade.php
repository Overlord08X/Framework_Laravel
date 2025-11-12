@extends('admin.layouts.app')

@section('title', 'Daftar Kode Tindakan Terapi')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarKodeTindakanTerapi.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kode Tindakan Terapi
        </button>
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Deskripsi Tindakan Terapi</th>
            <th>Kategori Klinis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($KodeTindakanTerapi as $index => $kodetindakan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kodetindakan->kode }}</td>
            <td>{{ $kodetindakan->deskripsi_tindakan_terapi }}</td>
            <td>{{ $kodetindakan->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
            <td>
                <form action="{{ route('admin.DaftarKodeTindakanTerapi.edit', $kodetindakan->idkode_tindakan_terapi) }}" method="GET" style="display:inline;">
                    <button type="submit"
                        class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>
                <form id="delete-form-{{ $kodetindakan->idkode_tindakan_terapi }}"
                    action="{{ route('admin.DaftarKodeTindakanTerapi.destroy', $kodetindakan->idkode_tindakan_terapi) }}"
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
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection