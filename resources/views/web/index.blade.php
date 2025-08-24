

@extends('layouts.master-without-nav')
@section('title') Home @endsection
@section('content')

    <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
        <div class="container-fluid custom-container">

            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('user.index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.gallery')}}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.blogs')}}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.about.us')}}">Abouts Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.contact.us')}}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.faq')}}">FAQs</a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>



    <section class="section job-hero-section bg-light pb-0" id="hero">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div>
                        <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">Find your product code and verify here</h1>
                        <p class="lead text-muted lh-base mb-4">Find codes, create trackable codes and enrich your products. Carefully crafted after analyzing the needs of different industries.</p>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('client'))
                            <table class="table table-warning">
                                <tr>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Code</th>
                                    <th>Verify Date</th>
                                </tr>
                                <tr>
                                    <td>{{ session('client')->name }}</td>
                                    <td><img src="{{ asset('storage/uploads/' . session('client')->pCode->product->image) }}" class="img-thumbnail avatar-lg" alt=""></td>
                                    <td>{{ session('client')->p_code }}</td>
                                    <td>{{ date('d M,Y,H:i:s', strtotime(session('client')->created_at)) }}</td>
                                </tr>
                            </table>
                        @endif


{{--                        <form action="#" class="job-panel-filter">--}}
{{--                            <div class="row g-md-0 g-2">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div>--}}
{{--                                        <input type="search" id="job-title" class="form-control filter-input-box" placeholder="Job, Company name...">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!--end col-->--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div>--}}
{{--                                        <select class="form-control" data-choices>--}}
{{--                                            <option value="">Select job type</option>--}}
{{--                                            <option value="Full Time">Full Time</option>--}}
{{--                                            <option value="Part Time">Part Time</option>--}}
{{--                                            <option value="Freelance">Freelance</option>--}}
{{--                                            <option value="Intership">Intership</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!--end col-->--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <div class="h-100">--}}
{{--                                        <button class="btn btn-primary submit-btn w-100 h-100" type="submit"><i class="ri-search-2-line align-bottom me-1"></i> Find Job</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!--end col-->--}}
{{--                            </div>--}}
{{--                            <!--end row-->--}}
{{--                        </form>--}}


                        <form action="{{ route('code.verify') }}" class="job-panel-filter" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4 col-12">
                                    <div>
                                        <input type="search" id="job-title" class="form-control" placeholder="Your Name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div>
                                        <input type="search" id="job-title" class="form-control" placeholder="Your Contact Number" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div>
                                        <input type="search" id="job-title" class="form-control" placeholder="Your Product Code" name="p_code">
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 mt-2" type="submit"><i class="ri-search-2-line align-bottom me-1"></i> Verify</button>
                                </div>
                            </div>
                        </form>

