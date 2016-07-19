<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/iCheck/square/blue.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link rel='stylesheet' href="{{ URL::asset('plugins/fullcalendar-year/fullcalendar.css') }}" />
    <link rel='stylesheet' media="print" href="{{ URL::asset('plugins/fullcalendar-year/fullcalendar.print.css') }}" />
 


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
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
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        @yield('content')

    <aside class="control-sidebar control-sidebar-dark chat-open-right">
        <div>
            <!-- Home tab content -->
            <div class="tab-pane chat-panel" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li class="activity-li">
                        <a href="javascript::;">
                            <div class="pull-left chat-user-image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="activity-item">
                                <p class="activity-news">
                                    <span class="activity-username">Count Dracula</span> was training today, see his profile
                                    <small class="activity-date btn-block text-left text-muted">28 THU 2016</small>
                                </p>
                            </div>
                        </a>
                    </li>

                    <!-- Activity 1-->
                    <li class="activity-li">
                        <a href="javascript::;" >
                            <div class="pull-left chat-user-image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="activity-item">
                                <p class="activity-news"><span class="activity-username">Langdon Gold</span> was online 3 minutes ago
                                    <small class="activity-date btn-block text-left text-muted">3 minutes ago</small>
                                </p>
                            </div>
                        </a>
                    </li>
                    <!-- Activity 2 -->
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading no-margin">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="#chat-1" data-toggle="collapse">
                            <div class="pull-left chat-user-image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p class="user-state"><i class="fa fa-circle text-warning"></i> Online</p>
                            </div>
                        </a>
                    </li><!-- Contact 1 -->
                    <li>
                        <a href="#chat-2" data-toggle="collapse">
                            <div class="pull-left chat-user-image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p class="user-state"><i class="fa fa-circle text-success"></i> Online</p>
                            </div>
                        </a>
                    </li><!-- Contact 2 -->
                    <li>
                        <a href="#chat-3" data-toggle="collapse">
                            <div class="pull-left chat-user-image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p class="user-state"><i class="fa fa-circle text-danger"></i> Online</p>
                            </div>
                        </a>
                    </li><!-- Contact 3 -->
                    <li>
                        <a href="#chat-3" data-toggle="collapse">
                            <div class="pull-left chat-user-image">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p class="user-state"><i class="fa fa-circle text-muted"></i> Online</p>
                            </div>
                        </a>
                    </li><!-- Contact 4 -->
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
        </div>
    </aside>

    <!-- Chat boxes -->
    <div class="chat-boxes">
        <!-- Box 1 -->
        <div class="col-md-3 collapse chat-box" id="chat-1" style="height: 340px;" >
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Direct Chat</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool"><i class="fa fa-cog"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="chat-body">
                    <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    Is this template really for free? That's unbelievable!
                                </div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                                </div><!-- /.direct-chat-info -->
                                <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    You better believe it!
                                </div><!-- /.direct-chat-text -->
                            </div><!-- /.direct-chat-msg -->
                        </div><!--/.direct-chat-messages-->

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat">Send</button>
                      </span>
                            </div>
                        </form>
                    </div><!-- /.box-footer-->
                </div>
            </div><!--/.direct-chat -->
        </div>
        <!-- /.Box 1 -->
        <!-- Box 2 -->
        <div class="col-md-3 collapse chat-box" id="chat-2">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Direct Chat</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool"><i class="fa fa-cog"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
                    </div><!--/.direct-chat-messages-->

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat">Send</button>
                      </span>
                        </div>
                    </form>
                </div><!-- /.box-footer-->
            </div><!--/.direct-chat -->
        </div>
        <!-- /.Box 2 -->
        <!-- Box 3 -->
        <div class="col-md-3 collapse chat-box" id="chat-3">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Direct Chat</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool"><i class="fa fa-cog"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                            </div><!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div><!-- /.direct-chat-text -->
                        </div><!-- /.direct-chat-msg -->
                    </div><!--/.direct-chat-messages-->

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat">Send</button>
                      </span>
                        </div>
                    </form>
                </div><!-- /.box-footer-->
            </div><!--/.direct-chat -->
        </div>
        <!-- /.Box 3 -->


    </div>


</div>
<!-- /.content-wrapper -->


</div><!-- ./wrapper -->
<!-- Main Footer -->
<footer class="main-footer row">
    <!-- To the right -->
    <div class="footer-right">
        <ul class="inline-list">
            <li><a href="#"><i class="fa fa-1x fa-facebook-square"></i></a></li>
            <li><a href="#"><i class="fa fa-1x fa-twitter-square"></i></a></li>
            <li><a href="#"><i class="fa fa-1x fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-1x fa-pinterest-square"></i></a></li>
        </ul>


        <!-- Default to the right -->
        <p><strong>Copyright &copy; 2016 <a href="#">Biorower</a>.</strong> All rights reserved.</p>
        <ul class="inline-list">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Contact Support</a></li>
            <li class="margin-right-5"><a href="#">Terms</a></li>
            <li><a href="#">Privacy Policy</a></li>

        </ul>
    </div>
    <div class="clear"></div>
</footer>


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ URL::asset('plugins/fullcalendar/moment.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/app.min.js') }}"></script>
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ URL::asset('plugins/flot/jquery.flot.min.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ URL::asset('plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.canvas.js') }}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{ URL::asset('plugins/flot/jquery.flot.categories.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.spline.js') }}"></script>
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
