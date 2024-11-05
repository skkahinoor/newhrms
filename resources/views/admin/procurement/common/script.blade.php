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
                            // let count = 1;
                            const row = `
                            <tr>
                                <td class="text-center">${count}</td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">${getAsset.remark}</td>
                                <td class="text-center"><textarea name="specification" class="form-control p-1" cols="30" rows="2" readonly ></textarea></td>
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
        });
    });
</script>
