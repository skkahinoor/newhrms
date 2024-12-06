<!DOCTYPE html>
<html lang="eng" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title')</title>

    {{-- CSS  --}}
    @include('recruitment.common.link')
</head>

<body>

    {{-- main content  --}}
    @yield('main-content')
    {{-- End main content  --}}

    {{-- Js  --}}
    @include('recruitment.common.script')

</body>

</html>
