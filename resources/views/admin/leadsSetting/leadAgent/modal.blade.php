{{-- new  Modal  --}}
<div class="modal fade" id="leadAgentModal" tabindex="-1" role="dialog" aria-labelledby="leadAgentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leadAgentModalLabel">Add Lead Agent</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> --}}
                    
                </button>
            </div>
            <div class="modal-body">
                <form id="leadAgentForm" method="POST" action="{{ route('admin.leadagent.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="leadAgentName" class="form-label">Lead Agent Name</label>
                        <select style="cursor: pointer;" class="form-control" id="leadAgentName" name="username" required>
                            <option value="">Select Employee</option>
                            @foreach($users as $user)
                                <option style="cursor: pointer;" value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End New Modal  --}}



<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Lead Agent</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this lead agent?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="delete-form">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
