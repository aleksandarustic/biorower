@extends('layouts.main')

@section('content')
<style> 
table tr {
    counter-increment: rowNumber;
}

table tr td:first-child::before {
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
}
</style>
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

               <!-- About Me Box -->
                <div class="box aboutMe-box">
                    <div class="aboutMe-body">
                        <div class="col-sm-6 about-border-r about-value-box">
                            <div class="about-desc latest-session"></div>
                            <div class="about-name">Latest Session</div>
                        </div>
                        <!-- Item 1 -->
                        <div class="col-sm-6 about-value-box">
                            <div class="about-desc time3"></div>
                            <div class="about-name">Training time</div>
                        </div>
                        <!-- Item 2 -->
                        <div class="col-sm-12 about-border-t">
                            <div class="col-sm-6 about-rowerIcon">
                                <img src="{{ asset('dist/img/rower-icon.png') }}">
                            </div>
                            <!-- Item 3.1 -->
                            <div class="col-sm-6 about-middle">
                                <div class="act-block about-value-box">
                                    <div class="about-value distance"></div>
                                    <div class="about-vname">Distance</div>
                                </div>
                                <!-- Item 3.2 -->
                                <div class="act-block about-value-box about-middle">
                                    <div class="about-value power-average"></div>
                                    <div class="about-vname">Power Average</div>
                                </div>
                                <!-- Item 3.3 -->
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="col-sm-12 about-border-t">
                            <div class="col-sm-6 about-value-box about-border-r">
                                <div class="about-value stroke-rate"></div>
                                <div class="about-vname about-vname-last">Stroke rate average</div>
                            </div>
                            <!-- Item 4 -->
                            <div class="col-sm-6 about-value-box">
                                <div class="about-value heart-rate-avg"></div>
                                <div class="about-vname about-vname-last">Heart rate average</div>
                            </div>
                            <!-- Item 5 -->
                        </div>
                    </div>
                    <div class="clear"></div>
                    <!-- /.box-body -->
                </div><!-- /.box -->
              
              <!--USER FRIENDS (show 8) -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-users margin-right text-blue"></i><a href="{{ asset($user->display_name.'/friends')}}"> Friends - {{count($friends)}} </a></h3>
                  </div>
			             <div class="box-body">
                    <div class="box-body no-padding">
                      <ul class="users-list clearfix">
                    @foreach($friends as $friend)  
                        <li>
                        <a class="" href="{{ asset('/'.$friend->display_name)}}">
                          <img src="{{asset($friend->name)}}" alt="{{ $friend->first_name.' '.$friend->last_name}}"><span class="users-list-name"> {{ $friend->first_name.' '.$friend->last_name}} </span>
                          <span class="users-list-date">&#64;{{$friend->display_name}}</span> </a>
                        </li>
                    @endforeach
                      </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center padding-bottom-zero">
                      <a href="{{ asset($user->display_name.'/friends')}}" class="uppercase">View All Friends</a>
                    </div><!-- /.box-footer -->
                  </div><!--/.box -->
              </div>
              <!--USER FRIENDS (show 8) -->
              
            </div><!-- /.col -->
            
			<div class="col-md-9 margin-bottom "> <!-- START TOTAL PARAMETERS -->
                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ $totalPar[config('parameters.sescnt.tag')][0] }}</h5>
                            <span class="description-text">{{ config('parameters.sescnt.title') }}</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{  gmdate(config('parameters.time.format'), $totalPar[config('parameters.time.tag')][0]) }}</h5>
                            <span class="description-text">Total training time </span>
                            <span class="description-percentage-small text-blue btn-block">{{ config('parameters.time.unit') }}</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalPar[config('parameters.tdist.tag')][0],
                            config('parameters.tdist.format') ) }}</h5>
                            <span class="description-text">Total Distance</span>
                            <span class="description-percentage-small text-blue btn-block">{{ config('parameters.tdist.unit') }}</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block">
                            <h5 class="description-header">{{ round($totalPar[config('parameters.pwr_avg.tag')][0], config('parameters.pwr_avg.format') ) }}</h5>
                            <span class="description-text">Total Power average </span>
                            <span class="description-percentage-small text-blue btn-block">{{ config('parameters.pwr_avg.unit') }}</span>
                        </div><!-- /.description-block -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalPar[config('parameters.tscnt.tag')][0], 0)}}</h5>
                            <span class="description-text">{{ config('parameters.tscnt.title') }}</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->

                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalPar[config('parameters.sdist_avg.tag')][0], config('parameters.sdist_avg.format')) }}</h5>
                            <span class="description-text">Total Stroke distance average </span>
                            <span class="description-percentage-small text-blue btn-block">{{ config('parameters.sdist_avg.unit') }}</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->

                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalPar[config('parameters.ang_avg.tag')][0], config('parameters.ang_avg.format')) }}</h5>
                            <span class="description-text">Total Angle average</span>
                            <span class="description-percentage-small text-blue btn-block">{{ config('parameters.ang_avg.unit') }}</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->

                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block">
                            <h5 class="description-header">{{ round($totalPar[config('parameters.hr_avg.tag')][0], config('parameters.hr_avg.format')) }}</h5>
                            <span class="description-text ">Total HR average</span>
                            <span class="description-percentage-small text-blue btn-block">{{ config('parameters.hr_avg.unit') }}</span>


                        </div><!-- /.description-block -->
                    </div>
                </div>
            </div>  <!-- END TOTAL PARAMETERS -->
             <!-- graph -->

              <div class="col-md-9 friends-pro no-shadow">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom box no-border transp-bg no-shadow">
               <h1 class="pull-left friends-pro-h1">Friend's Activities</h1>
               
               <div class="friends-btns-group">
               <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
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
               
                <ul class="nav nav-tabs friend-tabs">                
                  <li class="active"><a href="#timeline" data-toggle="tab"><i class="fa fa-clock-o margin-r-5" aria-hidden="true"></i> <span>Timeline</span></a></li>
                  <li><a href="#sessions-list" data-toggle="tab"><i class="fa fa-list margin-r-5" aria-hidden="true"></i> <span>Tranings</span></a></li>
                  <li><a href="{{asset($user->display_name.'/scalendar')}}"><i class="fa fa-calendar margin-r-5" aria-hidden="true"></i> <span> Calendar </span></a></li>
                  <li><a href="{{asset($user->display_name.'/graphs')}}"><i class="fa fa-line-chart margin-r-5" aria-hidden="true"></i> <span> Graphs </span></a></li>
                </ul>
                
                <div class="tab-content no-padding transp-bg">
                  <div class="tab-pane active" id="timeline">
