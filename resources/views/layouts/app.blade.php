<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') · RSHP Unair</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo RSHP" />
        </div>
        <div class="menu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('struktur') }}" class="{{ request()->routeIs('struktur') ? 'active' : '' }}">Struktur Organisasi</a>
            <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan Umum</a>
            <a href="{{ route('visimisi') }}" class="{{ request()->routeIs('visimisi') ? 'active' : '' }}">Visi, Misi & Tujuan</a>
            <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
        </div>
    </div>

    @yield('content')

    <hr />
    <small>&copy; 2025 RSHP (Website statis tugas Modul 1) | Sumber:
        <a href="https://rshp.unair.ac.id" target="_blank">RSHP Unair</a></small>
</body>

</html>