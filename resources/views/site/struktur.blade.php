@extends('site.layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="container">
  <h1>Struktur Organisasi RSHP</h1>
  <p>Berikut adalah contoh struktur organisasi RSHP:</p>

  <img
    src="{{ asset('css/aset/1.jpg') }}"
    alt="Struktur Organisasi RSHP" />

  <table>
    <tr>
      <th>Jabatan</th>
      <th>Nama</th>
      <th>Tugas Utama</th>
    </tr>
    <tr>
      <td>Direktur</td>
      <td>drh. A</td>
      <td>Strategi & kebijakan</td>
    </tr>
    <tr>
      <td>Wakil Direktur</td>
      <td>drh. B</td>
      <td>Mutu layanan</td>
    </tr>
    <tr>
      <td>Kepala Rawat Jalan</td>
      <td>drh. C</td>
      <td>Koordinasi poliklinik</td>
    </tr>
  </table>
</div>
@endsection