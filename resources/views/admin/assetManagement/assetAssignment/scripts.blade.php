<script>

function getFilterParameters() {
        let params = {
            name: $('#user').val(),
            assign_date : $('#assigned_date').val(),
            return_date: $('#returned_date').val(),
            return_status : $('#return_status').val(),
            damaged: $('#damaged').val(),
            type : $('#type').val(),
        }
        return params;
    }

    $('#download-csv-report').on('click', function(e) {
        e.preventDefault();
        console.log('comming to js ');
        let route = $(this).data('href');
        let filtered_params = getFilterParameters();
        filtered_params.download_excel = true;
        let queryString = $.param(filtered_params)
        let url = route + '?' + queryString;
        window.open(url, '_blank');
    })
    
    $('#type').change(function() {
        let selectedAssetTypeId = $('#type option:selected').val();
        console.log(selectedAssetTypeId);
        url = "{{ url('admin/asset-assignments/get-All-Assets') }}" + '/' + selectedAssetTypeId;
        let assetId = null;
        $('#assign_asset').empty();
        if (selectedAssetTypeId) {
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/asset-assignments/get-All-Assets') }}" + '/' + selectedAssetTypeId,
            }).done(function(response) {
                console.log(response.data.length);
                if (!selectedAssetTypeId) {
                    $('#assign_asset').append('<option disabled  selected >Select Type first</option>');
                }
                if (response.data.length == 0) {
                    $('#assign_asset').append('<option disabled  selected >No Assets</option>');
                }
                response.data.forEach(function(data) {
                    $('#assign_asset').append('<option ' + ((data.id === selectedAssetTypeId) ? "selected" : '') + ' value="' + data.id + '" >' + capitalize(data.name) + '</option>');
                });
            });
        }
    }).trigger('change');

    function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (let chr = 0; chr < str.length; chr++) {
            strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
        }
        return strVal
    }

    document.addEventListener("DOMContentLoaded", function() {
        const damageSelects = document.getElementsByClassName("damage_select");
        const damageFields = document.getElementsByClassName("damageFields");
        const returnDateFields = document.getElementsByClassName("returnDateField");

        Array.from(damageSelects).forEach((damageSelect, index) => {
            damageSelect.addEventListener("change", function() {
                console.log("Change event triggered for modal", index);
                const damageCostInput = damageFields[index].querySelector("#damageCost");
                const amountPaidSelect = damageFields[index].querySelector("#amountPaid");
                const damageReasonTextarea = damageFields[index].querySelector("#reason");
                const returnDateInput = returnDateFields[index].querySelector("#returnDate");

                if (damageSelect.value == "1") {
                    // Show all fields if 'Yes' is selected
                    damageFields[index].style.display = "block";
                    returnDateFields[index].style.display = "block";

                    // Make damage-related fields mandatory
                    damageCostInput.setAttribute("required", "required");
                    amountPaidSelect.setAttribute("required", "required");
                    damageReasonTextarea.setAttribute("required", "required");
                    returnDateInput.setAttribute("required", "required");
                } else if (damageSelect.value == "0") {
                    // Show only the return date if 'No' is selected
                    damageFields[index].style.display = "none";
                    returnDateFields[index].style.display = "block";

                    // Remove mandatory attribute from damage-related fields
                    damageCostInput.removeAttribute("required");
                    amountPaidSelect.removeAttribute("required");
                    damageReasonTextarea.removeAttribute("required");

                    // Make only the return date mandatory
                    returnDateInput.setAttribute("required", "required");
                } else {
                    // Hide all fields if no valid option is selected
                    damageFields[index].style.display = "none";
                    returnDateFields[index].style.display = "none";

                    // Remove mandatory attribute from all fields
                    damageCostInput.removeAttribute("required");
                    amountPaidSelect.removeAttribute("required");
                    damageReasonTextarea.removeAttribute("required");
                    returnDateInput.removeAttribute("required");
                }
            });
        });
    });
</script>