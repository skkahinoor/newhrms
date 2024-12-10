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



        // Post Type modal code here
        $('.editPostTypeBtn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            // Set the modal title and button text for editing
            $('#editPostTypeModalLabel').text('Edit Post Type');

            // Pre-fill the form with the existing data
            $('#editposttype').val(name);

            $('#posttypeid').val(id);

            // Set the action URL to the update route leadsource.update 
            $('#editPostTypeForm').attr('action', 'recruitment/addposttype-update/' + id);

        });

        $('.deletePostTypeLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.recruitment.addposttype-delete', '') }}/" + id;
            $('#delete-posttype-form').attr('action', url);
            $('#deletePostTypeModal').modal('show');
        });



        // Post Location modal code here
        $('.editpostlocationBtn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            // Set the modal title and button text for editing
            $('#editpostlocationModalLabel').text('Edit Post Location');

            // Pre-fill the form with the existing data
            $('#editpostlocationName').val(name);

            $('#postlocationId').val(id);

            // Set the action URL to the update route leadsource.update 
            $('#editpostlocationForm').attr('action', 'recruitment/addpostlocation-update/' + id);

        });

        $('.deletePostLocationLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.recruitment.addpostlocation-delete', '') }}/" + id;
            $('#delete-postlocation-form').attr('action', url);
            $('#deletepostlocationModal').modal('show');
        });





        // lead status change code 
        $('.defaultStatusRadio').on('change', function() {
            var selectedId = $(this).data('id');

            // Make an AJAX request to update the default status
            $.ajax({
                type: 'POST',
                url: 'leads-setting/update-default-status',
                data: {
                    id: selectedId
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire('Success!', 'Default status updated successfully.',
                        'success');
                    // Update delete button visibility
                    $('.deleteLeadStatusLink').each(function() {
                        var statusId = $(this).data('id');
                        if (statusId == selectedId) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to update default status.', 'error');
                }
            });
        });


        $(document).on('click', '.editPostButton', function() {
            let post = $(this).data('post');

            $('#editPostId').val(post.id);
            $('#editPostName').val(post.postname);
            $('#editPostExperience').val(post.experience);
            $('#editTotalVacancy').val(post.totalvacancy);
            $('#editSalaryRange').val(post.salaryrange);
            $('#editJobType').val(post.posttypeid);
            $('#editJobLocation').val(post.postlocationid);
            $('#editPostDescription').val(post.description);
            $('#editPostModal').modal('show');
        });

        // Delee Job Post through Ajax 
        $(document).on('click', '.deleteJob', function() {
            const deletejob = $(this).data('delete');
            console.log(deletejob);
            
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.recruitment.deletepost', ['id' => ':id']) }}'.replace(
                    ':id', deletejob),
                data: {
                    id: deletejob
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire('Success!', 'Delete Job successfully.',
                        'success').then(function() {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Failed to update default status.', 'error');
                }
            });
        });






    });
</script>
