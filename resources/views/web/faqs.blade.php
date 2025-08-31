@extends('layouts.web-master-layouts')
@section('title') About Us @endsection
@section('content')
<main class="main">


    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Frequently Asked Questions</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{route('user.index')}}">Home</a></li>
                    <li class="current">FAQs</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="mb-4" data-aos="fade-up">
                <div class="accordion" id="faqShipping">
                    @isset($data['faqs'])
                        @foreach($data['faqs'] as $row)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="q1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a1" aria-expanded="true" aria-controls="a1">
                                {{$row->questions}}
                            </button>
                        </h2>
                        <div id="a1" class="accordion-collapse collapse show" aria-labelledby="q1"
                             data-bs-parent="#faqShipping">
                            <div class="accordion-body">
                                {{$row->ans}}
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
