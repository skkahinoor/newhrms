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

        $(document).ready(function() {
            // Event listener for modal open
            $(document).on('click', '[data-bs-target="#viewFollowUpModal"]', function() {
                var followupId = $(this).data(
                    'id');
                $.ajax({
                    url: 'followuplist/followup/' + followupId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            // Populate modal with response data
                            $('#modal-lead-name').text(response.lead);
                            $('#modal-followup-date').text(response.followupDate);
                            $('#modal-followup-time').text(response.followupTime);
                            $('#modal-remark').text(response.remark);
                        } else {
                            $('#modal-remark').text('Error loading remark.');
                        }
                    },
                    error: function() {
                        $('#modal-remark').text(
                            'An error occurred while fetching the data.');
                    }
                });
            });
        });

        // edit script
        $('.editFollowUpBtn').on('click', function() {
            var id = $(this).data('id');
            var followupdate = $(this).data('followupdate');
            var followupname = $(this).data('followupname');
            var remark = $(this).data('remark');

            // Set the modal title and button text for editing
            $('#editFollowUpModalLabel').text('Edit Follow Up Details');

            // Pre-fill the form with the existing data
            $('#editFollowUpDate').val(followupdate);
            $('#editFollowUpName').val(followupname);
            $('#editFollowUpRemark').val(remark);

            $('#FollowUpId').val(id);

            // Set the action URL to the update route leadsource.update 
            $('#editFollowUpForm').attr('action', 'followuplist/update/' + id);

        });

        // Delete Followup data
        $('.deleteFollowUpLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.followuplist.destroy', '') }}/" + id;
            $('#delete-followup-form').attr('action', url);
            $('#deletefollowupModal').modal('show');
        });




    });
</script>
