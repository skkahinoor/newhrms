{{-- Lead Source  --}}
<br><br>
<div class="position-relative">
    <div class="position-absolute bottom-0 end-0">
        <button type="button" class="btn-primary rounded f-2 p-1" data-bs-toggle="modal" data-bs-target="#addPostModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            Add Post&nbsp;
        </button>
    </div>
</div>
{{-- Card start --}}
@if ($postlist->count() > 0)
    <div class="container mt-5 mb-3">
        <div class="row">
            @foreach ($postlist as $key => $value)
                <div class="col-md-4">
                    <div class="card p-3 mb-4 shadow-sm">
                        <!-- Card Header -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" color="#000"><path d="M11.007 21H9.605c-3.585 0-5.377 0-6.491-1.135S2 16.903 2 13.25s0-5.48 1.114-6.615S6.02 5.5 9.605 5.5h3.803c3.585 0 5.378 0 6.492 1.135c.857.873 1.054 2.156 1.1 4.365"/><path d="M20.017 20.023L22 22m-.947-4.474a3.527 3.527 0 1 0-7.053 0a3.527 3.527 0 0 0 7.053 0M16 5.5l-.1-.31c-.495-1.54-.742-2.31-1.331-2.75C13.979 2 13.197 2 11.63 2h-.263c-1.565 0-2.348 0-2.937.44c-.59.44-.837 1.21-1.332 2.75L7 5.5"/></g></svg>
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $companyname->name }}</h6>
                                    <span class="text-muted small">{{ $value->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="btn-group dropstart">
                                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="20"
                                        height="20" viewBox="0 0 24 24">
                                        <path fill="none" stroke="#000" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                    </svg>
                                </button>
                                <ul class="dropdown-menu">
                                    <!-- Add relevant dropdown menu options -->
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.recruitment.view', $value->id) }}">View</a></li>
                                    <li><a class="dropdown-item editPostButton" data-post="{{ json_encode($value) }}" href="javascript:void(0);">Edit</a></li>
                                    <li><a class="dropdown-item deleteJob" data-delete="{{ $value->id }}" href="javascript:void(0);">Delete</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="mt-4">
                            <h6 class="text-secondary mb-2">Post Name</h6>
                            <h5 class="fw-bold">{{ $value->postname }}</h5>
                            <p class="text-truncate text-secondary mb-2" title="{{ $value->description }}">
                                {{ $value->description }}
                            </p>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mt-4">
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ ($value->selected / $value->totalvacancy) * 100 }}%;"
                                    aria-valuenow="{{ $value->selected }}" aria-valuemin="0"
                                    aria-valuemax="{{ $value->totalvacancy }}">
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000"
                                        class="me-1">
                                        <path
                                            d="M17 6V4H6v2h3.5c1.302 0 2.401.838 2.815 2H6v2h6.315A2.99 2.99 0 0 1 9.5 12H6v2.414L11.586 20h2.828l-6-6H9.5a5.01 5.01 0 0 0 4.898-4H17V8h-2.602a4.9 4.9 0 0 0-.924-2z" />
                                    </svg>
                                    {{ $value->salaryrange }}
                                </p>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="text-muted">
                                        <strong>{{ $value->selected }}</strong> Selected
                                        <span class="text-muted">out of {{ $value->totalvacancy }} Candidates</span>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted">
                                        Total Apply:
                                        <strong>{{ $value->totalapply }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <p class="text-center text-muted mt-4">No Cards</p>
@endif

{{-- Card end  --}}

{{-- End Lead Source  --}}
