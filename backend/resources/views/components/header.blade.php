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

                <li class="dropdown notifications-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="friend-requests"> <i class="fa fa-users"></i> <span class="label label-warning" id="num-new-req"></span> </a>
                    <ul class="dropdown-menu menu-requests" style="width: 400px;">
                        <li class="header">Friend Requests</li>
                        <li>
                            <ul class="menu" id="received-req">
                                <li class="text-center"><br><img src="{{ URL::asset('images/ajax-loader.gif') }}"/></li>
                            </ul>
                        </li>
                        <li class="footer"><a href="{{url('/profile/friends/requests')}}">View all</a></li>
                    </ul>
                </li>
                
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu"> <a href="#"  data-toggle="control-sidebar" id="chat-view"> <i class="fa fa-comment-o"></i> 
                <span class="label label-success" id="num-new-msg"></span>
                 </a>
              
                </li>
             
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notifications-new"> <i class="fa fa-bell-o"></i><span class="label label-success" id="num-new-notif">@if($numnewnotifications) {{$numnewnotifications}} @endif</span> </a>

        <ul class="dropdown-menu" style="width: 400px;">
            <li class="header">Notifications</li>
            <li class="infinite-notif">
                <ul class="menu" id="notifications-box"> 
                        <li class="text-center"><br><img src="{{ URL::asset('images/ajax-loader.gif') }}"/></li>
                </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
        </ul>
    </li>  <!-- Notifications END: dropdown menu -->

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
        <div class="nav-search pull-right">
            <div class="sidebar-form">
                <div class="col-md-8">
                        <select class="form-control col-md-12 search-users"> 
                            <option value="3620194" selected="selected">Search users...</option>
                        </select>
                </div>
            </div>
        </div>
        <!-- /.search form -->

    </nav>
</header>
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>  
<script src="{{ URL::asset('dist/js/select2.min.js') }}"></script>
<script>
$(document).ready(function() {
        var span = document.getElementById('num-new-req');
        var span1 = document.getElementById('num-new-msg');
        var span2 = document.getElementById('num-new-notif');

        var user = 'private-<?php echo Auth::user()->id;?>';
        var asset = '{{ asset('') }}';
        $.ajax({
                url: '{{ asset('/new-requests') }}',
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data > 0) {
                            span.innerHTML = data;
                    }
                }
        });

        $.post( "{{ asset('/num-new-messages') }}", function( data ) {
                    if(data.length > 0){ span1.innerHTML = data.length; }               
        }); 

        var channel = pusher.subscribe('requests');
            channel.bind( user, function(data) {
                    $.ajax({
                        url: '{{ asset('/new-requests') }}',
                        type: 'POST',
                        dataType: 'json',
                        success: function (data) {
                            if (data > 0) {
                                    span.innerHTML = data;
                            }
                        }
                    });
            });
   
        function addNotification(data) {
                $.post( "{{ asset('/num-new-notifications') }}", function( data ) {
                    if(data > 0){  span2.innerHTML = data;  }
                }); 
        }

        channelNotif.bind('notifuser-{{Auth::id()}}', addNotification);   

        // Show number of new messages from each friend
        function showNotif{{Auth::user()->id}}(data) {
            var span1           = document.getElementById('num-new-msg');
                span1.innerHTML = data.length;

            $.each(data, function(index, v) {
                    $( '#new-msg-'+v.sender_user_id ).empty();
                    $( '#new-msg-'+v.sender_user_id ).append(v.nummsg); 
            });
        }

        channelChat.bind('chat-notif-{{Auth::user()->id}}', showNotif{{Auth::user()->id}});

// CLICK ON ICON FOR NOTIFICATIONS:
$(document).on("click", "#notifications-new", function(event){
    $('#notifications-new').attr('id', 'notifications-close');
    var boxNotifications = $('#notifications-box');

    $.post('{{asset("/get-new-notifications")}}', function(data) {
            if(data){-
                    boxNotifications.empty();
                    boxNotifications.html(data);
                    span2.innerHTML = '';  
            }
    }); // end post
    window.onclick = myFunction;
    function myFunction() {
        $('#notifications-close').attr('id', 'notifications-new');
    }
}); // end click NOTIFICATIONS ICON

