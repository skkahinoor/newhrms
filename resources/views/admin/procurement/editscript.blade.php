<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                    <td>${item.type_name}</td>
                    <td>${item.brand_name}</td>
                    <td>${item.quantity}</td>
                    <td>${item.specification}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">Remove</button></td>
                </tr>`;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
            document.getElementById('procurement_items').value = JSON.stringify(procurementItems);
        }

        document.getElementById('addItem').addEventListener('click', function() {
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
            renderTable();
        });

        window.removeItem = function(index) {
            procurementItems.splice(index, 1);
            renderTable();
        };

        renderTable();
    });
</script>
