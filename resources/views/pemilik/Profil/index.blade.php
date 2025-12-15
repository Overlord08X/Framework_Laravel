@extends('pemilik.layouts.lte.main')

@section('title', 'Profil Pemilik')

@section('content')
<br>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Profil Pemilik</h5>
    </div>
    <div class="card-body">
        @if($profil)
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $profil->nama }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $profil->email }}</td>
            </tr>
            <tr>
                <th>No WhatsApp</th>
                <td>{{ $profil->no_wa }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $profil->alamat }}</td>
            </tr>
        </table>
        @else
            <div class="alert alert-warning">
                Data profil tidak ditemukan.
            </div>
        @endif
    </div>
</div>
@endsection
