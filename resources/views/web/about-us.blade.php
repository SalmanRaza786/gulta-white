
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

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('storage/uploads/'.$data['aboutUs'][0]->pageMedia[0]->file_path) }}" class="img-fluid" alt="">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>{{$data['aboutUs'][0]->title}}</h3>
                    <p class="fst-italic">{!! $data['aboutUs'][0]->description !!}</p>
                </div>
            </div>

        </div>

    </section>

@endsection
