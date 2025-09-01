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
                            <th class="sort" data-sort="customer_name">Verification Status</th>
                            <th class="sort" data-sort="customer_name">Enable Status</th>
                            <th class="sort" data-sort="customer_name">Action</th>
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
    <script src="{{ URL::asset('build/js/custom-js/p-codes/pCodes.js') }}"></script>
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
                    {data: null},

                ],
                columnDefs: [


                    {
                        targets: 3,
                        render: function(data, type, row, meta) {
                            if(row.is_enable==1) {
                                return '<span class="badge badge-soft-success text-uppercase">Enable</span>';
                            }else{
                                return '<span class="badge badge-soft-danger text-uppercase">Disable</span>';
                            }

                        }
                    },
                    {
                        targets: 2,
                        render: function(data, type, row, meta) {
                            if(row.is_verify=='Verify') {
                                return '<span class="badge badge-soft-success text-uppercase">' + row.is_verify + '</span>';
                            }else{
                                return '<span class="badge badge-soft-danger text-uppercase">' + row.is_verify + '</span>';
                            }

                        }
                    },

                    {
                        targets:4,
                        render: function(data, type, row, meta) {
                            const rowId = row.id;
                            return '<td>'+
                                '<div class="dropdown fs-4">'+
                                '<a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'+
                                '<i class="ri-more-2-fill"></i>'+
                                '</a>'+
                                '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">'+
                                '<li><a class="btn-delete cursor-pointer ms-3"  data="'+rowId+'"  title="Delete" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Delete</a></li>'+
                                '<li><a class="btn-publish cursor-pointer ms-3" data-publish="1"  data="'+rowId+'"  title="Mark As Publish" data-bs-toggle="modal" data-bs-target="#markAsPublishModal">Mark As Enable</li>'+
                                '<li><a class="btn-publish cursor-pointer ms-3" data-publish="2"  data="'+rowId+'"  title="Mark As Un Publish" data-bs-toggle="modal" data-bs-target="#markAsPublishModal">Mark As Disable</a></li>'+
                                '</ul>'+
                                '</div>'+
                                '</td>';


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


