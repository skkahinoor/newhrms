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

        $('.toggleStatus').change(function(event) {
            event.preventDefault();
            var status = $(this).prop('checked') === true ? 1 : 0;
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to change status ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                } else if (result.isDenied) {
                    (status === 0) ? $(this).prop('checked', true): $(this).prop('checked',
                        false)
                }
            })
        })

        $('.deleteClientDetail').click(function(event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete Client Detail ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding: '10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        })

        // Lead Source modal code here

        // old edit script
        $('.editLeadSourceBtn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            // Set the modal title and button text for editing
            $('#editLeadSourceModalLabel').text('Edit Lead Source');

            // Pre-fill the form with the existing data
            $('#editLeadSourceName').val(name);

            $('#leadSourceId').val(id);

            // Set the action URL to the update route leadsource.update 
            $('#editLeadSourceForm').attr('action', 'leads-setting/leadsource/update/' + id);

        });

        $('.deleteLeadSourceLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.leadsource.destroy', '') }}/" + id;
            $('#delete-leadsource-form').attr('action', url);
            $('#deleteleadsourceModal').modal('show');
        });


        // Lead Status Modal javascript Code Here

        // pick color for create 
        document.getElementById('colorPicker').addEventListener('input', function() {
            var color = this.value.toUpperCase();
            document.getElementById('labelColor').value = color;
            document.querySelector('.lead-status-color-picker').style.backgroundColor = color;
        });

        // pick color for Edit 
        document.getElementById('editColorPicker').addEventListener('input', function() {
            var color = this.value.toUpperCase();
            document.getElementById('editLabelColor').value = color;
            document.querySelector('.lead-status-color-picker').style.backgroundColor = color;
        });

        // edit code
        $('.editLeadStatusBtn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var color = $(this).data('color');

            // Set the modal title and button text for editing
            $('#editLeadStatusModalLabel').text('Edit Lead Status');

            // Pre-fill the form with the existing data
            $('#editLeadStatusName').val(name);

            // Pre-fill the form with the existing data in color case
            if (color) {
                $('#editLabelColor').val(color);
                $('#editColorPicker').val(color); // Pre-fill the color picker as well
                $('.lead-status-color-picker').css('background-color', color);
            }
            // Set the action URL to the update route leadsource.update 
            $('#editLeadStatusForm').attr('action', 'leads-setting/leadstatus/update/' + id);

        });

        // Synchronize color picker and text input
        $('#editColorPicker').on('input', function() {
            var pickedColor = $(this).val(); // Get the selected color
            $('#editLabelColor').val(pickedColor); // Update the text input with the selected color
            $('.lead-status-color-picker').css('background-color',
                pickedColor); // Update the background color
        });

        $('#editLabelColor').on('input', function() {
            var typedColor = $(this).val(); // Get the manually entered color
            $('#editColorPicker').val(typedColor); // Update the color picker with the typed color
            $('.lead-status-color-picker').css('background-color',
                typedColor); // Update the background color
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

        // Initial setup to hide delete buttons for default statuses
        $('.defaultStatusRadio').each(function() {
            var statusId = $(this).data('id');
            var isDefault = $(this).is(':checked');
            if (isDefault) {
                $('.deleteLeadStatusLink[data-id="' + statusId + '"]').hide();
            } else {
                $('.deleteLeadStatusLink[data-id="' + statusId + '"]').show();
            }
        });


        // delete code
        $('.deleteLeadStatusLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.leadstatus.destroy', '') }}/" + id;
            $('#deleteLeadStatusForm').attr('action', url);
            $('#deleteLeadStatusModal').modal('show');
        });


        // Lead Agent Modal Code Here

        $('.deleteLeadAgentLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.leadagent.delete', '') }}/" + id;
            $('#delete-form').attr('action', url);
            $('#deleteModal').modal('show');
        });



        // Lead Category Modal Code Here

        $('.editLeadCategoryBtn').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            // Set the modal title and button text for editing
            $('#editLeadCategoryModalLabel').text('Edit Lead Category');

            // Pre-fill the form with the existing data
            $('#editLeadCategoryName').val(name);

            // Set the action URL to the update route leadCategory.update 
            $('#editLeadCategoryForm').attr('action', 'leads-setting/leadcategory/update/' + id);
        });

        $('.deleteLeadCategoryLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.leadcategory.destroy', '') }}/" + id;
            $('#delete-leadcategory-form').attr('action', url);
            $('#deleteleadcategoryModal').modal('show');
        });


        // Lead Setting Start here

        //for control which form is visible or not
        function handleSwitchChange(fieldId, fieldName) {
            $(fieldId).on('change', function() {
                if (!$(this).is(':checked')) {
                    Swal.fire('Error', 'You Cannot Off the ' + fieldName + ' field', 'error');
                    $(this).prop('checked', true);
                }
            });
        }
        handleSwitchChange('#name', 'Name');
        handleSwitchChange('#email', 'Email');
        handleSwitchChange('#number', 'Number');
        handleSwitchChange('#leadsource', 'Lead Source');
        handleSwitchChange('#leadcategory', 'Lead Category');

        // This is for which form field which can be change
        function handleSwitchChange2(fieldId, fieldName, updateColumn) {
            $(fieldId).on('change', function() {
                const isChecked = $(this).is(':checked');
                const checkbox = $(this);

                const data = {
                    column: updateColumn,
                    value: isChecked ? 1 : 0
                };

                $.ajax({
                    url: 'leads-setting/update-lead-form',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire('Success', fieldName + ' Update successfully!','success');
                        checkbox.prop('checked', isChecked);
                        // Reload Iframe in realtime
                        document.getElementById('ireload').src = document
                            .getElementById(
                                'ireload').src;
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Failed to update ' + fieldName, 'error');
                        checkbox.prop('checked', !isChecked);
                    }
                });
            });
        }

        handleSwitchChange2('#city', 'City', 'city');
        handleSwitchChange2('#state', 'State', 'state');
        handleSwitchChange2('#companyname', 'Company Name', 'companyname');
        handleSwitchChange2('#country', 'Country', 'country');
        handleSwitchChange2('#website', 'Website', 'website');
        handleSwitchChange2('#postalcode', 'Postal Code', 'postalcode');
        handleSwitchChange2('#address', 'Address', 'address');
        handleSwitchChange2('#message', 'Message', 'message');



    });
</script>
