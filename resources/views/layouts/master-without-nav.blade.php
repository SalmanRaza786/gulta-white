<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-sidebar-image="none">

    <head>
    <meta charset="utf-8" />
    <title>@yield('title'){{env('APP_NAME')}} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ URL::asset('build/images/logo-dark.png') }}">
        @include('layouts.head-css')
  </head>

    @yield('body')

    @yield('content')

    <script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ URL::asset('build/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{ URL::asset('build/js/plugins.js')}}"></script>

    <!--Swiper slider js-->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ URL::asset('build/js/pages/job-lading.init.js')}}"></script>
    </body>
</html>
