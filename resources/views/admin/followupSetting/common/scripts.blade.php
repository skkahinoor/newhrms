<script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>

<script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Clear Local Storage
        $('#lclear').on('click', function() {
            localStorage.clear();
            Swal.fire({
                title: 'Done! It Will Clear Now!',
                icon: 'success',
                confirmButtonText: 'OK',
                padding: '10px 50px 20px 50px',
                allowOutsideClick: false
            });
        });







    });
</script>
