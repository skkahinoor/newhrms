@extends('layouts.master')
@section('title', 'Job Applications')
@section('action', 'Job Applications')

@section('main-content')

    <section class="content">
        @include('admin.section.flash_message')
        @include('admin.recruitment.common.breadCrumb')

        <?php
            $status = [
                0 => 'Pending',
                1 => 'Schedule',
                2 => 'Approve',
                3 => 'Reject'
            ];
       ?>

        {{-- Requirement List  --}}
        <div class="card">
            <div class="card-header bg-danger text-light">
                <h5>Applied Candidates</h5>
            </div>
            <div class="card-body">
                {{-- table start  --}}
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Job Name</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Number</th>
                                <th>Experience</th>
                                <th>Experience</th>
                                <th>Current CTC</th>
                                <th>Expected CTC</th>
                                <th>Notice Period</th>
                                <th>Resume</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if ($applycandidates->count() > 0)
                                    @foreach ($applycandidates as $key => $value)
                            <tr>
                                <td>{{ $applycandidates->firstItem() + $key }}</td>
                                <td>{{ $value->jobName->postname }}</td>
                                <td>{{ $value->full_name }}</td>
                                <td><a href="mailto:{{ $value->email_address }}">{{ $value->email_address }}</a></td>
                                <td><a href="tel:{{ $value->mobile_number }}">{{ $value->mobile_number }}</a></td>
                                <td>{{ $value->experience_years }} Years</td>
                                <td>{{ $value->experience_months }} Months</td>
                                <td>{{ $value->current_ctc }} LPA</td>
                                <td>{{ $value->expected_ctc }} LPA</td>
                                <td>{{ $value->notice_period_days }} Months</td>
                                <td>
                                    <a href="{{ asset('uploads/resume/' . $value->cv_file_path) }}" target="_blank">
                                        {{ $value->cv_file_path }}
                                    </a>
                                </td>
                                <td><p class="badge bg-info text-dark">{{ $status[$value->status] ?? 'Unknown'}}</p></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            style="padding: 10px 11px !important;">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item shedule-interview" data-id="{{ $value->id }}" href="javascript:void(0);">Interview Shedule</a></li>
                                            <li><a class="dropdown-item approve-as-employee" data-id="{{ $value->id }}" href="javascript:void(0);">Approve as Employee</a></li>
                                            <li><a class="dropdown-item reject-candidate" data-id="{{ $value->id }}" href="javascript:void(0);">Reject</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <p>No Post Type here.</p>
                            @endif
                        </tbody>
                    </table>
                    <br>
                    <div class="row">{{ $applycandidates->links() }}</div>
                </div>
                {{-- Table end  --}}
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
    @include('admin.jobapplication.script')

@endsection
