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
                        url: '{{ route('vendor.getAssetDetails', ['id' => ':id']) }}'.replace(':id', ProcurementId),
                        type: 'GET',
                        data: {
                            procurement_id: ProcurementId
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function() {
                            Swal.fire('Error!',
                                'Could not fetch product details.',
                                'error');
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
                var quantity = $(this).data('quantity');
                console.log("Need Quantity", quantity);

                $('#order_id').val(orderId);
                $('#quotationModal').modal('show');

                // In quotation margin calculated code here
                $(document).on('change', '#vendorproduct', function() {
                    const productId = $(this).val();
                    console.log("Vendor Product Id", productId);
                    if (productId) {
                       
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
