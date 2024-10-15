@extends('layouts.master')
@section('title', 'Procurement')
@section('action', 'Procurements')
@section('button')
    @can('create_type')
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
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Request Number</th>
                                <th>Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Types</th>
                                <th class="text-center">Brands</th>
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
                                1 => 'success',
                                // null => 'danger'
                            ];
                            $changeTextColor = [
                                0 => '#000000',
                                1 => '#ffffff'
                        ];
                            ?>
                            <tr>
                                @forelse($requests as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-center">
                                    {{ $value->procurement_number }}
                                </td>
                                <td>{{ ucfirst($value->name) }}</td>
                                <td class="text-center">
                                    {{ $value->email }}
                                </td>
                                <td class="text-center">
                                    {{ $value->asset_types }}
                                </td>
                                <td class="text-center">
                                    {{ $value->brand }}
                                </td>
                                <td class="text-center">
                                    {{ $value->request_date }}
                                </td>
                                <td class="text-center">
                                    <h6 style="border-radius: 5px; padding: 4px; opacity: 0.6;font-family: serif; color: {{ $changeTextColor[$value->status] }};"
                                        class="btn-{{ $changeColor[$value->status] }}">
                                        {{ $value->status == 0 ? 'Pending' : 'Approved' }}</h6>
                                </td>

                                <td class="text-center">
                                    <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                        @can('edit_assets')
                                            <li class="me-2">
                                                <a href="{{ route('admin.procurement.edit', $value->id) }}" title="Edit">
                                                    <i class="link-icon" data-feather="edit"></i>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('show_asset')
                                            <li class="me-2">
                                                <a href="{{ route('admin.procurement.show', $value->id) }}" title="Show Detail">
                                                    <i class="link-icon" data-feather="eye"></i>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('delete_assets')
                                            <li>
                                                <a href="{{ route('admin.procurement.delete', $value->id) }}" title="Delete">
                                                    <i class="link-icon" data-feather="delete"></i>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
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
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection

@section('scripts')
    <!-- @include('admin.assetManagement.assetAssignment.scripts') -->
    @include('admin.procurement.script')
    <!-- @include('admin.assetManagement.types.common.scripts') -->
@endsection
