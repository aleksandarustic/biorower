@extends('layouts.main')

@section('content')
    <!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-md-9">
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
        <div class="pull-left col-md-8">
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
                  <div class="buttons-followUn" id="user{{$friend->id}}">
                    <div class="btn-group"><button data="{{$friend->id}}" type="button" class="btn btn-success btn-flat ff-btn unfriend" id="unfriend"> <span class="follow-txt"><i class="fa fa-check margin-r-5" aria-hidden="true"></i>Friends</span></button></div>
                  </div>
                @elseif($friend->sfriend == 0)
                 <div class="buttons-followUn" id="{{$friend->id}}">
                  <a class="btn btn-primary btn-sm" id="send-request" data="{{$friend->id}}"><b><i class="fa fa-user-plus"></i> Add Friend</b></a>
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
</script>
@endsection
