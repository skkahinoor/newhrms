<div class="fixed-plugin">
    {{-- <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="material-icons py-2">settings</i>
    </a> --}}
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Setting</h5>
                <p>Change everything which you want !</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="material-icons">clear</i>
                </button>
            </div>
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0" style="overflow: auto !important;">
            <div class="profile-details">
                <h3>Profile Details&nbsp;</h3>
                <div class="user-details text-center">
                    <img src="{{ asset('assets/images/favicon.png') }}" alt="Pfofile logo" width="100px" height="100px"
                        class="text-center">
                    <h5>{{ $getUserDetails->name }}</h5>
                    <h6 class="text-secondary">{{ $getUserDetails->email }}</h6>
                </div>
                <p>Your Asset Type:&nbsp;<b class="text-primary"></b></p>
                {{-- @foreach ($getUserDetails->assetTypes as $assetType)
                    <li>{{ $assetType->name }}</li>
                @endforeach --}}
                <p>Number:&nbsp;<b class="text-primary">{{ $getUserDetails->phone }}</b></p>

            </div>

            <hr class="horizontal dark my-sm-4">
            <div class="w-100 text-center">
            </div>
        </div>
    </div>
</div>
