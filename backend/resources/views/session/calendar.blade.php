@extends('layouts.main')

@section('content')
<section class="content">

<!-- Page specific script -->

<script src="{{ URL::asset('plugins/jQuery/jquery-1.5.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jQuery/jquery-ui-1.8.9.custom.min.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/moment.js') }}"></script>

	<script>
    var j = jQuery.noConflict();


	j(document).ready(function() {
         j("#eventContent").hide();
    
		var urlBase = "<?php echo Request::root() ?>";
        var email1="<?php echo Auth::user()->email ?>";  
        var display_name= "<?php echo Auth::user()->display_name ?>"; 
   
        var email2="biorower:"+email1;

	
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
                      d = new Date(dd[r].DateTime);
                      datum7 = j.fullCalendar.formatDate( d, "ddS MMM yyyy");
                      datumf.push(datum7); 
                      vreme = new Date(dd[r].DateTime);
                      vremef = j.fullCalendar.formatDate( vreme, "HH:mm:ss");
                      timef.push(vremef);

                            if(dd[r].Name!=null && dd[r].Name!=""){
                                ime.push(dd[r].Name);
                            }else{ // ukoliko ne postoji ime za sesiju, dodaj novi naziv
                                datum2  = dd[r].DateTime;
                                dat     = new Date(datum2);
                                novi    = j.fullCalendar.formatDate( dat, "ddd ddS MMM yyyy"); 
                                ime.push("Session:"+novi);
                            }
                  events.push({
                                id:dd[r].sessionID,
                                title:ime[r],
                                start: dd[r].DateTime,
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
	</script>


      <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body no-padding">

	       <div id='calendar'></div>
             </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

   

</section>


	<!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
@endsection
