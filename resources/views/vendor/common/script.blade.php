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

        // Delete Product modal code 
        $(document).ready(function() {
            // Trigger delete modal and populate with order id
            $(document).on('click', '.deleteProduct', function() {
                var orderId = $(this).data('id');
                // Set the order id in the modal's hidden input field
                $('#delete_order_id').val(orderId);

                // Show the delete confirmation modal
                $('#deleteProductModal').modal('show');
            });
        });




        // Make quotation code
        $(document).ready(function() {
            $(document).on('click', '.make-quotation-btn', function() {
                var orderId = $(this).data('id');
                var quantity = $(this).data('quantity');
                console.log("Need Quantity", quantity);

                $('#order_id').val(orderId);
                $('#quotationModal').modal('show');

                // In quotation margin calculated code here
                $(document).on('change', '#vendorproduct', function() {
                    const productId = $(this).val();
                    console.log("Vendor Product Id", productId);
                    if (productId) {
                        $.ajax({
                            url: '{{ route('vendor.getProductDetails') }}',
                            type: 'GET',
                            data: {
                                product_id: productId
                            },
                            success: function(response) {
                                console.log("AJAX Response:", response);
                                if (response.success) {

                                    const vendorProductSalePrice = response
                                        .salePrice;
                                    const procurementQuantity = quantity;


                                    const totalCost =
                                        vendorProductSalePrice *
                                        procurementQuantity;


                                    $('#calculatedamount').val(totalCost
                                        .toFixed(2));
                                } else {
                                    console.error(
                                        'Failed to retrieve product details.'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire('Error!',
                                    'Could not fetch product details.',
                                    'error');
                            }
                        });
                    } else {
                        $('#calculatedamount').val(
                            '');
                    }
                });
            });
            $('#givediscountamount').on('input', function() {
                updateFinalAmount();
            });

            function updateFinalAmount() {
                const calculatedAmount = parseFloat($('#calculatedamount').val()) || 0;
                const discount = parseFloat($('#givediscountamount').val()) || 0;
                const finalAmount = calculatedAmount - discount;

                $('#finalamount').val(finalAmount.toFixed(2));
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
