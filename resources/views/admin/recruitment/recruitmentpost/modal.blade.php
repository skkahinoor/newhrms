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
                            <label for="totalvacancy" class="form-label">Total Vacancy</label>
                            <input type="number" class="form-control" id="totalvacancy" name="totalvacancy"
                                placeholder="Enter Total Job Vacancy" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="salaryrange" class="form-label">Salary Range</label>
                            <input type="text" class="form-control" id="salaryrange" name="salaryrange"
                                placeholder="Enter Salary Range" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postexperience" class="form-label">Job Type</label>
                            <select name="jobtype" class="form-control" id="jobtype">
                                <option value="">Select Type</option>
                                @foreach ($applyposttype as $type)
                                    <option value="{{ $type->id }}">{{ $type->posttype }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postexperience" class="form-label">Job Location</label>
                            <select name="joblocation" class="form-control" id="joblocation">
                                <option value="">Select Location</option>
                                @foreach ($applypostlocation as $location)
                                    <option value="{{ $location->id }}">{{ $location->postlocation }}</option>
                                @endforeach
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
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Edit Requirement Post</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <!-- Form to Edit Requirement -->
                <form id="editPostForm" method="POST" action="{{ route('admin.recruitment.updatepost') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="post_id" id="editPostId">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPostName" class="form-label">Post Name</label>
                            <input type="text" class="form-control" id="editPostName" name="postname"
                                placeholder="Enter Job Post Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editPostExperience" class="form-label">Experience</label>
                            <input type="number" step="0.02" class="form-control" id="editPostExperience"
                                name="postexperience" placeholder="Enter Experience" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editTotalVacancy" class="form-label">Total Vacancy</label>
                            <input type="number" class="form-control" id="editTotalVacancy" name="totalvacancy"
                                placeholder="Enter Total Job Vacancy" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editSalaryRange" class="form-label">Salary Range</label>
                            <input type="text" class="form-control" id="editSalaryRange" name="salaryrange"
                                placeholder="Enter Salary Range" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editJobType" class="form-label">Job Type</label>
                            <select name="jobtype" class="form-control" id="editJobType">
                                <option value="">Select Type</option>
                                @foreach ($applyposttype as $type)
                                    <option value="{{ $type->id }}">{{ $type->posttype }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editJobLocation" class="form-label">Job Location</label>
                            <select name="joblocation" class="form-control" id="editJobLocation">
                                <option value="">Select Location</option>
                                @foreach ($applypostlocation as $location)
                                    <option value="{{ $location->id }}">{{ $location->postlocation }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editPostDescription" class="form-label">Job Post Description</label>
                            <textarea name="postdescription" class="form-control" id="editPostDescription" cols="20" rows="5"
                                placeholder="Enter Job Description" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editPostForm" class="btn btn-primary">Update</button>
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
