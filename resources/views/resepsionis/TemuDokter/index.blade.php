@extends('resepsionis.layouts.lte.main')

@section('content')
@php
    /** @var \Illuminate\Support\MessageBag $errors */
@endphp

<div class="container">

    <h1>Daftar Temu Dokter</h1>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('resepsionis.TemuDokter.store') }}">
        @csrf

        <div class="form-group">
            <label>Pilih Pet</label>
            <select name="idpet" class="form-control" required>
                <option value="">-- Pilih Pet --</option>
                @foreach ($petList as $pet)
                    <option value="{{ $pet->idpet }}">
                        {{ $pet->nama }} ({{ $pet->nama_pemilik }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary mt-2">Daftar Temu Dokter</button>
    </form>

    <hr>

    <h2>Daftar Hari Ini</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Urut</th>
                <th>Nama Pet</th>
                <th>Nama Pemilik</th>
                <th>Waktu Daftar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarHariIni as $d)
                <tr>
                    <td>{{ $d->no_urut }}</td>
                    <td>{{ $d->nama_pet }}</td>
                    <td>{{ $d->nama_pemilik }}</td>
                    <td>{{ $d->waktu_daftar }}</td>
                    <td>{{ $d->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
