<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>BIO</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{ URL::asset('images/login/Logo.png') }}" alt="Biorower" /></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                <!-- Messages: style can be found in dropdown.less-->
                <!-- <li class="dropdown messages-menu"> <a href="#"  data-toggle="control-sidebar"> <i class="fa fa-comment-o"></i> <span class="label label-success">4</span> </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <ul class="menu">
                                <li><
                                    <a href="#">
                                        <div class="pull-left"> <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> </div>
                                        <h4> Support Team <small><i class="fa fa-clock-o"></i> 5 mins</small> </h4>
                                        <p class="h2-subhead">Why not buy a new awesome theme?</p>
                                    </a> </li>
                                <li> <a href="#">
                                        <div class="pull-left"> <img src="" class="img-circle" alt="User Image"> </div>
                                        <h4> AdminLTE Design Team <small><i class="fa fa-clock-o"></i> 2 hours</small> </h4>
                                        <p class="h2-subhead">Why not buy a new awesome theme?</p>
                                    </a> </li>
                                <li> <a href="#">
                                        <div class="pull-left"> <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image"> </div>
                                        <h4> Developers <small><i class="fa fa-clock-o"></i> Today</small> </h4>
                                        <p class="h2-subhead">Why not buy a new awesome theme?</p>
                                    </a> </li>
                                <li> <a href="#">
                                        <div class="pull-left"> <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image"> </div>
                                        <h4> Sales Department <small><i class="fa fa-clock-o"></i> Yesterday</small> </h4>
                                        <p class="h2-subhead">Why not buy a new awesome theme?</p>
                                    </a> </li>
                                <li> <a href="#">
                                        <div class="pull-left"> <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image"> </div>
                                        <h4> Reviewers <small><i class="fa fa-clock-o"></i> 2 days</small> </h4>
                                        <p class="h2-subhead">Why not buy a new awesome theme?</p>
                                    </a> </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="messages.html">See All Messages</a></li>
                    </ul>
                </li>
                -->
                <!-- Notifications: style can be found in dropdown.less -->
            <!--    <li class="dropdown notifications-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-warning">10</span> </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <ul class="menu">
                                <li> <a href="#"> <i class="fa fa-users text-aqua"></i> 5 new members joined today </a> </li>
                                <li> <a href="#"> <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems </a> </li>
                                <li> <a href="#"> <i class="fa fa-users text-red"></i> 5 new members joined </a> </li>
                                <li> <a href="#"> <i class="fa fa-shopping-cart text-green"></i> 25 sales made </a> </li>
                                <li> <a href="#"> <i class="fa fa-user text-red"></i> You changed your username </a> </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li> -->
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ URL::asset(Auth::user()->profile->image->name) }}" class="user-image" alt="User Image">

                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span> 
                    </a>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                        <br>
                            <a href="{{ url('/profile/edit') }}">
                                    <img src="{{ URL::asset(Auth::user()->profile->image->name) }}" class="user-image" alt="User Image">                
                            </a>

                            <p class="h2-subhead"> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <small>Member since {{ date('M Y', strtotime(Auth::user()->created_at)) }}</small> </p>


                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left"> <a href="{{ url('/profile/edit') }}" class="btn btn-default btn-flat">Profile</a> </div>
                            <div class="pull-right"> <a href="{{ url('/profile/logout') }}" class="btn btn-default btn-flat">Sign out</a> </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>


        <!-- search form -->
        <!-- Trenutno ne treba da se prikazuje 
        <div class="nav-search pull-right">
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group search-onTop col-md-12">
                    <label for="front-search" ><i class="fa fa-search"></i></label>
                    <input type="text" name="q" id="front-search" class="form-control col-md-12" placeholder="Search...">
                </div>
            </form>
        </div>
        -->
        <!-- /.search form -->

    </nav>
</header>