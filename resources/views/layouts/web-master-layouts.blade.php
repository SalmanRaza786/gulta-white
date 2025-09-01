

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



    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">Creamista</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
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
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
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
