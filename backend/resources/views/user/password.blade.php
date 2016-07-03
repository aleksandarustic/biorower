@extends('layouts.full')

@section('content')
    <div>
        @if (session('status'))
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    <li>{{ session('status') }}</li>
                </ul>
            </div>
        @endif
    </div>
    <div id="myCarousel" class="carousel container slide carousel-fade">
        <div class="carousel-inner">
            <div class="active item one"></div>
            <div class="item two"></div>
            <div class="item three"></div>
            <div class="item four"></div>
            <div class="item five"></div>
            <div class="item six"></div>
            <div class="item seven"></div>
        </div>
        <div class="dark-bg"></div>
    </div>
    <div class="login">
        <div class="tab-content">
            <div class="login-box active tab-pane" id="login">
                <div class="login-box-body">
                    <div class="login-logo">
                        <a href="{{ url('/') }}"><img src="{{ URL::asset('images/login/Logo.png') }}" alt="Biorower"/></a>
                    </div><!-- /.login-logo -->
                    <form action="{{ url('/update-password') }}" method="post" id="login-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="st_usr" value="{{ $user->email }}">
                        <div class="form-group has-feedback">
                            <input type="password" name="password" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password_confirmation" placeholder="Repeat Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="btn btn-block">
                                <button type="submit" class="btn btn-primary btn-block btn-flat  margin-top">Update Password</button>
                            </div><!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->

                    <div class="clear"></div>

                </div><!-- /.login-box-body -->
            </div><!-- /.login-box -->

        </div>
    </div>

    <script>
        $('.carousel').carousel({
            interval: 6000,
            pause: "false"
        });
    </script>
@endsection