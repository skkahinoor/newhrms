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
                {{-- {!! $dataTable->table() !!} --}}
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-striped table-hover']) !!}
                </div>

            </div>
        </div>


    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables Buttons CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>



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

@endsection

@section('scripts')
    <!-- @include('admin.assetManagement.assetAssignment.scripts') -->
    @include('admin.procurement.script')
    @include('admin.procurement.common.script')
    <!-- @include('admin.assetManagement.types.common.scripts') -->
    {!! $dataTable->scripts() !!}
@endsection
