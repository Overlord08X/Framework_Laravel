@extends('admin.layouts.app')

@section('title', 'Daftar Role')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarRole.create') }}" method="GET" style="display:inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Role
        </button>
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Role as $index => $role)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $role->nama_role }}</td>
            <td>
                <form action="{{ route('admin.DaftarRole.edit', $role->idrole) }}" method="GET" style="display:inline;">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>
                <form action="{{ route('admin.DaftarRole.destroy', $role->idrole) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus role ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection