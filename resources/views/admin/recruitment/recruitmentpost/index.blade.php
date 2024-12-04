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
{{-- Table start  --}}
<div class="table-responsive">
    @isset($postlist)
        <table id="dataTableExample" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Post Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    @if ($postlist->count() > 0)
                        @foreach ($postlist as $key => $value)
                <tr>
                    <td>{{ $postlist->firstItem() + $key }}</td>
                    <td>{{ $value->postname }}</td>



                    <td class="text-center">
                        {{-- @if ($isAdmin) --}}
                        <ul class="d-flex list-unstyled mb-0 justify-content-center">
                            {{-- For admins --}}
                            <li class="me-2">
                                <a class="editLeadSourceBtn" data-id="{{ $value->id }}" data-name="{{ $value->name }}"
                                    data-bs-toggle="modal" data-bs-target="#editLeadSourceModal">
                                    <i class="link-icon" data-feather="edit"></i>`
                                </a>
                                <a class="deleteLeadSourceLink" data-id="{{ $value->id }}" data-toggle="modal"
                                    data-target="#deleteModal">
                                    <i class="link-icon" data-feather="delete"></i>
                                </a>
                            </li>
                        </ul>
                        {{-- @endif --}}

                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <br>
        <div class="row">{{ $postlist->links() }}</div>
    @endisset
</div>
{{-- Table end  --}}

{{-- Card start --}}
@if ($postlist->count() > 0)
    <div class="container mt-5 mb-3">
        <div class="row">
            @foreach ($postlist as $key => $value)
                 <div class="col-md-4">
                <div class="card p-3 mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                            <div class="ms-2 c-details">
                                <h6 class="mb-0">Mailchimp</h6> <span>1 days ago</span>
                            </div>
                        </div>
                        <div class="badge"> <span>Design</span> </div>
                    </div>
                    <div class="mt-5">
                        <span class="text-secondary">Post Name</span>
                        <h3 class="heading">{{ $value->postname }}</h3>
                        <div class="mt-5">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="mt-3"> <span class="text1">32 Applied <span class="text2">of 50
                                        capacity</span></span> </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <p>No Cards</p>
@endif
{{-- Card end  --}}

{{-- End Lead Source  --}}
