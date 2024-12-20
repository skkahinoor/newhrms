@extends('auth.main')

@section('title', 'Login')

@section('auth-content')
    <section class="content">
        <div class="main-wrapper">
            <div class="page-wrapper full-page">
                <div class="page-content d-flex align-items-center justify-content-center">
                    <div class="row w-100 mx-0 auth-page">
                        <div class="col-md-8 col-xl-6 mx-auto">
                            <div class="card">
                                {{-- @include('admin.section.flash_message') --}}
                                <div class="row align-items-center">
                                    <div class="col-md-4 pe-md-0">
                                        <div class="auth-side-wrapper p-4">
                                            <img src="
                                            {{ $companyDetail && $companyDetail->logo
                                                ? asset(\App\Models\Company::UPLOAD_PATH . $companyDetail->logo)
                                                : asset('assets/images/img.png') }}"
                                                style="object-fit: cover" width="100%" height="100%" alt="">
                                        </div>
                                    </div>

                                    <div class="col-md-8 ps-md-0">

                                        <div class="auth-form-wrapper px-4 py-5">
                                            <a href="#"
                                                class="noble-ui-logo d-block mb-2">{{ $companyDetail ? ucfirst($companyDetail->name) : '' }}</a>
                                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>

                                            <form class="forms-sample" method="POST"
                                                action="{{ route('admin.login.process') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="userEmail" class="form-label">Email address/Username</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" autofocus>
                                                    @if ($errors->has('username'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('username') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="userPassword" class="form-label">Password</label>
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password">
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                {{-- <div class="form-check mb-3"> --}}
                                                {{-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> --}}
                                                {{-- <label class="form-check-label" for="remember"> --}}
                                                {{-- Remember me --}}
                                                {{-- </label> --}}
                                                {{-- </div> --}}

                                                <div style="display: flex;">
                                                    <button type="submit"
                                                        class=" btn btn-primary me-2 mb-2 mb-md-0 text-white">
                                                        Login
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                    <a style="margin-top: 3%;" href="{{ route('vendor.register') }}">
                                                        {{ __('Vendor Register') }}
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
