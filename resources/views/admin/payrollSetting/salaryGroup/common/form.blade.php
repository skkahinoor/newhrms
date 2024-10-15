<div class="row">
    <div class="col-lg-6 mb-3">
        <label for="name" class="form-label">Name<span style="color: red">*</span></label>
        <input type="text"
               class="form-control"
               id="name"
               required
               name="name"
               value="{{ (isset($salaryGroupDetail) ? ($salaryGroupDetail->name) : old('name') )}}"
               autocomplete="off"
               placeholder="Enter Salary Group Name">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="" class="form-label"> Assign Salary Components </label>
        <select class="col-md-12 from-select" id="salaryComponent" name="salary_component_id[]" multiple="multiple"
                >
            @foreach($salaryComponents as $key => $value)
                <option value="{{$key}}"
                    {{
                        (isset($salaryGroupDetail) && in_array($key,$salaryGroupComponentId)) ||
                        old('salary_component_id') !== null && in_array($key,old('salary_component_id'))  ? 'selected' : ''
                     }}
                >
                    {{ucfirst($value)}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-12 mb-3">
        <label for="" class="form-label"> Assign Employee </label>
        <select class="col-md-12 from-select" id="salaryGroupEmployee" name="salary_group_employee[]" multiple="multiple"
                >
            @foreach($employees as $key => $value)
                <option value="{{$key}}"
                    {{
                        (isset($salaryGroupDetail) && in_array($key,$salaryGroupEmployeeId)) ||
                        old('salary_group_employee') !== null && in_array($key,old('salary_group_employee'))  ? 'selected' : ''
                     }}
                >
                    {{ucfirst($value)}}
                </option>
            @endforeach
        </select>
    </div>

    <div class="text-end">
        <button type="submit"
                class="btn btn-primary">
            <i class="link-icon" data-feather="{{isset($salaryGroupDetail)? 'edit-2':'plus'}}"></i>
            {{isset($salaryGroupDetail)? 'Update':'Create'}} Salary Group
        </button>
    </div>
</div>