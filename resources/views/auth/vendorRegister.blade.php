@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="main-wrapper">
            <div class="page-wrapper full-page">
                <div class="page-content d-flex align-items-center justify-content-center">
                    <div class="row w-100 mx-0 auth-page">
                        <div class="col-md-8 col-xl-6 mx-auto">
                            <div class="card">
                                <div class="row align-items-center">
                                    <div class="col-md-4 pe-md-0">
                                        <div class="auth-side-wrapper p-4">
                                            <img src="{{ asset('assets/images/vendor.png') }}" style="object-fit: cover"
                                                width="100%" height="100%" alt="">
                                        </div>
                                    </div>

                                    <div class="col-md-8 ps-md-0">

                                        <div class="auth-form-wrapper px-4 py-5">
                                            <a href="javascript:void(0);" class="noble-ui-logo d-block mb-2">Register As
                                                Vendor</a>
                                            <h5 class="text-muted fw-normal mb-4">Let's make a relationship towards the
                                                growth.</h5>

                                            <form class="forms-sample" method="POST" action="{{ route('vendor.create') }}">
                                                @csrf

                                                {{-- For Name And Email  --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="userEmail" class="form-label">Name&nbsp;<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" value="{{ old('name') }}" required
                                                                autocomplete="name" autofocus>
                                                            @error('name')
                                                                <span class="text-danger">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email&nbsp;<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email') }}" required
                                                                autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="text-danger">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- For phone and Asset type  --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="userPassword" class="form-label">Phone&nbsp;<span
                                                                    class="text-danger">*</span></label>
                                                            <input id="phone" type="phone"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone" required autocomplete="phone">
                                                            @error('phone')
                                                                <span class="text-danger">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="userPassword" class="form-label">Choose Asset
                                                                Type&nbsp;<span class="text-danger">*</span></label>
                                                            <select name="asset-type" id="asset-type" class="form-select"
                                                                required>
                                                                <option value="">Select option</option>
                                                                @if (count($assettype) > 0)
                                                                    @foreach ($assettype as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="">No Asset Type found</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- For Password And confirm password  --}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password&nbsp;<span
                                                                    class="text-danger">*</span></label>
                                                            <input id="password" type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" required autocomplete="new-password">
                                                            @error('password')
                                                                <span class="text-danger">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="password-confirm" class="form-label">Confirm
                                                                Password&nbsp;<span class="text-danger">*</span></label>
                                                            <input id="password-confirm" type="password"
                                                                class="form-control" name="password_confirmation" required
                                                                autocomplete="new-password">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="display: flex;">
                                                    <button type="submit" class="btn-primary me-2 mb-2 mb-md-0 text-white"
                                                        style="border:none;padding: 8px 18px;border-radius: 10px;">
                                                        Register
                                                    </button>

                                                    <a class="btn-primary text-white"
                                                        style="padding: 10px !important;height: 42px !important;border-radius: 10px;"
                                                        href="{{ route('admin.login') }}">
                                                        {{ __('Login') }}
                                                    </a>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
