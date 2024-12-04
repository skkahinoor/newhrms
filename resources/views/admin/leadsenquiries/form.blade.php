@if ($leadsenquiries->count() == 0)
    <br>
    <p>No leads available.</p>
@else
    <div class="table-responsive">
        <table id="dataTableExample" class="table" style="font-size: 13px;">
            <thead>
                <tr>
                    <th><input type="checkbox" style="cursor: pointer;" id="select-all"></th>
                    <th class="lead-table-heading">#</th>
                    <th class="lead-table-heading">Name</th>
                    <th class="lead-table-heading">Email</th>
                    <th class="lead-table-heading">Number</th>
                    <th class="lead-table-heading">Category</th>
                    <th class="text-center lead-table-heading">Assign To Agent</th>
                    <th class="lead-table-heading">Next Follow Up Date</th>
                    <th class="text-center lead-table-heading">Status</th>
                    <th class="text-center lead-table-heading">Choose Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leadsenquiries as $key => $value)
                    <tr>
                        <td><input type="checkbox" style="cursor: pointer;" class="select-item"
                                value="{{ $value->id }}"></td>
                        <td>{{ $leadsenquiries->firstItem() + $key }}</td>
                        <td><span style="font-weight: bold;">{{ $value->name ?? 'Not Set' }}</span></td>
                        <td>{{ $value->email ?? 'Not Set' }}</td>
                        <td><a href="tel:{{ $value->number }}">{{ $value->number ?? 'Not Set' }}</a></td>
                        <td>{{ $value->leadCategory->name ?? 'Not Set' }}</td>
                        {{-- Agent section --}}
                        <td>
                            @if ($isAdmin)
                                <div class="dropdown">
                                    <button class="btn sk-status-btn dropdown-toggle agent-toggle" type="button"
                                        id="dropdownMenuStatus{{ $value->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0 0 72 72">
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
                                            <path fill="none" stroke="#000" stroke-linejoin="round" stroke-width="3"
                                                d="M24.937 31c0 9 4.936 14 11 14C41.872 45 47 40 47 31c0-3-1-5-1-5c-3-3-7-8-7-8c-4 3-7 6-13 7c0 0-1.064 1-1.064 6z" />
                                            <path fill="none" stroke="#000" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="3" d="M33 38c1.939.939 4 1 6 0" />
                                        </svg>&nbsp;{{ $value->assignedAgent->username ?? 'Not Assigned' }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuStatus{{ $value->id }}">
                                        @foreach ($leadagents as $agents)
                                            <li>
                                                <a class="dropdown-item agent-option" href="javascript:void(0);"
                                                    data-lead-id="{{ $value->id }}"
                                                    data-agent-id="{{ $agents->id }}"
                                                    style="display: flex; align-items: center;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem"
                                                        height="1rem" viewBox="0 0 72 72">
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
                                                    </svg>&nbsp;{{ $agents->username }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <button class="btn sk-status-btn agent-toggle" type="button"
                                    id="dropdownMenuStatus{{ $value->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                        viewBox="0 0 72 72">
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
                                        <path fill="none" stroke="#000" stroke-linejoin="round" stroke-width="3"
                                            d="M24.937 31c0 9 4.936 14 11 14C41.872 45 47 40 47 31c0-3-1-5-1-5c-3-3-7-8-7-8c-4 3-7 6-13 7c0 0-1.064 1-1.064 6z" />
                                        <path fill="none" stroke="#000" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="3" d="M33 38c1.939.939 4 1 6 0" />
                                    </svg>&nbsp;{{ $value->assignedAgent->username ?? 'Not Assigned' }}&nbsp;<span
                                        style="font-size: 9px !important;" class="text-secondary">(Its you)</span>
                                </button>
                            @endif
                        </td>
                        {{-- End Agent section --}}
                        {{-- Followup section  --}}
                        <td class="text-center">
                            @if ($value->followups->isEmpty())
                                <p>Not Set</p>
                            @else
                                @php
                                    $latestFollowup = $value->followups->sortByDesc('followupdate')->first();
                                    $todaydate = \Carbon\Carbon::now()->toDateString();
                                    $yesterday = \Carbon\Carbon::now()->addDay()->toDateString();

                                    $followupDate = optional($latestFollowup)->followupdate
                                        ? \Carbon\Carbon::parse($latestFollowup->followupdate)->toDateString()
                                        : null;
                                @endphp
                                <p>
                                    @if ($todaydate > $followupDate)
                                        <span
                                            style="font-weight:bold;text-decoration: line-through;text-decoration-color:#E82E5F;">{{ $followupDate ?? 'Not Set' }}</span>
                                    @else
                                        <span style="font-weight:bold;">{{ $followupDate ?? 'Not Set' }}</span>
                                    @endif

                                    <br>
                                    @if ($todaydate > $followupDate)
                                        <span
                                            style="color:aliceblue; background-color:#E82E5F !important; padding:5px; border-radius:7px; font-size:10px; font-weight:bold;">
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
                            @endif
                        </td>
                        {{-- End Follow Up Section  --}}

                        {{-- Status section --}}
                        <td>
                            <div class="dropdown">
                                <button class="btn sk-status-btn dropdown-toggle" type="button"
                                    id="dropdownMenuStatus{{ $value->id }}" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <span
                                        style="background-color: {{ $value->status->color ?? '' }}; width: 15px; height: 15px; border-radius: 50%; display: inline-block; margin-right: 5px; margin-bottom:-3px;"></span>
                                    {{ $value->status->name ?? 'not set' }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuStatus{{ $value->id }}">
                                    @foreach ($leadstatuses as $status)
                                        <li>
                                            <a class="dropdown-item status-option" href="javascript:void(0);"
                                                data-lead-id="{{ $value->id }}"
                                                data-status-id="{{ $status->id }}"
                                                style="display: flex; align-items: center;">
                                                <span
                                                    style="background-color: {{ $status->color ?? '' }}; width: 15px; height: 15px; border-radius: 50%; display: inline-block; margin-right: 5px; margin-bottom:-3px;"></span>
                                                {{ $status->name ?? 'not set' }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                        {{-- End Status section --}}

                        <td class="text-center">
                            @if ($isAdmin)
                                <div class="dropdown dropstart">
                                    <button style="padding: 10px 10px !important; border-color: #7987a1 !important;"
                                        class="btn" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0 0 16 16">
                                            <g fill="none" stroke="#E82E5F" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5">
                                                <circle cx="8" cy="2.5" r=".75" />
                                                <circle cx="8" cy="8" r=".75" />
                                                <circle cx="8" cy="13.5" r=".75" />
                                            </g>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                class="dropdown-item enquire-modal-trigger" href="javascript:void(0)"
                                                data-id="{{ $value->id }}"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="1rem" height="1rem" viewBox="0 0 50 50">
                                                    <g fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="4">
                                                        <path stroke="#344054"
                                                            d="M39.583 25S33.063 33.333 25 33.333C16.938 33.333 10.417 25 10.417 25s6.52-8.333 14.583-8.333S39.583 25 39.583 25M25 20.833a4.167 4.167 0 1 0 0 8.334a4.167 4.167 0 0 0 0-8.334" />
                                                        <path stroke="#E82E5F"
                                                            d="M6.25 14.583v-6.25A2.083 2.083 0 0 1 8.333 6.25h6.25m29.167 8.333v-6.25a2.083 2.083 0 0 0-2.083-2.083h-6.25M6.25 35.417v6.25a2.083 2.083 0 0 0 2.083 2.083h6.25m29.167-8.333v6.25a2.083 2.083 0 0 1-2.083 2.083h-6.25" />
                                                    </g>
                                                </svg>&nbsp;View
                                            </a>
                                        </li>
                                        <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                class="dropdown-item"
                                                href="{{ route('admin.leadsenquiries.edit', $value->id) }}"
                                                title="Edit Lead Enquiries"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="1rem" height="1rem" viewBox="0 0 48 48">
                                                    <g fill="none" stroke="#000" stroke-linejoin="round"
                                                        stroke-width="4">
                                                        <path stroke-linecap="round"
                                                            d="M42 26V40C42 41.1046 41.1046 42 40 42H8C6.89543 42 6 41.1046 6 40V8C6 6.89543 6.89543 6 8 6L22 6" />
                                                        <path fill="#E82E5F"
                                                            d="M14 26.7199V34H21.3172L42 13.3081L34.6951 6L14 26.7199Z" />
                                                    </g>
                                                </svg>&nbsp;Edit
                                            </a>
                                        </li>
                                        <li><a style="cursor: pointer;color: #383838 !important;font-size:13px;font-weight:bold;"
                                                class="dropdown-item deleteLeadEnquiryLink"
                                                data-id="{{ $value->id }}" data-toggle="modal"
                                                data-target="#deleteModal"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="1rem" height="1rem" viewBox="0 0 48 48">
                                                    <g fill="none" stroke-linejoin="round" stroke-width="4">
                                                        <path fill="#E82E5F" stroke="#000" d="M9 10V44H39V10H9Z" />
                                                        <path stroke="#fff" stroke-linecap="round" d="M20 20V33" />
                                                        <path stroke="#fff" stroke-linecap="round" d="M28 20V33" />
                                                        <path stroke="#000" stroke-linecap="round" d="M4 10H44" />
                                                        <path fill="#E82E5F" stroke="#000"
                                                            d="M16 10L19.289 4H28.7771L32 10H16Z" />
                                                    </g>
                                                </svg>&nbsp;Delete
                                            </a>
                                        </li>
                                        <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                data-lead-id="{{ $value->id }}"
                                                data-remark="{{ $value->remark }}" class="dropdown-item followUpBtn"
                                                href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#addFollowUpModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                                    viewBox="0 0 48 48">
                                                    <g fill="none" stroke="#000" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="4">
                                                        <circle cx="24" cy="12" r="8" fill="#E82E5F" />
                                                        <path
                                                            d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" />
                                                        <path d="M19 39H29" />
                                                        <path d="M24 34V44" />
                                                    </g>
                                                </svg>&nbsp;Add Follow Up
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                {{-- for users  --}}
                                <div class="dropdown dropstart">
                                    <button style="padding: 10px 10px !important; border-color: #7987a1 !important;"
                                        class="btn" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0 0 16 16">
                                            <g fill="none" stroke="#E82E5F" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5">
                                                <circle cx="8" cy="2.5" r=".75" />
                                                <circle cx="8" cy="8" r=".75" />
                                                <circle cx="8" cy="13.5" r=".75" />
                                            </g>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                class="dropdown-item enquire-modal-trigger" href="javascript:void(0)"
                                                data-id="{{ $value->id }}"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="1rem" height="1rem" viewBox="0 0 50 50">
                                                    <g fill="none" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="4">
                                                        <path stroke="#344054"
                                                            d="M39.583 25S33.063 33.333 25 33.333C16.938 33.333 10.417 25 10.417 25s6.52-8.333 14.583-8.333S39.583 25 39.583 25M25 20.833a4.167 4.167 0 1 0 0 8.334a4.167 4.167 0 0 0 0-8.334" />
                                                        <path stroke="#E82E5F"
                                                            d="M6.25 14.583v-6.25A2.083 2.083 0 0 1 8.333 6.25h6.25m29.167 8.333v-6.25a2.083 2.083 0 0 0-2.083-2.083h-6.25M6.25 35.417v6.25a2.083 2.083 0 0 0 2.083 2.083h6.25m29.167-8.333v6.25a2.083 2.083 0 0 1-2.083 2.083h-6.25" />
                                                    </g>
                                                </svg>&nbsp;View
                                            </a>
                                        </li>
                                        <li><a style="color: #383838 !important;font-size:13px;font-weight:bold;"
                                                data-lead-id="{{ $value->id }}"
                                                data-remark="{{ $value->remark }}" class="dropdown-item followUpBtn"
                                                href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#addFollowUpModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                                    viewBox="0 0 48 48">
                                                    <g fill="none" stroke="#000" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="4">
                                                        <circle cx="24" cy="12" r="8" fill="#E82E5F" />
                                                        <path
                                                            d="M42 44C42 34.0589 33.9411 26 24 26C14.0589 26 6 34.0589 6 44" />
                                                        <path d="M19 39H29" />
                                                        <path d="M24 34V44" />
                                                    </g>
                                                </svg>&nbsp;Add Follow Up
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="row">{{ $leadsenquiries->links() }}</div>
    </div>
@endif
