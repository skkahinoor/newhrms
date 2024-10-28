@extends('layouts.master')
@section('title', 'Procurement')
@section('action', 'Procurements')
@section('button')
    @can('create_procurement')
        <a href="{{ route('admin.procurement.create') }}">
            <button class="btn btn-primary">
                <i class="link-icon" data-feather="plus"></i>Add Request
            </button>
        </a>
    @endcan
@endsection
@section('main-content')
    <style>
        .navbar {
            position: absolute !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #e82e5f !important;
            border-color: #e82e5f !important;
        }

        .btn-block {
            height: fit-content;
        }

        .filter-btn {
            margin-top: 8px;
        }

        .dropdown-item {
            color: #0e0d0d !important;
        }

        .table thead th {
            font-size: 12px !important;
            font-weight: 600 !important;

        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <section class="content">
        @include('admin.section.flash_message')
        @include('admin.procurement.breadCrumb')


        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="overflow-x: clip !important;">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Request Number</th>
                                <th>Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Types</th>
                                <th class="text-center">Brands</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Request Date</th>
                                <th class="text-center">Status</th>
                                @canany(['edit_type', 'delete_type'])
                                    <th class="text-center">Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $changeColor = [
                                0 => 'warning',
                                1 => 'primary',
                                2 => 'info',
                                3 => 'success',
                                4 => 'danger',
                            
                                // null => 'danger'
                            ];
                            $changeTextColor = [
                                0 => '#000000',
                                1 => '#ffffff',
                                2 => '#ffffff',
                                3 => '#ffffff',
                                4 => '#ffffff',
                            ];
                            $changeStatusValue = [
                                0 => 'Pending',
                                1 => 'Approved',
                                2 => 'In Process',
                                3 => 'Delivered',
                                4 => 'Pause',
                            ];
                            ?>
                            <tr>
                                @forelse($requests as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-center">
                                    {{ $value->procurement_number }}
                                </td>
                                <td>{{ $value->users->name }}</td>
                                <td class="text-center">
                                    {{ $value->email }}
                                </td>
                                <td class="text-center">
                                    {{ $value->asset_types->name }}
                                </td>
                                <td class="text-center">
                                    {{ $value->brands->name }}
                                </td>
                                <td class="text-center">
                                    {{ $value->quantity }}
                                </td>
                                <td class="text-center">
                                    {{ $value->request_date }}
                                </td>
                                <td class="text-center">
                                    <h6 style="border-radius: 5px; padding: 4px; opacity: 0.6; font-family: serif; color: {{ $changeTextColor[$value->status] }};"
                                        class="btn-{{ $changeColor[$value->status] }}">
                                        {{ $changeStatusValue[$value->status] ?? 'null' }}
                                    </h6>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown dropstart">
                                        <button style="padding: 5px 5px !important; border-color: #7987a1 !important;"
                                            class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                                viewBox="0 0 16 16">
                                                <g fill="none" stroke="#E82E5F" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5">
                                                    <circle cx="8" cy="2.5" r=".75" />
                                                    <circle cx="8" cy="8" r=".75" />
                                                    <circle cx="8" cy="13.5" r=".75" />
                                                </g>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('show_procurement')
                                                <li>
                                                    <a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                        class="dropdown-item enquire-modal-trigger"
                                                        href="{{ route('admin.procurement.show', $value->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                                            viewBox="0 0 50 50">
                                                            <g fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="4">
                                                                <path stroke="#344054"
                                                                    d="M39.583 25S33.063 33.333 25 33.333C16.938 33.333 10.417 25 10.417 25s6.52-8.333 14.583-8.333S39.583 25 39.583 25M25 20.833a4.167 4.167 0 1 0 0 8.334a4.167 4.167 0 0 0 0-8.334" />
                                                                <path stroke="#E82E5F"
                                                                    d="M6.25 14.583v-6.25A2.083 2.083 0 0 1 8.333 6.25h6.25m29.167 8.333v-6.25a2.083 2.083 0 0 0-2.083-2.083h-6.25M6.25 35.417v6.25a2.083 2.083 0 0 0 2.083 2.083h6.25m29.167-8.333v6.25a2.083 2.083 0 0 1-2.083 2.083h-6.25" />
                                                            </g>
                                                        </svg>&nbsp;View
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('edit_procurement')
                                                <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                        class="dropdown-item"
                                                        href="{{ route('admin.procurement.edit', $value->id) }}"
                                                        title="Edit Lead Enquiries"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="1rem" height="1rem" viewBox="0 0 48 48">
                                                            <g fill="none" stroke="#000" stroke-linejoin="round"
                                                                stroke-width="4">
                                                                <path stroke-linecap="round"
                                                                    d="M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6" />
                                                                <path fill="#E82E5F"
                                                                    d="M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z" />
                                                            </g>
                                                        </svg>&nbsp;Edit
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('delete_procurement')
                                                <li><a style="cursor: pointer;color: #383838 !important;font-size:13px;font-weight:bold;"
                                                        class="dropdown-item deleteLeadEnquiryLink"
                                                        href="{{ route('admin.procurement.delete', $value->id) }}"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                                            viewBox="0 0 48 48">
                                                            <g fill="none" stroke-linejoin="round" stroke-width="4">
                                                                <path fill="#E82E5F" stroke="#000" d="M9 10V44H39V10H9Z" />
                                                                <path stroke="#fff" stroke-linecap="round" d="M20 20V33" />
                                                                <path stroke="#fff" stroke-linecap="round" d="M28 20V33" />
                                                                <path stroke="#000" stroke-linecap="round" d="M4 10H44" />
                                                                <path fill="#E82E5F" stroke="#000"
                                                                    d="M16 10L19.289 4H28.7771L32 10H16Z" />
                                                            </g>
                                                        </svg>&nbsp;Delete
                                                    </a>
                                                </li>
                                            @endcan
                                            @if ($value->status == 0)
                                                <li>
                                                    <a style="cursor: pointer; color: #383838 !important; font-size: 13px; font-weight: bold;"
                                                        class="dropdown-item deleteLeadEnquiryLink" href="#"
                                                        data-id="{{ $value->id }}" data-toggle="modal"
                                                        data-target="#confirmModal"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="1.2rem"
                                                            height="1.2rem" viewBox="0 0 24 24">
                                                            <path fill="#ff4242"
                                                                d="m23 12l-2.44-2.78l.34-3.68l-3.61-.82l-1.89-3.18L12 3L8.6 1.54L6.71 4.72l-3.61.81l.34 3.68L1 12l2.44 2.78l-.34 3.69l3.61.82l1.89 3.18L12 21l3.4 1.46l1.89-3.18l3.61-.82l-.34-3.68zm-13 5l-4-4l1.41-1.41L10 14.17l6.59-6.59L18 9z" />
                                                        </svg>
                                                        &nbsp;Approve This Procurement
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a style="cursor: pointer; color: #383838 !important; font-size: 13px; font-weight: bold;"
                                                    class="dropdown-item pauseOrder" href="#"
                                                    data-id="{{ $value->id }}" data-toggle="modal"
                                                    data-target="#pauseModal"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1.2rem" height="1.2rem" viewBox="0 0 24 24">
                                                        <g fill="none" stroke="#ff4242" stroke-dasharray="32"
                                                            stroke-dashoffset="32" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2">
                                                            <path d="M7 6h2v12h-2Z">
                                                                <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                    dur="0.4s" values="32;0" />
                                                            </path>
                                                            <path d="M15 6h2v12h-2Z">
                                                                <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                    begin="0.4s" dur="0.4s" values="32;0" />
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    &nbsp;Pause This Procurement
                                                </a>
                                            </li>
                                            <li>
                                                <a style="cursor: pointer; color: #383838 !important; font-size: 13px; font-weight: bold;"
                                                    class="dropdown-item pauseOrder" href="#"
                                                    data-id="{{ $value->id }}" data-toggle="modal"
                                                    data-target="#pauseModal">
                                                    &nbsp;Quotation List
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <!-- Modal -->

                            @empty
                            <tr>
                                <td colspan="100%">
                                    <p class="text-center"><b>No records found!</b></p>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <br>
                    <div class="row" style="padding-left: 7px !important;">{{ $requests->links() }}</div>
                </div>
            </div>
        </div>


    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>

    {{-- Change Status Modal  --}}
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Status Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change the status?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmStatusChange">Yes, Change Status</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Pause Procurement modal  --}}
    <div class="modal fade" id="pauseModal" tabindex="-1" role="dialog" aria-labelledby="pauseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pauseModalLabel">Confirm To Pause</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Pause the Procurement?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="pauseStatusChange">Yes, Pause Now</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JS code to change status - approved
        document.addEventListener('DOMContentLoaded', function() {

            let procurementId = null;


            document.querySelectorAll('.deleteLeadEnquiryLink').forEach(function(link) {
                link.addEventListener('click', function() {

                    procurementId = this.getAttribute(
                        'data-id');
                });
            });

            // Handle the modal confirmation
            document.getElementById('confirmStatusChange').addEventListener('click', function() {
                console.log(procurementId);

                if (procurementId) {
                    // Make AJAX request to change the status
                    fetch(`procurement/${procurementId}/change-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: 1
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $('#confirmModal').modal('hide');
                                Swal.fire('Success!', 'Status updated successfully!',
                                    'success').then(() => {
                                    location
                                        .reload();
                                });
                            } else {
                                Swal.fire('Error!', 'Failed to update status!',
                                    'error').then(() => {
                                    location
                                        .reload();
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });

        // JS code to change status - pause
        document.addEventListener('DOMContentLoaded', function() {

            let procurementId = null;


            document.querySelectorAll('.pauseOrder').forEach(function(link) {
                link.addEventListener('click', function() {

                    procurementId = this.getAttribute(
                        'data-id');
                });
            });

            // Handle the modal confirmation
            document.getElementById('pauseStatusChange').addEventListener('click', function() {
                console.log(procurementId);

                if (procurementId) {
                    // Make AJAX request to change the status
                    fetch(`procurement/${procurementId}/pause-status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: 4
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Close the modal regardless of success or error
                            $('#pauseModal').modal('hide');

                            if (data.success) {
                                // Show success alert with SweetAlert2 and reload
                                Swal.fire('Success!', 'Status updated successfully!', 'success')
                                    .then(() => location.reload());
                            } else {
                                // Show error alert with SweetAlert2 and reload
                                Swal.fire('Error!', 'Failed to update status!', 'error')
                                    .then(() => location.reload());
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Handle unexpected errors gracefully
                            Swal.fire('Error!', 'An unexpected error occurred!', 'error')
                                .then(() => location.reload());
                        });
                }
            });

        });
    </script>

@endsection

@section('scripts')
    <!-- @include('admin.assetManagement.assetAssignment.scripts') -->
    @include('admin.procurement.script')
    <!-- @include('admin.assetManagement.types.common.scripts') -->
@endsection
