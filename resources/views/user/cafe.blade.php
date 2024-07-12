<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>List Cafe | {{ $sites->sitename }}</title>

    @include('user.components.link-cafe')
</head>

<body class="index-page">
    @include('user.layouts.navbar')

    <main class="main">
        @include('user.partials.hero-cafe')
        <!-- /Clients Section -->
        @yield('content')
    </main>

    @include('user.layouts.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- REQUIRED SCRIPTS -->
    @include('user.components.script-cafe')
</body>

</html>