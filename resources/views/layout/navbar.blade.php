<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top mb-2">
    <!-- Left navbar links -->
    <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link" id="date"></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" style="font-size: 20px;">
                        <strong>{{ Auth::user()->name }}</strong>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->
@include('layout.components.modal-logout')