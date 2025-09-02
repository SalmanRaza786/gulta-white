

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

                            {{-- Swiper Config --}}
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
                          },
                          "navigation": {
                            "nextEl": ".swiper-button-next",
                            "prevEl": ".swiper-button-prev"
                          }
                        }
                    </script>

                            {{-- Slides --}}
                            <div class="swiper-wrapper align-items-center">
                                @isset($data['pageDetail']->pageMedia)
                                    @foreach($data['pageDetail']->pageMedia as $media)
                                        <div class="swiper-slide">
                                            <img src="{{ URL::asset('storage/uploads/' .$media->file_path)}}" alt="">
                                        </div>
                                    @endforeach
                                @endisset
                            </div>

                            {{-- Pagination --}}
                            <div class="swiper-pagination"></div>

                            {{-- Navigation Arrows --}}
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                            <h2>{{ $data['pageDetail']->title }}</h2>
                            <p>{!! $data['pageDetail']->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
