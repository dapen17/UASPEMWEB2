<section id="hero" class="hero section">

  <img src="{{ asset('AdminLTE/dist/img/world-dotted-map.png') }}" alt="" class="hero-bg" data-aos="fade-in">

  <div class="container">
    <div class="row gy-4 d-flex justify-content-between">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h2 data-aos="fade-up">HALLO {{ auth()->user()->name }}, <br>SELAMAT DATANG</h2>
        <p data-aos="fade-up" data-aos-delay="100">Di Website Sistem Pendukung Keputusan Pemilihan Cafe Terbaik, ini merupakan website untuk membantu pengguna dalam memutuskan pemilihan dalam mencari cafe di daerah Brebes</p>

        <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
          <input type="text" class="form-control" placeholder="">
          <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">

          <div class="col-lg-3 col-6">
            <div class="stats-item text-center w-100 h-100">
              @if ($user->count() > 0)
              <span data-purecounter-start="0" data-purecounter-end="{{ $user->count() }}" data-purecounter-duration="1" class="purecounter">{{ $user->count() }}</span>
              @else
              <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter">0</span>
              @endif
              <p>Pengguna</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-6">
            <div class="stats-item text-center w-100 h-100">
              @if ($tipekriteria->count() > 0)
              <span data-purecounter-start="0" data-purecounter-end="{{ $tipekriteria->count() }}" data-purecounter-duration="1" class="purecounter">{{ $tipekriteria->count() }}</span>
              @else
              <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter">0</span>
              @endif
              <p>Kriteria</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-6">
            <div class="stats-item text-center w-100 h-100">
              @if ($products->count() > 0)
              <span data-purecounter-start="0" data-purecounter-end="{{ $products->count() }}" data-purecounter-duration="1" class="purecounter">{{ $products->count() }}</span>
              @else
              <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter">0</span>
              @endif
              <p>Alternatif</p>
            </div>
          </div><!-- End Stats Item -->
        </div>

      </div>

      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
        <img src="{{asset('AdminLTE/dist/img/hero-img.svg')}}" class="img-fluid mb-3 mb-lg-0" alt="">
      </div>

    </div>
  </div>

</section>