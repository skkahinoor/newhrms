<!-- Modal For Create-->
<div class="modal fade" id="addPostlocationModal" tabindex="-1" aria-labelledby="addPostlocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPostlocationModalLabel">Add Post Location</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <!-- Form to Add Lead Source -->
                <form id="postlocationForm" method="POST" action="{{ route('admin.recruitment.addPostLocation') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="postlocation" class="form-label">Location Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="postlocation" name="postlocation"
                            placeholder="Enter Location Name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="postlocationForm" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Create-->

<!-- Modal For Update/Edit-->
<div class="modal fade" id="editpostlocationModal" tabindex="-1" aria-labelledby="editpostlocationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editpostlocationModalLabel">Edit Post Location</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form id="editpostlocationForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editpostlocationName" class="form-label">Location Name</label>
                        <input type="text" class="form-control" id="editpostlocationName" name="editpostlocation"
                            placeholder="Enter Location Name" required>
                    </div>
                    <input type="hidden" id="postlocationId" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editpostlocationForm" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Update/Edit-->

<!-- Delete Modal -->
<div class="modal fade" id="deletepostlocationModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Post Location</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this location?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="delete-postlocation-form">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

