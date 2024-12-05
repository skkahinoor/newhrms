<!-- Modal For Create-->
<div class="modal fade" id="addPostTypeModal" tabindex="-1" aria-labelledby="addPostTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPostTypeModalLabel">Add Post Type</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <!-- Form to Add Lead Source -->
                <form id="postTypeForm" method="POST" action="{{ route('admin.recruitment.addPostType') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="posttype" class="form-label">Post Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="posttype" name="posttype"
                            placeholder="Enter Post Type Name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="postTypeForm" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Create-->

<!-- Modal For Update/Edit-->
<div class="modal fade" id="editPostTypeModal" tabindex="-1" aria-labelledby="editPostTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostTypeModalLabel">Edit Post Type</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form id="editPostTypeForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editposttype" class="form-label">Post Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editposttype" name="editposttype"
                            placeholder="Enter Post Type" required>
                    </div>
                    <input type="hidden" id="posttypeid" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editPostTypeForm" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Update/Edit-->

<!-- Delete Modal -->
<div class="modal fade" id="deletePostTypeModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Post Type</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Post Type?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="delete-posttype-form">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

