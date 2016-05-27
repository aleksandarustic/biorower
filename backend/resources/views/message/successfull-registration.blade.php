@extends('layouts.full')

@section('content')
        <!-- Full Page Image Background Carousel Header -->
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
            </div>
        </div>

        <div style="text-align: center">
            <h3>Thank you for registering! </h3>
            <p>
                Your registration request has been sent to our administration for approval. <br>
                <a href="{{ url('/') }}">Go back</a>
            </p>
        </div>

    </div>
</div>

@endsection
