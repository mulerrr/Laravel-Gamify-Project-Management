<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>8commerce | Login Page</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/important/8commerce-icon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themify/themify-icons.css') }}" rel="stylesheet">
    @yield('css')

    <script src="https://use.fontawesome.com/874dbadbd7.js"></script>
</head>
<body>
    <div id="app">
        
        {{-- flash message --}}
        <div class="container">
            @include('partials.success')
            @include('partials.errors')
        </div>

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</body>
</html>
