@extends('layouts.master')

@section('title','Add Procurement')

@section('action','Procurement Request')

@section('main-content')

<section class="content">

    @include('admin.section.flash_message')

    @include('admin.procurement.breadCrumb')

    <div class="card">
        <div class="card-body">
            <form id="" class="forms-sample" action="{{route('admin.procurement.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                @include('admin.procurement.form')
            </form>
        </div>
    </div>

</section>

<script>
    $(document).ready(function() {
        // Initialize an empty array to store entries
        let procurementItems = [];

        // Handle the "Add" button click
        $('.btn-primary[type="add"]').click(function(e) {
            e.preventDefault(); // Prevent form submission

            // Get input values
            const assetTypeId = $('#type').val();
            const assetTypeText = $('#type option:selected').text();
            const brandId = $('#brand').val();
            const brandText = $('#brand option:selected').text();
            const quantity = $('#procurement_quantity').val();
            const specification = $('#specification').val();

            // Validate fields
            if (!assetTypeId || !brandId || !quantity || !specification) {
                alert("All fields are required.");
                return;
            }

            // Create an entry object and push to the array
            const entry = {
                asset_type_id: assetTypeId,
                asset_type_name: assetTypeText,
                brand_id: brandId,
                brand_name: brandText,
                quantity: quantity,
                specification: specification
            };
            procurementItems.push(entry);

            // Append the new entry to the table
            $('#added-items tbody').append(`
                <tr>
                    <td>${assetTypeText}</td>
                    <td>${brandText}</td>
                    <td>${quantity}</td>
                    <td>${specification}</td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-item" data-index="${procurementItems.length - 1}">Remove</button></td>
                </tr>
            `);

            // Clear input fields
            $('#type').val('');
            $('#brand').val('');
            $('#procurement_quantity').val('');
            $('#specification').val('');
        });

        // Remove entry from array and table on click of "Remove" button
        $('#added-items').on('click', '.remove-item', function() {
            const index = $(this).data('index');
            procurementItems.splice(index, 1); // Remove from array
            $(this).closest('tr').remove(); // Remove row from table
        });

        // When the "Create" button is pressed, convert array to JSON and append it to the form
        $('#create-button').click(function() {
            const jsonData = JSON.stringify(procurementItems); // Convert array to JSON

            // Check if hidden input already exists, update it; otherwise, create a new one
            let hiddenInput = $('input[name="procurement_items"]');
            if (hiddenInput.length) {
                hiddenInput.val(jsonData);
            } else {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'procurement_items',
                    value: jsonData
                }).appendTo('form');
            }

            // Submit the form
            $('form').submit();
        });

    });
</script>

@endsection

@section('scripts')
@include('admin.assetManagement.assetAssignment.scripts')
@endsection