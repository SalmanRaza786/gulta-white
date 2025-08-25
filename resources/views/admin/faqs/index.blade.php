
@extends('layouts.master')
@section('title') FAQs  @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') FAQs@endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">FAQs List</h4>
                    </div>

                    <div class="col-auto justify-content-sm-end">
                        <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add FAQs</button>
                    </div>

                </div><!-- end card header -->


                <div class="card-body pt-0">
                    <table class="table table-nowrap align-middle" id="roleTable">
                        <thead class="text-muted table-light">

                        <tr class="text-uppercase">
                            <th class="sort" data-sort="id">Question</th>
                            <th class="sort" data-sort="customer_name">Answer</th>
                            <th class="sort" data-sort="date">Action</th>
                        </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('admin.faqs.faqs-modals')
    @include('admin.components.comon-modals.common-modal')

@endsection


@section('script')
    <script>
        $(document).ready(function(){

            var table=$('#roleTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                info: true,
                bFilter: false,
                ordering: false,
                bLengthChange: false,
                order: [[ 0, "desc" ]],
                ajax: {
                    url: "faqs-list",

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()
                    },

                },

                columns: [
                    { data: 'question' },
                    { data: 'ans' },
                    { data: null, orderable: false },
                ],

                columnDefs: [
                    {
                        targets:2,
                        render: function(data, type, row, meta) {
                            const rowId = row.id;
                            return '<td>'+
                                '<div class="dropdown fs-4">'+
                                '<a href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false">'+
                                '<i class="ri-more-2-fill"></i>'+
                                '</a>'+
                                '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">'+
                                '<li><a class="btn-delete cursor-pointer ms-3"  data="'+rowId+'"  title="Delete" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"><i class="ri-delete-bin-fill text-muted fs-4"></i></a></li>'+
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
    <script src="{{ URL::asset('build/js/custom-js/faqs/faqs.js') }}"></script>
@endsection




