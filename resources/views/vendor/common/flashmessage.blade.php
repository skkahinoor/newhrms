@if (isset($errors) && count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible text-white" role="alert">
            <span class="text-sm">{{ $error }}</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif


@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible text-white" role="alert">
        <span class="text-sm">
            {{ session('success') }}
        </span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (Session::has('danger'))
    <div class="alert alert-danger alert-dismissible text-white" role="alert">
        <span class="text-sm">{{ session('danger') }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible text-white" role="alert">
        <span class="text-sm">{{ session('info') }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible text-white" role="alert">
        <span class="text-sm">{{ session('warning') }}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
