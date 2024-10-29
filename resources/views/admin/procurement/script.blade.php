<script>
    let procurementItems = []; // Array to store the procurement items

    $(document).ready(function() {
        // Handler for adding items
        $('.btn-primary[type="add"]').click(function(event) {
            event.preventDefault();

            // Collect the data from the form
            let assetTypeId = $('#type').val();
            let brandId = $('#brand').val();
            let quantity = $('#procurement_quantity').val();
            let specification = $('#specification').val();

            // Optional validation to ensure fields are filled
            if (!assetTypeId || !brandId || !quantity || !specification) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please fill in all fields before adding.',
                });

                return;
            }

            // Add item to the procurementItems array
            let item = {
                asset_type_id: assetTypeId,
                brand_id: brandId,
                quantity: quantity,
                specification: specification
            };
            procurementItems.push(item);

            // Add the item to the table
            $('#added-items tbody').append(`
                <tr class='text-center'>
                    <td>${$('#type option:selected').text()}</td>
                    <td>${$('#brand option:selected').text()}</td>
                    <td>${quantity}</td>
                    <td>${specification}</td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-item">Remove</button></td>
                </tr>
            `);

            // Reset form fields
            $('#type, #brand').prop('selectedIndex', 0);
            $('#procurement_quantity, #specification').val('');
        });

        // Remove item handler
        $(document).on('click', '.remove-item', function() {
            let index = $(this).closest('tr').index();
            procurementItems.splice(index, 1); // Remove the item from array
            $(this).closest('tr').remove(); // Remove the row from the table
        });

        // Before form submission, set procurement_items field value
        $('form').submit(function() {
            $('#procurement_items').val(JSON.stringify(procurementItems));
        });
    });
</script>
