@extends('layouts.master')
@section('title') Attempt Codes @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Attempt Codes @endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Attempt Codes  List</h4>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">

                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-5">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Search by name,phone and code" name="s_name" id="s_name">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-4">
                                <div>
                                    <select class="form-control"  name="s_status" id="s_status">
                                        <option value="">Choose One</option>
                                        <option value="" selected>All</option>
                                        <option value="1">Valid</option>
                                        <option value="2">Invalid</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>


                <div class="card-body pt-0">
                    <table class="table table-nowrap align-middle" id="roleTable">
                        <thead class="text-muted table-light">

                        <tr class="text-uppercase">
                            <th class="sort" data-sort="id">Name</th>
                            <th class="sort" data-sort="customer_name">Phone</th>
                            <th class="sort" data-sort="customer_name">Code</th>
                            <th class="sort" data-sort="customer_name">Is Valid</th>
                        </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @include('generator.generator-modals')
    @include('admin.components.comon-modals.common-modal')

@endsection


@section('script')
    <script>
        $(document).ready(function () {

            var table = $('#roleTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                info: true,
                bFilter: false,
                ordering: false,
                bLengthChange: false,
                order: [[0, "desc"]],
                ajax: {
                    url: "attempt-code-list",

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val(),
                        d.s_status = $('select[name=s_status]').val()
                    },

                },

                columns: [
                    {data: 'name'},
                    {data: 'phone'},
                    {data: 'p_code'},
                    {data: 'is_valid'},

                ],

            });


        });
    </script>
    <script src="{{ URL::asset('build/js/custom-js/product/product.js') }}"></script>
@endsection


