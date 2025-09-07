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
                    @isset($data['faqs'])
                        @foreach($data['faqs'] as $row)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q{{ $loop->index }}">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#a{{ $loop->index }}"
                                            aria-expanded="false"
                                            aria-controls="a{{ $loop->index }}">
                                        {{ $row->questions }}
                                    </button>
                                </h2>
                                <div id="a{{ $loop->index }}"
                                     class="accordion-collapse collapse"
                                     aria-labelledby="q{{ $loop->index }}"
                                     data-bs-parent="#faqShipping">
                                    <div class="accordion-body">
                                        {{ $row->ans }}
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
