{{-- Lead Source  --}}
<br><br>
<div class="position-relative">
    <div class="position-absolute bottom-0 end-0">
        <button type="button" class="btn-primary rounded f-2 p-1" data-bs-toggle="modal"
            data-bs-target="#addPostlocationModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            Add Location
        </button>
    </div>
</div>
{{-- Table start  --}}
<div class="table-responsive">
    @if ($postlocation->count() > 0)
        <table id="dataTableExample" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Location Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postlocation as $key => $value)
                    <tr>
                        <td>{{ $postlocation->firstItem() + $key }}</td>
                        <td>{{ $value->postlocation }}</td>
                        <td class="text-center">
                            <ul class="d-flex list-unstyled mb-0 justify-content-center">
                                <li class="me-2">
                                    <a class="editpostlocationBtn" data-id="{{ $value->id }}"
                                        data-name="{{ $value->postlocation }}" data-bs-toggle="modal"
                                        data-bs-target="#editpostlocationModal" style="cursor: pointer;">
                                        <i class="link-icon" data-feather="edit"></i>
                                    </a>
                                    <a class="deletePostLocationLink" data-id="{{ $value->id }}" data-bs-toggle="modal"
                                        data-bs-target="#deletepostlocationModal" style="cursor: pointer;">
                                        <i class="link-icon" data-feather="delete"></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">{{ $postlocation->links() }}</div>
    @else
        <p class="text-center">No locations found.</p>
    @endif

</div>
{{-- Table end  --}}
{{-- End Lead Source  --}}
