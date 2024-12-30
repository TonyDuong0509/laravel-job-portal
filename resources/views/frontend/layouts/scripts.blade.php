<script>
    var notyf = new Notyf();

    $('.datepicker').datepicker({
        format: 'yyyy-m-d'
    });

    function showLoader() {
        $('.preloader_demo').removeClass('d-none');
    }

    function hideLoader() {
        $('.preloader_demo').addClass('d-none');
    }
</script>
