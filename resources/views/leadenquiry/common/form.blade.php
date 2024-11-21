<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <label for="name" class="form-label"> Name <span style="color: red">*</span></label>
        <input type="text" class="form-control  @error('name') is-validate @enderror " id="name" name="name" required value="{{ old('name') }}"
               autocomplete="off" placeholder="Enter Name">
               @error('name')
                   <p>{{ $message }}</p>
               @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="email" class="form-label"> Email <span style="color: red">*</span></label>
        <input type="email" class="form-control @error('email') is-validate @enderror" id="email" name="email" required value="{{  old('email') }}"
               autocomplete="off" placeholder="Enter Client email" >
               @error('email')
                   <p>{{ $message }}</p>
               @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="contact_no" class="form-label"> Number <span style="color: red">*</span> </label>
        <input type="text" class="form-control  @error('number') is-validate @enderror" id="contact_no" name="number" required value="{{ old('number') }}"
               autocomplete="off" placeholder="Enter Contact Number" >
               @error('number')
               <p>{{ $message }}</p>
           @enderror
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="address" class="form-label"> Address  </label>
        <input type="text" class="form-control  @error('address') is-validate @enderror" id="address" name="address" required value="{{ old('address') }}"
               autocomplete="off" placeholder="Enter Client address">
               @error('address')
               <p>{{ $message }}</p>
           @enderror
    </div>


    <div class="col-lg-4 col-md-6 mb-4">
        <label for="message" class="form-label"> Message <span style="color: red">*</span> </label>
               <textarea name="message" class="form-control @error('message') is-validate @enderror" id="message" cols="30" rows="10">{{ old('message') }}</textarea>
               @error('message')
               <p>{{ $message }}</p>
           @enderror
    </div>

  

    <div class="col-lg col-md-12 mb-4 text-start">
        <button type="submit" class="btn btn-primary">
            <i class="link-icon"></i>
            Create</button>
    </div>
</div>