<!-- Timeline -->
<section class="content no-padding">
  <!-- row -->
  <div class="row no-padding">
      <div class="">
      <ul class="scroll-timeline timeline">
<!-- timeline item -->
@foreach($posts as $ps)
  <li id="timeline-item">
      <i class="timeline-thumb"><img class="img-circle" src="{{asset($user->name)}}" alt="user image"></i>
<div class="timeline-item">
    <div class="">
              <!-- Box Comment -->
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="padding-b-5">
                    <span class="username timline-user"><a href="#">{{ $user->first_name }} {{$user->last_name}}</a></span>
                    <span class="description"><b>The new training saved.</b> - 
                      <a href="javascript:void(0)" data-toggle="timetip" data-placement="right" title="{{$ps->date_zone}}">{{$ps->time_ago}}</a>
                    </span>
                  </div><!-- /.user-block -->
                  <!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="">
                  <!-- post text -->
                  <!-- Attachment -->
                  <div class="attachment-block clearfix">
                    <img class="attachment-img" src="{{ asset($ps->image) }}" alt="attachment image">
                    <div class="attachment-pushed">
                      <h4 class="attachment-heading"><a href="{{asset("/profile/".$user->display_name."/session/".$ps->object_id)}}">{{$ps->session_name}}</a></h4>
                      <div class="attachment-text">
                        {{$ps->description}}<br>
                        Lasting:        {{$ps->total_time}}   <br>
                        Distance:       {{$ps->dist}}         <br>
                        Stroke count:   {{$ps->scnt}}         <br>

                      </div><!-- /.attachment-text -->
                    </div><!-- /.attachment-pushed -->
                  </div><!-- /.attachment-block -->
