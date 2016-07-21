

@extends('layouts.main')

@section('content')
 	<!-- Main content -->
 <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
 <script src="{{ URL::asset('js/json2html.js') }}"></script>
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
					<div class="pull-right filter-btn">
						<button class="btn btn-default btn-sm" value="{{Auth::id()}}" id="dugme"><i class="fa fa-filter margin-r-5"></i> Filter parametars</button>
					</div>

					<!-- /.pull-right -->

					
					<table id="my-sessions" class="table table-hover table-bordered table-striped">
						<thead>
						<tr>
							<th class="smallest-th nosort">id</th>
						    <th class="nosort">Session</th>
							<th class="nosort">Comments</th>
							<th class="nosort">Date/Time</th>
							<th class="nosort">Power</th>
							<th class="nosort">Strokes</th>
							<th class="nosort">Distance</th>
							<th class="nosort">HR</th>
							<th class="nosort">Time</th>
							<th>action</th>
						</tr>
						</thead>
						<tbody id="tabela4">
					
					</table>
					<!-- Edit Session -->
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
											<input type="text" class="oneLine-input" placeholder="Name of the session">
											<h5 class="text-blue bold">Comment</h5>
											<textarea rows="4" placeholder="I need to work on my strength" class="oneLine-input"></textarea>
										</form>
										</form>

									</div>
									<div class="modal-footer no-border">
										<button type="button" class="btn btn-primary pull-left"><i class="fa fa-edit margin-r-5"></i> Save changes</button>
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

     var urlBase = "<?php echo Request::root() ?>";
     var email1="<?php echo Auth::user()->email ?>";   
     var email2="biorower:"+email1;
		  			
		    	$.ajax({ 
		        type: 'POST', 
		        dataType: 'json',
		        url : urlBase + '/api/v1/sessions_recent_list',
		        data: {account: email2 ,offset:0,pageSize:100
		      

		    }, 
		        success: function (data) {
		        	var dat=data;
		        	delete dat.account;
		        	dat= JSON.parse(JSON.stringify(dat).split('"sessionsRecentList":').join('"data":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"ID":').join('"id":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"date":').join('"Date/Time":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"UTC":').join('"Strokes":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"name":').join('"Session":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"comment":').join('"Comments":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"time":').join('"Time":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"dist":').join('"Distance":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"pwr_avg":').join('"Power":'));
		        	dat.data= JSON.parse(JSON.stringify(dat.data).split('"hr_avg":').join('"HR":'));
		        	var d=dat.data;

		        	  for(var i=0;i< d.length; i++){
					        d[i].action="<span> <a href='#' class='mailedit-box-attachment-name' data-toggle='modal' data-target='#edit-session'><i class='fa fa-edit inline btn btn-sm btn-default'></i></a><a class='brisi' id="+d[i].id+" href='#'' class='mailedit-box-attachment-name' data-toggle='modal' data-target='#delete-session'><i class='fa fa-trash-o inline btn btn-sm btn-primary'></i></a </span>";
					      }





		        
		        	
		        	

		      
		       
		  	var table= $('#my-sessions').DataTable({
		  	     	"data":d,
		  	     	"columns":[
		  	     	{ 'data' : 'id' },
		  	     	{ 'data' : 'Session' },
		  	     	{ 'data' : 'Comments' },
		  	     	{ 'data' : 'Date/Time' },
		  	     	{ 'data' : 'Power' },
		  	     	{ 'data' : 'Strokes' },
		  	     	{ 'data' : 'Distance' },
		  	     	{ 'data' : 'HR' },
		  	     	{ 'data' : 'Time' },
		  	     	{ 'data' : 'action' }
		  	     	],
		  	     	responsive: true,
		  	     	'iDisplayLength': 100
					
					});
	
  	table.on('click','.brisi',function(){
        		var w=$(this).attr('id');
     		  var e =$(this).closest('tr');
     		   $("#dugme3").click(function() {
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







		   }
		});
		        	
		        };












$(document).ready(function(){

	OnloadFunction();
});



	


</script>
@endsection

