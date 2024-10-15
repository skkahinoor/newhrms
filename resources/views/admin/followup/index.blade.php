@extends('layouts.master')

@section('title', 'Follow-Up List ')

@section('action', 'List')


@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('admin.followup.common.breadcrumb')



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Follow Up List&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                viewBox="0 0 14 14">
                                <path fill="#e82e5f" fill-rule="evenodd"
                                    d="M.658.44A1.5 1.5 0 0 1 1.718 0h5.587a1.5 1.5 0 0 1 1.06.44l3.414 3.414a1.5 1.5 0 0 1 .44 1.06V12.5a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-11c0-.398.158-.78.44-1.06ZM5.33 4.527a.75.75 0 0 1 .175 1.047L4.108 7.53a.75.75 0 0 1-1.14.094l-.838-.838a.75.75 0 0 1 1.06-1.06l.212.211l.882-1.234a.75.75 0 0 1 1.046-.175Zm.95 1.847a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75m0 3.969a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75m-.775-.738a.75.75 0 1 0-1.22-.872l-.883 1.235l-.212-.212a.75.75 0 0 0-1.06 1.06l.838.838a.75.75 0 0 0 1.14-.094z"
                                    clip-rule="evenodd" />
                            </svg></h4>
                        <br>
                    </div>
                    <div class="col-md-12">
                        @if ($followuplist->isEmpty())
                            <p class="text-center text-secondary">There are No Folowup Details here...</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead style="background-color:silver !important;" class="text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Lead Name</th>
                                            <th scope="col">Next FollowUp Date</th>
                                            <th scope="col">Remark</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-striped table-hover text-center">
                                        @foreach ($followuplist as $key => $list)
                                            <tr>
                                                <th scope="row">{{ $followuplist->firstItem() + $key }}</th>
                                                <td>
                                                    @php
                                                        $latestFollowup = $list->followupdate;
                                                        $todaydate = \Carbon\Carbon::now()->toDateString();
                                                        $yesterday = \Carbon\Carbon::now()->addDay()->toDateString();

                                                        $followupDate = optional($latestFollowup)
                                                            ? \Carbon\Carbon::parse($latestFollowup)->toDateString()
                                                            : null;
                                                    @endphp
                                                    @if ($todaydate > $list->followupdate)
                                                        <p
                                                            style="text-decoration-color: #E82E5F !important; text-decoration: line-through;">
                                                            {{ $list->leadEnquery->name ?? 'Not Set' }}</p>
                                                    @else
                                                        <b>{{ $list->leadEnquery->name ?? 'Not Set' }}</b>
                                                    @endif
                                                </td>
                                                <td>{{ $list->followupdate ?? 'Not Set' }}</td>
                                                {{-- <td>{{ $list->remark ?? 'Not Set' }}</td> --}}
                                                <td><a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#viewFollowUpModal" data-id="{{ $list->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem"
                                                            height="1.2rem" viewBox="0 0 50 50">
                                                            <g fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="3">
                                                                <path stroke="#344054"
                                                                    d="M39.583 25S33.063 33.333 25 33.333C16.938 33.333 10.417 25 10.417 25s6.52-8.333 14.583-8.333S39.583 25 39.583 25M25 20.833a4.167 4.167 0 1 0 0 8.334a4.167 4.167 0 0 0 0-8.334" />
                                                                <path stroke="#E82E5F"
                                                                    d="M6.25 14.583v-6.25A2.083 2.083 0 0 1 8.333 6.25h6.25m29.167 8.333v-6.25a2.083 2.083 0 0 0-2.083-2.083h-6.25M6.25 35.417v6.25a2.083 2.083 0 0 0 2.083 2.083h6.25m29.167-8.333v6.25a2.083 2.083 0 0 1-2.083 2.083h-6.25" />
                                                            </g>
                                                        </svg>
                                                    </a></td>
                                                {{-- Status Section  --}}
                                                <td class="text-center">
                                                    @php
                                                        $latestFollowup = $list->followupdate;
                                                        $todaydate = \Carbon\Carbon::now()->toDateString();
                                                        $yesterday = \Carbon\Carbon::now()->addDay()->toDateString();

                                                        $followupDate = optional($latestFollowup)
                                                            ? \Carbon\Carbon::parse($latestFollowup)->toDateString()
                                                            : null;
                                                    @endphp

                                                    <p>
                                                        @if ($todaydate > $followupDate)
                                                            <span
                                                                style="color:aliceblue; background-color:#E82E5F; padding:5px; border-radius:7px; font-size:10px; font-weight:bold;">
                                                                Expire
                                                            </span>
                                                        @else
                                                            @if ($yesterday === $followupDate)
                                                                <span
                                                                    style="color:aliceblue; background-color:rgb(0, 115, 238); padding:5px; border-radius:7px; font-size:10px; font-weight:bold;">
                                                                    Yesterday
                                                                </span>
                                                            @else
                                                                @if ($todaydate === $followupDate)
                                                                    <span
                                                                        style="color:aliceblue; background-color:green; padding:5px; border-radius:7px; font-size:10px; font-weight:bold;">
                                                                        Today
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        style="color:black; background-color:#fecf14; padding:5px; border-radius:7px; font-size:10px; font-weight:bold;">
                                                                        Upcoming
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </p>
                                                </td>
                                                {{-- End Status Section  --}}
                                                {{-- Start Action Section  --}}
                                                <td class="text-center">
                                                    @if ($isAdmin)
                                                        <div class="dropdown dropstart">
                                                            <button
                                                                style="padding: 10px 10px !important; border-color: #7987a1 !important;"
                                                                class="btn" type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem"
                                                                    height="1rem" viewBox="0 0 16 16">
                                                                    <g fill="none" stroke="#E82E5F"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="1.5">
                                                                        <circle cx="8" cy="2.5" r=".75" />
                                                                        <circle cx="8" cy="8" r=".75" />
                                                                        <circle cx="8" cy="13.5" r=".75" />
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;cursor:pointer;"
                                                                        class="dropdown-item editFollowUpBtn"
                                                                        data-id="{{ $list->id }}"
                                                                        data-followupdate="{{ $list->followupdate }}"
                                                                        data-followuptime="{{ $list->followuptime }}"
                                                                        data-remark="{{ $list->remark }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editFollowUpModal"
                                                                        title="Edit Follow Up Details"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="1rem" height="1rem"
                                                                            viewBox="0 0 48 48">
                                                                            <g fill="none" stroke="#000"
                                                                                stroke-linejoin="round" stroke-width="4">
                                                                                <path stroke-linecap="round"
                                                                                    d="M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6" />
                                                                                <path fill="#E82E5F"
                                                                                    d="M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z" />
                                                                            </g>
                                                                        </svg>&nbsp;Edit
                                                                    </a>
                                                                </li>
                                                                <li><a style="cursor: pointer;color: #383838 !important;font-size:13px;font-weight:bold;"
                                                                        class="dropdown-item deleteFollowUpLink"
                                                                        data-id="{{ $list->id }}" data-bs-toggle="modal"
                                                                        data-bs-target="#deletefollowupModal"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="1rem" height="1rem"
                                                                            viewBox="0 0 48 48">
                                                                            <g fill="none" stroke-linejoin="round"
                                                                                stroke-width="4">
                                                                                <path fill="#E82E5F" stroke="#000"
                                                                                    d="M9 10V44H39V10H9Z" />
                                                                                <path stroke="#fff"
                                                                                    stroke-linecap="round" d="M20 20V33" />
                                                                                <path stroke="#fff"
                                                                                    stroke-linecap="round" d="M28 20V33" />
                                                                                <path stroke="#000"
                                                                                    stroke-linecap="round" d="M4 10H44" />
                                                                                <path fill="#E82E5F" stroke="#000"
                                                                                    d="M16 10L19.289 4H28.7771L32 10H16Z" />
                                                                            </g>
                                                                        </svg>&nbsp;Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @else
                                                        {{-- for users  --}}
                                                        <button class="btn deleteFollowUpLink" type="button"
                                                            data-id="{{ $list->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#deletefollowupModal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.3em"
                                                                height="1.2em" viewBox="0 0 48 48">
                                                                <g fill="none" stroke="#e82e5f"
                                                                    stroke-linejoin="round" stroke-width="5">
                                                                    <path d="M9 10v34h30V10z" />
                                                                    <path stroke-linecap="round"
                                                                        d="M20 20v13m8-13v13M4 10h40" />
                                                                    <path d="m16 10l3.289-6h9.488L32 10z" />
                                                                </g>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="row">{{ $followuplist->links() }}</div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- new modal for view  --}}
    <div class="modal fade" id="viewFollowUpModal" tabindex="-1" aria-labelledby="viewFollowUpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content" style="width: 100% !important;">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFollowUpModalLabel">FollowUp Remark</h5>
                </div>
                <div class="modal-body">
                    <h4 id="modal-lead-name" class="text-primary"></h4>
                    <br>
                    <p><strong>FollowUp Date:</strong> <span id="modal-followup-date"></span></p>
                    <p><strong>FollowUp Time:</strong> <span id="modal-followup-time"></span></p>
                    <p><strong>Remark:</strong> <span id="modal-remark"></span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal  --}}

    <!-- Modal For Update/Edit-->
    <div class="modal fade" id="editFollowUpModal" tabindex="-1" aria-labelledby="editFollowUpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFollowUpModalLabel">Edit Follow Up Details</h5>
                </div>
                <div class="modal-body">
                    <form id="editFollowUpForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editFollowUpDate" class="form-label">Follow Up Date&nbsp;<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="editFollowUpDate" name="followupdate"
                                    placeholder="Set Follow Up Date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editFollowUpTime" class="form-label">Follow Up Time&nbsp;<span
                                        class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="editFollowUpTime" name="followuptime"
                                    placeholder="Set Follow Up Time" required>
                            </div>
                            <div class="col-md-12">
                                <label for="editFollowUpRemark" class="form-label">Remark&nbsp;<span
                                        class="text-danger">*</span></label>
                                {{-- <input type="text" class="form-control" id="editFollowUpRemark" name="remark"
                                    placeholder="Set the Remark" required> --}}
                                <textarea name="remark" class="form-control" id="editFollowUpRemark" cols="30" rows="10" required></textarea>
                            </div>
                        </div>

                        <input type="hidden" id="FollowUpId" name="id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="editFollowUpForm" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal For Update/Edit-->

    <!-- Delete Modal -->
    <div class="modal fade" id="deletefollowupModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Follow Up</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Follow-up Data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="" method="POST" id="delete-followup-form">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')
    @include('admin.followup.common.scripts')
@endsection
