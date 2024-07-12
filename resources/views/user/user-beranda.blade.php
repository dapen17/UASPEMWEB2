<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Beranda | {{ $sites->sitename }}</title>

  @include('user.components.link-beranda')
  
</head>

<body class="index-page">
  @include('user.layouts.navbar')

  <main class="main">
    <!-- Hero Section -->
    @include('user.partials.hero-section')
    <!-- Memanggil Section featured-services -->
    @include('user.section.featured-services')
    <!-- Memanggil Section Tentang -->
    @include('user.section.tentang')
    <!-- Call To Action Section -->
    @include('user.partials.call-to-action')
    <!-- Memanggil Section Services -->
    @include('user.section.services')
  </main>

  @include('user.layouts.footer')

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- REQUIRED SCRIPTS -->
  @include('user.components.script-beranda')
</body>

</html>