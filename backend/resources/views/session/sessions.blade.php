

@extends('layouts.main')

@section('content')
 	<!-- Main content -->
 <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
   <script type="text/javascript">


        
 

</script>   



<section class="content">


    
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">My Sessions</h3>
				</div><!-- /.box-header -->
				<!-- Check all button -->

				<div class="box-body sessions-table">
				 <a class="pull-right btn-param" href="#" data-toggle="modal" data-target="#myParam" style="visibility:hidden;"><i class="fa fa-cog" >Filter parametars</i></a>
					

					<!-- /.pull-right -->
					<table id="my-sessions" class="table table-hover table-bordered table-striped">
						<thead>
						<tr>
							<th class="nosort">x</th>
							<th class="hiden" style="display:none;">id</th>
						    <th class="nosort">Session</th>
							<th class="nosort">Description</th>
							<th class="nosort">Date</th>
							<th class="nosort">Power</th>
							<th class="nosort">Distance</th>
							<th class="nosort">HR</th>
							<th class="nosort">Time</th>
							
							
							<th class="hiden" style="display:none;">Speed</th>
							<th class="hiden" style="display:none;">Angle</th>
							<th class="hiden" style="display:none;">Pace</th>
							<th class="hiden" style="display:none;">Power Max</th>
							<th class="hiden" style="display:none;">Power Balance</th>
							<th class="hiden" style="display:none;">Stroke Rate</th>
							<th class="hiden" style="display:none;">Stroke Rate Max</th>
							<th class="hiden" style="display:none;">Hearth Rate Max</th>
							<th class="hiden" style="display:none;">Strokes</th>
							<th>action</th>
							
							
							
						</tr>
						</thead>
						<tbody id="tabela4">
					
					</table>
					<!-- Edit Session -->




					<div class="example-modal">
						
					     <div class="modal" id="myParam">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header no-border">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-param">
                                                    <h2>Choose parametars</h2>
                                                    <p>Choose three parametars from the list</p>
                                                </div>
                                                <!-- List of Parametars -->
                                                <div id="history-graph-params" class="param-box">
                                                    <ul class="checkbox icheck modalParm-list">
                                                        <li>
                                                            <label for="speed">
                                                                <input type="checkbox" name="parameters" id="speed" value="speed">
                                                                speed
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="angle">
                                                                <input type="checkbox" name="parameters" id="angle" value="angle">
                                                                angle
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                      
                                                        <li>
                                                            <label for="pace">
                                                                <input type="checkbox" name="parameters" id="pace" value="pace" >
                                                                pace
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="power_max">
                                                                <input type="checkbox" name="parameters" id="power_max" value="power_max" >
                                                                power_max
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="power_balance">
                                                                <input type="checkbox" name="parameters" id="power_balance" value="power_balance">
                                                                power_balance
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="stroke_rate">
                                                                <input type="checkbox" name="parameters" id="stroke_rate" value="stroke_rate">
                                                                stroke_rate
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="stroke_rate_max">
                                                                <input type="checkbox" name="parameters" id="stroke_rate_max"  value="stroke_rate_max">
                                                                stroke_rate_max
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        
                                                        <li>
                                                            <label for="Heart Rate Max">
                                                                <input type="checkbox" name="parameters" id="Heart Rate Max" value="Heart Rate Max">
                                                                Heart Rate Max
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                      
                                                        
                                                       <!-- End Parametar Item -->
                                                    </ul><!-- /.contatcts-list -->


                                                </div><!-- /.List of Parametars -->
                                                 <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                <button type="button" id="potvrda" class="btn btn-primary margin-r-5" 
                                                        onclick="
                                                                 $('#myParam').modal('hide');">
                                                    Save changes
                                                </button>
                                            </div>
                                            </div>


										</div>
										  </div>
					             </div>


					</div>
					<div class="example-modal">






						<div class="modal" id="edit-session">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Edit Session</h4>
									</div>
									<div class="modal-body">

										<form id="edit-train-session">
											<h5 class="text-blue bold">Name</h5>
											<input type="text" class="oneLine-input" placeholder="Name of the session" id="imesesije">
											<h5 class="text-blue bold">Comment</h5>
											<textarea rows="4" placeholder="I need to work on my strength" class="oneLine-input" id="text"></textarea>
										</form>
										</form>

									</div>
									<div class="modal-footer no-border">
										<button type="button" class="btn btn-primary pull-left" id="dugme5" data-dismiss="modal"><i class="fa fa-edit margin-r-5"></i> Save changes</button>
										<button type="button" class="btn btn-default pull-left"  data-dismiss="modal"><i class="fa fa-times margin-r-5"></i> Cancel</button>
									</div>

								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- / end of Edit Session -->

					<!-- Remove Session -->
					<div class="example-modal">
						<div class="modal" id="delete-session">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" id="dugme" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Delete Session</h4>
									</div>
									<div class="modal-body">

										<h4>Are you sure you want to delete thid session?</h4>

									</div>

									<div class="modal-footer no-border">
										<button type="button" class="btn btn-default pull-right"  data-dismiss="modal"><i class="fa fa-times margin-r-5"></i> Cancel</button>
										<button type="button" class="btn btn-primary pull-right margin-r-5" id="dugme3" data-dismiss="modal"><i class="fa fa-check margin-r-5"></i> OK</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- / end of Remove Session -->

				</div><!-- /.box-body -->

			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
