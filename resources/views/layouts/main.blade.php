<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
        </nav>

        <main role="main" class="container">
            @yield('content')
        </main><!-- /.container -->

        <script src="{{ asset("js/app.js") }}"></script>
        @stack('scripts')

    </body>
</html>



