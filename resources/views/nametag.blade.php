<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>{{ $name }}</title>

        <link rel="stylesheet" href="{{ asset('css/vendor/reset.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Oswald:500|Roboto+Condensed:700" rel="stylesheet">
    </head>
    <body style="max-width: 336px; height: 545px;">
        <div class="box" style="text-align: center; margin-top: 300px; margin-left: 18px; width: 336px; height: 148px;">
            <h1 style="padding-top: 30px; font-weight: bold; font-family: 'Roboto Condensed', sans-serif; font-size: 32px; white-space: nowrap; overflow: hidden;">{{ $name }}</h1>
            <h5 style="padding-top: 30px; font-weight: bold; font-family: 'Oswald', sans-serif; font-size: 20px; text-transform: uppercase;">{{ $role }}</h5>
        </div>
    </body>
</html>
