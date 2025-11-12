@extends('admin.layouts.app')

@section('title', 'Daftar User')

@section('content')
<br>
<div class="mb-3">
    <form action="{{ route('admin.DaftarUser.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah User
    </form>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($User as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach ($user->roleUser as $role)
                    {{ $role->nama_role }}
                @endforeach
            </td>
            <td>
                <a href="{{ route('admin.DaftarUser.edit', $user->iduser) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.DaftarUser.destroy', $user->iduser) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection