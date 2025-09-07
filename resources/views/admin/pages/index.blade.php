@extends('layouts.master')
@section('title') @lang('translation.users') @endsection
@section('css')

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('li_1') Dashboard @endslot
        @slot('title') Pages @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Pages List</h4>

                    </div>

                    <div class="col-auto justify-content-sm-end">
                        <a href="{{route('admin.pages.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add New Page</a>
                    </div>


                </div>

                <div class="card-body border border-dashed border-end-0 border-start-0">

                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-7 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder=" {{__('translation.search')}}" name="s_name" id="s_name">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
{{--                            <div class="col-xxl-3 col-sm-4">--}}
{{--                                <div>--}}
{{--                                    <select class="form-control"  name="s_status">--}}
{{--                                        <option value="">Status</option>--}}
{{--                                        <option value="" selected>{{__('translation.all')}}</option>--}}
{{--                                        <option value="1">Active</option>--}}
{{--                                        <option value="2">In-Active</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!--end col-->

{{--                            <div class="col-xxl-2 col-sm-4">--}}
{{--                                <div>--}}
{{--                                    <button type="button" class="btn btn-primary w-100" id="filter"> <i class="ri-equalizer-fill me-1 align-bottom"></i>--}}
{{--                                        {{__('translation.filter')}}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>

                <div class="card-body pt-0">
                        <table class="table align-middle" id="roleTable">
                            <thead class="text-muted table-light">
                            <tr class="text-uppercase">
                                <th class="sort" data-sort="id">Title</th>
                                <th class="sort" data-sort="customer_name">Description</th>
                                <th class="sort" data-sort="customer_name">Page Type</th>
                                <th class="sort" data-sort="date">Action</th>

                            </tr>
                            </thead>

                    </table>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    @include('admin.user.user-modals')
    @include('admin.components.comon-modals.common-modal')


@endsection
@section('script')
    <script src="{{ URL::asset('build/js/custom-js/pages/pages.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#roleTable').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                info: true,
                bFilter: false,
                ordering: false,
                bLengthChange: false,
                order: [[ 0, "desc" ]],
                ajax: {
                    url: route('admin.pages.list'),
                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()


                    }
                },

                columns: [
                    { data: 'title' },
                    { data: 'description' },
                    { data: 'page_type' },
                    { data: null, orderable: false },
                ],
                columnDefs: [
                    {
                        targets: 3,
                        render: function(data, type, row, meta) {
                            const rowId = row.id;
                            var url = "{{ route('admin.page.edit') }}"; // no ':id'

                            return `
            <a href="${url}?id=${rowId}">
                <i class="ri-pencil-fill text-primary fs-4"></i>
            </a>
            <a href="#" class="btn-delete" data-id="${rowId}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">
                <i class="ri-delete-bin-fill text-danger fs-4"></i>
            </a>
        `;
                        }
                    }

                ]
            });

        });
    </script>

@endsection
