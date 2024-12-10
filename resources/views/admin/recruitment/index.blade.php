@extends('layouts.master')
@section('title', 'Recruitment')
@section('action', 'Recruitment')
@section('button')
    {{-- @can('create_procurement')
        <a href="{{ route('admin.procurement.create') }}">
            <button class="btn btn-primary">
                <i class="link-icon" data-feather="plus"></i>Add Request
            </button>
        </a>
    @endcan --}}
@endsection
@section('main-content')

    <section class="content">
        @include('admin.section.flash_message')
        @include('admin.recruitment.common.breadCrumb')

        {{-- Manage Requirement  --}}
        <div class="card">
            <div class="card-header bg-danger text-light">
                <h5>Manage Recruitment</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-category-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-category" type="button" role="tab" aria-controls="pills-category"
                            aria-selected="true">Job Type</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-setting-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-setting" type="button" role="tab" aria-controls="pills-setting"
                            aria-selected="false">Job Location</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab"
                        tabindex="0">
                        {{-- Post type  --}}
                        @include('admin.recruitment.recruitmenttype.index')
                        {{-- End Post type  --}}
                    </div>
                    <div class="tab-pane fade" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab"
                        tabindex="0">
                        {{--  location  --}}
                        @include('admin.recruitment.recruitmentlocation.index')
                        {{-- End location  --}}
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        {{-- Requirement List  --}}
        <div class="card">
            <div class="card-header bg-danger text-light">
                <h5>Recruitment List</h5>
            </div>
            <div class="card-body">
                @include('admin.recruitment.recruitmentpost.index')
            </div>
        </div>

    </section>

    {{-- new modal  --}}
    @include('admin.recruitment.recruitmentpost.modal')
    @include('admin.recruitment.recruitmenttype.modal')
    @include('admin.recruitment.recruitmentlocation.modal')
    {{-- End Modal  --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- <script>
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
    </script> --}}


    <!-- DataTables JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    {{-- Data table button and other scripts  --}}
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>


@endsection

@section('scripts')
    @include('admin.recruitment.common.script')
@endsection
