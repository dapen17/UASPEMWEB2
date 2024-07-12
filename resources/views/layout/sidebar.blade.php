<aside class="main-sidebar sidebar-dark bg-dark elevation-4" style="position: fixed;">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <h5 id="date" class="d-block text-dark text-center text-bold"></h5>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header mt-1">Menu Utama</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p><strong>Dashboard</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kriteria') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.kriteria') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p><strong>List Kriteria</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.alternatif') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.alternatif') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-stream"></i>
                        <p><strong>List Alternatif</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pembobotan') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.pembobotan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-scale-balanced"></i>
                        <p><strong>Pembobotan</strong></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.penilaian') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.penilaian') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p><strong>Penilaian</strong></p>
                    </a>
                </li>
                <li class="nav-header mt-3">Pengaturan</li>
                <li class="nav-item {{ Request::routeIs('admin.akun', 'admin.akunUser') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link sidebar-side {{ Request::routeIs('admin.akun', 'admin.akunUser') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Akun
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.akun') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.akun') ? 'active' : '' }}">
                                <i class="far fa-user nav-icon"></i>
                                <p>Akun Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.akunUser') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.akunUser') ? 'active' : '' }}">
                                <i class="far fa-user nav-icon"></i>
                                <p>Akun User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.site') }}" class="nav-link sidebar-side {{ Request::routeIs('admin.site') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-faw fa-gear"></i>
                        <p><strong>Pengaturan Site</strong></p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>