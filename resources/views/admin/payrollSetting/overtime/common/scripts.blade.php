<script>
    $(document).ready(function () {



        $("#overTimeEmployee").select2({
            placeholder: "Assign OverTime to Employee"
        });


        $('.toggleStatus').change(function (event) {
            event.preventDefault();
            let status = $(this).prop('checked') === true ? 1 : 0;
            let href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to change status ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }else if (result.isDenied) {
                    (status === 0)? $(this).prop('checked', true) :  $(this).prop('checked', false)
                }
            })
        })

        $('.delete').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to delete this data ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        })

        $('#pay_type').on('change',function () {
            let pay = $(this).val();

            if(pay === '1'){
                $('.pay_percent').addClass('d-none');
                $('.pay_rate').removeClass('d-none');

            }else{
                $('.pay_percent').removeClass('d-none');
                $('.pay_rate').addClass('d-none');

            }
        })

    });

</script>
