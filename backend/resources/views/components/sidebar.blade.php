<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                    <img src="{{ URL::asset(Auth::user()->profile->image->name) }}" class="user-image" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</p>

                <!-- STATUS ONLINE - iskljucen privremeno
                <a href="#"  data-toggle="dropdown" aria-expanded="true"><i class="fa fa-circle text-success"></i> Online</a>
                <ul class="dropdown-menu chat-status" role="menu">
                    <li><a href="#"><i class="fa fa-circle text-success"></i> Online</a></li>
                    <li> <a href="#"><i class="fa fa-circle text-warning"></i> Busy</a></li>
                    <li><a href="#"><i class="fa fa-circle text-danger"></i> Do not disturb</a></li>
                    <li> <a href="#"><i class="fa fa-circle text-muted"></i> Offline</a></li>
                </ul>
                <!-- Status -->
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ setActive('profile') }}"><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
            <li class="{{ setActive('sessions/calendar') }}"><a href="{{ url('/sessions/calendar') }}"><i class="fa fa-calendar"></i> <span>My Calendar</span></a></li>
            <li class="{{ setActive('profile/sessions') }}"><a href="{{ url('/profile/sessions') }}"><i class="fa fa-tasks"></i> <span>My Sessions</span></a></li>
            <li class="{{ setActive('sessions/training') }}"><a href="{{ url('/profile/training') }}"><i class="fa  fa-ship"></i> <span>My Training Session</span></a></li>
            <li class="{{ setActive('profile/friends') }}"><a href="{{ url('/profile/friends') }}"><i class="fa fa-users"></i> <span>Friends</span></a></li>
            <li class="{{ setActive('profile/edit') }}"><a href="{{ url('/profile/edit') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>