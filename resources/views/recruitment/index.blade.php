@extends('recruitment.layout.master')
@section('title', 'Recruitment')
@section('main-content')

    <!-- start banner Area -->
    <section class="banner-area relative" id="home" style="height: 600px;">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row fullscreen d-flex align-items-center justify-content-center">
                <div class="banner-content col-lg-12">
                    <h1 class="text-light">
                        <span>{{ $activejobcount }}</span> Jobs posted last week
                    </h1>
                    <form action="search.html" class="serach-form-area">
                        <div class="row justify-content-center form-wrap requirement-search">
                            <div class="col-lg-4 form-cols">
                                <input type="text" class="form-control" name="search"
                                    placeholder="what are you looging for?">
                            </div>
                            <div class="col-lg-3 form-cols">
                                <div class="default-select" id="default-selects">
                                    <select>
                                        <option value="1">Select area</option>
                                        <option value="2">Dhaka</option>
                                        <option value="3">Rajshahi</option>
                                        <option value="4">Barishal</option>
                                        <option value="5">Noakhali</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 form-cols">
                                <div class="default-select" id="default-selects2">
                                    <select>
                                        <option value="1">All Category</option>
                                        <option value="2">Medical</option>
                                        <option value="3">Technology</option>
                                        <option value="4">Goverment</option>
                                        <option value="5">Development</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 form-cols">
                                <button type="button" class="btn btn-light">
                                    <span class="lnr lnr-magnifier"></span> Search
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="text-white">Search by tags: Tecnology, Business, Consulting, IT Company,
                        Design, Development</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start features Area -->
    {{-- <section class="features-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <h4>Searching</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <h4>Applying</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <h4>Security</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature">
                        <h4>Notifications</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End features Area -->

    <!-- Start post Area -->
    <section class="post-area section-gap">
        <div class="container">
            <div class="title text-center">
                <h2 class="mb-10">Current Job Opening</h2>
                <hr>
                <br>
            </div>
            <div class="row justify-content-center d-flex">
                <div class="col-lg-8 post-list">
                    {{-- Job Post here  --}}

                    @if ($applypage->count() > 0)
                        @foreach ($applypage as $post)
                            <div class="single-post d-flex flex-row p-3 border rounded mb-4 shadow-sm">
                                <!-- Right Section: Post Details -->
                                <div class="details ms-3">
                                    <div
                                        class="title d-flex flex-row justify-content-between align-items-center border-bottom pb-2 mb-2">
                                        <!-- Left Section: Titles -->
                                        <div class="titles">
                                            <form action="{{ route('recruitment.view') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-link p-0 text-dark fw-bold fs-5">
                                                    <b>{{ $post->postname }}</b>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Job Description -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="mb-2 text-muted"><b class="fw-bolder">Description:
                                                </b>{{ $post->description }}</p>
                                        </div>
                                    </div>
                                    <div class="details-list">
                                        <h6 class="mb-1"><strong>Job Type:</strong> {{ $post->type->posttype }}</h6>

                                        <p class="mb-1">
                                            <span class="lnr lnr-map me-2"></span>
                                            <strong>Location:</strong> {{ $post->location->postlocation }}
                                        </p>
                                        <p class="mb-0">
                                            <span class="lnr lnr-database me-2"></span>
                                            <strong>Salary Range:</strong> {{ $post->salaryrange }}
                                        </p>
                                    </div>
                                    <ul class="btns">
                                        <br>
                                        <li class="bg-danger ">
                                            <form action="{{ route('recruitment.view') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-link text-light p-0 fw-bold fs-5">
                                                Apply
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No post founds</p>
                    @endif

                    {{-- End Job post  --}}

                    {{-- <a class="text-uppercase loadmore-btn mx-auto d-block" href="category.html">Load More job
                        Posts</a> --}}

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

                    <div class="single-slidebar">
                        <h4>Top rated job posts</h4>
                        <div class="active-relatedjob-carusel">
                            <div class="single-rated">
                                <img class="img-fluid" src="{{ asset('assets/recruitment/img/r1.jpg') }}" alt="">
                                <a href="single.html">
                                    <h4>Creative Art Designer</h4>
                                </a>
                                <h6>Premium Labels Limited</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc
                                    ididunt ut dolore magna aliqua.
                                </p>
                                <h5>Job Nature: Full time</h5>
                                <p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka
                                </p>
                                <p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
                                <a href="#" class="btns text-uppercase">Apply job</a>
                            </div>
                            <div class="single-rated">
                                <img class="img-fluid" src="{{ asset('assets/recruitment/img/r1.jpg') }}" alt="">
                                <a href="single.html">
                                    <h4>Creative Art Designer</h4>
                                </a>
                                <h6>Premium Labels Limited</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc
                                    ididunt ut dolore magna aliqua.
                                </p>
                                <h5>Job Nature: Full time</h5>
                                <p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka
                                </p>
                                <p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
                                <a href="#" class="btns text-uppercase">Apply job</a>
                            </div>
                            <div class="single-rated">
                                <img class="img-fluid" src="{{ asset('assets/recruitment/img/r1.jpg') }}"
                                    alt="">
                                <a href="single.html">
                                    <h4>Creative Art Designer</h4>
                                </a>
                                <h6>Premium Labels Limited</h6>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporinc
                                    ididunt ut dolore magna aliqua.
                                </p>
                                <h5>Job Nature: Full time</h5>
                                <p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka
                                </p>
                                <p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p>
                                <a href="#" class="btns text-uppercase">Apply job</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End post Area -->


    <!-- Start callto-action Area -->
    {{-- <section class="callto-action-area section-gap" id="join">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content col-lg-9">
                    <div class="title text-center">
                        <h1 class="mb-10 text-white">Join us today without any hesitation</h1>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation.</p>
                        <a class="primary-btn crud-btn" href="#">I am a Candidate</a>
                        <a class="primary-btn crud-btn" href="#">Request Free Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End calto-action Area -->

    <!-- Start download Area -->
    {{-- <section class="download-area section-gap" id="app">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 download-left">
                    <img class="img-fluid" src="{{ asset('assets/recruitment/img/d1.png') }}" alt="">
                </div>
                <div class="col-lg-6 download-right">
                    <h1>Download the <br>
                        Job Listing App Today!</h1>
                    <p class="subs">
                        It won’t be a bigger problem to find one video game lover in your neighbor. Since the
                        introduction of Virtual Game, it has been achieving great heights so far as its popularity and
                        technological advancement are concerned.
                    </p>
                    <div class="d-flex flex-row">
                        <div class="buttons">
                            <i class="fa fa-apple" aria-hidden="true"></i>
                            <div class="desc">
                                <a href="#">
                                    <p>
                                        <span>Available</span> <br>
                                        on App Store
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="buttons">
                            <i class="fa fa-android" aria-hidden="true"></i>
                            <div class="desc">
                                <a href="#">
                                    <p>
                                        <span>Available</span> <br>
                                        on Play Store
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End download Area -->

    <!-- start footer Area -->
    {{-- <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-12">
                    <div class="single-footer-widget">
                        <h6>Top Products</h6>
                        <ul class="footer-nav">
                            <li><a href="#">Managed Website</a></li>
                            <li><a href="#">Manage Reputation</a></li>
                            <li><a href="#">Power Tools</a></li>
                            <li><a href="#">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6  col-md-12">
                    <div class="single-footer-widget newsletter">
                        <h6>Newsletter</h6>
                        <p>You can trust us. we only send promo offers, not a single spam.</p>
                        <div id="mc_embed_signup">
                            <form target="_blank" novalidate="true"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="form-inline">

                                <div class="form-group row" style="width: 100%">
                                    <div class="col-lg-8 col-md-12">
                                        <input name="EMAIL" placeholder="Enter Email"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                            required="" type="email">
                                        <div style="position: absolute; left: -5000px;">
                                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1"
                                                value="" type="text">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-12">
                                        <button class="nw-btn primary-btn">Subscribe<span
                                                class="lnr lnr-arrow-right"></span></button>
                                    </div>
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-12">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="{{ asset('assets/recruitment/img/i1.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i2.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i3.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i4.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i5.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i6.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i7.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/recruitment/img/i8.jpg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
                <div class="col-lg-4 col-sm-12 footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
        </div>
    </footer> --}}
    <!-- End footer Area -->

@endsection
