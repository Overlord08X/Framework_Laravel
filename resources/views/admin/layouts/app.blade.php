
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="support-color-scheme" content="light dark" />
    <!-- <title>@yield('title') · Dashboard RSHP Unair</title> -->
    <link rel="preload" href="{{ asset('assets/css/adminlte.css') }}" />
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('css/aset/logo.png') }}" alt="Logo RSHP" />
        </div>
        <div class="menu">
            <a href="{{ route('admin.dashboard-admin') }}" class="{{ request()->routeIs('admin.dashboard-admin') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.DaftarJenisHewan.index') }}" class="{{ request()->routeIs('admin.DaftarJenisHewan.index') ? 'active' : '' }}">Daftar Jenis Hewan</a>
            <a href="{{ route('admin.DaftarKategori.index') }}" class="{{ request()->routeIs('admin.DaftarKategori.index') ? 'active' : '' }}">Daftar Kategori</a>
            <a href="{{ route('admin.DaftarKategoriKlinis.index') }}" class="{{ request()->routeIs('admin.DaftarKategoriKlinis.index') ? 'active' : '' }}">Daftar Kategori Klinis</a>
            <a href="{{ route('admin.DaftarKodeTindakanTerapi.index') }}" class="{{ request()->routeIs('admin.DaftarKodeTindakanTerapi.index') ? 'active' : '' }}">Daftar Kode Tindakan Terapi</a>
            <a href="{{ route('admin.DaftarPet.index') }}" class="{{ request()->routeIs('admin.DaftarPet.index') ? 'active' : '' }}">Daftar Pet</a>
            <a href="{{ route('admin.DaftarRasHewan.index') }}" class="{{ request()->routeIs('admin.DaftarRasHewan.index') ? 'active' : '' }}">Daftar Ras Hewan</a>
            <a href="{{ route('admin.DaftarRole.index') }}" class="{{ request()->routeIs('admin.DaftarRole.index') ? 'active' : '' }}">Daftar Role</a>
            <a href="{{ route('admin.DaftarUser.index') }}" class="{{ request()->routeIs('admin.DaftarUser.index') ? 'active' : '' }}">Daftar User</a>
        </div>
    </div>

    @yield('content')

    <hr />
    <small>&copy; 2025 RSHP (Website statis tugas Modul 1) | Sumber:
        <a href="https://rshp.unair.ac.id" target="_blank">RSHP Unair</a></small>
</body>

</html>