{{--                        <ul class="treding-keywords list-inline mb-0 mt-3 fs-13">--}}
{{--                            <li class="list-inline-item text-danger fw-semibold"><i class="mdi mdi-tag-multiple-outline align-middle"></i> Trending Keywords:</li>--}}
{{--                            <li class="list-inline-item"><a href="javascript:void(0)">Design,</a></li>--}}
{{--                            <li class="list-inline-item"><a href="javascript:void(0)">Development,</a></li>--}}
{{--                            <li class="list-inline-item"><a href="javascript:void(0)">Manager,</a></li>--}}
{{--                            <li class="list-inline-item"><a href="javascript:void(0)">Senior</a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                    <div class="position-relative home-img text-center mt-5 mt-lg-0">
                        <div class="card p-3 rounded shadow-lg inquiry-box">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <div class="avatar-title bg-soft-warning text-warning rounded fs-18">
                                        <i class="ri-mail-send-line"></i>
                                    </div>
                                </div>
                                <h5 class="fs-15 lh-base mb-0">Product Inquiry from here</h5>
                            </div>
                        </div>

                        <div class="card p-3 rounded shadow-lg application-box">
{{--                            <h5 class="fs-15 lh-base mb-3">Applications</h5>--}}
{{--                            <div class="avatar-group">--}}
{{--                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">--}}
{{--                                    <div class="avatar-xs">--}}
{{--                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg')}}" alt="" class="rounded-circle img-fluid">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">--}}
{{--                                    <div class="avatar-xs">--}}
{{--                                        <div class="avatar-title rounded-circle bg-danger">--}}
{{--                                            S--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">--}}
{{--                                    <div class="avatar-xs">--}}
{{--                                        <img src="{{ URL::asset('build/images/users/avatar-10.jpg')}}" alt="" class="rounded-circle img-fluid">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top">--}}
{{--                                    <div class="avatar-xs">--}}
{{--                                        <div class="avatar-title rounded-circle bg-success">--}}
{{--                                            Z--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">--}}
{{--                                    <div class="avatar-xs">--}}
{{--                                        <img src="{{ URL::asset('build/images/users/avatar-9.jpg')}}" alt="" class="rounded-circle img-fluid">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="More Appliances">--}}
{{--                                    <div class="avatar-xs">--}}
{{--                                        <div class="avatar-title fs-13 rounded-circle bg-light border-dashed border text-primary">--}}
{{--                                            2k+--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>
                        <img src="{{ URL::asset('build/images/job-profile2.png')}}" alt="" class="user-img">

                        <div class="circle-effect">
                            <div class="circle"></div>
                            <div class="circle2"></div>
                            <div class="circle3"></div>
                            <div class="circle4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>


    <section class="section" id="blog">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">Our Latest <span class="text-primary">News</span></h1>
                        <p class="text-muted mb-4">We thrive when coming up with innovative ideas but also understand that a smart concept should be supported with faucibus sapien odio measurable results.</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ URL::asset('build/images/small/img-8.jpg')}}" alt="" class="img-fluid rounded" />
                        </div>
                        <div class="card-body">
                            <ul class="list-inline fs-14 text-muted">
                                <li class="list-inline-item">
                                    <i class="ri-calendar-line align-bottom me-1"></i> 30 Oct, 2021
                                </li>
                                <li class="list-inline-item">
                                    <i class="ri-message-2-line align-bottom me-1"></i> 364 Comment
                                </li>
                            </ul>
                            <a href="javascript:void(0);">
                                <h5>Design your apps in your own way ?</h5>
                            </a>
                            <p class="text-muted fs-14">One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others.</p>

                            <div>
                                <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ URL::asset('build/images/small/img-6.jpg')}}" alt="" class="img-fluid rounded" />
                        </div>
                        <div class="card-body">
                            <ul class="list-inline fs-14 text-muted">
                                <li class="list-inline-item">
                                    <i class="ri-calendar-line align-bottom me-1"></i> 02 Oct, 2021
                                </li>
                                <li class="list-inline-item">
                                    <i class="ri-message-2-line align-bottom me-1"></i> 245 Comment
                                </li>
                            </ul>
                            <a href="javascript:void(0);">
                                <h5>Smartest Applications for Business ?</h5>
                            </a>
                            <p class="text-muted fs-14">Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception.</p>

                            <div>
                                <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ URL::asset('build/images/small/img-9.jpg')}}" alt="" class="img-fluid rounded" />
                        </div>
                        <div class="card-body">
                            <ul class="list-inline fs-14 text-muted">
                                <li class="list-inline-item">
                                    <i class="ri-calendar-line align-bottom me-1"></i> 23 Sept, 2021
                                </li>
                                <li class="list-inline-item">
                                    <i class="ri-message-2-line align-bottom me-1"></i> 354 Comment
                                </li>
                            </ul>
                            <a href="javascript:void(0);">
                                <h5>How apps is changing the IT world</h5>
                            </a>
                            <p class="text-muted fs-14">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate one-to-one technology.</p>

                            <div>
                                <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end container -->
    </section>



    <footer class="custom-footer bg-dark py-5 position-relative">
        <div class="container">


            <div class="row text-center text-sm-start align-items-center mt-5">
                <div class="col-sm-6">
                    <div>
                        <p class="copy-rights mb-0">
                            <script> document.write(new Date().getFullYear()) </script> © Velzon - Themesbrand
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-list gap-4 fs-13">
                            <li class="list-inline-item">
                                <a href="pages-privacy-policy.html">Privacy Policy</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="pages-term-conditions.html">Terms & Conditions</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="pages-privacy-policy.html">Security</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

@endsection

