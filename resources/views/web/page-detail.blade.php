

@extends('layouts.web-master-layouts')
@section('title') Detail @endsection
@section('content')
    <main class="main">
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Details</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{route('user.index')}}">Home</a></li>
                    <li class="current"> Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="portfolio-details" class="portfolio-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper init-swiper">

                        <script type="application/json" class="swiper-config">
                            {
                              "loop": true,
                              "speed": 600,
                              "autoplay": {
                                "delay": 5000
                              },
                              "slidesPerView": "auto",
                              "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                              }
                            }
                        </script>

                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="{{ URL::asset('build/web/assets/img/gallery/app-1.jpg')}}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ URL::asset('build/web/assets/img/gallery/product-1.jpg')}}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ URL::asset('build/web/assets/img/gallery/branding-1.jpg')}}" alt="">
                            </div>

                            <div class="swiper-slide">
                                <img src="{{ URL::asset('build/web/assets/img/gallery/books-1.jpg')}}" alt="">
                            </div>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
{{--                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">--}}
{{--                        <h3>Project information</h3>--}}
{{--                        <ul>--}}
{{--                            <li><strong>Category</strong>: Web design</li>--}}
{{--                            <li><strong>Client</strong>: ASU Company</li>--}}
{{--                            <li><strong>Project date</strong>: 01 March, 2020</li>--}}
{{--                            <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>{{$data['pageDetail']->title}}</h2>
                        <p>{!! $data['pageDetail']->description !!}</p>
                    </div>
                </div>

            </div>

        </div>

    </section>
    </main>
@endsection
