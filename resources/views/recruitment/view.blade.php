@extends('recruitment.layout.master')
@section('title', $viewcurrentjob->postname)
@section('main-content')



    <!-- start banner Area -->
    <section class="banner-area relative" id="home">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        {{ $viewcurrentjob->postname }}
                    </h1>
                    <p class="text-white link-nav"><a href="{{ route('recruitment.index') }}">Home </a> <span
                            class="lnr lnr-arrow-right"></span> <a href="javascript:void(0);">
                            {{ $viewcurrentjob->postname }}</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start post Area -->
    <section class="post-area section-gap">
        <div class="container">
            <div class="row justify-content-center d-flex">
                <div class="col-lg-8 post-list">
                    <div class="single-post d-flex flex-row">

                        <div class="details">
                            <div class="title d-flex flex-row justify-content-between">
                                <div class="titles">
                                    <a href="#">
                                        <h4>{{ $viewcurrentjob->postname }}</h4>
                                    </a>
                                </div>

                            </div>
                            <br>

                            <p class="mb-2">{{ $viewcurrentjob->description }}</p>

                            <p class="address fw-bold"><span class="lnr lnr-map"></span> <span class="fw-bold">Job Type:
                                </span>{{ $viewcurrentjob->type->posttype }}</p>
                            <p class="address fw-bold"><span class="lnr lnr-map"></span><span class="fw-bold">Job Location:
                                </span>
                                {{ $viewcurrentjob->location->postlocation }}
                            </p>
                            <p class="address fw-bold"><span class="lnr lnr-database"></span><span class="fw-bold">Salary
                                    Range: </span>
                                ₹{{ $viewcurrentjob->salaryrange }}</p>
                        </div>
                    </div>

                    {{-- Apply Page  --}}
                </div>
                <div class="col-lg-4 sidebar">
                    <div class="single-slidebar">
                        <h4>Jobs by Location</h4>
                        <ul class="cat-list">
                            @foreach ($applybylocation as $location)
                                <li><a class="justify-content-between d-flex" href="category.html">
                                        <p>{{ $location->postlocation }}</p><span>37</span>
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container mt-4">
                        <h2 class="mb-4 text-center text-danger">Apply for Job</h2>
                        <form action="{{ route('recruitment.apply') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jobpostid" value="{{ $viewcurrentjob->id }}">
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="fullName" name="full_name"
                                    placeholder="Enter your full name" required>
                            </div>

                            <!-- Email Address -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email" required>
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label for="experienceMonths" class="form-label">Date Of Birth *</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                            </div>

                            <!-- Mobile Number -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile Number *</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter your mobile number" required>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6">
                                    <label for="experienceMonths" class="form-label">Gender *</label>
                                    <select name="gender" id="gender" class="form-control" required
                                        style="cursor: pointer">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Experience (In Years) -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="experienceYears" class="form-label">Experience (In Years) *</label>
                                    <input type="number" class="form-control" id="experienceYears" name="experience_years"
                                        value="0" min="0" required>
                                </div>

                                <!-- Experience (In Months) -->
                                <div class="col-md-6">
                                    <label for="experienceMonths" class="form-label">Experience (In Months) *</label>
                                    <input type="number" class="form-control" id="experienceMonths"
                                        name="experience_months" value="0" min="0" max="11" required>
                                </div>
                            </div>

                            <!-- Current CTC -->
                            <div class="mb-3">
                                <label for="currentCTC" class="form-label">Current CTC (In Lakhs) *</label>
                                <input type="number" class="form-control" id="currentCTC" name="current_ctc"
                                    placeholder="Enter your current CTC" required>
                            </div>

                            <!-- Expected CTC -->
                            <div class="mb-3">
                                <label for="expectedCTC" class="form-label">Expected CTC (In Lakhs) *</label>
                                <input type="number" class="form-control" id="expectedCTC" name="expected_ctc"
                                    placeholder="Enter your expected CTC" required>
                            </div>

                            <!-- Notice Period -->
                            <div class="mb-3">
                                <label for="noticePeriod" class="form-label">Notice Period (In Months) *</label>
                                <input type="number" class="form-control" id="noticePeriod" name="notice_period"
                                    placeholder="Enter notice period in days" required>
                            </div>

                            <!-- Upload Your CV -->
                            <div class="mb-3">
                                <label for="cv" class="form-label">Upload Your CV (PDF Only) *</label>
                                <input type="file" class="form-control" id="cv" name="cv"
                                    accept="application/pdf" required>
                            </div>

                            <!-- Apply Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger">Apply</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- End post Area -->

@endsection
