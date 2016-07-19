

@extends('layouts.main')

@section('content')
 	<!-- Main content -->
 <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
 <script src="{{ URL::asset('js/json2html.js') }}"></script>
   <script type="text/javascript">

function OnloadFunction ()
{   

     var urlBase = "<?php echo Request::root() ?>";
     var email1="<?php echo Auth::user()->email ?>";  
   
     var email2="biorower:"+email1;


	 


	    var prvi=document.getElementsByClassName("form-control input-sm");
   prvi[0].addEventListener("change", function(){
     	OnloadFunction()

   
});

  if(document.getElementsByClassName("form-control input-sm")[0].value==null){
  	document.getElementsByClassName("form-control input-sm")[0].value=10;
  }
 

	
	

	
   
     var urlBase = "<?php echo Request::root() ?>";
     var email1="<?php echo Auth::user()->email ?>";  
   
     var email2="biorower:"+email1;
 
  

     
    
  
 


        $.ajax({ 
        type: 'POST', 
        dataType: 'json',
        url : urlBase + '/api/v1/sessions_recent',
        data: {account: email2 ,maxCount: document.getElementsByClassName("form-control input-sm")[0].value,
      

    }, 
        success: function (data3) {
        	var dd=data3.sessionIdsUTCs;
        	var nizid=[];
        	for(var r=0;r<dd.length;r++){
        		nizid.push(dd[r].sessionID);


        	}






        	 $.ajax({ 
        type: 'POST', 
        dataType: 'json',
        url : urlBase + '/api/v1/sessions_get',
        data: {account: email2 ,sessionIds: nizid,
      

    }, 
        success: function (data2) { 
        	

       var sesije2=data2.sessions;
     
      
var transform = {
    tag: 'tr',
    children: [,{
        "tag": "td class='eee'",
            "html": ""
    }, {
        "tag": "td class='eeee'",
            "html": ""
    }, {
        "tag": "td",
            "html": "${Comment}"
    }, {
        "tag": "td",
            "html": "${date}"
    }, {
        "tag": "td",
            "html": "${summary.power_average}"
    }, {
        "tag": "td",
            "html": "${summary.stroke_count}"
    }, {
        "tag": "td",
            "html": "${summary.distance}"
    }, {
        "tag": "td",
            "html": "${summary.heart_rate_max}"
    }, {
        "tag": "td",
            "html": "${summary.pace_max}"
    }, {
        "tag": "td",
            "html": "${summary.time}"
    }, {
        "tag": "td class='action-td' data-title='Action'",
             "html": ""

                        
							
						
                       
						
    }
    ]
};
   
       
    
        
    

    document.getElementById('tabela4').innerHTML = json2html.transform(sesije2,transform);
    var t=document.getElementsByClassName("eee");
    var r=document.getElementsByClassName("eeee");
    var e=document.getElementsByClassName("action-td");
    var tt=t.length;
    for(var i=0;i<nizid.length ;i++){
    	
    	
    	t[i].innerHTML="<h4>"+nizid[i]+"</h4>";
    	r[i].innerHTML="Sesija:"+nizid[i]+"";
    	e[i].innerHTML="<span> <a href='#' class='mailedit-box-attachment-name' data-toggle='modal' data-target='#edit-session'><i class='fa fa-edit inline btn btn-sm btn-default'></i></a><a class='brisi' id="+nizid[i]+" href='#'' class='mailedit-box-attachment-name' data-toggle='modal' data-target='#delete-session'><i class='fa fa-trash-o inline btn btn-sm btn-primary'></i></a </span>";
    	
    }

    $(".brisi").click(function() { 
    	var w=$(this).attr('id');
    	
    	 $("#dugme3").click(function() {
    	 		   $.ajax({ 
        type: 'POST', 
        dataType: 'json',
        url : urlBase + '/api/v1/delete_session',
        data: {account: email2 ,id: w,
      

    }, 
        success: function (data3) {


        	OnloadFunction();

        	


        	
        

        
        






        	
         }
     })
        	




    	  });


  

     });

   



    
        }
    });










        	






        	}

        	


        	
        

       
        






        	
         
     })








     
     

  


    
       
}
$(document).ready(function(){

	OnloadFunction();
});


        
 

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
							<th class="smallest-th nosort">#</th>
							<th>Session</th>
							<th class="nosort">Comments</th>
							<th class="nosort">Date/Time</th>
							<th class="nosort">Power</th>
							<th class="nosort">Strokes</th>
							<th class="nosort">Distance</th>
							<th class="nosort">HR</th>
							<th class="nosort">Pace</th>
							<th class="nosort">Time</th>
							<th class="nosort">Action</th>
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
	$(function () {
		$('my-sessions').DataTable({
			responsive: true
		});
	});

	$(function () {
		//Enable iCheck plugin for checkboxes
		//iCheck for checkbox and radio inputs
		$('.sessions-table input[type="checkbox"]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});

		//Enable check and uncheck all functionality
		$(".checkbox-toggle").click(function () {
			var clicks = $(this).data('clicks');
			if (clicks) {
				//Uncheck all checkboxes
				$(".sessions-table input[type='checkbox']").iCheck("uncheck");
				$(this).addClass('icheckbox_flat-blue').removeClass('checked');
			} else {
				//Check all checkboxes
				$(".sessions-table input[type='checkbox']").iCheck("check");
				$(this).addClass('checked');
			}
			$(this).data("clicks", !clicks);
		});

	});


	var table = $('#my-sessions').DataTable({
		'aoColumnDefs': [{
			'bSortable': false,
			'aTargets': ['nosort']
		}]
	});
	$('.search-input').on( 'keyup', function () {
     $('#my-sessions').DataTable().column().search(
        $('.eee').val()
       
    ).draw();

      });


</script>
@endsection
