@extends('layouts.master-without-nav')
@section('title') Gluta White @endsection
@section('content')
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
        <div class="container-fluid custom-container">
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="17">
                <img src="assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17">
            </a>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link active" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#findJob">Find Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#candidates">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Blog</a>
                    </li>
                </ul>

                <div class="">
                    <a href="auth-signin-basic.html" class="btn btn-soft-primary"><i class="ri-user-3-line align-bottom me-1"></i> Login & Register</a>
                </div>
            </div>

        </div>
    </nav>
    <section class="section job-hero-section bg-light pb-0" id="hero">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <!-- Main Content Column -->
                <div class="col-lg-8 col-md-12">
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
                    </div>
                </div>
                <!-- Image/Info Column -->
                <div class="col-lg-4 col-md-12">
                    <div class="text-center mt-4 mt-lg-0">
                        <div class="card p-3 rounded shadow-lg mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0 me-3">
                                    <div class="avatar-title bg-soft-warning text-warning rounded fs-18">
                                        <i class="ri-mail-send-line"></i>
                                    </div>
                                </div>
                                <h5 class="fs-15 lh-base mb-0">Product Inquiry from here</h5>
                            </div>
                        </div>
                        <img src="{{ URL::asset('build/images/job-profile2.png') }}" alt="" class="img-fluid">
                        <!-- Circular Effect -->
                        <div class="circle-effect position-relative mt-4">
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

@endsection
