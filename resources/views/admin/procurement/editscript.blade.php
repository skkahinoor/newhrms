<script>
    document.addEventListener('DOMContentLoaded', function () {
        let procurementItems = [];

        try {
            procurementItems = JSON.parse(document.getElementById('procurement_items').value || '[]');
            if (!Array.isArray(procurementItems)) {
                procurementItems = [];
            }
        } catch (error) {
            console.error("Error parsing procurement_items:", error);
            procurementItems = [];
        }

        function renderTable() {
            let tableBody = document.querySelector('#added-items tbody');
            tableBody.innerHTML = '';
            procurementItems.forEach((item, index) => {
                let row = `
                <tr class='text-center'>
                    <td>
                        <select class="form-control edit-type" data-index="${index}">
                            ${document.getElementById('type').innerHTML}
                        </select>
                    </td>
                    <td>
                        <select class="form-control edit-brand" data-index="${index}">
                            ${document.getElementById('brand').innerHTML}
                        </select>
                    </td>
                    <td><input type="number" value="${item.quantity}" min="1" class="form-control text-center edit-quantity" data-index="${index}"></td>
                    <td><textarea class="form-control text-center edit-specification" data-index="${index}" cols="15" rows="1">${item.specification}</textarea></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button></td>
                </tr>`;
                tableBody.insertAdjacentHTML('beforeend', row);

                // Set the selected options for type and brand
                document.querySelector(`.edit-type[data-index="${index}"]`).value = item.asset_type_id;
                document.querySelector(`.edit-brand[data-index="${index}"]`).value = item.brand_id;
            });
            document.getElementById('procurement_items').value = JSON.stringify(procurementItems);
        }

        document.getElementById('addItem').addEventListener('click', function () {
            let type = document.getElementById('type').value;
            let typeName = document.querySelector('#type option:checked').textContent;
            let brand = document.getElementById('brand').value;
            let brandName = document.querySelector('#brand option:checked').textContent;
            let quantity = document.getElementById('quantity').value;
            let specification = document.getElementById('specification').value;

            if (!type || !brand || !quantity || !specification) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please fill in all fields before adding.',
                });
                return;
            }

            procurementItems.push({
                asset_type_id: type,
                type_name: typeName,
                brand_id: brand,
                brand_name: brandName,
                quantity,
                specification
            });

            // Clear the form fields after adding
            document.getElementById('type').selectedIndex = 0; // Reset type dropdown
            document.getElementById('brand').selectedIndex = 0; // Reset brand dropdown
            document.getElementById('quantity').value = ''; // Clear quantity input
            document.getElementById('specification').value = ''; // Clear specification textarea

            renderTable();
        });

        window.removeItem = function (index) {
            procurementItems.splice(index, 1);
            renderTable();
        };

        // Update procurementItems when type, brand, quantity, or specification is changed
        document.addEventListener('change', function (event) {
            if (event.target.classList.contains('edit-type')) {
                let index = event.target.dataset.index;
                procurementItems[index].asset_type_id = event.target.value;
                procurementItems[index].type_name = event.target.options[event.target.selectedIndex].textContent;
            } else if (event.target.classList.contains('edit-brand')) {
                let index = event.target.dataset.index;
                procurementItems[index].brand_id = event.target.value;
                procurementItems[index].brand_name = event.target.options[event.target.selectedIndex].textContent;
            }
        });

        document.addEventListener('input', function (event) {
            if (event.target.classList.contains('edit-quantity')) {
                let index = event.target.dataset.index;
                procurementItems[index].quantity = event.target.value;
            } else if (event.target.classList.contains('edit-specification')) {
                let index = event.target.dataset.index;
                procurementItems[index].specification = event.target.value;
            }
        });

        renderTable();
    });
</script>
