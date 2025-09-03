@extends('layouts.master')
@section('title')
    @lang('translation.app_settings')
@endsection
@section('css')

@endsection
@section('content')
        @component('components.breadcrumb')
            @slot('li_1') Dashboard @endslot
            @slot('routeUrl') {{url('/')}} @endslot
            @slot('title') Message Text @endslot
        @endcomponent
        @include('components.common-error')


    <div class="row">
        <div class="col-xxl-12 mt-5">
            <form method="post" class=" g-3 needs-validation" action="{{route('admin.text.message.update')}}" enctype="multipart/form-data" autocomplete="off" id="TextMessageForm">

                @csrf
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#app_settings" role="tab"
                                   aria-selected="true">
                                    <i class="fas fa-home"></i> Message Setting
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body p-4">
                        <div class="tab-content">
                         <div class="tab-pane active show" id="app_settings" role="tabpanel">


                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="app_title"
                                                   class="form-label">Valid Message</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                   value="{{isset($data['appSetting'])? $data['appSetting']->valid_message:''}}"
                                                   id="app_title" name="valid_message"
                                                   placeholder="Valid Message">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="app_title"
                                                   class="form-label">InValid Message</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                   value="{{isset($data['appSetting'])? $data['appSetting']->in_valid_message:''}}"
                                                   id="app_title" name="invalid_message"
                                                   placeholder="InValid Message">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="app_title"
                                                   class="form-label">Verified  Message</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                   value="{{ isset($data['appSetting'])? $data['appSetting']->verified_message:''}}"
                                                   id="app_title" name="verified_message"
                                                   placeholder="Verified  Message">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                   class="form-label mt-5">Home Image</label>
                                        </div>
                                        <div class="col-lg-9">

                                            <div class="profile-user position-relative d-inline-block mx-auto  mb-2">

                                                <img
                                                    src="{{ isset($data['appSetting']) && $data['appSetting']->home_image
            ? asset('storage/uploads/' . $data['appSetting']->home_image)
            : asset('default.png') }}"
                                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                    alt="user-profile-image">



                                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                    <input id="profile-img-file-input" name="home_image" type="file"
                                                           class="profile-img-file-input">
                                                    <label for="profile-img-file-input"
                                                           class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                        </div>
                    </div>

                </div>
                <div class="text-end">

                    <button type="submit" class="btn btn-primary btn-submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

     <script src="{{ URL::asset('build/js/custom-js/product/product.js') }}"></script>

@endsection




