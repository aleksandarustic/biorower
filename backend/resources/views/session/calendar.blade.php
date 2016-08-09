@extends('layouts.main')

@section('content')
<section class="content">

 





	

	<!-- Page specific script -->

<script src="{{ URL::asset('plugins/jQuery/jquery-1.5.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jQuery/jquery-ui-1.8.9.custom.min.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.js') }}"></script>

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
             titleFormat: {
                month: 'MMMM yyyy',
                week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
                day: 'MM/dd'
         },
             dayClick: function(date, allDay, jsEvent, view) {

        
            // Clicked on the entire day
            j('#calendar').fullCalendar('changeView', 'agendaWeek'/* or 'basicDay' */)
                .fullCalendar('gotoDate',
                    date.getFullYear(), date.getMonth(), date.getDate());
        
    },

            eventClick: function(calEvent, jsEvent, view) {
        window.location.href = urlBase+"/profile/"+display_name+"/session/"+calEvent.id;

    },

			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'year,month,agendaWeek'
			},			
            defaultView: 'year',
			events: function( start, end, callback) { 
				var moment = j('#calendar').fullCalendar('getDate');
				var start_date = j('#calendar').fullCalendar('getView').start;
                var end_date  = j('#calendar').fullCalendar('getView').end;
                var view = j('#calendar').fullCalendar('getView').name;
				start2 = j.fullCalendar.formatDate(start_date, 'yyyy-MM-dd hh:mm:ss');
				 end2= j.fullCalendar.formatDate(end_date, 'yyyy-MM-dd hh:mm:ss');

                $.ajax({ 
                    url : urlBase + '/api/v1/sessions_calendar_data',
                    type: 'POST', 
                    data: { 
                    	account: email2 ,
                    	type:view,
                    	dateStart:start2,
                    	dateEnd:end2,

                    }, 
                    success: function (doc) { 

                    	var dd=doc.sessionIdsUTCs;

                        var ime=[];

       				 	for(var r=0;r<dd.length;r++){
        			

                            if(dd[r].Name!=null && dd[r].Name!=""){
                                ime.push(dd[r].Name);
                            }
                            else{
                                datum2=dd[r].DateTime;
                                dat= new Date(datum2)
                                novi=j.fullCalendar.formatDate( dat, "dddd dd MMMM yyyy"); 

                                 ime.push("Session:"+novi);
                            }



                  
                   events.push({
                                          id:dd[r].sessionID,
                                          title:ime[r],
                                           start: dd[r].DateTime,
                                          description:dd[r].Description,
                                          duration:dd[r].duration,
                                          distance:dd[r].distance,
                                          power:dd[r].power,
                                          hr:dd[r].hr,
                                         
                                          allDay:false
                        
                       });
                           
        					


        					}


        					callback(events);
        					
           	         	
                    	

                        
                        
                    } 
                }); 

            },
                eventRender: function(event, element) {
               $(element).popover({
                html : true, 
                trigger: "hover",
            title: "<h3>"+event.title+"</h3>",
            placement: 'auto',
            container: 'body',
            content: '<strong>Description: </strong>' + event.description + '<br /><strong>DateTime:</strong> ' + event.start+'<br /><strong>Duration:</strong> '+event.duration+'<br /><strong>Distance: </strong>'+event.distance+'<br /><strong>Power: </strong>'+event.power+'<br /><strong>Hr: </strong>'+event.hr ,
        });             
  },



            
          







			 
		
		});
		j(".fc-year-monthly-td").click(function(){


              // Clicked on the entire day
            j('#calendar').fullCalendar('changeView', 'month'/* or 'basicDay' */)
                .fullCalendar('gotoDate',
                    date.getFullYear(), date.getMonth(), date.getDate());

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

