<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Master Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('perawat.ManajemenPasien.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Manajemen Pasien</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('perawat.Reservasi.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Reservasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('perawat.RekamMedis.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Rekam Medis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">DOCUMENTATIONS</li>
                <li class="nav-item">
                    <a href="./docs/introduction.html" class="nav-link">
                        <i class="nav-icon bi bi-download"></i>
                        <p>Installation</p>
                    </a>
                </li>
        </nav>
    </div>
</aside>