$(document).on("click", "#notifications-close", function(){
    $(this).attr('id', 'notifications-new');
});


 $(document).on("click", "#friend-requests", function(event){
        event.stopPropagation();
        var viewreq = '{{ asset('/view-newreq') }}';

        $.ajax({
                url: '{{ asset('/friends/received-req') }}',
                type: 'GET',
                headers: {  _token: $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',
                success: function (data) {
                        $("#received-req li").empty();
                    if(data == 0){
                        $("#received-req").append('<li> <b> No friend requests. </b></li>');        
                    }else{
                        $.each(data, function(index, v) {
                             $("#received-req").append('<li> <a href="#"><img class="img-square" width="50" src="'+asset+''+v.name+'" alt="User Picture">  <b> '+v.first_name+' '+v.last_name+' </b> <div style="float: right;" class="text-center" id="box'+v.id+'"><span class="btn btn-primary btn-sm" id="confirm-friend" data="'+v.id+'">Confirm</span> <span class="btn btn-default btn-sm" id="unfriend"  data="'+v.id+'"> Delete </span></div></li></a>');
                        });
                    }
                $.post(viewreq);
                span.innerHTML = '';
                } // end success ajax data
        }); // end ajax
}); // end click on FRIEND RECEIVED REQUESTS


$(document).on("click", "#chat-view", function(event){
    event.preventDefault();
    $(this).attr('id', 'close-sidebar-box');

        $.ajax({
                url: '{{ asset('/friend-chat-list') }}',
                type: 'POST',
                dataType: 'json',
                headers: {  _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                        $("#friend-chat-list").empty();
                    if(data == 0){
                        $("#friend-chat-list").append('<li> <b> No friends. </b></li>');        
                    }else{
                        $.each(data, function(index, v) {
                        var rezultat = '<li class="row-chat"><a href="#chat-'+v.id_chat+'" data-toggle="collapse" id="view-box-msg" data="'+v.id+'" class="'+v.id_chat+'"><div class="pull-left chat-user-image"><img src="'+asset+''+v.name+'" class="img-circle" alt="User Image"></div>             <div class="menu-info>   <h4 class="control-sidebar-subheading chat-search-class"> '+v.first_name+' '+v.last_name+' <span class="label label-warning" id="new-msg-'+v.id+'"></span></h4>';
                        if( v.online == 1){
                            rezultat += ' <p class="user-state"> <i class="fa fa-circle text-success"></i> Online</p>';
                        }
                            rezultat += '</div></a></li>';
                            $("#friend-chat-list").append(rezultat);  
                        });
                                             
                        $.post( "{{ asset('/chat-box') }}", function( data ) {
                                $( '#chat-boxes' ).empty();
                                $( "#chat-boxes" ).html( data );
                        });  
                        $.post( "{{ asset('/num-new-messages') }}", function( data ) {
                                $.each(data, function(index, v) {
                                    $( '#new-msg-'+v.sender_user_id ).empty();
                                    $( '#new-msg-'+v.sender_user_id ).append(v.nummsg);
                                });
                        });        
                    }
             } // end success ajax data
        }); // end ajax
}); // end click on VIEW CHAT BAR


}); // end document.ready
// Received Requests Tab -- Confirm friend request
$(document).on("click", "#confirm-friend", function(event){
    event.stopPropagation();
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
                      $('.menu-requests').addClass('open'); // Opens the dropdown

                  }
              });   
});

// Received Requests Tab -- Unfriend && Delete Request
$(document).on("click", "#unfriend", function(){
        var id    = $(this).attr("data"); // get user id
        var button = document.getElementById('user'+id);
        vex.dialog.confirm({
            message: 'Are you sure you want to remove a friend?',
            callback: function (value) {
                if(value == true){
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
                }        
        } });           
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
  });
// Sent Requests tab - cancel sent requests /END


/*******  SEARCH USERS - BEGIN  *******/
function formatRepo (repo) {
      if (repo.loading) return repo.text;

      var markup = "<a href='{{asset('')}}"+repo.username+"'><div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar'><img src='{{ asset('') }}"+repo.avatar+"' /></div>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'>" + repo.text + "</div>";

        markup += "<div class='select2-result-repository__description'>@" + repo.username + "</div></div> </div> </a>";
      

      /*markup += "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> 23 Forks</div>" +
        "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> 33  Stars</div>" +
        "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> 44 Watchers</div>" +
      "</div>" +
      "</div></div>";*/

      return markup;
    }

function formatRepoSelection (repo) {
      return repo.full_name || repo.text;
}

$(".search-users").select2({
    minimumInputLength: 2,
        ajax: {
            url: "{{asset('search')}}",
            dataType: 'json',
            type: 'POST',
            delay: 250,
            headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: function (params) {
                return {
                        search_name: params.term, // search term
                };
        },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                                    text:       item.first_name+' '+item.last_name,
                                    username:   item.display_name,
                                    avatar:     item.name,
                                    id:         item.id
                                }
                    })
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        templateResult: formatRepo, 
        templateSelection: formatRepoSelection 
});
// 
$('.search-users').on('select2:select', function (evt) {
        window.location.href =  '{{asset('')}}'+evt.params.data.username;
});
/*******  SEARCH USERS - END  *******/
</script>
