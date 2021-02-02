<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Azzara Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('assets/img/icon.ico')}}" type="image/x-icon" />

    @include('AdminArea.includes.css')

</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        @include('AdminArea.includes.navbar')
        <!-- End Navbar -->

        <!-- Sidebar -->
        @include('AdminArea.includes.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('header')

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('AdminArea.includes.js')
</body>

</html>
