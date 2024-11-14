<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Digital HR Complete HR Attendance System">
    <meta name="author" content="Digital HR">
    <meta name="keywords" content="Digital HR">

    <title>@yield('title')</title>

    @include('admin.section.head_links')
    <link href="{{ asset('assets/css/datatable.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> --}}


    @yield('styles')
</head>

<body>
    <div id="preloader">
        @include('admin.section.preloader')
    </div>

    <div class="main-wrapper">
        @include('admin.section.sidebar')
        <div class="page-wrapper">
            @include('admin.section.nav')

            <div class="page-content">
                @include('admin.section.page_header')
                @yield('main-content')
            </div>

            <!-- partial -->
            @include('admin.section.footer')
        </div>
    </div>

    @include('admin.section.body_links')

    @include('layouts.nav_notification_scripts')
    @include('layouts.nav_search_scripts')
    @include('layouts.theme_scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>


    <!-- DataTables JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}


    @yield('scripts')
    @yield('attendanceScripts')



</body>

</html>
