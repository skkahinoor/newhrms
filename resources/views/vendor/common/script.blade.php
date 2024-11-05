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
                                <td class="text-center"><textarea name="specification" class="form-control p-1" cols="30" rows="2" readonly >${getAsset.specification}</textarea></td>
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
                var orderId = $(this).data('id');
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

                            // Show the div and add event listeners for calculation
                            $('#append-asset').show();

                            // Attach event listeners to calculate total amount
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
                // Event listener for any change in `amountperproduct` or `givediscount`
                $('#append-asset').on('input', '.amountperproduct, .givediscount', function() {
                    const index = $(this).attr('id').split('_')[
                    1]; // Extract the index from the ID

                    // Select elements by index
                    const quantity = parseFloat($(`[name="productQuantity[${index}]"]`)
                    .val()) || 0;
                    const pricePerProduct = parseFloat($(`#amountperproduct_${index}`).val()) ||
                        0;
                    const discount = parseFloat($(`#givediscount_${index}`).val()) || 0;

                    // Calculate total
                    const totalAmount = (quantity * pricePerProduct) - discount;

                    // Set the final amount
                    $(`#finalamount_${index}`).val(totalAmount.toFixed(2));
                });
            }






            $('#quotationForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
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









    });
</script>
