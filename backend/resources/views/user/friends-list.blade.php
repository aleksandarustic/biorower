@extends('layouts.main')

@section('content')
    <!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-md-12">
  <div class="box box-primary">
    <div class="padding-all white-bg">
        <span class="pull-left act-h2"><i class="fa fa-users margin-right"></i>
        Friends -<a href="{{ asset( $user->display_name ) }}"> {{ $user->first_name. ' '. $user->last_name }}</a>
        </span>
                
        <div class="act-like-tabs pull-right col-md-7 search-friends">
                <div class="input-group col-md-12">
                  <i class="fa fa-search icon-search"></i>
                  <input type="text" id="myInput" class="form-control search-forFriends" onkeyup="SearchFriendsList(this)" placeholder="Search">
                </div><!-- /.input-group -->
        </div>

        <div class="clear"></div>
    </div>
<hr>  
<div class="white-bg col-left">
<div class="friends-tabs-custom row">
  
<div class="tab-content">
<div class="no-padding">
<ul class="products-list product-list-in-box" id="FriendsList">
  @if(count($friends) == 0)
        <h1 class="text-center no-friends-h1">No friends.</h1> 
  @endif  

  @foreach($friends as $friend)
    <li class="item pull-left full-width-item" id="user-item">
        <div class="pull-left col-md-11">
            <div class="product-img">
                <a href="{{asset($friend->display_name)}}">
                  <img class="img-square" src="{{ asset( $friend->name )}}" alt="User Picture">
                </a>
            </div>

            <div class="product-info">
                        <a href="{{asset($friend->display_name)}}" class="product-title" id="user-name">{{ $friend->first_name. ' '. $friend->last_name }}</a>
                        <span class="product-description product-username">
                           &#64;{{ $friend->display_name }}
                        </span>
            </div>
        </div>


                @if($friend->sfriend == 2)
                  <div class="buttonfriend" id="user{{$friend->id}}" style="margin-top: 25px;">
                 
                  <div class="btn-group" style="position: absolute;">
                      <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-check margin-r-5" aria-hidden="true"></i> <span class="follow-txt">Friends </span>
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        @if($friend->getstatus == 1)
                            <li id="id-getnotif-{{$friend->id}}"><a id="ungetnotification" data="{{$friend->id}}"><i class="fa fa-check" aria-hidden="true"></i> Get Notifications</a></li>
                        @else
                            <li id="id-getnotif-{{$friend->id}}"><a id="getnotification" data="{{$friend->id}}">Get Notifications</a></li>
                        @endif
                            <li><a href="#">  Block</a></li>                   
                            <li class="divider"></li>
                            <li><a href="#" id="unfriend" data="{{$friend->id}}"> Unfriend</a></li>
                      </ul>
                    </div>
                    </div>
                @elseif($friend->sfriend == 0)
                  <div class="buttonfriend" id="{{$friend->id}}" style="margin-top: 25px;">
                  <a style="position: absolute;" class="btn btn-primary btn-sm" id="send-request" data="{{$friend->id}}"><b><i class="fa fa-user-plus"></i> Add Friend</b></a>
                  </div>
                @endif  
    </li><!-- /.item -->
  @endforeach   
</ul>
 <div id="pagination" style="display: none">
   <div class="clear"></div>  
      {!! $friends->render() !!}</div>   
      </div>  
</div>
 <div class="clear"></div>       
</div>
  </div>
  </div> <!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
<script src="{{ URL::asset('dist/js/jquery.infinitescroll.min.js') }}"></script>

<script type="text/javascript">
// INFINITE SCROLL / load more users with scrolling
(function(){

    var loading_options = {
        finishedMsg: "No more results.",
        msgText: "Loading...",
        img: "{{ asset('images/ajax-loader.gif') }}",
    };

    $('ul.products-list').infinitescroll({
      loading : loading_options,
      navSelector : "#pagination .pagination",
      nextSelector : "#pagination .pagination li.active + li a",
      itemSelector : "#user-item"
    });

})();

function SearchFriendsList() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("FriendsList");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("product-info")[0];
        b = li[i].getElementsByClassName("product-username")[0];

        if (a.innerHTML.toUpperCase().indexOf(filter) > -1 || b.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// SELECT GET NOTIFICATION
  $(document).on("click", "#getnotification", function(event){
     event.stopPropagation();
      var id          = $(this).attr("data"); // get user id
      var notifButton = document.getElementById("id-getnotif-"+id);

          $.ajax({
                  url: '{{ asset('/get-notifications') }}',
                  type: 'POST',
                  headers: {  _token: $('meta[name="csrf-token"]').attr('content') }, 
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          notifButton.innerHTML = '<a id="ungetnotification" data="'+id+'"><i class="fa fa-check" aria-hidden="true"></i> Get Notifications</a>';
                      }
                  }
              });   
  });
// SELECT GET NOTIFICATION
// UN GET NOTIFICATION
  $(document).on("click", "#ungetnotification", function(event){
      event.stopPropagation();
      var id          = $(this).attr("data"); // get user id
      var notifButton = document.getElementById("id-getnotif-"+id);

          $.ajax({
                  url: '{{ asset('/unget-notifications') }}',
                  type: 'POST',
                  headers: {  _token: $('meta[name="csrf-token"]').attr('content') }, 
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                           notifButton.innerHTML = '<a id="getnotification" data="'+id+'">Get Notifications</a>';
                      }
                  }
              });   
  });
// UN GET NOTIFICATION
</script>
@endsection
