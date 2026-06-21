

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>@yield('title'){{env('APP_NAME')}} </title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Favicons -->
        <link href="{{ URL::asset('build/web/assets/img/logo.jpg')}}" rel="icon">
        <link href="{{ URL::asset('build/web/assets/img/logo.jpg')}}" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ URL::asset('build/web/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('build/web/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('build/web/assets/vendor/aos/aos.css" rel="stylesheet')}}">
        <link href="{{ URL::asset('build/web/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('build/web/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
        <link href="{{ URL::asset('build/web/assets/css/main.css')}}" rel="stylesheet">

    </head>

    <body class="index-page">

@include('layouts.navbar')
<main class="main">
@yield('body')
@yield('content')
    @yield('scripts')

    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title text-white" id="contactModalLabel">Add Your Review</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form method="post" action="{{route('user.review.store')}}" id="ReviewForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="review_image" class="form-label">Profile Picture <small class="text-muted">(Optional)</small></label>
                            <input type="file" class="form-control" id="review_image" name="image" accept="image/*">
                        </div>



                        <div class="mb-3">
                            <label for="message" class="form-label">Review Message</label>
                            <textarea name="review_message" id="message-field" cols="10" rows="3"
                                      class="form-control" placeholder="Write your message" required></textarea>
                            <small id="message-error" class="text-danger d-none">Message cannot exceed 250 characters.</small>
                            <small id="char-count" class="text-muted">0 / 250</small>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-send-review">Send Message</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">{{env('APP_NAME')}}</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Manufactured By:</p>
                        <p>Zonex Pharma (Pvt) Ltd.</p>
                        <p>121-Sundar Industrial Estate.</p>

                        <p>Raiwind Road Lahore</p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{route('user.index')}}">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{route('user.about.us')}}">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#{{route('user.gallery')}}">Gallery</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{route('user.blogs')}}">Blogs</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
{{--                    <h4>Our Services</h4>--}}
{{--                    <ul>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>--}}
{{--                    </ul>--}}
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Stay connected with us for the latest updates, insights, and news. Join our community on social media.</p>
                    <div class="social-links d-flex">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>


            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Gluta White</strong> <span>All Rights Reserved</span>
            </p>
{{--            <div class="credits">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by--}}
{{--                 <a href=“https://themewagon.com>ThemeWagon</a>--}}
{{--            </div>--}}
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ URL::asset('build/web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{ URL::asset('build/web/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ URL::asset('build/web/assets/js/main.js')}}"></script>

    </body>

</html>
