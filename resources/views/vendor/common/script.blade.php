<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        console.log("Document is ready");

        // Set up CSRF token for AJAX (if needed)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Event listener for opening the Edit Product modal and populating it with data
        $(document).on('click', '.editProductBtn', function() {
            function calculateModalMargin() {
                let buyPrice = parseFloat($('#buy_price').val());
                let salePrice = parseFloat($('#sale_price').val());

                if (!isNaN(buyPrice) && !isNaN(salePrice)) {
                    let margin = salePrice - buyPrice;
                    $('#modalmargin').val(margin.toFixed(2)); // Display margin with 2 decimal places
                }
            }

            // Listen for changes in buy_price and sale_price fields in the modal
            $('#buy_price, #sale_price').on('input', function() {
                calculateModalMargin();
            });
            console.log("Edit button clicked");

            // Get product data from data attributes
            var orderId = $(this).data('id');
            var productBrand = $(this).data('brand');
            var buyPrice = $(this).data('buyprice');
            var salePrice = $(this).data('saleprice');
            var margin = $(this).data('margin');
            var quantity = $(this).data('quantity');

            // Log the data to make sure they are being fetched correctly
            console.log({
                orderId,
                productBrand,
                buyPrice,
                salePrice,
                margin,
                quantity
            });

            // Populate the modal form fields with product data
            $('#order_id').val(orderId);
            $('#product_brand').val(productBrand);
            $('#buy_price').val(buyPrice);
            $('#sale_price').val(salePrice);
            $('#modalmargin').val(margin);
            $('#quantity').val(quantity);

        });

        function calculateMargin() {
            let buyPrice = parseFloat($('input[name="buyprice"]').val());
            let salePrice = parseFloat($('input[name="saleprice"]').val());

            if (!isNaN(buyPrice) && !isNaN(salePrice)) {
                let margin = salePrice - buyPrice;
                $('input[name="margin"]').val(margin.toFixed(2));
            }
        }

        // Listen for changes in buy price and sale price fields
        $('input[name="buyprice"], input[name="saleprice"]').on('input', function() {
            calculateMargin();
        });

        // Initialize margin calculation on page load if values are pre-filled
        calculateMargin();


        // View Asset On Modal 
        $(document).ready(function() {
            $(document).on('click', '.view-asset', function() {
                const ProcurementId = $(this).data('id');
                console.log("Procurement ID is: ", ProcurementId);

                if (ProcurementId) {
                    $.ajax({
                        url: '{{ route('vendor.getAssetDetails', ['id' => ':id']) }}'
                            .replace(':id', ProcurementId),
                        type: 'GET',
                        data: {
                            procurement_id: ProcurementId
                        },
                        success: function(response) {
                            console.log(response);
                            const tableBody = $('#asset-details-table');
                            tableBody.empty();
                            let count = 1;
                            response.forEach(getAsset => {
                                // let count = 1;
                                const row = `
                            <tr>
                                <td class="text-center">${count}</td>
                                <td class="text-center">${getAsset.assettype ? getAsset.assettype.name : 'N/A'}</td>
                                <td class="text-center">${getAsset.brand.name}</td>
                                <td class="text-center">${getAsset.quantity}</td>
                                <td class="text-center"><textarea name="specification" class="form-control text-center p-1" cols="30" rows="2" readonly >${getAsset.specification}</textarea></td>
                            </tr>
                        `;
                                tableBody.append(row);
                                count++;
                            });
                            $('#asset-details-table').show();
                        },
                        error: function() {
                            console.log("Could not fetch product details.");
                        }
                    });
                } else {
                    console.log("ProcurementId Not found or error");
                }
            });
        });




        // Make quotation code
        $(document).ready(function() {
            $(document).on('click', '.make-quotation-btn', function() {
                const orderId = $(this).data('id');
                console.log("Procurement ID is:", orderId);

                $('#order_id').val(orderId);
                $('#quotationModal').modal('show');

                if (orderId) {
                    $.ajax({
                        url: '{{ route('vendor.sendquotation', ['id' => ':id']) }}'
                            .replace(':id', orderId),
                        type: 'GET',
                        data: {
                            order_id: orderId
                        },
                        success: function(response) {
                            console.log(response);
                            const divBody = $('#append-asset');
                            divBody.empty();

                            response.forEach((item, index) => {
                                const row = `
                            <div class="col-md-2">
                                <label class="text-primary" style="font-size: 11px;font-weight:bold;">Product<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="productType[${index}]" readonly value="${item.assettype ? item.assettype.name : 'N/A'}" style="border: 1px solid #d2d6da !important; padding-left: 5px !important;">
                            </div>
                            <div class="col-md-2">
                                <label class="text-primary" style="font-size: 11px;font-weight:bold;">Brand<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="productBrand[${index}]" readonly value="${item.brand ? item.brand.name : 'N/A'}" style="border: 1px solid #d2d6da !important; padding-left: 5px !important;">
                            </div>
                            <div class="col-md-2">
                                <label class="text-primary" style="font-size: 11px;font-weight:bold;">Quantity<span class="text-danger">*</span></label>
                                <input type="number" class="form-control productQuantity" name="productQuantity[${index}]" readonly value="${item.quantity}" style="border: 1px solid #d2d6da !important; padding-left: 5px !important;">
                            </div>
                            <div class="col-md-2">
                                <label class="text-primary" style="font-size: 11px;font-weight:bold;">Product per price<span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control amountperproduct" id="amountperproduct_${index}" name="amountperproduct[${index}]" required style="border: 1px solid #d2d6da !important; padding-left: 5px !important;">
                            </div>
                            <div class="col-md-2">
                                <label class="text-primary" style="font-size: 11px;font-weight:bold;">Discount Price</label>
                                <input type="number" step="0.01" class="form-control givediscount" id="givediscount_${index}" name="givediscount[${index}]" required style="border: 1px solid #d2d6da !important; padding-left: 5px !important;">
                            </div>
                            <div class="col-md-2">
                                <label class="text-primary" style="font-size: 11px;font-weight:bold;">Total Amount<span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control finalamount" id="finalamount_${index}" name="finalamount[${index}]" readonly required style="border: 1px solid #d2d6da !important; padding-left: 5px !important;">
                            </div>
                        `;
                                divBody.append(row);
                            });

                            $('#append-asset').show();
                            attachCalculationListeners();
                        },
                        error: function() {
                            console.log("Could not fetch product details.");
                        }
                    });
                } else {
                    console.log("OrderId Not found or error");
                }
            });

            function attachCalculationListeners() {
                // Event listener for changes in amountperproduct or givediscount
                $('#append-asset').on('input', '.amountperproduct, .givediscount', function() {
                    const index = $(this).attr('id').split('_')[1];
                    const quantity = parseFloat($(`[name="productQuantity[${index}]"]`)
                        .val()) || 0;
                    const pricePerProduct = parseFloat($(`#amountperproduct_${index}`).val()) ||
                        0;
                    const discount = parseFloat($(`#givediscount_${index}`).val()) || 0;

                    // Calculate and set total for this row
                    const totalAmount = (quantity * pricePerProduct) - discount;
                    $(`#finalamount_${index}`).val(totalAmount.toFixed(2));

                    // Calculate and update overall total
                    calculateTotalAmount();
                });
            }

            // Function to calculate total of all finalamount fields
            function calculateTotalAmount() {
                let grandTotal = 0;

                // Loop through each finalamount input to sum values
                $('.finalamount').each(function() {
                    const amount = parseFloat($(this).val()) || 0;
                    grandTotal += amount;
                });

                // Set the grand total in the total calculate amount field
                $('#totalcalculateamount').val(grandTotal.toFixed(2));
            }

            // Form submission with AJAX
            $('#quotationForm').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('vendor.quotationsStore') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#quotationModal').modal('hide');
                        Swal.fire('Success!', 'Quotation created successfully!',
                                'success')
                            .then(() => location.reload());
                    },
                    error: function(xhr) {
                        Swal.fire('Error!',
                                'Failed to create quotation. Please try again!',
                                'error')
                            .then(() => location.reload());
                    }
                });
            });
        });


        // View Quotation Modal 
        $(document).ready(function() {
            $(document).on('click', '.viewQuotation', function() {
                const proId = $(this).data('id');
                console.log("Procurement Id: ", proId);

                if (proId) {
                    // Fetch Quotation Details
                    $.ajax({
                        url: '{{ route('vendor.getQuotationDetails', ['id' => ':id']) }}'
                            .replace(':id', proId),
                        type: 'GET',
                        success: function(response) {
                            console.log("Quotation Details Response:", response);

                            // Display procurement number
                            const spanshow = $('#show-no');
                            spanshow.empty();
                            spanshow.text(response[0]?.procurement
                                .procurement_number || 'N/A');

                            // Populate Quotation Details
                            const tbody = $('#quotation-view');
                            tbody.empty();
                            response.forEach((list) => {
                                const approvedStatus = list.is_approved ==
                                    1 ? 'Approved By Admin' : 'Rejected';

                                const checkqstatus = list.quotation_status;

                                const row = `
                            <p class="text-dark"><b>Procurement No: </b>${list.procurement.procurement_number || 'N/A'}</p>
                            <p class="text-dark"><b>Total Item Price: </b>₹ ${list.total_item_price || 'Not Set'}</p>
                            <p class="text-dark"><b>Final Delivery Date: </b>${list.final_delivery_date || 'You Delivered on Time'}</p>
                            <p class="text-dark"><b>Remark: </b>${list.remark || 'Not Provided'}</p>
                            <p class="text-dark"><b>Status: </b>${approvedStatus}</p>
                        `;
                                tbody.append(row);
                            });

                            // Display Quotation Items
                            const divitems = $('#show-loop-items');
                            divitems.empty();
                            response.forEach((qitems) => {
                                try {
                                    const itemsArray = typeof qitems
                                        .items === 'string' ? JSON.parse(
                                            qitems.items) : qitems.items;
                                    itemsArray.forEach((item, index) => {
                                        const itemRow = `
                                    <tr class="text-center">
                                        <td>${index + 1}</td>
                                        <td>${item.productType}</td>
                                        <td>${item.productBrand}</td>
                                        <td>${item.productQuantity} PCS</td>
                                        <td>₹${item.product_per_price}</td>
                                        <td>₹${item.discount_price}</td>
                                        <td>₹${item.total_amount}</td>
                                    </tr>
                                `;
                                        divitems.append(itemRow);
                                    });
                                } catch (error) {
                                    console.error("Error parsing items:",
                                        error);
                                }
                            });

                            // Check deliver status
                            const deliveryStatus = response[0].quotation_status ||
                                'Unknown';

                            const deliverydiv = $('#setdeliverybutton');
                            deliverydiv.empty();
                            if (deliveryStatus === 1) {
                                const givdata = `
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="set-deliver" class="btn btn-success" disabled>Already Delivered</button>
                                    `;
                                deliverydiv.append(givdata);
                            } else {
                                const givdata = `
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="set-deliver" class="btn btn-success">Set To Deliver</button>
                                    `;
                                deliverydiv.append(givdata);
                            }

                            // Set to deliver the order
                            $(document).on('click', '#set-deliver', function() {
                                const qID = proId;
                                console.log(
                                    "Another Procurement which Set to Deliver iD: ",
                                    qID);

                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Are you ready to mark this order as delivered?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, deliver it!',
                                    cancelButtonText: 'No, cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: '{{ route('vendor.setDeliver', ['id' => ':id']) }}'
                                                .replace(
                                                    ':id',
                                                    qID),
                                            method: 'POST',
                                            data: {
                                                status: qID
                                            },
                                            success: function(
                                                response
                                            ) {
                                                Swal.fire(
                                                        'Delivered!',
                                                        'The order has been marked as delivered.',
                                                        'success'
                                                    )
                                                    .then(
                                                        function() {
                                                            location
                                                                .reload();
                                                        }
                                                    );
                                            },
                                            error: function(
                                                error) {
                                                Swal.fire(
                                                    'Error!',
                                                    'Failed to update delivery status.',
                                                    'error'
                                                );
                                            }
                                        });
                                    }
                                });
                            });

                        },
                        error: function() {
                            Swal.fire('Error!',
                                'Problem fetching Quotation orders!', 'error');
                        }
                    });
                } else {
                    console.log("Procurement ID is not available!");
                }
            });
        });





        $(document).on('click', '.generate-bill', function() {
            const qbill = $(this).data('bill');
            console.log('Checking existing bill data for quotation ID:', qbill);

            // Display file name when a file is selected
            document.getElementById('billFile').addEventListener('change',
                function() {
                    const file = this.files[0];
                    if (file) {
                        document.getElementById('fileName').innerText =
                            `Selected file: ${file.name}`;
                    }
                });

            // Upload file when the "Upload Bill" button is clicked
            document.getElementById('uploadButton').addEventListener('click',
                function() {
                    const formData = new FormData(document.getElementById(
                        'uploadBillForm'));
                    formData.append('id', qbill);

                    $.ajax({
                        url: '{{ route('vendor.uploadBill', ['id' => ':id']) }}'.replace(
                            ':id', qbill),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                Swal.fire('Success!', 'Bill uploaded successfully.',
                                    'success').then(function() {
                                    location.load();
                                });
                                $('#generate-bill').modal('hide');
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(response) {
                            console.log(response);
                            Swal.fire('Error!', 'An error occurred while uploading.',
                                'error');
                        }
                    });
                });
        });


















    });
</script>
