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
                                <th class="text-center">Request Date</th>
                                <th class="text-center">Delivery Date</th>
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
                                    {{ $value->procurement_number ?? 'Null' }}
                                </td>
                                <td>{{ $value->users->name ?? 'Null' }}</td>
                                <td class="text-center">
                                    {{ $value->email }}
                                </td>
                                <td class="text-center">
                                    {{ $value->request_date ?? 'Null' }}
                                </td>
                                <td class="text-center">
                                    {{ $value->delivery_date ?? 'Null' }}
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
                                                    <a class="dropdown-item enquire-modal-trigger"
                                                        href="{{ route('admin.procurement.show', $value->id) }}"
                                                        style="font-weight:bold;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem"
                                                            viewBox="0 0 24 24">
                                                            <path fill="none" stroke="#ff3366" stroke-width="2"
                                                                d="M12 21c-5 0-11-5-11-9s6-9 11-9s11 5 11 9s-6 9-11 9Zm0-14a5 5 0 1 0 0 10a5 5 0 0 0 0-10Z" />
                                                        </svg>
                                                        &nbsp;View
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('edit_procurement')
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.procurement.edit', $value->id) }}"
                                                        title="Edit Procurement" style="font-weight:bold;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem"
                                                            viewBox="0 0 24 24">
                                                            <g fill="none" stroke="#ff3366" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2">
                                                                <path stroke-dasharray="20" stroke-dashoffset="20" d="M3 21h18">
                                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                        dur="0.2s" values="20;0" />
                                                                </path>
                                                                <path stroke-dasharray="48" stroke-dashoffset="48"
                                                                    d="M7 17v-4l10 -10l4 4l-10 10h-4">
                                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                        begin="0.2s" dur="0.6s" values="48;0" />
                                                                </path>
                                                                <path stroke-dasharray="8" stroke-dashoffset="8" d="M14 6l4 4">
                                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                        begin="0.8s" dur="0.2s" values="8;0" />
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        &nbsp;Edit
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('delete_procurement')
                                                <li>
                                                    <a class="dropdown-item deleteLeadEnquiryLink"
                                                        href="{{ route('admin.procurement.delete', $value->id) }}"
                                                        style="cursor: pointer; font-weight:bold;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem"
                                                            viewBox="0 0 24 24">
                                                            <path fill="#ff3366" d="M8 9h8v10H8z" opacity="0.3" />
                                                            <path fill="#ff3366"
                                                                d="m15.5 4l-1-1h-5l-1 1H5v2h14V4zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zM8 9h8v10H8z" />
                                                        </svg>
                                                        &nbsp;Delete
                                                    </a>
                                                </li>
                                            @endcan

                                            <!-- Approval Options -->
                                            @if ($isAdmin)
                                                @if ($value->status != 1 && $value->status != 4 && $value->status != 2 && $value->status != 3)
                                                    <li>
                                                        <a class="dropdown-item deleteLeadEnquiryLink" href="#"
                                                            data-id="{{ $value->id }}" data-toggle="modal"
                                                            data-target="#confirmModal" style="font-weight:bold;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                                height="1.4rem" viewBox="0 0 24 24">
                                                                <path fill="#ff3366"
                                                                    d="m17.371 19.827l2.84-2.796l-.626-.627l-2.214 2.183l-.955-.975l-.627.632zM6.77 8.731h10.462v-1H6.769zM18 22.116q-1.671 0-2.835-1.165Q14 19.787 14 18.116t1.165-2.836T18 14.116t2.836 1.164T22 18.116q0 1.67-1.164 2.835Q19.67 22.116 18 22.116M4 20.769V5.616q0-.672.472-1.144T5.616 4h12.769q.67 0 1.143.472q.472.472.472 1.144v5.944q-.892-.293-1.828-.301t-1.845.241H6.769v1h7.312q-.752.521-1.326 1.223t-.946 1.546H6.77v1h4.71q-.108.404-.168.815t-.061.858q0 .685.143 1.359t.43 1.299l-.034.034l-1.135-.826l-1.346.961l-1.346-.961l-1.346.961l-1.347-.961z" />
                                                            </svg>
                                                            &nbsp;Approve
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif

                                            <!-- Pause and Resume Options -->
                                            @if ($value->status == 1)
                                                <li>
                                                    <a class="dropdown-item pauseOrder" href="#"
                                                        data-id="{{ $value->id }}" data-toggle="modal"
                                                        data-target="#pauseModal" style="font-weight:bold;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                            height="1.4rem" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="#ff3366" stroke-dasharray="32"
                                                                stroke-dashoffset="32" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2">
                                                                <path d="M7 6h2v12h-2Z">
                                                                    <animate fill="freeze"
                                                                        attributeName="stroke-dashoffset" dur="0.4s"
                                                                        values="32;0" />
                                                                </path>
                                                                <path d="M15 6h2v12h-2Z">
                                                                    <animate fill="freeze"
                                                                        attributeName="stroke-dashoffset" begin="0.4s"
                                                                        dur="0.4s" values="32;0" />
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        &nbsp;Pause
                                                    </a>
                                                </li>
                                            @endif


                                            @if ($isAdmin && $value->status == 4)
                                                <li>
                                                    <a class="dropdown-item resumeOrder" href="#"
                                                        data-id="{{ $value->id }}" data-toggle="modal"
                                                        data-target="#resumeModal" style="font-weight:bold;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                            height="1.4rem" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="#ff3366" stroke-width="2"
                                                                d="M1 20h5V4H1zm10-1l11-7l-11-7z" />
                                                        </svg>
                                                        &nbsp;Resume
                                                    </a>
                                                </li>
                                            @endif

                                            <!-- Quotation List -->
                                            @if ($isAdmin)
                                                <li>
                                                    <a class="dropdown-item viewlist" href="javascript:void(0);"
                                                        data-id="{{ $value->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#viewlist" style="font-weight:bold;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                            height="1.4rem" viewBox="0 0 24 24">
                                                            <path fill="#ff3366" fill-rule="evenodd"
                                                                d="M20 4H4a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1M4 2a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h16a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3zm2 5h2v2H6zm5 0a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2zm-3 4H6v2h2zm2 1a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2h-6a1 1 0 0 1-1-1m-2 3H6v2h2zm2 1a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2h-6a1 1 0 0 1-1-1"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        &nbsp;Quotation List
                                                    </a>
                                                </li>
                                            @endif

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

    {{-- Quotation List  --}}
    <!-- Modal -->
    <div class="modal fade" id="viewlist" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="top: 0% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Quotation List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table mt-3">
                            <thead>
                                <tr class="bg-danger bg-gradient text-center">
                                    <th scope="col" style="color: white !important; font-weight:bold;">Type</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;">Brand</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;">Quantity</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;">Specification</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="approve-list">
                                {{-- append data will be here  --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


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

    {{-- Resume Procurement modal  --}}
    <div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pauseModalLabel">Confirm To Resume</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Resume the Procurement?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="resumeStatusChange">Yes, Resume Now</button>
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

        // JS code to change status - Resume
        document.addEventListener('DOMContentLoaded', function() {

            let procurementId = null;


            document.querySelectorAll('.resumeOrder').forEach(function(link) {
                link.addEventListener('click', function() {

                    procurementId = this.getAttribute(
                        'data-id');
                });
            });

            // Handle the modal confirmation
            document.getElementById('resumeStatusChange').addEventListener('click', function() {
                console.log(procurementId);

                if (procurementId) {
                    // Make AJAX request to change the status
                    fetch(`procurement/${procurementId}/resume-status`, {
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
                            // Close the modal regardless of success or error
                            $('#resumeModal').modal('hide');

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
    @include('admin.procurement.common.script')
    <!-- @include('admin.assetManagement.types.common.scripts') -->
@endsection
