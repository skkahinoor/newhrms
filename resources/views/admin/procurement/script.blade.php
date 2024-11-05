<script>
    let procurementItems = []; // Array to store the procurement items

    $(document).ready(function() {
        // Cache the HTML for the `type` and `brand` dropdowns for reuse
        let typeOptions = $('#type').html();
        let brandOptions = $('#brand').html();

        // Handler for adding items
        $('.btn-primary[type="add"]').click(function(event) {
            event.preventDefault();

            // Collect data from the form
            let assetTypeId = $('#type').val();
            let brandId = $('#brand').val();
            let quantity = $('#procurement_quantity').val();
            let specification = $('#specification').val();

            // Validation
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

            // Get index for the newly added item
            let index = procurementItems.length - 1;

            // Append the item to the table with editable selects and inputs
            $('#added-items tbody').append(`
            <tr class='text-center' data-index="${index}">
                <td>
                    <select class="form-control edit-type" data-index="${index}">
                        ${typeOptions}
                    </select>
                </td>
                <td>
                    <select class="form-control edit-brand" data-index="${index}">
                        ${brandOptions}
                    </select>
                </td>
                <td><input type="number" value="${quantity}" min="1" class="form-control edit-quantity" data-index="${index}"></td>
                <td><textarea class="form-control edit-specification" data-index="${index}" cols="15" rows="1">${specification}</textarea></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-item">Remove</button></td>
            </tr>
        `);

            // Set the selected options for type and brand
            $(`.edit-type[data-index="${index}"]`).val(assetTypeId);
            $(`.edit-brand[data-index="${index}"]`).val(brandId);

            // Reset form fields
            $('#type, #brand').prop('selectedIndex', 0);
            $('#procurement_quantity, #specification').val('');
        });

        // Remove item handler
        $(document).on('click', '.remove-item', function() {
            let index = $(this).closest('tr').data('index');
            procurementItems.splice(index, 1); // Remove the item from array
            $(this).closest('tr').remove(); // Remove the row from the table

            // Update indices for remaining items
            $('#added-items tbody tr').each((i, row) => {
                $(row).attr('data-index', i);
                $(row).find('.edit-type, .edit-brand, .edit-quantity, .edit-specification')
                    .attr('data-index', i);
            });
        });

        // Update asset_type_id in procurementItems when changed in the table
        $(document).on('change', '.edit-type', function() {
            let index = $(this).data('index');
            procurementItems[index].asset_type_id = $(this).val();
        });

        // Update brand_id in procurementItems when changed in the table
        $(document).on('change', '.edit-brand', function() {
            let index = $(this).data('index');
            procurementItems[index].brand_id = $(this).val();
        });

        // Update quantity in procurementItems when changed in the table
        $(document).on('input', '.edit-quantity', function() {
            let index = $(this).data('index');
            procurementItems[index].quantity = $(this).val();
        });

        // Update specification in procurementItems when changed in the table
        $(document).on('input', '.edit-specification', function() {
            let index = $(this).data('index');
            procurementItems[index].specification = $(this).val();
        });

        // Before form submission, set procurement_items field value
        $('form').submit(function() {
            $('#procurement_items').val(JSON.stringify(procurementItems));
        });
    });

    
</script>
