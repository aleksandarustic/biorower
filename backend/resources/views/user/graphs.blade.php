@extends('layouts.main')

@section('content')
<section class="content">
<div class="row"> 
	<div class="col-md-3 col-left">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                <div class="img-circle-width">
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->name) }}" alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name}}
                  @if($user->online == 1)
                      <i class="fa fa-circle text-success"></i>
                  @else
                      <i class="fa fa-circle text-danger"></i>
                  @endif
                  </h3>
                  <p class="text-muted text-center">&#64;{{ $user->display_name }} 
					 <i class="fa  fa-map-marker"></i> @if($user->country) {{ $user->country }}
                  @else unknown @endif  
                 </p>
                  <input type="hidden" name="user-email" id="user-email" value="{{ $user->email }}">
                 <!-- <a href="edit-profile.html" class="btn btn-primary btn-block"><b>Edit Profile</b></a>-->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        <a href="{{asset($user->display_name)}}" class="btn btn-primary btn-block"><b> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to {{ $user->first_name.' '.$user->last_name}} profile</b></a>
  </div><!-- /.col LEFT-->

        <div class="col-md-9 friends-pro no-shadow">
            <div class="nav-tabs-custom box no-border transp-bg no-shadow">
               <h1 class="pull-left friends-pro-h1"><i class="fa fa-line-chart text-aqua" aria-hidden="true"></i> User Graphs:</h1>
               
               	<div class="friends-btns-group">
               	<div class="btn-group">
                      <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-check margin-r-5" aria-hidden="true"></i> <span class="follow-txt">Friends </span>
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        @if($getstatus == 1)
                            <li id="id-getnotif"><a id="ungetnotification"><i class="fa fa-check" aria-hidden="true"></i> Get Notifications</a></li>
                        @else
                            <li id="id-getnotif"><a id="getnotification">Get Notifications</a></li>
                        @endif
                        <li><a href="#">  Block</a></li>                   
                        <li class="divider"></li>
                        <li><a href="#" id="unfriend-button"> Unfriend</a></li>
                      </ul>
                    </div>
                  <button type="button" class="btn btn-default margin-r-5 fsm-btn"  data-toggle="control-sidebar" id="chat-view"><i class="fa fa-comments" aria-hidden="true"></i> <span class="msm-txt">Sent Message</span></button>  
              	</div>
            </div> <!-- /.nav-tabs-custom box-->
        </div><!-- /.col-md-9 friends-pro -->        

              
</div> <!-- /.row -->
</section> 
@endsection

@section('page-scripts')


@endsection