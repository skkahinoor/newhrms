@extends('layouts.master')
@section('title', $viewjob->postname)
@section('action', 'View Job')

@section('main-content')

    <section class="content">
        @include('admin.section.flash_message')
        @include('admin.recruitment.common.breadCrumb')

        <!-- Card Start -->
        <div class="card">
            <div class="card-header bg-danger text-light">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-0">Job Title: {{ $viewjob->postname }}</h3>
                    </div>
                    <div class="col-md-4 text-md-end text-start">
                        <h6 class="mb-0">Posted in: {{ $viewjob->created_at->diffForHumans() }}</h6>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h3>Job Description:</h3>
                                <br>
                                <p class="text-secondary">{{ $viewjob->description }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <p><span class="h6">Salary Range:</span> <span class="text-secondary">₹{{ $viewjob->salaryrange }}</span></p>
                                <br>
                                <p><span class="h6">Location:</span>
                                    <span class="text-secondary">{{ $viewjob->location->postlocation }}</span></p>
                                    <br>
                                <p><span class="h6">Job Type:</span>
                                    <span class="text-secondary">{{ $viewjob->type->posttype }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End of card -->


        <!-- End post Area -->

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
