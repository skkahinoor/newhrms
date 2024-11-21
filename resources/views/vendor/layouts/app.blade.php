<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/vendor/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/2c6fa898a2.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/vendor/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="g-sidenav-show bg-gray-200">
    {{-- Side Bar  --}}
    @include('vendor.section.vendorsidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('vendor.section.vendornavbar')
        <!-- End Navbar -->

        {{-- main Content  --}}
        @yield('main-content')
        {{-- End Main Content  --}}
    </main>
    {{-- Vendor Setting  --}}
    @include('vendor.section.vendorsetting')

    {{-- Vendor Script  --}}
    @include('vendor.section.vendorscript')

</body>

</html>
