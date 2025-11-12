@extends('admin.layouts.app')

@section('title', 'Daftar Pet')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarPet.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pet
        </button>
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pet</th>
            <th>Tanggal Lahir</th>
            <th>Warna / Tanda</th>
            <th>Jenis Kelamin</th>
            <th>Pemilik</th>
            <th>Ras</th>
            <th>Jenis Hewan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Pet as $index => $pet)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $pet->nama }}</td>
            <td>{{ $pet->tanggal_lahir }}</td>
            <td>{{ $pet->warna_tanda }}</td>
            <td>{{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}</td>
            <td>{{ $pet->pemilik->user->nama }}</td>
            <td>{{ $pet->rashewan->nama_ras }}</td>
            <td>{{ $pet->rashewan->jenishewan->nama_jenis_hewan }}</td>
            <td>
                <form action="{{ route('admin.DaftarPet.edit', $pet->idpet) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>
                <form action="{{ route('admin.DaftarPet.destroy', $pet->idpet) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin ingin menghapus data pet ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection