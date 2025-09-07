
@extends('layouts.web-master-layouts')
@section('title') About Us @endsection
@section('content')

 <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>About Us<br></span>
            <h2>About Us</h2>
            <p>We are dedicated to delivering quality and innovation, building trust through our work, and creating lasting value for our clients and community.</p>

        </div><!-- End Section Title -->
     @if (session('error'))
         <div class="alert alert-danger">
             <h2>{{ session('error') }}</h2>
         </div>
     @endif

     @if (session('success'))
         <div class="alert alert-success">
             <h2>{{ session('success') }}</h2>
         </div>
     @endif
     @if($data['aboutUs']->count() > 0)
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
                           },
                           "navigation": {
                             "nextEl": ".swiper-button-next",
                             "prevEl": ".swiper-button-prev"
                           }
                         }
                     </script>

                     <div class="swiper-wrapper align-items-center">

@isset($data['aboutUs'][0]->pageMedia)
    @foreach($data['aboutUs'][0]->pageMedia as $media)

                         <div class="swiper-slide">
                             <img src="{{ URL::asset('storage/uploads/' .$media->file_path)}}" alt="">
                         </div>
                             @endforeach
                                 @endisset


                     </div>
                     <div class="swiper-pagination"></div>
                     <div class="swiper-button-prev"></div>
                     <div class="swiper-button-next"></div>
                 </div>
             </div>

             <div class="col-lg-4">

                 <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                     <h2>{{$data['aboutUs'][0]->title}}</h2>
                     <p>{!! $data['aboutUs'][0]->description !!}</p>
                 </div>
             </div>

         </div>

     </div>
     @endif

    </section>



@endsection
