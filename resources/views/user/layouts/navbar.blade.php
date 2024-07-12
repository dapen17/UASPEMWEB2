
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('user.home') }}" class="logo d-flex align-items-center me-auto">
        <img src="data:image/jpeg/jpg/png/webp;base64,{{ $logoBase64 }}" alt="">
        <h1 class="sitename">{{ $sites->sitename }}</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('user.home') }}" class="active">Beranda<br></a></li>
          <li><a href="{{ route('user.cafe') }}">List Cafe</a></li>
          <li><a href="{{ route('user.rekomendasi') }}">Rekomendasi Cafe</a></li>
          <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#" data-toggle="modal" data-target="#logoutModal">Keluar</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      

    </div>
  </header>
  
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-block btn-primary">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div> 