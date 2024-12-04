<!-- Modal For Create-->
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPostModalLabel">Add Requirement Post</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <!-- Form to Add Requirement -->
                <form id="postForm" method="POST" action="{{ route('admin.recruitment.addpost') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="postName" class="form-label">Post Name</label>
                            <input type="text" class="form-control" id="postName" name="postname"
                                placeholder="Enter Job Post Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postexperience" class="form-label">Experience</label>
                            <input type="number" step="0.02" class="form-control" id="postexperience"
                                name="postexperience" placeholder="Enter Experience" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postexperience" class="form-label">Job Type</label>
                            <select name="jobtype" class="form-control" id="jobtype">
                                <option value="">Select Type</option>
                                <option value="1">Remote</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postexperience"  class="form-label">Job Location</label>
                            <select name="joblocation" class="form-control" id="joblocation">
                                <option value="">Select Location</option>
                                <option value="3">BBSR</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="postName" class="form-label">Job Post Description</label>
                            <textarea name="postdescription" class="form-control" id="postdescription" cols="20" rows="5"
                                placeholder="Enter Job Description" required></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="postForm" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Create-->

<!-- Modal For Update/Edit-->
<div class="modal fade" id="editLeadSourceModal" tabindex="-1" aria-labelledby="editLeadSourceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeadSourceModalLabel">Edit Lead Source</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form id="editLeadSourceForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editLeadSourceName" class="form-label">Lead Source Name</label>
                        <input type="text" class="form-control" id="editLeadSourceName" name="name"
                            placeholder="Enter Lead Source Name" required>
                    </div>
                    <input type="hidden" id="leadSourceId" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editLeadSourceForm" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Update/Edit-->

<!-- Delete Modal -->
<div class="modal fade" id="deleteleadsourceModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Lead Source</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this lead Source?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="delete-leadsource-form">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
