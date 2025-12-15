@extends('dokter.layouts.lte.main')

@section('title', 'Profil Dokter')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Profil Dokter</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="30%">Nama</th>
                <td>{{ $profil->nama }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $profil->email }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $profil->no_hp }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $profil->alamat }}</td>
            </tr>
            <tr>
                <th>Bidang Dokter</th>
                <td>{{ $profil->bidang_dokter }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $profil->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
