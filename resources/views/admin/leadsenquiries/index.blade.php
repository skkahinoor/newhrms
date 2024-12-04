@extends('layouts.master')

@section('title', 'Lead Lists ')

@section('action', 'Lead Lists')


@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('leadsenquiries.common.breadcrumb')


        {{-- Bootstrap Gutters  --}}
        <div class="row g-0 ">
            @if ($isAdmin)
                <div class="col-sm-6 col-md-7 text-start">
                    <button type="button" class=" sk-g-btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addLeadModal"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                            viewBox="0 0 48 48">
                            <g fill="none" stroke="white" stroke-linecap="round" stroke-width="4">
                                <path
                                    d="M33 7.26261C30.3212 5.81915 27.2563 5 24 5C13.5066 5 5 13.5066 5 24C5 34.4934 13.5066 43 24 43C26.858 43 29.5685 42.369 32 41.2387" />
                                <path stroke-linejoin="round" d="M31 30L43 30" />
                                <path stroke-linejoin="round" d="M15 22L22 29L41 11" />
                                <path stroke-linejoin="round" d="M37 24V36" />
                            </g>
                        </svg>&nbsp;Add Lead
                    </button>

                    <a href="{{ route('admin.followuplist.list') }}">
                        <button type="button" class=" sk-g-btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                width="1.2em" height="1.2em" viewBox="0 0 14 14">
                                <path fill="white" fill-rule="evenodd"
                                    d="M.658.44A1.5 1.5 0 0 1 1.718 0h5.587a1.5 1.5 0 0 1 1.06.44l3.414 3.414a1.5 1.5 0 0 1 .44 1.06V12.5a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-11c0-.398.158-.78.44-1.06ZM5.33 4.527a.75.75 0 0 1 .175 1.047L4.108 7.53a.75.75 0 0 1-1.14.094l-.838-.838a.75.75 0 0 1 1.06-1.06l.212.211l.882-1.234a.75.75 0 0 1 1.046-.175Zm.95 1.847a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75m0 3.969a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75m-.775-.738a.75.75 0 1 0-1.22-.872l-.883 1.235l-.212-.212a.75.75 0 0 0-1.06 1.06l.838.838a.75.75 0 0 0 1.14-.094z"
                                    clip-rule="evenodd" />
                            </svg>&nbsp;Follow Up List
                        </button>
                    </a>

                    <button type="button" class=" sk-g-btn btn-outline-dark btn-sm" data-bs-toggle="modal"
                        data-bs-target="#importLeadModal"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em"
                            height="1.2em" viewBox="0 0 48 48">
                            <path fill="#f8bbd0"
                                d="M7 40V8c0-2.2 1.8-4 4-4h24c2.2 0 4 1.8 4 4v32c0 2.2-1.8 4-4 4H11c-2.2 0-4-1.8-4-4" />
                            <g fill="#e91e63">
                                <path d="M13.3 24L24 15v18z" />
                                <path d="M19 21h23v6H19z" />
                            </g>
                        </svg>&nbsp;Import</button>

                    <button type="button" class="sk-g-btn btn-outline-dark btn-sm"
                        onclick="window.location.href='leadsenquiries/export-leadenquery';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48">
                            <path fill="#ffccbc"
                                d="M7 40V8c0-2.2 1.8-4 4-4h24c2.2 0 4 1.8 4 4v32c0 2.2-1.8 4-4 4H11c-2.2 0-4-1.8-4-4" />
                            <g fill="#ff5722">
                                <path d="M42.7 24L32 33V15z" />
                                <path d="M14 21h23v6H14z" />
                            </g>
                        </svg>&nbsp;Export
                    </button>
                </div>
            @else
                <div class="col-sm-6 col-md-7 text-start">
                    <button type="button" class=" sk-g-btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addLeadModal"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                            viewBox="0 0 48 48">
                            <g fill="none" stroke="white" stroke-linecap="round" stroke-width="4">
                                <path
                                    d="M33 7.26261C30.3212 5.81915 27.2563 5 24 5C13.5066 5 5 13.5066 5 24C5 34.4934 13.5066 43 24 43C26.858 43 29.5685 42.369 32 41.2387" />
                                <path stroke-linejoin="round" d="M31 30L43 30" />
                                <path stroke-linejoin="round" d="M15 22L22 29L41 11" />
                                <path stroke-linejoin="round" d="M37 24V36" />
                            </g>
                        </svg>&nbsp;Add Lead
                    </button>
                    <a href="{{ route('admin.followuplist.list') }}">
                        <button type="button" class=" sk-g-btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                width="1.2em" height="1.2em" viewBox="0 0 14 14">
                                <path fill="white" fill-rule="evenodd"
                                    d="M.658.44A1.5 1.5 0 0 1 1.718 0h5.587a1.5 1.5 0 0 1 1.06.44l3.414 3.414a1.5 1.5 0 0 1 .44 1.06V12.5a1.5 1.5 0 0 1-1.5 1.5h-9a1.5 1.5 0 0 1-1.5-1.5v-11c0-.398.158-.78.44-1.06ZM5.33 4.527a.75.75 0 0 1 .175 1.047L4.108 7.53a.75.75 0 0 1-1.14.094l-.838-.838a.75.75 0 0 1 1.06-1.06l.212.211l.882-1.234a.75.75 0 0 1 1.046-.175Zm.95 1.847a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75m0 3.969a.75.75 0 0 1 .75-.75h2.5a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75m-.775-.738a.75.75 0 1 0-1.22-.872l-.883 1.235l-.212-.212a.75.75 0 0 0-1.06 1.06l.838.838a.75.75 0 0 0 1.14-.094z"
                                    clip-rule="evenodd" />
                            </svg>&nbsp;Follow Up List
                        </button>
                    </a>

                </div>
            @endif

            <div class="col-6 col-md-5 align-items-center text-end">
                {{-- hidden content Section start --}}
                <div class="hidden-content" style="display: none;">
                    <div class="position-relative">
                        <div class="position-absolute end-0">
                            <div class="container">
                                <div class="d-flex flex-wrap align-items-center">
                                    {{-- First Drop Down  --}}
                                    <div class="dropdown dropdown-lcustom">
                                        <button class="sk-g-btn btn-outline-ltheme dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            No Action
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="javascript:void(0);"
                                                    data-action="no-action"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1rem" height="1rem" viewBox="0 0 48 48">
                                                        <g fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="4">
                                                            <path fill="#E82E5F" stroke="#000"
                                                                d="M39 6H9C7.34315 6 6 7.34315 6 9V39C6 40.6569 7.34315 42 9 42H39C40.6569 42 42 40.6569 42 39V9C42 7.34315 40.6569 6 39 6Z" />
                                                            <path stroke="#fff" d="M21 31L26 35L34 25" />
                                                            <path stroke="#fff" d="M14 15H34" />
                                                            <path stroke="#fff" d="M14 23L22 23" />
                                                        </g>
                                                    </svg>&nbsp;No Action</a></li>
                                            <li><a class="dropdown-item status-dropdown" href="javascript:void(0);"
                                                    data-action="change-status"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1rem" height="1rem" viewBox="0 0 28 28">
                                                        <path fill="#E82E5F"
                                                            d="M18.745 3.245a4.25 4.25 0 1 1 6.01 6.01l-7.391 7.392a2.75 2.75 0 0 1-1.25.716L9.94 18.976a.75.75 0 0 1-.916-.916l1.613-6.174a2.75 2.75 0 0 1 .716-1.25zM14 4.5a9.6 9.6 0 0 1 1.888.188l1.237-1.238C16.135 3.157 15.085 3 14 3C7.925 3 3 7.925 3 14s4.925 11 11 11s11-4.925 11-11c0-1.086-.157-2.134-.45-3.125l-1.238 1.237A9.5 9.5 0 1 1 14 4.5" />
                                                    </svg>&nbsp;Change Status</a></li>
                                            <li><a class="dropdown-item agent-dropdown" href="javascript:void(0);"
                                                    data-action="change-agent"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1rem" height="1rem" viewBox="0 0 72 72">
                                                        <path fill="#E82E5F"
                                                            d="M17 61v-4c0-4.994 5.008-9 10-9q9 7.5 18 0c4.994 0 10 4.006 10 9v4" />
                                                        <path fill="currentColor"
                                                            d="M26 39c-4 0-4-6-4-13s4-14 14-14s14 7 14 14s0 13-4 13" />
                                                        <path fill="#ffe0bd"
                                                            d="M24.937 31c0 9 4.936 14 11 14C41.872 45 47 40 47 31c0-3-1-5-1-5c-3-3-7-8-7-8c-4 3-7 6-13 7c0 0-1.064 1-1.064 6" />
                                                        <path fill="none" stroke="#000" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="3"
                                                            d="M26 39c-4 0-4-6-4-13s4-14 14-14s14 7 14 14s0 13-4 13M17 60v-3c0-4.994 5.008-9 10-9q9 7.5 18 0c4.994 0 10 4.006 10 9v3" />
                                                        <path
                                                            d="M41.873 30a2 2 0 1 1-4 0a2 2 0 0 1 4 0m-8 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                                                        <path fill="none" stroke="#000" stroke-linejoin="round"
                                                            stroke-width="3"
                                                            d="M24.937 31c0 9 4.936 14 11 14C41.872 45 47 40 47 31c0-3-1-5-1-5c-3-3-7-8-7-8c-4 3-7 6-13 7c0 0-1.064 1-1.064 6z" />
                                                        <path fill="none" stroke="#000" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="3"
                                                            d="M33 38c1.939.939 4 1 6 0" />
                                                    </svg>&nbsp;Change Agent</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"
                                                    data-action="delete"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1rem" height="1rem" viewBox="0 0 48 48">
                                                        <g fill="none" stroke-linejoin="round" stroke-width="4">
                                                            <path fill="#E82E5F" stroke="#000" d="M9 10V44H39V10H9Z" />
                                                            <path stroke="#fff" stroke-linecap="round" d="M20 20V33" />
                                                            <path stroke="#fff" stroke-linecap="round" d="M28 20V33" />
                                                            <path stroke="#000" stroke-linecap="round" d="M4 10H44" />
                                                            <path fill="#E82E5F" stroke="#000"
                                                                d="M16 10L19.289 4H28.7771L32 10H16Z" />
                                                        </g>
                                                    </svg>&nbsp;Delete</a></li>
                                        </ul>
                                    </div>
                                    {{-- Second Dropdown Call Status (Initially Hidden) --}}
                                    <div class="dropdown dropdown-lcustom" id="second-dropdown" style="display: none;">
                                        <button class="sk-g-btn btn-outline-ltheme dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Status
                                        </button>
                                        <ul class="dropdown-menu" id="lead-status-options"
                                            aria-labelledby="dropdownMenuButton2">
                                            <!-- Lead Status options will be populated dynamically via AJAX -->
                                        </ul>
                                    </div>
                                    {{-- Third Dropdown Call Agents (Initially Hidden) --}}
                                    <div class="dropdown dropdown-lcustom" id="third-dropdown" style="display: none;">
                                        <button class="sk-g-btn btn-outline-ltheme dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Agent
                                        </button>
                                        <ul class="dropdown-menu" id="lead-agent-options"
                                            aria-labelledby="dropdownMenuButton3">
                                            <!-- Lead Agent options will be populated dynamically via AJAX -->
                                        </ul>
                                    </div>
                                    {{-- Apply Button --}}
                                    <button class="sk-g-btn btn-primary btn-apply rounded f-2 p-1"
                                        style="padding: 10px; width:100px; height:40px;">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- hidden content Section end --}}

            </div>
        </div>
        <br>
        {{-- Bootstrap Gutters Ends  --}}

        {{-- Lead Filter start  --}}
        <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
            <form class="forms-sample" action="{{ route('admin.leadsenquiries.index') }}" method="get">
                <h5>Lead Filter</h5>
                <div class="row align-items-center">

                    <div class="col-lg col-md-6 mt-3">
                        <input type="text" placeholder="Lead Name" id="name" name="name" value="{{ request('name') }}" class="form-control">
                    </div>

                    <div class="col-lg col-md-6 mt-3">
                        <input type="email" placeholder="Email" id="email" name="email" value="{{ request('email') }}" class="form-control">
                    </div>

                    <div class="col-lg col-md-6 mt-3">
                        <select class="form-select form-select-sm" name="leadstatus" id="status">
                            <option value="">All Statuses</option>
                            @foreach($leadstatuses as $leadStatus)
                                <option value="{{ $leadStatus->id }}" {{ request('leadstatus') == $leadStatus->id ? 'selected' : '' }}>{{ $leadStatus->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($isAdmin)
                        <div class="col-lg col-md-6 mt-3">
                        <select class="form-select form-select-sm" name="leadagent" id="leadagent">
                            <option value="">All Agents</option>
                            @foreach($leadagents as $leadAgent)
                                <option value="{{ $leadAgent->id }}" {{ request('leadagent') == $leadAgent->id ? 'selected' : '' }}>{{ $leadAgent->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif


                    <div class="col-lg-2 col-md-6 mt-3">
                        <div class="d-flex float-md-end">
                            <button type="submit" class="btn btn-block btn-secondary me-2">Filter</button>
                            <a class="btn btn-block btn-primary" href="{{ route('admin.leadsenquiries.index') }}">Reset</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        {{-- Lead Filter Ends  --}}

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Lead
                            Enquery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Lead From</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                        @if ($leadagents->isEmpty())
                            <br>
                            <p>No leads available.</p>
                        @else
                            {{-- Lead Source  --}}
                            @include('admin.leadsenquiries.form')
                            {{-- End Lead Source  --}}
                        @endif
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                        tabindex="0">
                        <br>
                        {{-- Lead Form Link  --}}
                        <h5 class="card-title">Lead Form Link</h5>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-control">
                                <a class="card-link" id="copy-link" href="#"
                                    onclick="copyLinkToClipboard(event)">{{ $leadformlink }}</a><span
                                    class="text-secondary">&nbsp;(Tap the link to Copy)</span>
                            </div>
                        </div>
                        {{-- Lead Form Link  --}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Full-Screen Modal -->
    <div class="modal fade" id="addLeadModal" tabindex="-1" aria-labelledby="addLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 100% !important;">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeadModalLabel">Add New Lead</h5>
                </div>
                <div class="modal-body">
                    <!-- Your form or content for adding a new lead goes here -->
                    <form class="forms-sample" action="leadsenquiries/addleadstore" method="POST">
                        @csrf
                        <div class="row mb-3">
                            @if ($leadform->name == 1)
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-validate @enderror"
                                        placeholder="Please enter your name" required="required"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->city == 1)
                                <div class="col-md-4">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" name="city"
                                        class="form-control @error('city') is-validate @enderror"
                                        placeholder="Please enter your City" value="{{ old('city') }}">
                                    @error('city')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->email == 1)
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-validate @enderror"
                                        placeholder="Enter Your Email" required="required" value="{{ old('email') }}">
                                    @error('email')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->state == 1)
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" id="state" name="state"
                                        class="form-control @error('state') is-validate @enderror"
                                        placeholder="Enter Your State" value="{{ old('state') }}">
                                    @error('state')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif


                            @if ($leadform->companyname == 1)
                                <div class="col-md-4">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" id="company" name="companyname"
                                        class="form-control @error('companyname') is-validate @enderror"
                                        placeholder="Enter Your Company Name" value="{{ old('companyname') }}">
                                    @error('companyname')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->country == 1)
                                <div class="col-md-4">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select @error('country') is-validate @enderror" name="country"
                                        id="country">
                                        <option selected disabled>Select Country</option>
                                    </select>
                                    @error('country')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif


                            @if ($leadform->website == 1)
                                <div class="col-md-4">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" id="website" name="website"
                                        class="form-control @error('website') is-validate @enderror"
                                        placeholder="Enter Your Website Name" value="{{ old('website') }}">
                                    @error('website')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->postalcode == 1)
                                <div class="col-md-4">
                                    <label for="postalcode" class="form-label">Postal Code</label>
                                    <input type="text" id="postalcode" name="postalcode"
                                        class="form-control @error('postalcode') is-validate @enderror"
                                        placeholder="Enter Your Postal Code" value="{{ old('postalcode') }}">
                                    @error('postalcode')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif


                            @if ($leadform->address == 1)
                                <div class="col-md-4">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address"
                                        class="form-control  @error('address') is-validate @enderror"
                                        value="{{ old('address') }}" placeholder="Enter Contact Number">
                                    @error('address')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->number == 1)
                                <div class="col-md-4">
                                    <label for="mobile" class="form-label">Number <span
                                            class="text-danger">*</span></label>
                                    <input type="number" id="mobile" name="number"
                                        class="form-control  @error('number') is-validate @enderror"
                                        value="{{ old('number') }}" placeholder="Enter Contact Number"
                                        required="required">
                                    @error('number')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif


                            @if ($leadform->message == 1)
                                <div class="col-md-4">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" rows="3" name="message" class="form-control @error('message') is-validate @enderror"
                                        placeholder="Write your message here"></textarea>
                                    @error('message')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->leadsource == 1)
                                <div class="col-md-4">
                                    <label for="leadsource" class="form-label">Lead Source <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('leadsource') is-validate @enderror"
                                        id="leadsource" name="leadsource" required="required">
                                        <option value="">Select Source</option>
                                        @if (isset($leadsource) && count($leadsource) > 0)
                                            @foreach ($leadsource as $source)
                                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Source found</option>
                                        @endif
                                    </select>
                                    @error('source')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            @if ($leadform->leadcategory == 1)
                                <div class="col-md-4">
                                    <label for="product" class="form-label">Lead Category <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="leadcategory" name="leadcategory"
                                        required="required">
                                        <option value="">Select Category</option>
                                        @if (isset($leadcategory) && count($leadcategory) > 0)
                                            @foreach ($leadcategory as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">No Category found</option>
                                        @endif
                                    </select>
                                    @error('leadcategory')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        <!-- Add more form fields as needed -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Lead</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- End Full Screen Modal  --}}

    {{-- Import Modal Start --}}
    <div class="modal fade" id="importLeadModal" tabindex="-1" aria-labelledby="addLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 100% !important;">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeadModalLabel">Import Lead Data</h5>
                </div>
                <div class="modal-body">
                    <!-- Your form or content for adding a new lead goes here -->
                    <form class="box" action="leadsenquiries/import-leadenquery" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label>Select Excel File:( <span class="text-danger">Only csv,xlsx Format will accepted</span>
                            )&nbsp;<span class="text-danger">*</span></label>
                        <div class="box__input">
                            <input class="box__file" type="file" name="file" required>
                        </div>
                        <br><br>
                        <div class="row form-control">
                            <div class="col-md-12">
                                <b><span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em"
                                            height="1.2em" viewBox="0 0 32 32">
                                            <path fill="#e82e5f"
                                                d="M12 8a4 4 0 0 1 8 0c0 1.45-.421 3.348-1.046 5.315c-.613 1.932-1.372 3.776-1.942 5.066c-.158.356-.532.619-1.012.619s-.854-.263-1.012-.62c-.57-1.289-1.329-3.133-1.942-5.065C12.42 11.348 12 9.45 12 8m4-6a6 6 0 0 0-6 6c0 3.523 1.986 8.536 3.16 11.19C13.654 20.31 14.773 21 16 21s2.345-.69 2.84-1.81C20.015 16.536 22 11.522 22 8a6 6 0 0 0-6-6m1.5 24.5a1.5 1.5 0 1 0-3 0a1.5 1.5 0 0 0 3 0m2 0a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0" />
                                        </svg></span>Important Message</b>
                                <br>
                            </div>
                            <div class="col-md-12">
                                <p style="margin-top: 5px !important;">You must Download the Demo File, then after fill the
                                    data you can import here.&nbsp;<a
                                        href="{{ asset('assets/document/LeadEnquery.csv') }}" download>Click Here To
                                        Download Demo File</a></p>
                            </div>
                        </div>

                        <!-- Add more form fields as needed -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import Lead</button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div>
                            <strong class="text-danger">Errors:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    {{-- Import Modal Ends  --}}

    {{-- new modal for view  --}}
    <div class="modal fade" id="enquire-modal" tabindex="-1" role="dialog" aria-labelledby="enquire-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Lead Enquire Details</h5>
                </div>
                <div class="modal-body">
                    {{-- Bootstrap Tabs starts here  --}}
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab"
                                aria-controls="v-pills-home" aria-selected="true">Lead Details</button>
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-profile" type="button" role="tab"
                                aria-controls="v-pills-profile" aria-selected="false">Company Details</button>
                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-messages" type="button" role="tab"
                                aria-controls="v-pills-messages" aria-selected="false">Follow-Up Details</button>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent"
                            style="height: auto !important; background-color: #edededb3 !important;padding: 5px 20px !important;border-radius: 7px !important;">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab" tabindex="0">
                                {{-- Lead Details Start  --}}
                                <div id="enquire-data">
                                    <!-- Lead Data will be displayed here -->
                                </div>
                                {{-- Lead Details End  --}}
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab" tabindex="0">
                                {{-- Company Details Start  --}}
                                <div id="company-data">
                                    <!-- Company Data will be displayed here -->
                                </div>
                                {{-- Company Details End  --}}
                            </div>

                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab" tabindex="0">
                                {{-- Follow Up Details Start  --}}
                                <div id="followup-data" style="overflow: auto; height:250px !important;">
                                    <!-- Follow Up Data will be displayed here -->
                                </div>
                                {{-- Follow Up Details End  --}}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal  --}}

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteleadenquiryModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Lead Enquiry</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this lead Enquiry?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="" method="POST" id="delete-leadenquiry-form">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





    {{-- Add Follow Up Modal Code Is here  --}}
    <div class="modal fade" id="addFollowUpModal" tabindex="-1" aria-labelledby="addFollowUpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFollowUpModalLabel">Add Follow Up</h5>
                </div>
                <div class="modal-body">
                    <!-- Form to Add Lead Category -->
                    <form id="followUpForm" method="POST" action="{{ route('admin.addfollowup.store') }}">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="lead_id" value="">
                            <div class="col-6 mb-3">
                                <label for="FollowUpdate" class="form-label">Next Follow Up Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="FollowUpDate" name="followupdate"
                                    value="" placeholder="Enter Follow Up Date" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="FollowUpTime" class="form-label">Next Follow Up Time <span
                                        class="text-danger">*</span></label>
                                <input type="time" class="form-control timePicker" id="timepicker"
                                    name="followuptime" value="" placeholder="Enter Follow Up time" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="remark" class="form-label">Remark <span
                                        class="text-danger">*</span></label>
                                <textarea name="remark" class="form-control" id="remark" cols="30" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="followUpForm" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Follow up Modal Code  --}}


@endsection

@section('scripts')
    @include('admin.leadsenquiries.common.scripts')
@endsection
