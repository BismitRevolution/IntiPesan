<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="description" content="Description of the page">
        <!-- Reset CSS -->
        <!-- <link rel="stylesheet" href="{{ asset('css/vendor/reset.min.css') }}"> -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
        <!-- Foundation Zurb CSS -->
        <!-- <link rel="stylesheet" href="{{ asset('css/vendor/foundation.min.css') }}"> -->
        <!-- Materialize CSS -->
        <!-- <link rel="stylesheet" href="{{ asset('css/vendor/materialize.min.css') }}"> -->
        <!-- Flat UI CSS -->
        <link rel="stylesheet" href="{{ asset('css/vendor/flat-ui.min.css') }}">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/vendor/all.min.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @yield('extra-css')
        <title>@yield('title')</title>
    </head>
    <body>
        @include('layout/_nav')
        <div class="">
            @yield('content')
        </div>
        @include('layout/_footer')
        @yield('extra-js')
    </body>
</html>
