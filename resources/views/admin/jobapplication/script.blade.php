<script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>

<script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/additional-methods.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // Shedule Interview
        $('.shedule-interview').on('click', function() {
            const applicantId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.jobapplication.sheduleinterview', ['id' => ':id']) }}'
                    .replace(
                        ':id', applicantId),
                data: {
                    id: applicantId
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire('Success!', 'Interview Shedule successfully.',
                        'success').then(
                        function() {
                            location
                                .reload();
                        }
                    );
                    // Update delete button visibility
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to update status.', 'error');
                }
            });
        });

        // Approve as Employee
        $('.approve-as-employee').on('click', function() {
            const applicantId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.jobapplication.approveeasemployee', ['id' => ':id']) }}'
                    .replace(
                        ':id', applicantId),
                data: {
                    id: applicantId
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire('Success!', 'Employee Created Successfully',
                        'success').then(
                        function() {
                            location
                                .reload();
                        }
                    );
                    // Update delete button visibility
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to update status.', 'error');
                }
            });
        });

        // Reject Candidate
        $('.reject-candidate').on('click', function() {
            const applicantId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.jobapplication.rejectcandidate', ['id' => ':id']) }}'
                    .replace(
                        ':id', applicantId),
                data: {
                    id: applicantId
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire('Success!', 'Candidate Reject successfully.',
                        'success').then(
                        function() {
                            location
                                .reload();
                        }
                    );
                    // Update delete button visibility
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to update status.', 'error');
                }
            });
        });



    });
</script>
