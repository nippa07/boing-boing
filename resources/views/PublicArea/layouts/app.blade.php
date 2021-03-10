<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#2b2c5a">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#2b2c5a">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#2b2c5a">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Boing-Boing">
    <meta name="description" content="Boing-Boing">
    <!-- Favicons -->
    <title>Boing-Boing</title>
    <link rel="icon" href="{{asset('assets/img/favicon.webp')}}" type="image/x-icon" />

    @include('PublicArea.includes.css')
</head>

<body>
    <section>
        @yield('content')
    </section>

    @include('PublicArea.includes.footer')
    @include('PublicArea.includes.js')
</body>

</html>
