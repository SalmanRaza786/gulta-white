
@extends('layouts.master')
@section('title') Contact US  @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('routeUrl') {{url('/')}} @endslot
        @slot('title') Contact US @endslot
    @endcomponent
    @include('components.common-error')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex ">
                    <div class="col">
                        <h4 class="card-title mb-0">Contact US List</h4>
                    </div>
                </div>


                <div class="card-body pt-0">
                    <table class="table align-middle" id="roleTable">
                        <thead class="text-muted table-light">

                        <tr class="text-uppercase">
                            <th class="sort" data-sort="id">Name</th>
                            <th class="sort" data-sort="customer_name">Email</th>
                            <th class="sort" data-sort="customer_name">Pharma Name</th>
                            <th class="sort" data-sort="customer_name">Message</th>

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
                    url: route('admin.contact.us.list'),

                    data: function (d) {
                        d.s_name = $('input[name=s_name]').val()
                    },

                },

                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'subject' },
                    { data: 'message' },

                ],


            });

            table.on('xhr', function () {
                var json = table.ajax.json();
                $('#totalRecords').text(json.recordsTotal);
            });

        });
    </script>

@endsection