<ul class="list-inline comments-below">
<!-- Social sharing buttons - BEGIN -->
  <li>
    <div>
    <div class="btn-group">
          <button type="button" class="dropdown-toggle btn-link" data-toggle="dropdown" aria-expanded="false"><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a> </button>

    <ul class="dropdown-menu friends-share">
          <li class="li-tw"> <!-- Twitter -->
              <a rel="nofollow" data-shared="sharing-twitter-650" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=twitter&amp;nb=1" target="_blank" title="Click to share on Twitter"><i class="fa fa-twitter margin-r-5"></i> Twitter</a>
          </li>
          <li class="li-fb"> <!-- Facebook -->
            <a class="fb-xfbml-parse-ignore" rel="nofollow" data-shared="sharing-facebook-650" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F46.101.189.85%2Fprofile%2Fakvinskit%2Fsession%2F616&amp;src=sdkpreparse" target="_blank" title="Click to share on Facebook"><i class="fa fa-facebook margin-r-5"></i> Facebook</a>
          </li>
          <li class="li-goog"><!-- Google+ -->
            <a rel="nofollow" data-shared="sharing-google-650" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=google-plus-1&amp;nb=1" target="_blank" title="Click to share on Google+"><i class="fa fa-google-plus margin-r-5"></i> Google+</a>
          </li>
          <li class="li-pin"><!-- Pinterest -->
            <a rel="nofollow" data-shared="sharing-pinterest-650" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=pinterest&amp;nb=1" target="_blank" title="Click to share on Pinterest"><i class="fa fa-pinterest margin-r-5"></i> Pinterest</a>
          </li>
          <li><a href="#"><i class="fa fa-comment margin-r-5"></i> Share via message</a></li>
    </ul>
    </div>                    
    </div>                      
  </li>
<!-- Social sharing buttons - END -->
<!-- COMMENTS - BEGIN -->
  <li>
        <div><button class="no-button-look btn-fixed-width" data-widget="" data-toggle="tooltip" title="" style="margin-right: 5px;" id="show-comments"  data="{{$ps->object_id}}"><a href="javascript:void(0)" class="link-black text-sm" data="{{$ps->object_id}}"><i class="fa fa-comment-o margin-r-5"></i> Comments (<span id="numcoms{{$ps->object_id}}">{{$ps->coms}}</span>)</a></button></div>
  </li>
</ul> 
</div><!-- /.box-body -->                   
<div class="box-body box-comments collapse" id="ShowCommBox-{{$ps->object_id}}"> <!-- COMMENTS- START-->
      
      <div class="box-footer"> <!-- /.box-footer -->
          <img class="img-responsive img-circle img-sm" src="{{ URL::asset(Auth::user()->profile->image->name) }}" alt="alt text">
              <div class="img-push">
                  <input type="text" class="form-control input-sm no-border" placeholder="Press enter to post comment" id="addComment-{{$ps->object_id}}">
              </div>
      </div><!-- /.box-footer --> <br>
      <div id="com-box-{{$ps->object_id}}"></div>

      <div id="comm-load-more" class="text-center" style="display: none;"><img src="{{ URL::asset('images/ajax-loader.gif') }}"/></div>

  @if($ps->coms > 2)
      <div class="box-footer text-center" id="hidemorecomments{{$ps->object_id}}">
                      <a href="javascript:void(0)" class="uppercase" id="morecomments{{$ps->object_id}}" data="{{$ps->object_id}}">View more comments</a>
      </div><!-- /.box-footer -->
  @endif    

</div> <!-- /.box-comments --><!-- COMMENTS - END --> 

            </div><!-- /.box -->
     </div>
</div> <!-- /.timeline-item -->

