
@extends('layouts.master')
@section('title') Reviews  @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Reviews @endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Reviews List</h4>
                    </div>
                </div>


                <div class="card-body pt-0">
                    <table class="table align-middle" id="roleTable">
                        <thead class="text-muted table-light">

                        <tr class="text-uppercase">
                            <th class="sort" data-sort="id">Name</th>
                            <th class="sort" data-sort="customer_name">Email</th>
                            <th class="sort" data-sort="customer_name">Review Message</th>
                            <th class="sort" data-sort="customer_name">Status</th>
                            <th class="sort" data-sort="date">Action</th>
                        </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('admin.reviews.reviews-modals')
    @include('admin.components.comon-modals.common-modal')

@endsection


@section('script')
    <script src="{{ URL::asset('build/js/custom-js/reviews/reviews.js') }}"></script>

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
                    url: route('admin.review.list'),

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()
                    },

                },

                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'review_message' },
                    { data: 'is_published' },
                    { data: null, orderable: false },
                ],

                columnDefs: [

                    {
                        targets:3,
                        render: function(data, type, row, meta) {
                            var isPublish='Un Publish';
                            var isPublishClass='danger';
                            if(row.is_published==1){
                                isPublish='Publish'
                                isPublishClass='success';
                            }
                            return '<td>'+
                                '<span class="badge badge-soft-'+isPublishClass+' p-2">'+isPublish+'</span>'+
                                '</td>';


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
                                '<li><a class="btn-publish cursor-pointer ms-3" data-publish="1"  data="'+rowId+'"  title="Mark As Publish" data-bs-toggle="modal" data-bs-target="#markAsPublishModal">Mark As Publish</li>'+
                                '<li><a class="btn-publish cursor-pointer ms-3" data-publish="2"  data="'+rowId+'"  title="Mark As Un Publish" data-bs-toggle="modal" data-bs-target="#markAsPublishModal">Mark As UnPublish</a></li>'+
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

@endsection




