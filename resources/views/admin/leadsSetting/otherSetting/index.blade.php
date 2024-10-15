{{-- Other Lead Setting  --}}
<br>

<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button button-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Set Limit & Lead Form Link
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <form action="{{ route('admin.leadsetting.setting') }}" class="forms-sample" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mb-4">
                            <label class="form-label" for="datanum">Limit Of Lead Enquiry Per Page <span
                                    class="text-danger">*</span>&nbsp;<span class="text-secondary">(Min 5 to max
                                    50)</span></label>
                            <input type="number" class="form-control" name="limit" id="datanum"
                                value="{{ old('limit', $setting->datanum) }}" required>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <label class="form-label" for="leadformlink">Current Lead Form Link <span
                                    class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="leadformlink" id="leadformlink"
                                value="{{ old('leadformlink', $setting->leadformlink) }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg col-md-12 mb-4 text-start">
                            <button type="submit" class="btn btn-primary">
                                <i class="link-icon"></i>
                                Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Customize Lead Form
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row" style="height: 1300px !important;">
                    <div class="col-lg-6 col-md-12">
                        {{-- Main Customize Section here  --}}
                        <h3>Customize your Lead Form&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1.2rem"
                                height="1.2rem" viewBox="0 0 28 28">
                                <path fill="#E82E5F"
                                    d="M8.5 11.5a1 1 0 1 0 0 2a1 1 0 0 0 0-2m-1 8a1 1 0 1 1 2 0a1 1 0 0 1-2 0M3 6.75A3.75 3.75 0 0 1 6.75 3h14.5A3.75 3.75 0 0 1 25 6.75v14.5A3.75 3.75 0 0 1 21.25 25H6.75A3.75 3.75 0 0 1 3 21.25zm3 5.75a2.5 2.5 0 1 0 5 0a2.5 2.5 0 0 0-5 0M8.5 17a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5m4.5-4.75c0 .414.336.75.75.75h7.5a.75.75 0 0 0 0-1.5h-7.5a.75.75 0 0 0-.75.75m.75 6.25a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5zM6 6.75c0 .414.336.75.75.75h14.5a.75.75 0 0 0 0-1.5H6.75a.75.75 0 0 0-.75.75" />
                            </svg></h3>
                        <br>
                        <form action="{{ route('admin.leadsetting.setting2') }}" class="forms-sample" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="leadformtitle" class="form-control" id="floatingInput"
                                    placeholder="Enter Form Title" value="{{ $setting->leadformtitle }}" required>
                                <label for="floatingInput" class="text-secondary">Form Title&nbsp;<span
                                        class="text-danger">*</span></label>
                            </div>
                            {{-- Submit button here  --}}
                            <div class="row">
                                <div class="col-lg col-md-12 mb-4 text-start">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="link-icon"></i>
                                        Update</button>
                                </div>
                            </div>
                            <br>
                        </form>
                        {{-- Display Which One is visible or not  --}}
                        <div class="form-check form-switch form-control">
                            <h4 class="text-secondary">&nbsp;~&nbsp;Check which you want to show&nbsp;<svg
                                    xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem"
                                    viewBox="0 0 24 24">
                                    <path fill="#E82E5F"
                                        d="M14 12c-1.095 0-2-.905-2-2c0-.354.103-.683.268-.973C12.178 9.02 12.092 9 12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3s3-1.358 3-3c0-.092-.02-.178-.027-.268c-.29.165-.619.268-.973.268" />
                                    <path fill="#E82E5F"
                                        d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316l-.105-.316C21.927 11.617 19.633 5 12 5m0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5c-.504 1.158-2.578 5-7.926 5" />
                                </svg></h4>
                            <br>
                            <input class="form-check-input" name="name" type="checkbox" role="switch" id="name"
                                checked>
                            <label style="cursor: pointer;" class="form-check-label"
                                for="name">&nbsp;Name&nbsp;<span class="text-danger">*</span>&nbsp;<span
                                    class="text-secondary">(Sorry You can't change this)</span></label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="city"
                                {{ $leadform->city == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="city">&nbsp;City</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="email" checked>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="email">&nbsp;Email&nbsp;<span class="text-danger">*</span>&nbsp;<span
                                    class="text-secondary">(Sorry You can't change this)</span></label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="state" {{ $leadform->state == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="state">&nbsp;State</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="companyname" {{ $leadform->companyname == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="companyname">&nbsp;Company Name</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="country" {{ $leadform->country == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="country">&nbsp;Country</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="website" {{ $leadform->website == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="website">&nbsp;Website</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="postalcode" {{ $leadform->postalcode == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="postalcode">&nbsp;Postal Code</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="address" {{ $leadform->address == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="address">&nbsp;Address</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="number" checked>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="number">&nbsp;Number&nbsp;<span class="text-danger">*</span>&nbsp;<span
                                    class="text-secondary">(Sorry You can't change this)</span></label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="message" {{ $leadform->message == 1 ? 'checked' : '' }}>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="message">&nbsp;Message</label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="leadsource" checked>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="leadsource">&nbsp;Lead Source&nbsp;<span class="text-danger">*</span>&nbsp;<span
                                    class="text-secondary">(Sorry You can't change this)</span></label>
                            <br>
                            <br>
                            <input class="form-check-input" type="checkbox" role="switch" id="leadcategory"
                                checked>
                            <label style="cursor: pointer;color:black !important;" class="form-check-label"
                                for="leadcategory">&nbsp;Lead Category&nbsp;<span
                                    class="text-danger">*</span>&nbsp;<span class="text-secondary">(Sorry You can't
                                    change this)</span></label>
                        </div>
                        {{-- End Customization  --}}
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <iframe id="ireload" src="{{ $setting->leadformlink }}" frameborder="1" scrolling="no"
                            style="height: 100%; width:100%;"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- End Other Lead Setting  --}}
