<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/php-email-form/validate.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/aos/aos.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/isotope-layout/isotope.pkgd.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ asset('AdminLTE/dist/js/main.js') }}"></script>

<script>
    $(document).ready(function() {
        // Ensure all modals are working correctly
        $('[data-bs-toggle="modal"]').click(function() {
            var target = $(this).data('bs-target');
            $(target).modal('show');
        });
        $('.btn-close').click(function() {
            $(this).closest('.modal').modal('hide');
        });
    });
</script>