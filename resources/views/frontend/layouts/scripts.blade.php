<script>
    var notyf = new Notyf();

    $('.datepicker').datepicker({
        format: 'yyyy-m-d'
    });

    $('.yearpicker').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years'
    });

    function showLoader() {
        $('.preloader_demo').removeClass('d-none');
    }

    function hideLoader() {
        $('.preloader_demo').addClass('d-none');
    }
</script>
