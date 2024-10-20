@extends('layouts.master')
@section('title') Codes Print @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Codes Print @endslot
    @endcomponent
    @include('components.common-error')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body border border-dashed border-end-0 border-start-0 d-print-none">

                    <form method="post" action="{{route('admin.codes.print')}}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-6">

                                    <label for="">From Date</label>
                                    <input type="date" class="form-control search" placeholder="Date From" name="from_date">

                            </div>

                            <div class="col-xxl-3 col-sm-6">

                                <label for="">To Date</label>
                                <input type="date" class="form-control search" placeholder="Date From" name="to_date">

                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-4">
                                <div>
                                    <label for="">Product</label>
                                    <select class="form-control"  name="product_id">
                                        <option value="">Choose One</option>
                                        @isset($data['products'])
                                            @foreach($data['products'] as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-sm-4">
                                <div>
                                    <label for="">Filter</label>
                                    <button type="submit" class="btn btn-primary w-100" id="filter"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                        {{__('translation.filter')}}
                                    </button>
                                </div>
                            </div>

                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <label for="">Print</label>
                         <button type="button" class="btn btn-primary w-100" id="btnPrint"> <i class="ri-printer-cloud-fill me-1 align-bottom"></i>Print</button>


                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="card-body pt-2">
                    <div class="row">
                        @isset($data['codes'])
                            <div class="col-12 d-flex flex-wrap">
                                @foreach($data['codes'] as $row)
                                    <div class="col-md-1 text-center bg-light rounded p-2 m-1">
                                        <span class="fw-bold">{{$row->p_codes}}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Trigger print preview on page load -->
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>

    <!-- Print-specific styles to avoid page breaks -->
    <style>
        @media print {
            .row {
                page-break-inside: avoid; /* Avoid breaking the row between pages */
            }
        }
    </style>
    <script>
        document.getElementById('btnPrint').addEventListener('click', function(event) {
            event.preventDefault();
            window.print();
        });
    </script>


@endsection





