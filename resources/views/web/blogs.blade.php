
@extends('layouts.web-master-layouts')
@section('title') Blogs @endsection
@section('content')

    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Blogs</span>
            <h2>Blogs</h2>
            <p>Browse through our collection of articles and insights showcasing our ideas, stories, and experiences.</p>

        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">


                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                    @isset($data['blogs'])
                        @foreach($data['blogs'] as $row)

                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <img src="{{ URL::asset('storage/uploads/' .$row->pageMedia[0]->file_path) }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{$row->title}}</h4>
                                    @isset($row->pageMedia)
                                        @foreach($row->pageMedia as $media)
                                            <a href="{{ URL::asset('storage/uploads/' .$media->file_path)}}" title="App 1"
                                               data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                                    class="bi bi-zoom-in"></i></a>
                                        @endforeach
                                    @endisset

                                    <a href="{{route('user.page.detail',['id'=>encrypt($row->id)])}}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>

                                </div>
                            </div>
                        @endforeach
                    @endisset



                </div>

            </div>

        </div>

    </section>
@endsection
