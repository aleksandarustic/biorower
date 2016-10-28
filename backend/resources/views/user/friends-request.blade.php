@extends('layouts.main')

@section('content')

    <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="padding-all white-bg">
                            <span class="pull-left act-h2"><i class="fa fa-users margin-right"></i> Friends Requests</span>
                            <div class="act-like-tabs pull-right col-md-7 search-friends">
                                <div class="search-form">
                                    <div class="input-group col-md-12">
                                        <i class="fa fa-search icon-search"></i>
                                        <input type="text" name="search" id="search-request" class="form-control search-forFriends" placeholder="Search">
                                    </div><!-- /.input-group -->
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="white-bg col-left">
                            <div class="friends-tabs-custom row">
                                <ul class="friends-tab margin-bottom">
                                    <li class="active"><a href="#following" data-toggle="tab">Received Requests</a></li>
                                    <li><a href="#follow" data-toggle="tab">Sent Requests</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="following" >
                                        <div class="no-padding">
                                        @if(count($received) == 0)
                                         <h1 class="text-center no-friends-h1">You currently have no request for friendship.</h1>
                                        @endif
                                            <ul class="products-list product-list-in-box">
                                        @foreach($received as $res)
                                                <li class="item pull-left full-width-item" id="user{{$res->id}}">
                                                    <div class="pull-left col-md-8">
                                                        <div class="product-img">
                                                          <a href="{{ asset($res->display_name) }}"> 
                                                            <img class="img-square" src="{{ asset($res->name) }}" alt="User Picture">
                                                            </a>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="{{ asset($res->display_name) }}" class="product-title">
                                                                {{ $res->first_name.' '.$res->last_name }}
                                                            </a>
                                                            <span class="product-description product-username">
                                                              &#64;{{ $res->display_name }}
                                                            </span>
                                                            <span class="product-description">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="buttons-followUn" id="box{{$res->id}}">
                                                        <a class="btn btn-primary btn-sm" id="confirm-friend" data="{{$res->id}}">Confirm</a>
                                                        <a class="btn btn-default btn-sm" id="unfriend"  data="{{$res->id}}"> Delete Request</a>
                                                    </div>
                                                </li><!-- /.item -->
                                        @endforeach                                                   
                                            </ul>



                                            <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>

                                    </div>

                                    <div class="no-padding tab-pane" id="follow" >
                                        <div class="no-padding">
                                    @if(count($send) == 0)
                                            <h1 class="text-center no-friends-h1">You have no sent a request for friendship.</h1> 
                                    @endif    
                                            <ul class="products-list product-list-in-box">
                                    @foreach($send as $rs)
                                                <li class="item pull-left full-width-item">
                                                    <div class="pull-left col-md-8">
                                                        <div class="product-img">
                                                         <a href="{{asset($rs->display_name)}}" class="product-title">
                                                            <img class="img-square" src="{{ asset($rs->name) }}" alt="User Picture">
                                                            </a>
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="{{asset($rs->display_name)}}" class="product-title">
                                                                {{ $rs->first_name.' '.$rs->last_name }}
                                                            </a>
                                                            <span class="product-description product-username">
                                                              &#64;{{ $rs->display_name }}
                                                            </span>
                                                            <span class="product-description">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="buttons-followUn" id="{{$rs->id}}" >
                                                    <a class="btn btn-default btn-sm" id="cancel-friend-request" data="{{$rs->id}}">Cancel Request</a>
                                                    </div>
                                                </li><!-- /.item -->
                                        @endforeach            
                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>

                                </div>

                                <div class="white-bg no-padding tab-pane" id="search" >

                                    <div class="clear"></div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.col -->
                </div>

    
                <!-- /.row -->
    </section>
<script type="text/javascript">/*
// Received Requests Tab -- Confirm friend request
$(document).on("click", "#confirm-friend", function(){
    var id    = $(this).attr("data"); // get user id
    var button = document.getElementById('box'+id);

    $.ajax({
                  url: '{{ asset('/friend-confirm') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          button.innerHTML = '<div class="btn-group"><button data="'+id+'" type="button" class="btn btn-default btn-flat ff-btn unfriend" id="unfriend"> <span class="follow-txt"><i class="fa fa-check margin-r-5" aria-hidden="true"></i>Friends</span></button></div>';   
                      }
                  }
              });   
});
// Received Requests Tab -- Unfriend && Delete Request
$(document).on("click", "#unfriend", function(){
        var id    = $(this).attr("data"); // get user id
        var button = document.getElementById('user'+id);

            $.ajax({
                  url: '{{ asset('/unfriend') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                            button.innerHTML = '';
                      }
                  }
              });   
});
// Sent Requests tab - send friend request
$(document).on("click", "#send-request", function(){
        var id    = $(this).attr("data"); // get user id
        var button = document.getElementById(id);
          $.ajax({
                  url: '{{ asset('/friend-request') }}',
                  type: 'POST',
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          button.innerHTML = '<a class="btn btn-default btn-sm" id="cancel-friend-request" data="'+id+'">Cancel Request</a>';   
                      }
                  }
              });   
  });
// Sent Requests tab - cancel sent requests
$(document).on("click", "#cancel-friend-request", function(){
        var id    = $(this).attr("data"); // get user id 
        var button = document.getElementById(id);
            $.ajax({
                    url: '{{ asset('/unfriend') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {id2: id},
                    success: function (data) {
                      if (data == 200) {
                          button.innerHTML = '<a class="btn btn-default btn-sm" id="send-request" data="'+id+'"><b><i class="fa fa-user-plus"></i> Add Friend</b></a>'; 
                      }
                  }
              });  
  });*/
// Sent Requests tab - cancel sent requests /END

// SEARCH REQUEST LIST

</script>
@endsection

