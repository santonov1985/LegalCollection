<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css?v=1') }}">

    @yield('styles')

    <title>{{ env('APP_NAME') }}</title>
</head>
<body class="c-app c-legacy-theme">
@include('layouts.sidebar')

<div class="c-wrapper c-fixed-components">
    @include('layouts.header')

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</div>

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('/js/coreui.min.js') }}"></script>
<script src="{{ asset('/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('/js/app.js') }}"></script>

@yield('scripts')

</body>
</html>
