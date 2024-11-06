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
                                <th class="text-center" scope="row">${count}</th>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"><textarea name="specification" class="form-control p-1" cols="30" rows="2" readonly >${getAsset.remark}</textarea></td>
                                <td class="text-center"><a href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 24 24"><path fill="none" stroke="#ff3366" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.86 5.392c.428 1.104-.171 1.86-1.33 2.606c-.935.6-2.126 1.252-3.388 2.365c-1.238 1.091-2.445 2.406-3.518 3.7a55 55 0 0 0-2.62 3.437c-.414.591-.993 1.473-.993 1.473A2.25 2.25 0 0 1 8.082 20a2.24 2.24 0 0 1-1.9-1.075c-.999-1.677-1.769-2.34-2.123-2.577C3.112 15.71 2 15.618 2 14.134C2 12.955 2.995 12 4.222 12c.867.032 1.672.373 2.386.853c.456.306.939.712 1.441 1.245a58 58 0 0 1 2.098-2.693c1.157-1.395 2.523-2.892 3.988-4.184c1.44-1.27 3.105-2.459 4.87-3.087c1.15-.41 2.429.153 2.856 1.258" color="#ff3366"/></svg>
                                    </a></td>
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
