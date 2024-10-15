{{-- Lead Source  --}}
<br><br>
<div class="position-relative">
    <div class="position-absolute bottom-0 end-0">
        <button type="button" class="btn-primary rounded f-2 p-1" data-bs-toggle="modal"
            data-bs-target="#addLeadSourceModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            Add LeadSource
        </button>
    </div>
</div>
{{-- Table start  --}}
<div class="table-responsive">
    @isset($leadSources)
        <table id="dataTableExample" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    @if ($leadSources->count() > 0)
                        @foreach ($leadSources as $key => $value)
                <tr>
                    <td>{{ $leadSources->firstItem() + $key }}</td>
                    <td>{{ $value->name }}</td>



                    <td class="text-center">
                        {{-- @if ($isAdmin) --}}
                        <ul class="d-flex list-unstyled mb-0 justify-content-center">
                            {{-- For admins --}}
                            <li class="me-2">
                                <a class="editLeadSourceBtn" data-id="{{ $value->id }}" data-name="{{ $value->name }}"
                                    data-bs-toggle="modal" data-bs-target="#editLeadSourceModal">
                                    <i class="link-icon" data-feather="edit"></i>
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
            @else
                <p>No enquiries assigned to you.</p>
                @endif


            </tbody>
        </table>
        <br>
        <div class="row">{{ $leadSources->links() }}</div>
    @endisset
</div>
{{-- Table end  --}}
{{-- End Lead Source  --}}
