<script>
    $(document).ready(function() {

        $(document).on('click', '.viewlist', function() {
            const orderId = $(this).data('id');
            console.log("Order Id: ", orderId);
            if (orderId) {
                $.ajax({
                    url: '{{ route('admin.getQuotationDetails', ['id' => ':id']) }}'
                        .replace(':id', orderId),
                    type: 'GET',
                    data: {
                        procurement_id: orderId
                    },
                    success: function(response) {
                        console.log(response);
                        const tableBody = $('#approve-list');
                        tableBody.empty();
                        let count = 1;
                        response.forEach(getAsset => {
                            let status = getAsset.is_approved === 0 ? `<a href="javascript:void(0);" class="text-secondary approveorder" style="text-decoration:none;" data-id="${getAsset.id}" data-title="Approve">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="#ff3366" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4l8-8z"/></svg>&nbsp;Approve
                                    </a>` : `Already Approved`;
                            const row = `
                            <tr>
                                <th class="text-center text-danger" scope="row">${count}</th>
                                <td class="text-center text-secondary fs-12">${getAsset.vendor.name ?? 'Null'}</td>
                                <td class="text-center text-secondary fs-12">₹ ${getAsset.total_item_price}</td>
                                <td class="text-center text-secondary">${getAsset.final_delivery_date ?? 'Timely Delivered'}</td>
                                <td class="text-center text-secondary"><textarea name="specification" class="form-control text-center p-1" cols="30" rows="2" readonly >${getAsset.remark}</textarea></td>
                                <td class="text-center">
                                    <a href="${getAsset.bill_file ? `{{ asset('assets/uploads/vendor/bill/') }}/${getAsset.bill_file}` : 'javascript:void(0);'}" ${getAsset.bill_file ? `download` : ``}>${getAsset.bill_file || 'Bill Not Generated'}</a>
                                <td class="text-center">${status}</td>
                            </tr>
                        `;
                            tableBody.append(row);
                            count++;
                        });
                        $('#approve-list').show();
                    },
                    error: function() {
                        console.log("Could not fetch product details.");
                    }
                });
            } else {
                console.log("Order Id Is not Found or Something Went wrong");
            }

            // When click approve btn 
            $(document).on('click', '.approveorder', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to approve this order?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Approve it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const approveId = $(this).data(
                            'id');
                        console.log("Quotation ID: ", approveId);
                        $.ajax({
                            url: '{{ route('admin.approveStatusQuotation', ['id' => ':id']) }}'
                                .replace(':id', approveId),
                            type: 'POST',
                            data: {
                                id: approveId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Approved!',
                                    'The order has been approved.',
                                    'success'
                                ).then(() => {
                                    location
                                        .reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue approving the order. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });



        // Status Change on Procurement Page
        $(document).ready(function() {
            $(document).on('click', '.approveprocurementstatus', function() {
                const procurementNumbers = $(this).data('skk');
                console.log("Approved procurementId: ", procurementNumbers);
                // Approve
                $(document).on('click', '#confirmStatusChange', function() {
                    console.log("DD: ", procurementNumbers);
                    if (procurementNumbers) {
                        $.ajax({
                            url: '{{ route('admin.change-status-approve', ['id' => ':id']) }}'
                                .replace(':id', procurementNumbers),
                            method: 'POST',
                            data: {
                                status: procurementNumbers
                            },
                            contentType: 'application/json',
                            success: function(response) {
                                $('#confirmModal').modal('hide');
                                Swal.fire('Success!',
                                        'Status updated successfully!',
                                        'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!',
                                    'Failed to update status!',
                                    'error').then(
                                    () => {
                                        location.reload();
                                    });
                            }
                        });
                    } else {
                        console.log("Procurement ID is not found");
                    }
                });
            });


            // Pause Status
            $(document).on('click', '.pauseOrder', function() {
                const pprocurementNumber = $(this).data('pid');
                console.log("Pause procurementId: ", pprocurementNumber);

                // pause
                $(document).on('click', '#pauseStatusChange', function() {
                    if (pprocurementNumber) {
                        $.ajax({
                            url: '{{ route('admin.pauseStatus', ['id' => ':id']) }}'
                                .replace(':id', pprocurementNumber),
                            method: 'POST',
                            data: {
                                pstatus: pprocurementNumber
                            },
                            contentType: 'application/json',
                            success: function(response) {
                                $('#pauseModal').modal('hide');
                                Swal.fire('Success!',
                                        'Status updated successfully!',
                                        'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!',
                                    'Failed to update status!',
                                    'error').then(
                                    () => {
                                        location.reload();
                                    });
                            }
                        });
                    } else {
                        console.log("Procurement ID is not found");
                    }
                });
            });

            // Resume Status
            $(document).on('click', '.resumeOrder', function() {
                const rprocurementNumber = $(this).data('rid');
                console.log("Resume procurementId: ", rprocurementNumber);

                // Resume
                $(document).on('click', '#resumeStatusChange', function() {
                    if (rprocurementNumber) {
                        $.ajax({
                            url: '{{ route('admin.resumeStatus', ['id' => ':id']) }}'
                                .replace(':id', rprocurementNumber),
                            method: 'POST',
                            data: {
                                rstatus: rprocurementNumber
                            },
                            contentType: 'application/json',
                            success: function(response) {
                                $('#pauseModal').modal('hide');
                                Swal.fire('Success!',
                                        'Status updated successfully!',
                                        'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error!',
                                    'Failed to update status!',
                                    'error').then(
                                    () => {
                                        location.reload();
                                    });
                            }
                        });
                    } else {
                        console.log("Procurement ID is not found");
                    }
                });
            });
        });


       


    });
</script>
