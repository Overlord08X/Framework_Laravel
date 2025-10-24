@extends('site.layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <h1>Selamat Datang di Rumah Sakit Hewan Pendidikan (RSHP)</h1>
    <p>
        RSHP Universitas Airlangga adalah fasilitas layanan kesehatan hewan yang
        berfokus pada pendidikan, penelitian, dan pelayanan kepada masyarakat.
    </p>
    <p>
        Website ini dibuat sebagai tugas <b>Modul 1 – HTML Dasar</b> dengan
        menampilkan heading, paragraf, <mark>format teks</mark>,
        <a href="https://rshp.unair.ac.id">hyperlink</a>, gambar, tabel, dan
        list.
    </p>

    <img src="{{ asset('css/aset/2.jpg') }}" alt="Banner RSHP Unair" />

    <h2>Tentang RSHP</h2>
    <ul>
        <li>Pelayanan Rawat Jalan</li>
        <li>Pelayanan Gawat Darurat</li>
        <li>Laboratorium & Diagnostik</li>
    </ul>

    <h2>Jam Operasional</h2>
    <table>
        <tr>
            <th>Hari</th>
            <th>Pelayanan</th>
            <th>Jam</th>
        </tr>
        <tr>
            <td>Senin-Jumat</td>
            <td>Rawat Jalan</td>
            <td>08.00-15.00</td>
        </tr>
        <tr>
            <td>Sabtu</td>
            <td>Rawat Jalan</td>
            <td>08.00-12.00</td>
        </tr>
        <tr>
            <td>Senin-Minggu</td>
            <td>Gawat Darurat</td>
            <td>24 Jam</td>
        </tr>
    </table>

    <h2>FAQ</h2>
    <ol>
        <li>Apakah menerima pasien darurat? Ya.</li>
        <li>Apakah ada layanan vaksinasi? Ya.</li>
        <li>Metode pembayaran? Tunai & Non-tunai.</li>
    </ol>
</div>
@endsection