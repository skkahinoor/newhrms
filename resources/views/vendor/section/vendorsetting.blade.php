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
                <h3>Profile Details&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                        viewBox="0 0 24 24">
                        <g fill="#e82e5f" fill-rule="evenodd" clip-rule="evenodd">
                            <path
                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352z" />
                            <path
                                d="M19.846 4.318a2.2 2.2 0 0 0-.437-.692a2 2 0 0 0-.654-.463a1.92 1.92 0 0 0-1.544 0a2 2 0 0 0-.654.463l-.546.578l2.852 3.02l.546-.579a2.1 2.1 0 0 0 .437-.692a2.24 2.24 0 0 0 0-1.635M17.45 8.721L14.597 5.7L9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.5.5 0 0 0 .255-.145l4.778-5.06Z" />
                        </g>
                    </svg></h3>
                <div class="user-details text-center">
                    <img src="{{ asset('assets/images/favicon.png') }}" alt="Pfofile logo" width="100px" height="100px"
                        class="text-center">
                    <h5>{{ $getUserDetails->name }}</h5>
                    <h6 class="text-secondary">{{ $getUserDetails->email }}</h6>
                </div>
                <p>Your Asset Type:&nbsp;<b class="text-primary">{{ $getUserDetails->assettype->name }}</b></p>
                <p>Number:&nbsp;<b class="text-primary">{{ $getUserDetails->phone }}</b></p>

            </div>

            <hr class="horizontal dark my-sm-4">
            <div class="w-100 text-center">
            </div>
        </div>
    </div>
</div>
