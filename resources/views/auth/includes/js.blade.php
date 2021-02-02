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

<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}">
</script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/ready.js') }}"></script>
