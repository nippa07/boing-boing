<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Boing-Boing | Customer Area</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('assets/img/icon.ico')}}" type="image/x-icon" />

    @include('CustomerArea.includes.css')

</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        @include('CustomerArea.includes.navbar')
        <!-- End Navbar -->

        <!-- Sidebar -->
        @include('CustomerArea.includes.sidebar')
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

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    @include('CustomerArea.includes.js')
</body>

</html>
