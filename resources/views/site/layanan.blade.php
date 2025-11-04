@extends('layouts.app')

@section('title', 'Layanan Umum')

@section('content')
<div class="container">
    <h1>Layanan Umum</h1>

    <table>
        <tr>
            <th rowspan="2">Layanan</th>
            <th rowspan="2">Deskripsi</th>
            <th colspan="2">Biaya</th>
        </tr>
        <tr>
            <th>Reguler</th>
            <th>Mahasiswa</th>
        </tr>
        <tr>
            <td>Registrasi</td>
            <td>Pendaftaran pasien</td>
            <td>Rp25.000</td>
            <td>Rp15.000</td>
        </tr>
        <tr>
            <td>Vaksinasi</td>
            <td>Vaksin dasar</td>
            <td>Rp80.000</td>
            <td>Rp60.000</td>
        </tr>
    </table>

    <h2>Dokumen yang Diperlukan</h2>
    <ul>
        <li>Identitas pemilik hewan</li>
        <li>Kartu vaksin</li>
        <li>Riwayat medis</li>
    </ul>
</div>
@endsection