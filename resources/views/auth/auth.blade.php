<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <title>{{ env('APP_NAME') }}</title>
</head>
<body class="c-app flex-row align-items-center">

@yield('content')

</body>
</html>
