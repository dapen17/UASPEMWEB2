<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rekomendasi Cafe | {{ $sites->sitename }}</title>

    @include('user.components.link-perhitungan')
</head>

<body class="index-page">
    @include('user.layouts.navbar')
    <div id="preloader"></div>

    @yield('content')
    @include('user.partials.modal-hitung')
    @include('user.layouts.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Perhitungan Berhasil</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Perhitungan Weighted Product telah berhasil!
            </div>
        </div>
    </div>


    @include('user.components.script-perhitungan')
</body>

</html>