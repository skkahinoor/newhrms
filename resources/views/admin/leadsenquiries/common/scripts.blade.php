<script src="{{ asset('assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/js/tinymce.js') }}"></script>

<script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/additional-methods.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>


<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#country').select2({
            placeholder: 'Select a country',
            ajax: {
                url: 'https://restcountries.com/v3.1/all',
                dataType: 'json',
                processResults: function(data) {
                    // Sort the data alphabetically by country name
                    data.sort(function(a, b) {
                        return a.name.common.localeCompare(b.name.common);
                    });
                    return {
                        results: data.map(function(country) {
                            return {
                                id: country.name.common,
                                text: country.name.common
                            };
                        })
                    };
                }
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



        // ajax will be defined here 
        // Listen for changes to the department select field


        // modal code for view Lead
        $(document).ready(function() {
            $('#enquire-modal').modal({
                backdrop: 'fixed', // Prevent closing by clicking outside
                keyboard: false // Prevent closing with the Esc key
            });
            $('.enquire-modal-trigger').on('click', function(event) {
                event.preventDefault();
                var enquireId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/leadsenquiries/lead-enquiries') }}" + '/' +
                        enquireId,
                    success: function(data) {
                        // For lead Data
                        $('#enquire-data').html('');
                        $('#enquire-data').append('<p><strong>Name:</strong> ' +
                            data.name + '</p>');
                        $('#enquire-data').append('<p><strong>Email:</strong> ' +
                            data.email + '</p>');
                        $('#enquire-data').append('<p><strong>Number:</strong> ' +
                            data.number + '</p>');
                        $('#enquire-data').append('<p><strong>Message:</strong> ' +
                            data.message + '</p>');
                        $('#enquire-data').append(
                            '<p><strong>Lead Source:</strong> ' +
                            data.leadsource + '</p>');
                        $('#enquire-data').append(
                            '<p><strong>Lead Category:</strong> ' +
                            data.leadcategory + '</p>');
                        $('#enquire-data').append(`
    <p><strong>Assign Agent:</strong>&nbsp;
        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 72 72">
            <path fill="#E82E5F" d="M17 61v-4c0-4.994 5.008-9 10-9q9 7.5 18 0c4.994 0 10 4.006 10 9v4" />
            <path fill="currentColor" d="M26 39c-4 0-4-6-4-13s4-14 14-14s14 7 14 14s0 13-4 13" />
            <path fill="#ffe0bd" d="M24.937 31c0 9 4.936 14 11 14C41.872 45 47 40 47 31c0-3-1-5-1-5c-3-3-7-8-7-8c-4 3-7 6-13 7c0 0-1.064 1-1.064 6" />
            <path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M26 39c-4 0-4-6-4-13s4-14 14-14s14 7 14 14s0 13-4 13M17 60v-3c0-4.994 5.008-9 10-9q9 7.5 18 0c4.994 0 10 4.006 10 9v3" />
            <path d="M41.873 30a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-8 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
            <path fill="none" stroke="#000" stroke-linejoin="round" stroke-width="3" d="M24.937 31c0 9 4.936 14 11 14C41.872 45 47 40 47 31c0-3-1-5-1-5c-3-3-7-8-7-8c-4 3-7 6-13 7c0 0-1.064 1-1.064 6z" />
            <path fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M33 38c1.939.939 4 1 6 0" />
        </svg>
        ${data.leadagents}
    </p>`);

                        $('#enquire-data').append(
                            '<p><strong>Lead Status:</strong>&nbsp; <span style="background-color: ' +
                            data.leadstatuscolor +
                            '; width:15px; height:15px; border-radius:50%; display:inline-block; margin-right:5px; margin-bottom:-3px;"></span>&nbsp;' +
                            data.leadstatus + '</p>');


                        // For Company Data
                        $('#company-data').html('');
                        $('#company-data').append(
                            '<p><strong>Company Name:</strong> ' +
                            data.companyname + '</p>');
                        $('#company-data').append('<p><strong>Website:</strong> ' +
                            data.website + '</p>');
                        $('#company-data').append('<p><strong>Country:</strong> ' +
                            data.country + '</p>');
                        $('#company-data').append('<p><strong>State:</strong> ' +
                            data.state + '</p>');
                        $('#company-data').append('<p><strong>City:</strong> ' +
                            data.city + '</p>');
                        $('#company-data').append(
                            '<p><strong>Postal Code:</strong> ' +
                            data.postalcode + '</p>');
                        $('#company-data').append('<p><strong>Address:</strong> ' +
                            data.address + '</p>');


                        // For Follow Up Data

                        // For Follow-Up Data
                        if (Array.isArray(data.followups) && data.followups.length >
                            0) {
                            let followupsHtml = '';
                            data.followups.forEach(function(followup) {
                                followupsHtml += `
                            <p><strong>Next Follow Up Date:</strong> ${followup.date}</p>
                            <p><strong>Time:</strong> ${followup.time}</p>
                            <p><strong>Remark:</strong> ${followup.remark}</p>
                            <hr>
                        `;
                            });
                            $('#followup-data').html(followupsHtml);
                        } else {
                            $('#followup-data').html(
                                '<p>No follow-ups scheduled.</p>');
                        }


                        // Modal Will Show Here
                        $('#enquire-modal').modal('show');
                    }
                });
            });
        });

        // To get follow up data in loop 



        $('.deleteLeadEnquiryLink').on('click', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.leadsenquiries.destroy', '') }}/" + id;
            $('#delete-leadenquiry-form').attr('action', url);
            $('#deleteleadenquiryModal').modal('show');
        });

        // chnage on event click after select one or all data 

        $(document).ready(function() {
            // Select all checkbox event
            $('#select-all').on('change', function() {
                if ($(this).is(':checked')) {
                    $('tbody tr').addClass('selected-row');
                } else {
                    $('tbody tr').removeClass('selected-row');
                }
            });

            // Individual checkbox event
            $('.select-item').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).closest('tr').addClass('selected-row');
                } else {
                    $(this).closest('tr').removeClass('selected-row');
                }
            });
        });

        // Status update on dropdown 
        $(document).ready(function() {
            $('.status-option').on('click', function() {
                var leadId = $(this).data('lead-id');
                var statusId = $(this).data('status-id');
                var statusText = $(this).text();
                var statusColor = $(this).find('span').css('background-color');

                // Update the dropdown button with the selected status and color
                var dropdownButton = $(this).closest('td').find('.dropdown-toggle');
                dropdownButton.html('<span style="background-color: ' + statusColor +
                    '; width: 15px; height: 15px; border-radius: 50%; display: inline-block; margin-right: 5px; margin-bottom:-3px;"></span>' +
                    statusText);

                // Send an AJAX request to update the status in the database
                $.ajax({
                    url: 'leadsenquiries/update-status', // Update this with the correct route
                    method: 'POST',
                    data: {
                        lead_id: leadId,
                        status_id: statusId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Success!', 'Status updated successfully!',
                            'success').then(() => {
                            location
                                .reload(); // Reload the page after the success message
                        });
                    },
                    error: function(error) {
                        Swal.fire('Error!', 'Status update Fail!',
                            'error');
                    }
                });
            });
        });

        // Agents update on dropdown 
        $(document).ready(function() {
            $('.agent-option').on('click', function() {

                var leadId = $(this).data('lead-id');
                var agentId = $(this).data('agent-id');
                var agentNameText = $(this).text();

                // Update the dropdown button with the selected agent's name
                var dropdownButton = $(this).closest('td').find('.agent-toggle');
                dropdownButton.html(agentNameText);

                // Disable button to prevent multiple clicks
                dropdownButton.prop('disabled', true);

                // Send AJAX request to assign the agent
                $.ajax({
                    url: '{{ route('admin.leadsenquiries.update-lagents') }}',
                    method: 'POST',
                    data: {
                        lead_id: leadId,
                        agent_id: agentId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Agent assigned successfully!',
                            icon: 'success',
                            allowOutsideClick: false // Prevent closing on outside click
                        }).then(() => {
                            Swal.fire({
                                allowOutsideClick: false,
                                icon: 'info',
                                title: 'Now change the Status to?',
                                input: 'select',
                                inputOptions: leadStatuses.reduce(
                                    function(options, status) {
                                        options[status.id] =
                                            status
                                            .name;
                                        return options;
                                    }, {}),
                                inputPlaceholder: 'Select a status',
                                showCancelButton: true,
                                confirmButtonText: 'Confirm'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var statusId = result
                                        .value;
                                    $.ajax({
                                        url: 'leadsenquiries/update-lstatus',
                                        method: 'POST',
                                        data: {
                                            lead_id: leadId,
                                            status_id: statusId,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(
                                            statusResponse
                                        ) {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Status updated successfully!',
                                                icon: 'success',
                                                allowOutsideClick: false // Prevent closing on outside click
                                            }).then(
                                                () => {
                                                    location
                                                        .reload();
                                                });
                                        },
                                        error: function(
                                            error) {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'Status update failed!',
                                                icon: 'error',
                                                allowOutsideClick: false // Prevent closing on outside click
                                            });
                                        }
                                    });
                                } else if (result.dismiss === Swal
                                    .DismissReason.cancel) {
                                    Swal.fire({
                                        title: 'Cancelled',
                                        text: 'You have cancelled the status update!',
                                        icon: 'error',
                                        allowOutsideClick: false
                                    }).then(
                                        () => {
                                            location
                                                .reload();
                                        });
                                }
                            });
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Agent assignment failed!',
                            icon: 'error',
                            allowOutsideClick: false // Prevent closing on outside click
                        });
                        console.log(error);
                        dropdownButton.prop('disabled', false);
                    }
                });
            });
        });







        // Function to check if any checkbox is checked
        function checkSelection() {
            const checkboxes = document.querySelectorAll('.select-item');
            const hiddenContent = document.querySelector('.hidden-content');
            let isChecked = false;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    isChecked = true;
                }
            });

            // Toggle the hidden content based on selection
            hiddenContent.style.display = isChecked ? 'block' : 'none';

        }

        // Event listener for "Select All" checkbox
        document.getElementById('select-all').addEventListener('click', function(event) {
            const checked = event.target.checked;
            const checkboxes = document.querySelectorAll('.select-item');

            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
            });

            checkSelection(); // Check if hidden content should be shown
        });

        // Event listener for individual checkboxes
        document.querySelectorAll('.select-item').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                checkSelection(); // Check if hidden content should be shown
            });
        });





        // dropdown for bothe agent and status
        $(document).ready(function() {
            let selectedLeadStatusId = null;
            let selectedLeadAgentId = null;
            let isDeleteAction = false; // Track if delete action is selected

            function handleDropdown(action, dropdownType) {
                let dropdownButton = dropdownType === 'status' ? '#dropdownMenuButton2' :
                    '#dropdownMenuButton3';
                let optionsContainer = dropdownType === 'status' ? '#lead-status-options' :
                    '#lead-agent-options';
                let fetchUrl = dropdownType === 'status' ? 'leadsenquiries/get-lead-statuses' :
                    'leadsenquiries/get-lead-agents';

                // Show the relevant dropdown
                dropdownType === 'status' ? $('#second-dropdown').show() : $('#third-dropdown').show();
                dropdownType === 'status' ? $('#third-dropdown').hide() : $('#second-dropdown').hide();

                $.ajax({
                    url: fetchUrl,
                    method: 'GET',
                    success: function(response) {
                        $(optionsContainer).empty();
                        $.each(response.data, function(index, item) {
                            $(optionsContainer).append(`
                        <li>
                            <a class="dropdown-item ${dropdownType}-option" href="javascript:void(0);" data-${dropdownType}-id="${item.id}">
                                ${dropdownType === 'status' ? item.name : item.username}
                            </a>
                        </li>
                    `);
                        });
                        bindOptionSelection(dropdownType);
                    },
                    error: function() {
                        alert('Failed to fetch options');
                    }
                });
            }

            function bindOptionSelection(dropdownType) {
                $(`.${dropdownType}-option`).off('click').on('click', function() {
                    let selectedName = $(this).text().trim();
                    if (dropdownType === 'status') {
                        selectedLeadStatusId = $(this).data('status-id');
                        $('#dropdownMenuButton2').text(selectedName);
                    } else {
                        selectedLeadAgentId = $(this).data('agent-id');
                        $('#dropdownMenuButton3').text(selectedName);
                    }
                });
            }

            $('.dropdown-item').on('click', function() {
                let selectedAction = $(this).data('action');
                $('#dropdownMenuButton1').text($(this).text().trim());

                if (selectedAction === 'change-status') {
                    handleDropdown(selectedAction, 'status');
                } else if (selectedAction === 'change-agent') {
                    handleDropdown(selectedAction, 'agent');
                } else if (selectedAction === 'delete') {
                    isDeleteAction = true; // Set flag for delete action
                    $('#second-dropdown, #third-dropdown').hide();
                } else {
                    $('#second-dropdown, #third-dropdown').hide();
                    selectedLeadStatusId = null;
                    selectedLeadAgentId = null;
                    isDeleteAction = false; // Reset delete flag
                }
            });

            $('.btn-apply').on('click', function() {
                let selectedLeadIds = [];
                $('.select-item:checked').each(function() {
                    selectedLeadIds.push($(this).val());
                });

                if (isDeleteAction && selectedLeadIds.length > 0) {
                    // Make an AJAX call to delete selected leads
                    $.post('leadsenquiries/delete-leads', {
                        lead_ids: selectedLeadIds
                    }, function(response) {
                        Swal.fire('Success!', 'Leads deleted successfully!', 'success')
                            .then(() => {
                                location
                                    .reload(); // Reload the page after the success message
                            });
                    }).fail(function() {
                        Swal.fire('Error!', 'Failed to delete leads', 'error');
                    });
                } else if (selectedLeadStatusId && selectedLeadIds.length > 0) {
                    $.post('leadsenquiries/update-lead-status', {
                        lead_ids: selectedLeadIds,
                        status_id: selectedLeadStatusId
                    }, function(response) {
                        Swal.fire('Success!',
                            'Status updated successfully for selected leads!',
                            'success').then(() => {
                            location.reload();
                        });
                    }).fail(function() {
                        Swal.fire('Error!', 'Failed to update status', 'error');
                    });
                } else if (selectedLeadAgentId && selectedLeadIds.length > 0) {
                    $.post('leadsenquiries/update-lead-agent', {
                        lead_ids: selectedLeadIds,
                        agent_id: selectedLeadAgentId
                    }, function(response) {
                        Swal.fire('Success!',
                            'Agent updated successfully for selected leads!',
                            'success').then(() => {
                            location.reload();
                        });
                    }).fail(function() {
                        Swal.fire('Error!', 'Failed to update agent', 'error');
                    });
                } else {
                    Swal.fire('Error!', 'Please select at least one lead and a valid option',
                        'error');
                }

                // Reset the flags after the action
                selectedLeadStatusId = null;
                selectedLeadAgentId = null;
                isDeleteAction = false;
            });
        });

        // Add Follow Up Modal Code is here
        $('#addFollowUpModal').modal({
            backdrop: 'fixed', // Prevent closing by clicking outside
            keyboard: false // Prevent closing with the Esc key
        });
        $('#addFollowUpModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var leadId = button.data('lead-id');
            console.log("Lead ID:", leadId);
            var modal = $(this);
            modal.find('input[name="lead_id"]').val(leadId);
        });










    });

    // Copy to clipboard js code 
    function copyLinkToClipboard(event) {
        event.preventDefault(); // prevent the default link behavior
        const linkUrl = document.getElementById("copy-link").textContent;
        const textarea = document.createElement("textarea");
        textarea.value = linkUrl;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);

        // Display a modal with a success message
        Swal.fire({
            title: 'Link copied to clipboard successfully!',
            icon: 'success',
            confirmButtonText: 'OK',
            padding: '10px 50px 10px 50px',
            allowOutsideClick: false
        });
    }


    // Js Code to set current date and time

    // current date 
    $('#addFollowUpModal').on('shown.bs.modal', function() {
        var currentDate = new Date();
        var year = currentDate.getFullYear();
        var month = currentDate.getMonth() + 1; // months are 0-based
        var day = currentDate.getDate();

        var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day :
            day);

        document.getElementById("FollowUpDate").value = formattedDate;
    });

    // Random time picker
    $(document).ready(function() {
        // Function to format current time in 24-hour format with AM/PM
        function formatAMPM24(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading 0 to minutes if necessary
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

        // Set the input to current time in 24-hour format
        var currentTime = formatAMPM24(new Date());
        $('#FollowUpTime').val(currentTime);

        // Initialize clockpicker
        $('#FollowUpTime').clockpicker({
            autoclose: true,
            placement: 'bottom',
            align: 'left',
            vibrate: true,
            donetext: 'Done',
            twelveHour: false, // Keep 24-hour format
            afterDone: function() {
                // Get the selected time from the input element
                var timeValue = $('#FollowUpTime').val();

                // Split the value into hours, minutes, and AM/PM
                var timeParts = timeValue.split(':');
                var hours = parseInt(timeParts[0]);
                var minutes = timeParts[1].substring(0, 2);
                var ampm = hours >= 12 ? 'PM' : 'AM';

                // Update the input field with the 24-hour format + AM/PM
                $('#FollowUpTime').val(hours + ':' + minutes + ' ' + ampm);
            }
        });
    });

    var leadStatuses = @json($leadStatuses);

   
</script>