</li><!-- END timeline item -->
<script type="text/javascript">
    function init{{$ps->object_id}}() {
        //$('#send-message-{{$ps->object_id}}').click(sendMessage{{$ps->object_id}});
        $('#addComment-{{$ps->object_id}}').keypress(checkSend{{$ps->object_id}});
    }
    // Send on enter/return key
    function checkSend{{$ps->object_id}}(e) {
        if (e.keyCode === 13) {
            return sendMessage{{$ps->object_id}}();
        }
    }
    // Handle the send button being clicked
    function sendMessage{{$ps->object_id}}() {
        var messageText = $('#addComment-{{$ps->object_id}}').val();
        if(messageText.length < 1) {
            return false;
        }
          var id2       = "{{$user->id}}";
          var ids       = "{{$ps->object_id}}";
       // Build POST data and make AJAX request
        var data = {text: messageText, ids: ids, id2: id2} ;
        $('#addComment-{{$ps->object_id}}').val('');
        $.post('{{ asset("/addComment")}}', data).success();
        // Ensure the normal browser event doesn't take place
        return false;
    }
    // Build the UI for a new message and add to the DOM
    function addMessage{{$ps->object_id}}(data) {
        var comm = "<div class='box-comment'><img class='img-circle img-sm' src='{{ URL::asset('')}}"+data.avatar+"' alt='user image'><div class='comment-text'><span class='username'>"+data.name+"  <span class='text-muted pull-right comment-date'>"+data.time_ago+"</span></span>"+data.text+"</div></div>";
        var messages = $('#com-box-{{$ps->object_id}}');
        var num      = $('#numcoms{{$ps->object_id}}');
        var broj     = $('#numcoms{{$ps->object_id}}').html();
        broj++;

        messages.prepend(comm);
        num.html(broj);
    }

        $(init{{$ps->object_id}});
        var com_page{{$ps->object_id}} = 1;

        // load more comments
  $(document).on("click", "#morecomments{{$ps->object_id}}", function(e){
      var id    = $(this).attr("data"); // get user id
      com_page{{$ps->object_id}}++;

      //$('#comm-load-more').show();
      $.post( "{{ asset('/getLatestComment') }}", {ids: id, num: 6, page: com_page{{$ps->object_id}}} ,function( data ) {
          if(data != 0){
                  //$('#comm-load-more').hide();
                  $( "#com-box-"+id ).append( data );
          }else{
              $("#hidemorecomments{{$ps->object_id}}").css('display', 'none');
             // $('#comm-load-more').hide();
          }
      });
  });
</script>
@endforeach       
<li>
    @if(count($posts) == 0)
      <b> The user does not have any announcement. </b>
    @endif  
</li>
<li><i class=""></i></li>  
<li>
  <div id="pagination" style="display: none; ">{!! $posts->render() !!}</div>
</li> 
            </ul>
            <br>

            </div><!-- /.col -->
          </div><!-- /.row -->

</section>
            <!-- /.Timeline -->
</div><!-- /.tab-pane -->
               
    <!-- Tranings List Table -->             
    <div class="tab-pane" id="sessions-list">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Sessions:</h3>
                </div><!-- /.box-header -->
                    <!-- Check all button -->
                <div class="box-body sessions-table">

                <!-- /.pull-right -->
                  <table id="my-sessions" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                          <th class="smallest-th nosort">#</th>
                          <th class="nosort">Session</th>
                          <th class="nosort">Date/Time</th>
                          <th class="nosort">Lasting {{ config('parameters.time.unit') }}</th>           
                          <th class="nosort">Power {{ config('parameters.pwr_avg.unit') }}</th>
                          <th class="nosort">Distance {{ config('parameters.dist.unit') }}</th>
                          <th class="nosort">HR {{ config('parameters.hr_avg.unit') }}</th>
                          <th class="nosort">Description</th>                    
                      </tr>
                    </thead>
                  <tbody>
                      @foreach($sessions as $session)    
                        <tr id="session-item">
                            <td data-title="#"></td>
                            <td data-title="name"><a href="{{ asset('profile/'.$user->display_name.'/session/'.$session['id'].'') }}">{{ $session['session_name'] }}</a></td>
                            <td data-title="Date/Time"><a href="{{ asset('profile/'.$user->display_name.'/session/'.$session['id'].'') }}">{{ $session['date_zone'] }}</a></td>
                            <td data-title="Time">{{ gmdate(config('parameters.time.format'), $session["time"]) }}</td>
                            <td data-title="Power">{{ round($session["power_average"], config('parameters.pwr_avg.format')) }}</th>
                            <td data-title="Distance">{{ round($session["distance"], config('parameters.dist.format')) }}</td>
                            <td data-title="HR">{{ round($session["heart_rate_average"], config('parameters.hr_avg.format')) }}</td>
                            <td data-title="Comments">{{ $session['short_desc'] }}</td>
                        </tr> 
                      @endforeach 
                  </tbody>         
                  </table>
               
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
            <!-- /.graph -->
            
          </div>
          </div><!-- /.row -->
          
</section><!-- /.content -->

@section('page-scripts')
<script type="text/javascript">
@foreach($posts as $post)
  channelComment.bind('comments-{{$post->object_id}}', addMessage{{$post->object_id}});
