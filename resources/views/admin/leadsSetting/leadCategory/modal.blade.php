<!-- Modal For Create-->
<div class="modal fade" id="addLeadCategoryModal" tabindex="-1" aria-labelledby="addLeadCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeadCategoryModalLabel">Add Lead Category</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <!-- Form to Add Lead Category -->
                <form id="leadCategoryForm" method="POST" action="{{ route('admin.leadcategory.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="leadCategoryName" class="form-label">Lead Category Name</label>
                        <input type="text" class="form-control" id="leadCategoryName" name="name"
                            placeholder="Enter Lead Category Name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="leadCategoryForm" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Create-->

<!-- Modal For Update/Edit-->
<div class="modal fade" id="editLeadCategoryModal" tabindex="-1" aria-labelledby="editLeadCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeadCategoryModalLabel">Edit Lead Category</h5>
            </div>
            <div class="modal-body">
                <form id="editLeadCategoryForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editLeadCategoryName" class="form-label">Lead Category Name</label>
                        <input type="text" class="form-control" id="editLeadCategoryName" name="name"
                            placeholder="Enter Lead Category Name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editLeadCategoryForm" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Update/Edit-->

<!-- Delete Modal -->
<div class="modal fade" id="deleteleadcategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Lead Category</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this lead Category?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="delete-leadcategory-form">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

