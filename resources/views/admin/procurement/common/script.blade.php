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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="badge bg-success text-light"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.326 18.092c-.327.275-.61.41-.906.408c-.68-.007-1.247-.703-2.38-2.094l-1.515-1.86c-.624-.766-.7-1.907-.185-2.767c.588-.984 1.717-1.259 2.596-.766M10.922 8.5a52 52 0 0 1 2.556-2.513A1.77 1.77 0 0 1 15 5.527m-.894 10.784c2.26-2.62 4.441-4.396 7.182-6.913c.82-.753.947-2.073.303-3.009c-.684-.994-1.983-1.193-2.863-.402c-2.51 2.255-4.463 4.427-6.315 6.748c-.098.122-.146.183-.197.217a.37.37 0 0 1-.416.003c-.051-.034-.1-.094-.197-.213l-.987-1.21c-.9-1.106-2.516-.983-3.268.246c-.527.861-.449 2.002.189 2.768l1.548 1.86c1.157 1.391 1.736 2.087 2.431 2.094s1.327-.725 2.59-2.189" color="#000000"/></svg>&nbsp;Approve</span>
                                                
                                            </div>
                                        </div>
                                    </a>` : `Already Approved`;
                            const alreadyapprove = getAsset.is_approved === 1 ?
                                `<span class="badge bg-success text-light">Approved</span>` :
                                ``;
                            const row = `
                            <tr>
                                <th class="text-center text-danger" scope="row">${count}</th>
                                <td class="text-center text-secondary fs-12">${getAsset.vendor.name ?? 'Null'} ${alreadyapprove}</td>
                                <td class="text-center text-secondary fs-12">₹ ${getAsset.total_item_price}</td>
                                <td class="text-center text-secondary">${getAsset.final_delivery_date ?? 'Timely Delivered'}</td>
                                <td class="text-center text-secondary"><textarea name="specification" class="form-control text-center p-1" cols="30" rows="2" readonly >${getAsset.remark}</textarea></td>
                                <td class="text-center">
                                    <a style="text-decoration:none;" class="text-danger" href="${getAsset.bill_file ? `{{ asset('assets/uploads/vendor/bill/') }}/${getAsset.bill_file}` : 'javascript:void(0);'}" ${getAsset.bill_file ? `download` : ``}>${getAsset.bill_file || 'Bill Not Generated'}</a>
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
