


@extends('layouts.web-master-layouts')
@section('title') Contact Us @endsection
@section('content')
    <style>
        /* Make intl-tel-input match Bootstrap input */
        .iti {
            width: 100%; /* full width */
        }
        .iti input {
            width: 100% !important;
            height: calc(2.25rem + 2px); /* match bootstrap form-control height */
            padding: 0.375rem 0.75rem 0.375rem 3rem; /* leave space for flag */
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
            font-size: 1rem;
            line-height: 1.5;
        }
        /* Adjust flag dropdown alignment */
        .iti__flag-container {
            left: 10px;
        }
    </style>

 <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Get In Touch</span>
                <h2>Contact US</h2>
                <p class="text-muted fs-5">
                    We’d love to hear from you!
                    Feel free to reach out to us with any questions, feedback, or product verification support.
                    Our team is here to help you.
                </p>
            </div><!-- End Section Title -->




     <div class="container" data-aos="fade-up" data-aos-delay="100">
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

                <div class="row gy-4">
                    <div class="col-lg-2"></div>
{{--                    <div class="col-lg-5">--}}

{{--                        <div class="info-wrap">--}}
{{--                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">--}}
{{--                                <i class="bi bi-geo-alt flex-shrink-0"></i>--}}
{{--                                <div>--}}
{{--                                    <h3>Address</h3>--}}
{{--                                    <p>A108 Adam Street, New York, NY 535022</p>--}}
{{--                                </div>--}}
{{--                            </div><!-- End Info Item -->--}}

{{--                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">--}}
{{--                                <i class="bi bi-telephone flex-shrink-0"></i>--}}
{{--                                <div>--}}
{{--                                    <h3>Call Us</h3>--}}
{{--                                    <p>+1 5589 55488 55</p>--}}
{{--                                </div>--}}
{{--                            </div><!-- End Info Item -->--}}

{{--                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">--}}
{{--                                <i class="bi bi-envelope flex-shrink-0"></i>--}}
{{--                                <div>--}}
{{--                                    <h3>Email Us</h3>--}}
{{--                                    <p>info@example.com</p>--}}
{{--                                </div>--}}
{{--                            </div><!-- End Info Item -->--}}

{{--                            <iframe--}}
{{--                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"--}}
{{--                                frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen=""--}}
{{--                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-lg-8">
                        <form action="{{route('user.store.contact.us')}}" method="post" class="php-email-form" data-aos="fade-up"
                              data-aos-delay="200">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <label for="name-field" class="pb-2">Your Name</label>
                                    <input type="text" name="name" id="name-field" class="form-control" required="" placeholder="Name">
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email-field" required="" placeholder="Email">
                                </div>

                                <div class="col-md-12">
                                    <label for="phone" class="pb-2">Contact</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Contact" required>
                                </div>

{{--                                <div class="col-md-12">--}}
{{--                                    <label for="subject-field" class="pb-2">Pharma Name</label>--}}
{{--                                    <input type="text" class="form-control" name="subject" id="subject-field"--}}
{{--                                           required="" placeholder="Pharma Name">--}}
{{--                                </div>--}}

{{--                                <div class="col-md-12">--}}
{{--                                    <label for="message-field" class="pb-2">Message</label>--}}
{{--                                    <textarea name="message" id="message-field" cols="10" rows="3" class="form-control" placeholder="Message"></textarea>--}}
{{--                                </div>--}}

                                <div class="col-md-12">
                                    <label for="message-field" class="pb-2">Message</label>
                                    <textarea name="message" id="message-field" cols="10" rows="3"
                                              class="form-control" placeholder="Message"></textarea>
                                    <small id="message-error" class="text-danger d-none">Message cannot exceed 250 characters.</small>
                                    <small id="char-count" class="text-muted">0 / 250</small>
                                </div>


                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->
                    <div class="col-lg-2"></div>
                </div>

            </div>

        </section>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const messageField = document.getElementById("message-field");
    const errorMsg = document.getElementById("message-error");
    const charCount = document.getElementById("char-count");
    const maxChars = 250;

    function validateMessage() {
        let text = messageField.value;

        charCount.textContent = `${text.length} / ${maxChars}`;

        if (text.length > maxChars) {
            errorMsg.classList.remove("d-none");
            // keep the text as is (don't trim)
        } else {
            errorMsg.classList.add("d-none");
        }
    }

    // Validate on input & paste
    messageField.addEventListener("input", validateMessage);
    messageField.addEventListener("paste", () => {
        setTimeout(validateMessage, 10); // run after paste completes
    });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector("#phone");

        var iti = window.intlTelInput(input, {
            initialCountry: "pk",   // set Pakistan as default
            separateDialCode: true, // show country code separately
            nationalMode: false,    // force full international format
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
        });

        // Optional: validate before submit
        document.querySelector("form").addEventListener("submit", function (e) {
            if (!iti.isValidNumber()) {
                e.preventDefault();
                alert("Please enter a valid mobile number");
            } else {
                // Replace input value with full international format (+92333463416)
                input.value = iti.getNumber();
            }
        });
    });
</script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        initialCountry: "pk", // set default country
        separateDialCode: true,
    });
</script>



