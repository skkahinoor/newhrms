<!-- Modal For Create-->
<div class="modal fade" id="addLeadStatusModal" tabindex="-1" aria-labelledby="addLeadStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeadStatusModalLabel">Add Lead Status</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <!-- Form to Add Lead Source -->
                <form id="leadStatusForm" method="POST" action="{{ route('admin.leadstatus.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="leadStatusName" class="form-label">Lead Source Name <span
                                style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="leadStatusName" name="name"
                            placeholder="Enter Lead Status Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="leadStatusColor" class="form-label">Label Color <span
                                style="color: red;">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="labelColor" name="color" value="#E82E5F"
                                required>
                            <div class="lead-status-color-picker">
                                <input type="color" id="colorPicker" value="#E82E5F">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="leadStatusForm" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Create-->

<!-- Modal For Update/Edit-->
<div class="modal fade" id="editLeadStatusModal" tabindex="-1" aria-labelledby="editLeadStatusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLeadStatusModalLabel">Edit Lead Status</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form id="editLeadStatusForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editLeadStatusName" class="form-label">Lead Status Name</label>
                        <input type="text" class="form-control" id="editLeadStatusName" name="name"
                            placeholder="Enter Lead Status Name" required>
                    </div>
                    {{-- color pick  --}}
                    <div class="mb-3">
                        <label for="editLabelColor" class="form-label">Label Color <span
                                style="color: red;">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control labelStatusColor" id="editLabelColor"
                                name="color" placeholder="Pick Color" required>
                            <div class="lead-status-color-picker">
                                <input type="color" class="form-control-color" id="editColorPicker">
                            </div>
                        </div>
                    </div>
                    {{-- end color pick  --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editLeadStatusForm" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal For Update/Edit-->

<!-- Delete Modal -->
<div class="modal fade" id="deleteLeadStatusModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteLeadStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLeadStatusModalLabel">Delete Lead Status</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this lead Status?
            </div>
            <div class="modal-footer">
                <form id="deleteLeadStatusForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
