


@extends('layouts.web-master-layouts')
@section('title') Home @endsection
@section('content')


    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                     data-aos="fade-up">
                    <h1>Elegant and creative solutions</h1>
                    <p>We are team of talented designers making websites with Bootstrap</p>
                    <div class="d-flex">
                        <a href="About.html" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                           class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch
                                    Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ URL::asset('build/web/assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title position-relative" data-aos="fade-up">
            <span>Testimonials</span>
            <h2>Testimonials</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>

            <!-- Right Side Button -->
            <button type="button" class="btn btn-success position-absolute top-0 end-0 z-3" data-bs-toggle="modal"
                    data-bs-target="#contactModal">
                Contact Us
            </button>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                 data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
                <script type="application/json" class="swiper-config">
                    {
                      "loop": true,
                      "speed": 600,
                      "autoplay": { "delay": 5000 },
                      "slidesPerView": "auto",
                      "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                      },
                      "breakpoints": {
                        "320": { "slidesPerView": 1, "spaceBetween": 40 },
                        "1200": { "slidesPerView": 3, "spaceBetween": 20 }
                      }
                    }
                </script>

                <div class="swiper-wrapper">

                    @isset($data['testimonials'])
                        @foreach($data['testimonials'] as $row)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>{{$row->review_message}}</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="{{ URL::asset('build/web/assets/img/testimonials/dummy.png')}}" class="testimonial-img" alt="">
                            <h3>{{$row->name}}</h3>
{{--                            <h4>Ceo &amp; Founder</h4>--}}
                        </div>
                    </div>
                        @endforeach
                    @endisset



                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title text-white" id="contactModalLabel">Contact Form</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone">
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3"
                                      placeholder="Write your message"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Send Message</button>
                </div>

            </div>
        </div>
    </div>
    <section id="call-to-action" class="call-to-action section accent-background">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Call To Action</h3>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                            nulla pariatur.
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                            mollit anim id est
                            laborum.</p>
                        <a class="cta-btn" href="#">Call To Action</a>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection
