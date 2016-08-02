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
			 editable: true,
            selectable: true,
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
        				var nizid=[];
        				var sesije=[];
                        var ime=[];

       				 	for(var r=0;r<dd.length;r++){
        					nizid.push(dd[r].DateTime);
        					sesije.push(dd[r].sessionID);
                            if(dd[r].Name!=null && dd[r].Name!=""){
                                ime.push(dd[r].Name);
                            }
                            else{
                                datum2=dd[r].DateTime;
                                dat= new Date(datum2)
                                novi=j.fullCalendar.formatDate( dat, "dddd dd MMMM yyyy"); 

                                 ime.push("Session:"+novi);
                            }
                           
        					


        					}
        				for(var r=0;r<nizid.length;r++){
                          
                         
        					
        					 events.push({
                                          id:sesije[r],
       									  title:ime[r],
     									  start: nizid[r],
                                          description:"session:"+sesije[r],
                                          allDay:false
     									  
    									 });
        					 


        					}
        					callback(events);
        					
           	         	
                    	

                        
                        
                    } 
                }); 

            },
            eventMouseover: function(event, jsEvent, view) {
              

                        var tooltip = "<div class='tooltipevent' style='width:180px;height:180px;background:#ccc;position:absolute;z-index:10001;'><h3>"+event.title+"</h3><p><b>Start:</b>"+event.start+"<br /><p><strong><a href="+urlBase+"/profile/"+display_name+"/session/"+event.id+" >Read More</a></strong></p></div>";
            j("body").append(tooltip);
            j(this).mouseover(function(e) {
                j(this).css('z-index', 10000);
                j('.tooltipevent').fadeIn('500');
                j('.tooltipevent').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                j('.tooltipevent').css('top', e.pageY + 10);
                j('.tooltipevent').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function(event, jsEvent, view) {
    $(".tooltipevent").remove();
}
          







			 
		
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

