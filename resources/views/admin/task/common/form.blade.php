 <div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <label for="title" class="form-label"> Task Name <span style="color: red">*</span></label>
        <input type="text" class="form-control" id="name" name="name" required value="{{ ( isset($taskDetail) ?  $taskDetail->name: old('name') )}}"
               autocomplete="off" placeholder="Enter Task Name">
    </div>

    @if(isset($project))
        <div class="col-lg-4 col-md-6 mb-4">
            <label for="project" class="form-label">Project <span style="color: red">*</span> </label>
            <select class="form-select form-select"  name="project_id"  >
                <option value="{{$project->id}}" selected >{{ucfirst($project->name)}}</option>
            </select>
        </div>
    @else
        <div class="col-lg-4 col-md-6 mb-4">
            <label for="project" class="form-label">Project <span style="color: red">*</span> </label>
            <select class="form-select form-select" id="project" name="project_id"  >
                <option value="" {{isset($taskDetail) ? '' : 'selected'}}  disabled>Select Project</option>
                @foreach($projectLists as $key => $value)
                    <option value="{{$value->id}}" {{ (isset($taskDetail) && ($taskDetail->project_id) == $value->id) || ( old('project_id') == $value->id)? 'selected': '' }}>
                        {{$value->name}}
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="start_date" class="form-label"> Task Start Date <span style="color: red">*</span> </label>
        <input type="datetime-local" class="form-control startDate" id="start_date" name="start_date" required value="{{ ( isset( $taskDetail) ?  $taskDetail->start_date: old('start_date') )}}"
               autocomplete="off" >
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <label for="end_date" class="form-label"> Task End Date <span style="color: red">*</span> </label>
        <input type="datetime-local" class="form-control deadline" id="end_date" name="end_date" required value="{{ ( isset( $taskDetail) ?  $taskDetail->end_date: old('end_date') )}}"
               autocomplete="off" >
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="priority" class="form-label">Priority</label>
        <select class="form-select" id="priority" name="priority"  >
            <option value="" {{isset($taskDetail) ? '' : 'selected'}}  disabled>Select Priority</option>
            @foreach(\App\Models\Task::PRIORITY as $value)
                <option value="{{$value}}" {{ (isset($taskDetail) && ($taskDetail->priority ) == $value) || ( old('priority') == $value) ? 'selected': '' }}>
                    {{ucfirst($value)}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="status" class="form-label">Task Status </label>
        <select class="form-select" id="status" name="status"  >
            <option value="" {{isset($taskDetail) ? '' : 'selected'}}  disabled>Select Task Status</option>
            @foreach(\App\Models\Task::STATUS as $value)
                <option value="{{$value}}" {{ (isset($taskDetail) && ($taskDetail->status ) == $value) || (old('status') == $value) ? 'selected': '' }}>
                    {{\App\Helpers\PMHelper::STATUS[$value]}}</option>
            @endforeach
        </select>
    </div>

    @if(isset($projectMember))
        <div class="col-lg-12 mb-3">
            <label for="employee" class="form-label">Assign Member <span style="color: red">*</span></label>
            <br>
            <select class="col-md-12 form-select" id="taskMember" name="assigned_member[]" multiple="multiple" required>
                @if(isset($projectMember))
                    @foreach($projectMember as $key => $datum)
                        <option value="{{$datum->user->id}}"  >{{ucfirst($datum->user->name)}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    @else
        <div class="col-lg-12 mb-3 taskMemberAssignDiv">
            <label for="employee" class="form-label">Assign Member <span style="color: red">*</span></label>
            <br>
            <select class="col-md-12 form-select" id="taskMember" name="assigned_member[]" multiple="multiple" required>
                @if(isset($taskDetail))
                    @foreach($taskDetail->project->assignedMembers as $key => $value)
                        <option value="{{$value->user->id}}" {{ isset($taskDetail) && in_array($value->user->id,$memberId)  ? 'selected' : '' }}  >{{ucfirst($value->user->name)}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    @endif

    <div class="col-lg-6 mb-4">
        <label for="description" class="form-label">Description<span style="color: red">*</span></label>
        <textarea class="form-control" name="description" id="tinymceExample" rows="4">{{ ( isset($taskDetail) ? $taskDetail->description: old('description') )}}</textarea>
    </div>

    @if(isset($taskDetail))
        <div class="col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="">Uploaded Files And Images </h6>
                </div>
                <div class="card-body">
                    @if(count($files) < 1 && count($images) < 1)
                        <div class="row">
                            <p class="text-muted">No project file uploaded</p>
                        </div>
                    @endif
                    <div class="row mb-4">
                        @forelse($images as $key => $imageData)
                            <div class="col-lg-3">
                                <div class="uploaded-image">
                                    <img class="w-100" style=""
                                         src="{{ asset(\App\Models\Attachment::UPLOAD_PATH.$imageData->attachment) }}"
                                         alt="document images">
                                        <a class="documentDelete" data-href="{{route('admin.attachment.delete',$imageData->id)}}">
                                            <i class="link-icon remove-image" data-feather="x"></i>
                                        </a>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                    <div class="row">
                        @forelse($files as $key => $fileData)
                            <div class="uploaded-files">
                                <div class="row align-items-center">
                                    <div class="col-lg-1">
                                        <div class="file-icon">
                                            <i class="link-icon" data-feather="file-text"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <a target="_blank" href="{{asset(\App\Models\Attachment::UPLOAD_PATH.$fileData->attachment)}}">
                                            {{asset(\App\Models\Attachment::UPLOAD_PATH.$fileData->attachment)}}
                                        </a>
                                    </div>

                                    <div class="col-lg-1">
                                        <a class="documentDelete" data-href="{{route('admin.attachment.delete',$fileData->id)}}">
                                            <i class="link-icon remove-files" data-feather="x"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-lg-6 mb-4">
        <h6 class="mb-2">Task Attachments </h6>
        <div>
            <input id="image-uploadify" type="file"  name="attachments[]"
                   accept=".pdf,.jpg,.jpeg,.png,.docx,.doc,.xls,.txt,.zip"  multiple />
        </div>
    </div>

     <div class="col-12">
         <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="{{isset($taskDetail)? 'edit-2':'plus'}}"></i> {{isset($taskDetail)? 'Update':'Create'}} Task</button>
     </div>
</div>







