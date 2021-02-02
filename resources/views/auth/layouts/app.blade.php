<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />

    @include('auth.includes.css')
</head>

<body class="login">

    <div class="wrapper wrapper-login">
        @yield('content')
    </div>

    @include('auth.includes.js')
</body>

</html>
