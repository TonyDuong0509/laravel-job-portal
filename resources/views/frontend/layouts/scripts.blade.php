<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.log(error);
        });

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

    $(".delete-item").on('click', function(event) {
        event.preventDefault();
        let url = $(this).attr('href');
        swal({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this imaginary file!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            showLoader();
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                            swal(xhr.responseJSON.message, {
                                icon: 'error',
                            });
                            hideLoader();
                        }
                    });
                }
            });
    });
</script>
