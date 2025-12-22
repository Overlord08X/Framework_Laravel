@extends('admin.layouts.lte.main')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <h4>Edit User</h4>

    <form action="{{ route('admin.DaftarUser.update', $user->iduser) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama User <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                value="{{ old('nama', $user->nama) }}" required>
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email', $user->email) }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <small>(kosongkan jika tidak ingin diubah)</small></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="mb-3">
            <label for="idrole" class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-select @error('idrole') is-invalid @enderror" id="idrole" name="idrole" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($Role as $role)
                <option value="{{ $role->idrole }}"
                    {{ old('idrole', $userRole) == $role->idrole ? 'selected' : '' }}>
                    {{ $role->nama_role }}
                </option>
                @endforeach
            </select>
            @error('idrole')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.DaftarUser.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection