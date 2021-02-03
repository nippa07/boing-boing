<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<!-- Bootstrap Notify -->
<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}">
</script>
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
