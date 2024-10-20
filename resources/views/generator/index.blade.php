@extends('layouts.master')
@section('title') Products @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Products List @endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Products List</h4>
                    </div>

                        <div class="col-auto justify-content-sm-end">
                            <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Product</button>
                        </div>

                </div><!-- end card header -->


                <div class="card-body pt-0">
                    <table class="table table-nowrap align-middle" id="roleTable">
                        <thead class="text-muted table-light">

                        <tr class="text-uppercase">
                            <th class="sort" data-sort="id">@lang('translation.title')</th>
                            <th class="sort" data-sort="customer_name">Prefix</th>
                            <th class="sort" data-sort="product_name">Digit</th>
                            <th class="sort" data-sort="product_name">Image</th>
                            <th class="sort" data-sort="date">@lang('translation.action')</th>
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
                    url: "product-list",

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()
                    },

                },

                columns: [
                    {data: 'name'},
                    {data: 'prefix'},
                    {data: 'digit_length'},
                    {data: 'image'},
                    {data: null, orderable: false},
                ],

                columnDefs: [

                    {
                        targets: 4,
                        render: function (data, type, row, meta) {
                            const rowId = row.id;


                            return '<td>' +
                                '<div class="dropdown fs-4">' +
                                '<a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">' +
                                '<i class="ri-more-2-fill"></i>' +
                                '</a>' +
                                '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">' +
                                '<li><a href="#" class="btn-edit ms-3" data="' + rowId + '" data-bs-toggle="modal" data-bs-target="#showModal" title="Edit"><i class="ri-pencil-fill text-muted fs-4"></i></a></li>' +
                                '<li><a class="btn-delete cursor-pointer ms-3"  data="' + rowId + '"  title="Delete" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-fill text-muted fs-4"></i></a></li>' +
                                '</ul>' +
                                '</div>' +
                                '</td>';


                        }
                    },
                    {
                        "targets": 3,
                        "render": function(data, type, row, meta) {
                            return '<img src="/storage/uploads/' + row.image + '" class="img-thumbnail avatar-lg" alt="">';
                        }
                    },
                ]
            });

            table.on('xhr', function () {
                var json = table.ajax.json();
                $('#totalRecords').text(json.recordsTotal);
            });

        });
    </script>
    <script src="{{ URL::asset('build/js/custom-js/product/product.js') }}"></script>
@endsection


