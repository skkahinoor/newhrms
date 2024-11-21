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

        .pro-copy-hover {
            color: #000;
            transition: color 0.3s ease;
        }

        .pro-copy-hover:hover {
            color: #e82e5f;
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
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-striped table-hover', 'style' => 'width: 100% !important;']) !!}
                </div>
            </div>
        </div>


    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.copy-procurement-number', function() {
                var procurementNumber = $(this).data('number');
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(procurementNumber).select();
                document.execCommand('copy');
                tempInput.remove();
                Swal.fire('Success!', 'The Procurement Number: ' + '<b>' + procurementNumber + '</b>' +
                    ' is Copied Successfully.', 'success');
            });
        });
    </script>


    <!-- DataTables JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    {{-- Data table button and other scripts  --}}
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {{-- Quotation List  modal --}}
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

@endsection

@section('scripts')
    <!-- @include('admin.assetManagement.assetAssignment.scripts') -->
    @include('admin.procurement.script')
    @include('admin.procurement.common.script')
    <!-- @include('admin.assetManagement.types.common.scripts') -->
    {!! $dataTable->scripts() !!}
@endsection
