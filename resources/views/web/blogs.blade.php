

@extends('layouts.web-master-layouts')
@section('title') Contact Us @endsection
@section('content')
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Blogs</span>
            <h2>Blogs</h2>
            <p>Explore our collection of articles, resources, and guides designed to help you stay ahead with valuable knowledge and fresh perspectives.</p>

        </div><!-- End Section Title -->

        <div class="container">
            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="{{ URL::asset('build/web/assets/img/gallery/app-1.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="{{ URL::asset('build/web/assets/img/gallery/app-1.jpg')}}" title="App 1"
                               data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="product-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="{{ URL::asset('build/web/assets/img/gallery/product-1.jpg')}}'" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="{{ URL::asset('build/web/assets/img/gallery/product-1.jpg')}}" title="Product 1"
                               data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="product-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="{{ URL::asset('build/web/assets/img/gallery/branding-1.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="{{ URL::asset('build/web/assets/img/gallery/branding-1.jpg')}}" title="Branding 1"
                               data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="product-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </section>

@endsection
