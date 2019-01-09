<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Concert</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Semantic UI -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
        <script src="{{ asset('js/semantic.min.js') }}"></script>
    </head>
    <body>
        <div class="container"></div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
