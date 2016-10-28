@extends('layouts.main')


@section('content')
  <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->name) }}" alt="User profile picture">
                  <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name}}</h3>
                  <p class="text-muted text-center">&#64;{{ $user->display_name }}   <i class="fa  fa-map-marker"></i> @if($user->country) {{ $user->country }}
                  @else unknown @endif  </p>
                  <div id="button-follow">
                  @if(!$status['status'])
                        <button class="btn btn-primary btn-block" id="send-request-profile"><b>
                        <i class="fa fa-user-plus"></i> Add Friend</b></button>         
                  @elseif($status['status'] == 1 && $status['user_action'] != $user->id)
                      <button class="btn btn-primary btn-block" id="cancel-request"><b><i class="fa fa-user-times"></i> Cancel Request</b></button>
                  @endif
                 </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary opacity-low">
                <div class="box-header"></div>
			         <div class="box-body">
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item no-border-first"> 
                    </li>
                    </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            
                <div class="col-md-9 margin-bottom padding-all opacity-low">
                 <div class="row">
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block border-right">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">Total training sessions</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block border-right">
                        <h5 class="description-header">00:00:00</h5>
                        <span class="description-text">Total training time </span>
                        <span class="description-percentage-small-small text-blue btn-block">[hh:mm:ss]</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block border-right">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">Total Distance</span>
                        <span class="description-percentage-small text-blue btn-block">[km]</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">Total Power average </span>
                        <span class="description-percentage-small text-blue btn-block">[W]</span>
                      </div><!-- /.description-block -->
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block border-right">
                        
                        <h5 class="description-header">0</h5>
                        <span class="description-text">Total number of strokes</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block border-right">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">Total Stroke distance average </span>
                        <span class="description-percentage-small text-blue inline">[spm]</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block border-right">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">Total Angle average</span>
                        <span class="description-percentage-small text-blue btn-block">[°]</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                      <div class="description-block">
                        <h5 class="description-header">0</h5>
                        <span class="description-text ">Total HR average</span>
                        <span class="description-percentage-small text-blue btn-block">[bmp]</span>
                       
                        
                      </div><!-- /.description-block -->
                    </div>
                  </div>
				</div>
                
            <div class="col-md-9 hide-info">
           <hr class="border-top">
           @if($status['status'] == 1 && $status['user_action'] == $user->id)
            <h1 class="h1-info"><b> {{ $user->first_name.' '.$user->last_name}} </b> sent you a friend request  <br><br>
              <a class="btn btn-primary btn-sm" id="confirm-friend-profile">Confirm Request</a>
              <a class="btn btn-default btn-sm" id="delete-request">Delete Request</a>
            </h1>   
           @else
            <h1 class="h1-info">You need to be friend with this user in order to see his information</h1>
           @endif
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script type="text/javascript">
// send request to follow
  $(document).on("click", "#send-request-profile", function(){
        var button = document.getElementById("button-follow");
        var id    = "<?php echo $user->id; ?>";
          $.ajax({
                  url: '{{ asset('/friend-request') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          button.innerHTML = '<button class="btn btn-primary btn-block" id="cancel-request"><b><i class="fa fa-user-times"></i> Cancel Request</b></button>';   
                      }
                  }
              });   
  });
// -- Confirm friend request
$(document).on("click", "#confirm-friend-profile", function(){
    var id    = "<?php echo $user->id; ?>";// get user id
    $.ajax({
                  url: '{{ asset('/friend-confirm') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          window.location.reload();
                      }
                  }
              });   
});

// cancel a requesto to follow
$(document).on("click", "#cancel-request", function(){
        var button = document.getElementById("button-follow");
        var id    = "<?php echo $user->id; ?>";
          $.ajax({
                  url: '{{ asset('/unfriend') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          button.innerHTML = '<button class="btn btn-primary btn-block" id="send-request-profile"><b><i class="fa fa-user-plus"></i> Add Friend</b></button>'; 
                      }
                  }
              });   
});

// -- Delete friend Request
$(document).on("click", "#delete-request", function(){
        var id    = "<?php echo $user->id; ?>";
          $.ajax({
                  url: '{{ asset('/unfriend') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          window.location.reload();
                      }
                  }
              });   
});
</script>

@endsection
