<!-- Fonts and icons -->
<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>

<script>
    WebFont.load({
        google: {
            "families": ["Open+Sans:300,400,600,700"]
        },
        custom: {
            "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular",
                "Font Awesome 5 Brands"
            ],
            urls: ["{{ asset('assets/css/fonts.css') }}"]
        },
        active: function () {
            sessionStorage.fonts = true;
        }
    });

</script>

<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}">
</script>
<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}">
</script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}">
</script>

<!-- Moment JS -->
<script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}">
</script>

<!-- Chart Circle -->
<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}">
</script>

<!-- Bootstrap Toggle -->
<script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}">
</script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Google Maps Plugin -->
<script src="{{ asset('assets/js/plugin/gmaps/gmaps.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Azzara JS -->
<script src="{{ asset('assets/js/ready.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

@yield('js')

<script>
    $(document).ready(function () {

        @foreach(['danger', 'success'] as $msg)
        @if(Session::has('alert-'.$msg))
        var msg = '@php echo Session("alert-".$msg); @endphp';
        @if($msg == 'success')
        setTimeout(() => {
            notifySuccess(msg);
        }, 500);
        @endif
        @if($msg == 'danger')
        setTimeout(() => {
            notifyDanger(msg);
        }, 500);
        @endif
        @endif
        @endforeach

    });

    function notifySuccess(msg) {
        var content = {};
        content.message = msg;
        content.title = 'Success Message';
        content.icon = 'fa fa-bell';

        $.notify(content, {
            type: 'success',
            placement: {
                from: "top",
                align: "right"
            },
            time: 1000,
            delay: 500,
        });
    }

    function notifyDanger(msg) {
        var content = {};
        content.message = msg;
        content.title = 'Error Message';
        content.icon = 'fa fa-bell';

        $.notify(content, {
            type: 'danger',
            placement: {
                from: "top",
                align: "right"
            },
            time: 1000,
            delay: 500,
        });
    }

</script>
