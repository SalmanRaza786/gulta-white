@extends('layouts.master')
@section('title') Message Text @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Message Text @endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Message Text List</h4>
                    </div>
                </div>


                <div class="card-body pt-0">

                    <table class="table  align-middle" id="roleTable">
                        <thead class="text-muted table-light">
                        <tr class="text-uppercase">

                            <th class="sort" data-sort="customer_name">Valid Message</th>
                            <th class="sort" data-sort="customer_name">In Valid Message</th>
                            <th class="sort" data-sort="customer_name">Verified Message</th>
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
                    url: "message-list",

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()
                    },

                },

                columns: [
                    {data: 'valid_message'},
                    {data: 'in_valid_message'},
                    {data: 'verified_message'},
                    {data: null, orderable: false},
                ],

                columnDefs: [

                    {
                        targets: 3,
                        render: function (data, type, row, meta) {
                            const rowId = row.id;


                            return '<td>' +
                                '<div class="dropdown fs-4">' +
                                '<a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">' +
                                '<i class="ri-more-2-fill"></i>' +
                                '</a>' +
                                '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">' +
                                '<li><a href="#" class="btn-edit-text ms-3" data="' + rowId + '" data-bs-toggle="modal" data-bs-target="#textMessage" title="Edit"><i class="ri-pencil-fill text-muted fs-4"></i></a></li>' +

                                '</ul>' +
                                '</div>' +
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


