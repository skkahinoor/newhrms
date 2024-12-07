@extends('layouts.master')
@section('title', 'Job Applications')
@section('action', 'Job Applications')

@section('main-content')

    <section class="content">
        @include('admin.section.flash_message')
        @include('admin.recruitment.common.breadCrumb')

        {{-- Requirement List  --}}
        <div class="card">
            <div class="card-header bg-danger text-light">
                <h5>Applied Candidates</h5>
            </div>
            <div class="card-body">
            </div>
        </div>

    </section>



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
