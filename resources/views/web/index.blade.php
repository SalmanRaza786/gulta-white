


@extends('layouts.web-master-layouts')
@section('title') Home @endsection
@section('content')


    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                     data-aos="fade-up">
                    <h2>Find your product code and verify here</h2>
                    <p>Find codes, create trackable codes and enrich your products. Carefully crafted after analyzing the needs of different industries.</p>
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
                        <div class="card shadow-sm border-0">
                            <div class="card-header  text-white">
                                <h5 class="mb-0">Product Verification</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle text-center">
                                        <thead class="table-success">
                                        <tr>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Code</th>
                                            <th>Verify Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ session('client')->name }}</td>
                                            <td>
                                                <img src="{{ asset('storage/uploads/' . session('client')->pCode->product->image) }}"
                                                     class="img-thumbnail rounded shadow-sm"
                                                     style="width: 80px; height: auto;"
                                                     alt="Product">
                                            </td>
                                            <td>
                            <span class="badge bg-success fs-6">  {{ session('client')->p_code }}</span></td>

                                            <td>{{ date('d M,Y,H:i:s', strtotime(session('client')->created_at)) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex">

                        <form action="{{ route('code.verify') }}" class="job-panel-filter" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4 col-12">
                                    <div>
                                        <input type="search" id="job-title" class="form-control" placeholder="Your Name" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div>
                                        <input type="search" id="job-title" class="form-control" placeholder="Your Contact Number" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div>
                                        <input type="search" id="job-title" class="form-control" placeholder="Your Product Code" name="p_code" required>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button class="btn btn-success w-100 mt-2" type="submit"><i class="ri-search-2-line align-bottom me-1"></i> Verify</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    @if($data['totalAttempts'] >= 3)
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-bold">Captcha Verification</label>
                            <div class="input-group">
                                <span id="captchaQuestion" class="input-group-text bg-dark text-white fw-bold"></span>
                                <input type="number" id="captchaInput" class="form-control" placeholder="Enter Answer">
                            </div>
                            <div id="captchaMessage" class="text-danger small mt-1" style="display:none;"></div>
                        </div>
                        <div class="mt-3" id="contactUsSection" style="display:none;">
                            <a href="{{ route('user.contact.us') }}" class="btn btn-primary w-100">Contact Us</a>
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    @isset($data['homeImage'])
                    <img src="{{ URL::asset('storage/uploads/'.'/'.$data['homeImage'])}}" class="img-fluid animated" alt="">
                    @else
                        <img src="{{ URL::asset('build/web/assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
                    @endisset
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title position-relative" data-aos="fade-up">
            <span>Testimonials</span>
            <h2>Testimonials</h2>
            <p>Our clients’ feedback inspires us every day. Here are some of their stories.</p>
            <!-- Right Side Button -->

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
                        <h3>Share Your Experience</h3>
                        <p>Your feedback helps us grow and improve. We’d love to hear your thoughts about our products and services</p>
                        <a class="cta-btn" href="#"  data-bs-target="#contactModal" data-bs-toggle="modal">Add Your Review</a>


                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let captchaQuestion = document.getElementById("captchaQuestion");
        let captchaInput = document.getElementById("captchaInput");
        let captchaMessage = document.getElementById("captchaMessage");
        let contactUsSection = document.getElementById("contactUsSection");

        let correctAnswer = null;

        // Generate random captcha (like 2+2, 5+5, 3+3)
        function generateCaptcha() {
            let num1 = Math.floor(Math.random() * 9) + 1; // 1–9
            let num2 = Math.floor(Math.random() * 9) + 1; // 1–9
            correctAnswer = num1 + num2;
            captchaQuestion.innerText = `${num1} + ${num2} = ?`;
        }

        if (captchaQuestion) {
            generateCaptcha(); // show first captcha

            captchaInput.addEventListener("keyup", function () {
                let val = captchaInput.value.trim();
                if (val !== "") {
                    if (parseInt(val) === correctAnswer) {
                        captchaMessage.style.display = "none";
                        contactUsSection.style.display = "block";
                    } else {
                        contactUsSection.style.display = "none";
                        captchaMessage.innerText = "❌ Wrong answer, try again.";
                        captchaMessage.style.display = "block";
                    }
                } else {
                    contactUsSection.style.display = "none";
                    captchaMessage.style.display = "none";
                }
            });
        }
    });
</script>
