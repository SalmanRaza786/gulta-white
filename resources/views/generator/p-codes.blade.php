@extends('layouts.master')
@section('title') Product Codes @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Products Codes @endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Products Codes List</h4>
                    </div>

                    <div class="col-auto justify-content-sm-end">
                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#pCodes"><i class="ri-add-line align-bottom me-1"></i> Add Product Code</button>
                    </div>

                </div><!-- end card header -->


                <div class="card-body pt-0">
                    <table class="table table-nowrap align-middle" id="roleTable">
                        <thead class="text-muted table-light">

                        <tr class="text-uppercase">
                            <th class="sort" data-sort="id">Product</th>
                            <th class="sort" data-sort="customer_name">Code</th>
                            <th class="sort" data-sort="customer_name">Status</th>
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
                    url: "p-codes-list",

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()
                    },

                },

                columns: [
                    {data: 'product.name'},
                    {data: 'p_codes'},
                    {data: 'is_verify'},

                ],

            });

            table.on('xhr', function () {
                var json = table.ajax.json();
                $('#totalRecords').text(json.recordsTotal);
            });

        });
    </script>
    <script src="{{ URL::asset('build/js/custom-js/product/product.js') }}"></script>
@endsection


