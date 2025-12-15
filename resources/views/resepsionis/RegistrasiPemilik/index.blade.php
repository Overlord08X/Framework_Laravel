@extends('resepsionis.layouts.lte.main')

@section('content')
@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp

<div class="container">
    <h1>Registrasi Pemilik</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('resepsionis.RegistrasiPemilik.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>No WhatsApp</label>
            <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa') }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
        <a href="{{ route('resepsionis.dashboard-resepsionis') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
