<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
   <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/iCheck/square/blue.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('dist/css/s2-docs.css') }}">

    <link rel='stylesheet' type='text/css' href="{{ URL::asset('plugins/fullcalendar/fullcalendar.css') }}" />
    <link rel='stylesheet' type='text/css' href="{{ URL::asset('plugins/fullcalendar/fullcalendar.print.css') }}" media='print' />
   
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
    <!-- VEX style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/vex.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('dist/css/vex-theme-plain.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/skin-blue.min.css') }}">
    <!-- Date Range Picker -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    @include('components.header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('components.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        @yield('content')
        <!-- Right side column. contains chat -->
        @include('components.rightbar')
    </div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->
<!-- Main Footer -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Pusher -->
<script src="{{ URL::asset('dist/js/pusher.js') }}"></script>
<!-- VEX - dialog -->
<script src="{{ URL::asset('dist/js/vex.combined.min.js') }}"></script>
<script src="{{ URL::asset('dist/js/jstz.min.js') }}"></script>
<script type="text/javascript">        
var pusher           = new Pusher('{{env("PUSHER_KEY")}}', 
    { cluster: 'eu', encrypted: true});

var channelChat      = pusher.subscribe('ch-chat');
var channelNotif     = pusher.subscribe('notifications');
var channelComment   = pusher.subscribe('comments');

$.ajaxSetup({
            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

vex.defaultOptions.className = 'vex-theme-plain';
</script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
<!-- INFINITE SCROLL - load more item with scrolling -->
<script src="{{ URL::asset('dist/js/jquery.infinitescroll.min.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ URL::asset('plugins/flot/jquery.flot.min.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ URL::asset('plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.canvas.js') }}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{ URL::asset('plugins/flot/jquery.flot.categories.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.axislabels.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.navigate.js') }}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->

<!-- iCheck -->
<script src="{{ URL::asset('plugins/iCheck/icheck.min.js') }}"></script>
@yield('page-scripts')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. Slimscroll is required when using the
    fixed layout. -->
</body>
</html>