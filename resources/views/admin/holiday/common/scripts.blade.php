<script src="{{asset('assets/vendors/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/js/tinymce.js')}}"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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

        $('.deleteHoliday').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete Holiday Detail ?',
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

        $('body').on('click', '#showHolidayDetail', function (e) {
            e.preventDefault();
            let url = $(this).data('href');
            $.get(url, function (data) {
                $('.modal-title').html('Holiday Detail');
                $('.occasion').text(data.data.event);
                $('.occasion_date').text((data.data.event_date));
                $('.branch_name').text(data.data.branch_name);
                $('.note').text(data.data.note);
                $('#addslider').modal('show');
            })
        }).trigger("change");


        $('.reset').click(function(event){
            event.preventDefault();
            $('#event').val('');
            $('#month').val('');
            $('#year').val('');
        })

        $('#eventDate').nepaliDatePicker({
            language: "english",
            dateFormat: "MM/DD/YYYY",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 20,
            disableAfter: "2089-12-30",
        });
    });

</script>
