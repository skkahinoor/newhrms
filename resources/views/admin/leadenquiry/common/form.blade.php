<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <label for="name" class="form-label"> Name <span style="color: red">*</span></label>
        <input type="text" class="form-control  @error('name') is-validate @enderror " id="name" name="name"
            required value="{{ old('name', $leadsenquiries->name) }}" autocomplete="off" placeholder="Enter Name">
        @error('name')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="city" class="form-label"> City</label>
        <input type="text" class="form-control  @error('city') is-validate @enderror " id="city" name="city"
            value="{{ old('city', $leadsenquiries->city) }}" autocomplete="off" placeholder="Enter City">
        @error('city')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="email" class="form-label"> Email <span style="color: red">*</span></label>
        <input type="email" class="form-control @error('email') is-validate @enderror" id="email" name="email"
            required value="{{ old('email', $leadsenquiries->email) }}" autocomplete="off"
            placeholder="Enter Client email">
        @error('email')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="state" class="form-label"> State</label>
        <input type="text" class="form-control  @error('state') is-validate @enderror " id="state" name="state"
            value="{{ old('state', $leadsenquiries->state) }}" autocomplete="off" placeholder="Enter State">
        @error('state')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="companyname" class="form-label"> Company Name</label>
        <input type="text" class="form-control  @error('companyname') is-validate @enderror " id="companyname"
            name="companyname" value="{{ old('companyname', $leadsenquiries->companyname) }}" autocomplete="off"
            placeholder="Enter Company Name">
        @error('companyname')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="country" class="form-label"> Country</label>
        <select name="country" id="country" class="form-select">
            <option value="{{ old('country', $leadsenquiries->country) }}">
                {{ old('country', $leadsenquiries->country) }}</option>
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="website" class="form-label"> Website</label>
        <input type="text" class="form-control  @error('website') is-validate @enderror " id="website"
            name="website" value="{{ old('website', $leadsenquiries->website) }}" autocomplete="off"
            placeholder="Enter Website">
        @error('website')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="postalcode" class="form-label"> Postal Code</label>
        <input type="text" class="form-control  @error('postalcode') is-validate @enderror " id="postalcode"
            name="postalcode" value="{{ old('postalcode', $leadsenquiries->postalcode) }}" autocomplete="off"
            placeholder="Enter Postal Code">
        @error('postalcode')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="address" class="form-label"> Address </label>
        <input type="text" class="form-control  @error('address') is-validate @enderror" id="address"
            name="address" value="{{ old('address', $leadsenquiries->address) }}" autocomplete="off"
            placeholder="Enter Client address">
        @error('address')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="contact_no" class="form-label"> Number <span style="color: red">*</span> </label>
        <input type="text" class="form-control  @error('number') is-validate @enderror" id="contact_no"
            name="number" required value="{{ old('number', $leadsenquiries->number) }}" autocomplete="off"
            placeholder="Enter Contact Number">
        @error('number')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>


    <div class="col-lg-4 col-md-6 mb-4">
        <label for="message" class="form-label"> Message</label>
        <textarea name="message" class="form-control @error('message') is-validate @enderror" id="message" cols="5"
            rows="2">{{ old('message', $leadsenquiries->message) }}</textarea>
        @error('message')
            <p class="text-danger">(&nbsp;{{ $message }}&nbsp;)</p>
        @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <label for="leadsource" class="form-label">Lead Source <span style="color: red">*</span></label>
        <select name="leadsource" id="leadsource" class="form-select" required>
            <option value="">Select option</option>
            @if (count($leadsources) > 0)
                @foreach ($leadsources as $source)
                    <option value="{{ $source->id }}"
                        {{ $leadsenquiries->leadsource == $source->id ? 'selected' : '' }}>
                        {{ $source->name }}
                    </option>
                @endforeach
            @else
                <option value="">No Lead Source found</option>
            @endif
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <label for="leadcategory" class="form-label">Lead Category <span style="color: red">*</span></label>
        <select name="leadcategory" id="leadcategory" class="form-select" required>
            <option value="">Select option</option>
            @if (count($leadcategory) > 0)
                @foreach ($leadcategory as $category)
                    <option value="{{ $category->id }}"
                        {{ $leadsenquiries->leadcategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            @else
                <option value="">No Lead Category found</option>
            @endif
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <label for="leadagents" class="form-label">Choose Lead Agent <span style="color: red">*</span></label>
        <select name="leadagents" id="leadagents" class="form-select" required aria-label="Lead Agent">
            <option value="">Select option</option>
            @if (count($leadagents) > 0)
                @foreach ($leadagents as $agent)
                    <option value="{{ $agent->id }}"
                        {{ $leadsenquiries->leadagent == $agent->id ? 'selected' : '' }}>
                        {{ $agent->username }}
                    </option>
                @endforeach
            @else
                <option value="">No Lead Agent Assign</option>
            @endif
        </select>
        @if ($errors->has('leadagents'))
            <div class="text-danger">
                {{ $errors->first('leadagents') }}
            </div>
        @endif
    </div>




    <div class="col-lg-4 col-md-6 mb-3">
        <label for="assign_user" class="form-label">Lead Status <span style="color: red">*</span></label>
        <select name="leadstatus" id="leadstatus" class="form-select" required>
            @foreach ($leadstatuses as $leadstatus)
                <option value="{{ $leadstatus->id }}"
                    {{ $leadsenquiries->leadstatus == $leadstatus->id ? 'selected' : '' }}>
                    <span
                        style="background-color: {{ $leadstatus->color }}; width: 15px; height: 15px; border-radius: 50%; display: inline-block; margin-right: 5px;"></span>
                    {{ $leadstatus->name }}
                </option>
            @endforeach
        </select>
    </div>



    <div class="row">
        <div class="col-lg col-md-12 mb-4 text-start">
            <button type="submit" class="btn btn-primary">
                <i class="link-icon"></i>
                Update</button>
        </div>
    </div>

</div>