</div>



</div>
<!-- /.row -->
</section><!-- /.content -->

@endsection
@section('page-scripts')
		<!-- DataTables -->
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
	function OnloadFunction ()
{   
	$(".hiden").hide();

  










     var urlBase = "<?php echo Request::root() ?>";
     var email1="<?php echo Auth::user()->email ?>"; 
     var display_name= "<?php echo Auth::user()->display_name ?>"; 
     var email2="biorower:"+email1;
		  			
		    	$.ajax({ 
		        type: 'POST', 
		        dataType: 'json',
		        url : urlBase + '/api/v1/sessions_recent_list',
		        data: {account: email2 ,offset:0,pageSize:80000
		      

		    }, 
		        success: function (data) {

		        	var dat=data;
		        	
		        	delete dat.account;

		        	
		        	
		        	
		        	dat= JSON.parse(JSON.stringify(dat).split('"sessionsRecentList":').join('"data":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"ID":').join('"id":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"date":').join('"Date":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"UTC":').join('"Strokes":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"name":').join('"Session":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"description":').join('"Description":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"time":').join('"Time":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"dist":').join('"Distance":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"pwr_avg":').join('"Power":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"hr_avg":').join('"HR":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"speed":').join('"Speed":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"pwr_max":').join('"Power Max":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"pwr_balance":').join('"Power Balance":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"stroke_rate":').join('"Stroke Rate":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"stroke_rate_max":').join('"Stroke Rate Max":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"hr_rate_max":').join('"Heart Rate Max":'));

		        	var d=dat.data;
		        	

		        	  for(var i=0;i< d.length; i++){
	
		        	  	var ime=d[i].Session;
		        	  	    d[i].x=i+1;

		        	  	  
					        d[i].action="<span> <a href='#' class='update'  id="+d[i].id+" data-toggle='modal' data-target='#edit-session'><i class='fa fa-edit inline btn btn-sm btn-default'></i></a><a class='brisi' id="+d[i].id+" href='#'' class='mailedit-box-attachment-name' data-toggle='modal' data-target='#delete-session'><i class='fa fa-trash-o inline btn btn-sm btn-primary'></i></a </span>";
					      
					          if (ime === undefined || ime == null) {
					          	   var datum=new Date(d[i].Date);
					          	   var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
									var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

									var day = days[ datum.getDay() ];
									var month = months[ datum.getMonth() ];
								   d[i].Session="<a href='"+urlBase+"/profile/"+display_name+"/session/"+d[i].id+"'>Session:"+day+","+datum.getDate()+"."+month+" "+datum.getFullYear()+"</a>";
								}
							if(ime !=null){
								for (var i2 = 0; i2 < ime.length; i2++) {
						       d[i].Session="<a href='"+urlBase+"/profile/"+display_name+"/session/"+d[i].id+"'>"+d[i].Session+"</a>";
						}
								
							}
					   


					        
					      

					      }





		        
		        	
		        	

		      
		       
		  	var table= $('#my-sessions').DataTable({
		  	     	"data":d,
		  	     	"columns":[
		  	     	{ 'data'  : 'x' },
		  	     	{ 'data' : 'id' },
		  	     	{ 'data' : 'Session' },
		  	     	{ 'data' : 'Description' },
		  	     	{ 'data' : 'Date' },
		  	     	{ 'data' : 'Power' },
		  	     	{ 'data' : 'Distance' },
		  	     	{ 'data' : 'HR' },
		  	     	{ 'data' : 'Time' },
		  	     	{ 'data' : 'Speed' },
		  	     	{ 'data' : 'Angle' },
		  	     	{ 'data' : 'Pace' },
		  	     	{ 'data' : 'Power Max' },
		  	     	{ 'data' : 'Power Balance' },
		  	     	{ 'data' : 'Stroke Rate' },
		  	     	{ 'data' : 'Stroke Rate Max' },
		  	     	{ 'data' : 'Heart Rate Max' },
		  	     	{ 'data' : 'Strokes' },
		  	     	{ 'data' : 'action' }			  	       	    
		  	     	],
		  	     	responsive: true,
		  	     	'iDisplayLength': 100
					
					});
	$("tr > td:nth-child(2)").hide();

    $("tr > td:nth-child(10)").hide();
     $("tr > td:nth-child(11)").hide();
     $("tr > td:nth-child(12)").hide();
     $("tr > td:nth-child(13)").hide();
     $("tr > td:nth-child(14)").hide();
     $("tr > td:nth-child(15)").hide();
     $("tr > td:nth-child(16)").hide();
     $("tr > td:nth-child(17)").hide();
     $("tr > td:nth-child(18)").hide();




     $('#my-sessions').delegate('tbody > tr > td:nth-child(-n +17)', 'click', function ()
{
	var eee =$(this).closest('tr');
	var id4=eee.find('td:eq(1)').text();
	

    
   window.location.href = urlBase+"/profile/"+display_name+"/session/"+id4;
});
     


		$("#potvrda").click(function(){
     	var niz=[];
     	
     	niz=document.getElementsByName("parameters");
     	
     	 for(var i=0;i< niz.length; i++){
     	 	if(niz[i].checked==true){
     	 		$(".hiden").eq(i+1).show();
     	 		var broj=i+10;
     	 		

     	 		 $('tr > td:nth-child('+broj+')').show();


     	 	}
     	 	if(niz[i].checked==false){
     	 		$(".hiden").eq(i+1).hide();
     	 		var broj=i+10;
     	 		

     	 		 $('tr > td:nth-child('+broj+')').hide();
     	 		


     	 	}

     	}


     });


		 
	
  	 $(".brisi").click(function() {
  		
        	var w=$(this).attr('id');
     		var e =$(this).closest('tr');
     		   $("#dugme3").unbind().click(function() {
     		   	 $.ajax({ 
        type: 'POST', 
        dataType: 'json',
        url : urlBase + '/api/v1/delete_session',
        data: {account: email2 ,id: w,
      

    }, 
        success: function (data3) {


 	e.remove();



        	
         }
     })



     		   	



     		   });

   				  });

  
  		 $(".update").unbind().click(function() {
		       		  
			 w=$(this).attr('id');
  
  			var ee =$(this).closest('tr');
  			var broj=ee[0]._DT_RowIndex;

  			document.getElementById("imesesije").value= ee.find('td:eq(2)').text();
  			document.getElementById("text").value=ee.find('td:eq(3)').text();


		   

		       		   $("#dugme5").unbind().click(function() {
		       		  
     		   	 $.ajax({ 
        type: 'POST', 
        dataType: 'json',
        url : urlBase + '/api/v1/sessions_edit',
        data: {account: email2 ,id: w,name:document.getElementById("imesesije").value,description:document.getElementById("text").value
      

    }, 
        success: function (data4) {
        	 var cell = table.cell(broj,2);
        	 var cell2 = table.cell(broj,3);
        	 cell.data("<a href='"+urlBase+"/profile/"+display_name+"/session/"+w+"'>"+document.getElementById("imesesije").value+"</a>");
        	 cell2.data(document.getElementById("text").value);


        	

        	
 	



        	
         }
     })



     		   	



     		   });



   				  });







		   }
		});
		        	
		        };












$(document).ready(function(){

	OnloadFunction();
});



	


</script>
@endsection





