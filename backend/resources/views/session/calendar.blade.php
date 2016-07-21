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
		var urlBase = "<?php echo Request::root() ?>";
        var email1="<?php echo Auth::user()->email ?>";  
   
        var email2="biorower:"+email1;

  






	



	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		 var events = [];


	
		j('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'year,month,agendaWeek,agendaDay'
			},
			editable: true,
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
        				var nizid=[];
        				var sesije=[]

       				 	for(var r=0;r<dd.length;r++){
        					nizid.push(dd[r].DateTime);
        					sesije.push(dd[r].sessionID);
        					


        					}
        				for(var r=0;r<nizid.length;r++){
        					
        					 events.push({
       									  title: sesije[r],
     									  start: nizid[r] 
     									  
    									 });
        					 


        					}
        					callback(events);
        					
           	         	
                    	

                        
                        
                    } 
                }); 

            }


			 
		
		});
		
	});
	</script>
  
	<div id='calendar'></div>

</section>


	<!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
@endsection

