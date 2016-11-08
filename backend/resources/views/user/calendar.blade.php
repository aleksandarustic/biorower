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
               <h1 class="pull-left friends-pro-h1"><i class="fa fa-calendar text-aqua" aria-hidden="true"></i> Calendar:</h1>
               
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
            </div> <!-- /.nav-tabs-custom box-->
            <div class="row">
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-body no-padding">
                                  <div id='calendar'></div>
                  </div><!-- /.box-body -->
                </div><!-- /. box -->
              </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.col-md-9 friends-pro -->        

   
</div> <!-- /.row -->
</section> 
@endsection
@section('page-scripts')
<script src="{{ URL::asset('plugins/jQuery/jquery-1.5.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jQuery/jquery-ui-1.8.9.custom.min.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/moment.js') }}"></script>
<script>
    var j = jQuery.noConflict();

  j(document).ready(function() {
    j("#eventContent").hide();
    
    var urlBase       = "<?php echo Request::root() ?>";
    var email1        = "{{$user->email}}";  
    var display_name  = "{{$user->display_name}}"; 
    var email2        = "biorower:"+email1;
  
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var events = [];

    j('#calendar').fullCalendar({
            header: {
                left: 'today',
                center: 'prev title next',
                right: 'year,month,agendaWeek'
            },  

            titleFormat: {
                month: 'MMMM yyyy',
                week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
                day: 'MM/dd'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day',
                year: 'year'
            },
            draggable: false,
            showTime: false,

          dayClick: function(date, allDay, jsEvent, view) {
            // Clicked on the entire day
            j('#calendar').fullCalendar('changeView', 'agendaWeek'/* or 'basicDay' */)
                .fullCalendar('gotoDate',
              date.getFullYear(), date.getMonth(), date.getDate());
        
          },

        eventClick: function(calEvent, jsEvent, view) {
          window.location.href = urlBase+"/profile/"+display_name+"/session/"+calEvent.id;
        },

      defaultView: 'year',
      events: function( start, end, callback) { 
        var moment      = j('#calendar').fullCalendar('getDate');
        var start_date  = j('#calendar').fullCalendar('getView').start;
        var end_date    = j('#calendar').fullCalendar('getView').end;
        var view        = j('#calendar').fullCalendar('getView').name;
        start2          = j.fullCalendar.formatDate(start_date, 'yyyy-MM-dd hh:mm:ss');
        end2            = j.fullCalendar.formatDate(end_date, 'yyyy-MM-dd hh:mm:ss');

          // api get sessions calendar
          $.ajax({  
              url : urlBase + '/api/v1/sessions_calendar_data',
              type: 'POST',
              headers: {  _token: $('meta[name="csrf-token"]').attr('content') }, 
              data: { 
                      account: email2 ,
                      type:view,
                      dateStart:start2,
                      dateEnd:end2,
                    }, 
              success: function (doc) { 

                  var dd  = doc.sessionIdsUTCs;
                  var ime = [];
                  var datumf = [];
                  var timef = [];
              

                  for(var r=0;r<dd.length;r++){
                      d = new Date(dd[r].DateFormat);
                      datum7 = j.fullCalendar.formatDate( d, "ddS MMM yyyy");
                      datumf.push(datum7); 
                      vreme = new Date(dd[r].DateFormat);
                      vremef = j.fullCalendar.formatDate( vreme, "HH:mm:ss");
                      timef.push(vremef);

                            if(dd[r].Name!=null && dd[r].Name!=""){
                                ime.push(dd[r].Name);
                            }else{ // ukoliko ne postoji ime za sesiju, dodaj novi naziv
                                datum2  = dd[r].DateFormat;
                                dat     = new Date(datum2);
                                novi    = j.fullCalendar.formatDate( dat, "ddd ddS MMM yyyy"); 
                                ime.push("Session:"+novi);
                            }
                  events.push({
                                id:dd[r].sessionID,
                                title:ime[r],
                                start: dd[r].DateFormat,
                                datum: datumf[r],
                                time: timef[r],
                                description:dd[r].Description,
                                duration:dd[r].duration,
                                distance:dd[r].distance,
                                power:dd[r].power,
                                srate: dd[r].srate,
                                hr:dd[r].hr,
                                allDay:false
                              });                                
                  } // end for

                  callback(events);          
              } // SUCCESS DATA
            }); // ajax post end - api get sessions calendar data
      }, // end EVENTS function
      
      // TOOLTIP mouse hover
      eventRender: function(event, element) {
          $(element).popover({
              html      : true, 
              trigger   : "hover",
              title     : "<h3>Session:</h3>",
              placement : 'auto',
              container : 'body',
              content   : '<div class="row"><div class="col-md-6 col-xs-9"><strong>Date</strong><br><strong>Time</strong><br><strong>Lasting</strong><br><strong>Distance</strong><br><strong>Power</strong><br><strong>Stroke rate </strong><br><strong>Heart rate</strong></div><div class="col-md-6 col-xs-9" style="padding-right: 4px; padding-left:0;">: ' + event.datum+'<br>: ' + event.time+'<br>: '+event.duration+'<br>: '+event.distance+' {{config('parameters.dist.unit')}}<br>: '+event.power+' {{config('parameters.pwr_avg.unit')}}<br>: '+event.srate+' {{config('parameters.srate_avg.unit')}}<br>: '+event.hr+' {{config('parameters.hr_avg.unit')}}</div></div>',
          });             
      },
    });

    // KLIK NA MESEC - changeView to month
    j(".fc-widget-content").click(function(){
        var month   = $(this).attr('month');
        var year    = $(this).attr('year');

        j('#calendar').fullCalendar('changeView', 'month')
                .fullCalendar('gotoDate', year, month, 0);
    });

  });

// UNFRIEND - cancellation friendship
  $(document).on("click", "#unfriend-button", function(){
        var id    = "<?php echo $user->id; ?>";
        var name  = "<?php echo $user->display_name; ?>";
        var url = '{{ URL::asset('') }}';
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