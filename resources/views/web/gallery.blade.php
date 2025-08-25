

@extends('layouts.master-without-nav')
@section('title') Home @endsection
@section('content')

  @include('layouts.navbar')
  <section class="section" id="blog">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-8">
                  <div class="text-center mb-5">
                      <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">Latest <span class="text-primary">Gallery</span></h1>
                      <p class="text-muted mb-4">We thrive when coming up with innovative ideas but also understand that a smart concept should be supported with faucibus sapien odio measurable results.</p>
                  </div>
              </div>
          </div>
          <!-- end row -->

          <div class="row">
              <div class="col-lg-4 col-md-6">
                  <div class="gallery-box card">
                      <div class="gallery-container">
                          <a class="image-popup" href="{{ URL::asset('build/images/small/img-1.jpg')}}" title="">
                              <img class="gallery-img img-fluid mx-auto" src="{{ URL::asset('build/images/small/img-1.jpg')}}" alt="" />
                              <div class="gallery-overlay">
                                  <h5 class="overlay-caption">Glasses and laptop from above</h5>
                              </div>
                          </a>
                      </div>

                      <div class="box-content">
                          <div class="d-flex align-items-center mt-1">
                              <div class="flex-grow-1 text-muted">by <a href="" class="text-body text-truncate">Ron Mackie</a></div>
                              <div class="flex-shrink-0">
                                  <div class="d-flex gap-3">
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-thumb-up-fill text-muted align-bottom me-1"></i> 2.2K
                                      </button>
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-question-answer-fill text-muted align-bottom me-1"></i> 1.3K
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="gallery-box card">
                      <div class="gallery-container">
                          <a class="image-popup" href="{{ URL::asset('build/images/small/img-1.jpg')}}" title="">
                              <img class="gallery-img img-fluid mx-auto" src="{{ URL::asset('build/images/small/img-1.jpg')}}" alt="" />
                              <div class="gallery-overlay">
                                  <h5 class="overlay-caption">Glasses and laptop from above</h5>
                              </div>
                          </a>
                      </div>

                      <div class="box-content">
                          <div class="d-flex align-items-center mt-1">
                              <div class="flex-grow-1 text-muted">by <a href="" class="text-body text-truncate">Ron Mackie</a></div>
                              <div class="flex-shrink-0">
                                  <div class="d-flex gap-3">
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-thumb-up-fill text-muted align-bottom me-1"></i> 2.2K
                                      </button>
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-question-answer-fill text-muted align-bottom me-1"></i> 1.3K
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="gallery-box card">
                      <div class="gallery-container">
                          <a class="image-popup" href="{{ URL::asset('build/images/small/img-1.jpg')}}" title="">
                              <img class="gallery-img img-fluid mx-auto" src="{{ URL::asset('build/images/small/img-1.jpg')}}" alt="" />
                              <div class="gallery-overlay">
                                  <h5 class="overlay-caption">Glasses and laptop from above</h5>
                              </div>
                          </a>
                      </div>

                      <div class="box-content">
                          <div class="d-flex align-items-center mt-1">
                              <div class="flex-grow-1 text-muted">by <a href="" class="text-body text-truncate">Ron Mackie</a></div>
                              <div class="flex-shrink-0">
                                  <div class="d-flex gap-3">
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-thumb-up-fill text-muted align-bottom me-1"></i> 2.2K
                                      </button>
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-question-answer-fill text-muted align-bottom me-1"></i> 1.3K
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6">
                  <div class="gallery-box card">
                      <div class="gallery-container">
                          <a class="image-popup" href="{{ URL::asset('build/images/small/img-1.jpg')}}" title="">
                              <img class="gallery-img img-fluid mx-auto" src="{{ URL::asset('build/images/small/img-1.jpg')}}" alt="" />
                              <div class="gallery-overlay">
                                  <h5 class="overlay-caption">Glasses and laptop from above</h5>
                              </div>
                          </a>
                      </div>

                      <div class="box-content">
                          <div class="d-flex align-items-center mt-1">
                              <div class="flex-grow-1 text-muted">by <a href="" class="text-body text-truncate">Ron Mackie</a></div>
                              <div class="flex-shrink-0">
                                  <div class="d-flex gap-3">
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-thumb-up-fill text-muted align-bottom me-1"></i> 2.2K
                                      </button>
                                      <button type="button" class="btn btn-sm fs-12 btn-link text-body text-decoration-none px-0">
                                          <i class="ri-question-answer-fill text-muted align-bottom me-1"></i> 1.3K
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>


          </div>
      </div>
      <!-- end container -->
  </section>
@endsection

