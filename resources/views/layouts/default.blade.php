<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet"  href="{{asset('css/app.css')}}"/>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">


</head>
<body>
    <header>
        @include('layouts.default.header')
    </header>
    <main>
        <section id="app">
            @yield('content')
        </section>
    </main>

    <div id="loader">
        <loader/>
    </div>

    @include('layouts.default.footer')

    @component('layouts.default.body_scripts')
        @yield('scripts')
    @endcomponent

</body>
</html>