@endforeach
</script>
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
//  LATEST SESSION USER 
var email2 = 'biorower:' + $('#user-email').val();
    $.ajax({
            type: 'POST',
            dataType: 'json',
            url : '{{ asset('api/v1/sessions_recent_list') }}',
            data: {account: email2 ,offset:0,pageSize:1, web: 1},
            success: function (response) {
                var json = JSON.parse(JSON.stringify(response.sessionsRecentList));
                // PRIKAZ PODATAKA POSLEDNJE SESIJE
                if (response.sessionsRecentList.length !== 0) {
                    $('.time3').append(json[0].time);
                    $('.distance').append(json[0].dist);
                    $('.power-average').append(json[0].pwr_avg);
                    $('.heart-rate-avg').append(json[0].hr_avg);
                    $('.stroke-rate').append(json[0].srate);
                    var latest_session = json[0].date_zone;
                    $('.latest-session').append(moment(latest_session).format('MMM Do YYYY h:mm a'));
                }else{
                    $('.time').append('-');
                    $('.distance').append('-');
                    $('.power-average').append('-');
                    $('.heart-rate-avg').append('-');
                    $('.stroke-rate').append('-');
                    $('.latest-session').append('No workouts');
                }
            }
    });
//  LATEST SESSION USER
// Setting the table my sessions
$(document).ready(function() {
    var table = $('#my-sessions').DataTable({
        "paging"  :   true,
        "ordering":   true,
        "info"    :   false,
        "iDisplayLength": 25,
        language: {
           searchPlaceholder: "Search user sessions..."
        }
    });
// Time Tool tip!!
    $('[data-toggle="timetip"]').tooltip();
// Time Tool tip!!
});
// TABEL TRANINGS: click on session
/*$(document).on("click", "#session-item", function(){
        window.document.location = $(this).data("href");
});*/

// COMMENTS BOX SHOW LATEST TWO COMMENT - SHOW/HIDE 
$(document).on("click", "#show-comments", function(){
    var id    = $(this).attr("data"); // get user id
    $(this).attr('id', 'close-comments');

    $.post( "{{ asset('/getLatestComment') }}", {ids: id, num: 2} ,function( data ) {
          if(data != 0){
            $(  "#com-box-"+id ).html( data );
          }
            $(  "#ShowCommBox-"+id ).collapse( 'show' );
            $(  "#hidemorecomments"+id ).css('display', 'block');
    });
});
// comments hide
$(document).on("click", "#close-comments", function(){
    var id    = $(this).attr("data"); // get user id
    $(this).attr('id', 'show-comments');

    $("#ShowCommBox-"+id).collapse('hide');
    window['com_page'+id] = 1; 
});
// ***** COMMENTS 

// INFINITE SCROLL / ucitavanje jos sesija prilikom skrolovanja
(function(){
    var loading_options = {
        finishedMsg: "No more results.",
        msgText: "Loading...",
        img: "{{ asset('images/ajax-loader.gif') }}",
    };

    $('ul.scroll-timeline').infinitescroll({
      loading : loading_options,
      navSelector : "#pagination .pagination",
      nextSelector : "#pagination .pagination li.active + li a",
      itemSelector : "#timeline-item"
    });
})();

// UNFRIEND - cancellation friendship
  $(document).on("click", "#unfriend-button", function(){
        var id    = "<?php echo $user->id; ?>";
        var name  = "<?php echo $user->display_name; ?>";
        var url = '{{ URL::asset('') }}';
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
                                window.location.href = url+name;
                            }
                        }
                  });
              }
        } });   
  });
// UNFRIEND - cancellation friendship

// SELECT GET NOTIFICATION
  var id          = "<?php echo $user->id; ?>";
  var notifButton = document.getElementById("id-getnotif");

  $(document).on("click", "#getnotification", function(event){
     event.stopPropagation();
          $.ajax({
                  url: '{{ asset('/get-notifications') }}',
                  type: 'POST',
                  headers: {  _token: $('meta[name="csrf-token"]').attr('content') }, 
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                          notifButton.innerHTML = '<a id="ungetnotification"><i class="fa fa-check" aria-hidden="true"></i> Get Notifications</a>';
                      }
                  }
              });   
  });
// SELECT GET NOTIFICATION
// UN GET NOTIFICATION
  $(document).on("click", "#ungetnotification", function(event){
     event.stopPropagation();
          $.ajax({
                  url: '{{ asset('/unget-notifications') }}',
                  type: 'POST',
                  headers: {  _token: $('meta[name="csrf-token"]').attr('content') }, 
                  dataType: 'json',
                  data: {id2: id},
                  success: function (data) {
                      if (data == 200) {
                           notifButton.innerHTML = '<a id="getnotification">Get Notifications</a>';
                      }
                  }
              });   
  });
// UN GET NOTIFICATION
</script>
@endsection
@endsection
