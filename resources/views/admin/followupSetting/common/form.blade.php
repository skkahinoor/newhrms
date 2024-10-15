<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <label for="name" class="form-label"> Name <span style="color: red">*</span></label>
        <input type="text" class="form-control  @error('name') is-validate @enderror " id="name" name="name" required value="{{ $leadsenquiries->name }}"
               autocomplete="off" placeholder="Enter Name">
               @error('name')
                   <p>{{ $message }}</p>
               @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="email" class="form-label"> Email <span style="color: red">*</span></label>
        <input type="email" class="form-control @error('email') is-validate @enderror" id="email" name="email" required value="{{  old('email',$leadsenquiries->email) }}"
               autocomplete="off" placeholder="Enter Client email" >
               @error('email')
                   <p>{{ $message }}</p>
               @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="contact_no" class="form-label"> Number <span style="color: red">*</span> </label>
        <input type="text" class="form-control  @error('number') is-validate @enderror" id="contact_no" name="number" required value="{{ old('number',$leadsenquiries->number) }}"
               autocomplete="off" placeholder="Enter Contact Number" >
               @error('number')
               <p>{{ $message }}</p>
           @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="address" class="form-label"> Address  </label>
        <input type="text" class="form-control  @error('address') is-validate @enderror" id="address" name="address" required value="{{ old('address',$leadsenquiries->address) }}"
               autocomplete="off" placeholder="Enter Client address">
               @error('address')
               <p>{{ $message }}</p>
           @enderror
    </div>


    <div class="col-lg-4 col-md-6 mb-4">
        <label for="message" class="form-label"> Message <span style="color: red">*</span> </label>
               <textarea name="message" class="form-control @error('message') is-validate @enderror" id="message" cols="5" rows="2">{{ old('message',$leadsenquiries->message) }}</textarea>
               @error('message')
               <p>{{ $message }}</p>
           @enderror
    </div>

    
    {{-- my Code  --}}
    <div class="col-lg-4 col-md-6 mb-3">
        <label for="department" class="form-label">Departments <span style="color: red">*</span></label>
        <select class="form-select" id="department" name="department_id">
            <option value="">Select option</option>
            @if(count($departments) > 0)
            @foreach($departments as $department)
                <option value="{{  $department->id }}">{{ $department->dept_name }}</option>
            @endforeach
            @else
            <option value="">No departments found</option>
        @endif
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <label for="assign_user" class="form-label">Assign to Employee <span
                style="color: red">*</span></label>
        <select class="form-select" id="assign_user" name="assign_user" required>
            <option value="">
                Choose Employee
            </option>
        </select>
    </div>
  

  

    <div class="col-lg col-md-12 mb-4 text-start">
        <button type="submit" class="btn btn-primary">
            <i class="link-icon"></i>
            Update</button>
    </div>
</div>







