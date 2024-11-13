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


        <div class="card">
            <div class="card-body">
                {!! $dataTable->table() !!}
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
    <div class="modal fade" id="viewlist" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-bysk" style="top: 0% !important;">
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
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">#
                                    </th>
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">
                                        Vendor Name</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">
                                        Vendor Price</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">
                                        Expected Delivery Date</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">
                                        Remark</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">
                                        Bill</th>
                                    <th scope="col" style="color: white !important; font-weight:bold;font-size: 6px;">
                                        Actions</th>
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
                </div>
            </div>
        </div>
    </div>



    {{-- Change Status Modal  --}}
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="top: 25% !important;">
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
    {!! $dataTable->scripts() !!}
@endsection
