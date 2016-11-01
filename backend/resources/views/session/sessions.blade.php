@extends('layouts.main')

@section('content')
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
								<th class="nosort">#</th>
							    <th class="nosort" width="20%">Session</th>
								<th class="nosort">Date/Time</th>
								<th class="nosort" width="9%">Lasting {{ config('parameters.time.unit') }}</th>
								<th class="nosort">Power {{ config('parameters.pwr_avg.unit') }}</th>
								<th class="nosort">Distance {{ config('parameters.dist.unit') }}</th>
								<th class="nosort">HR {{ config('parameters.hr_avg.unit') }}</th>
								<th class="nosort" width="15%">Description</th>					
								<th width="5%">Action</th>
								<th class="hiden" style="display:none;">id</th>
							</tr>
						</thead>
							<tbody id="tabela4"></tbody>
					</table>
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
    var email1			=	"<?php echo Auth::user()->email ?>"; 
    var display_name	= 	"<?php echo Auth::user()->display_name ?>"; 
    var email2			=	"biorower:"+email1;

function OnloadFunction ()
{   
	$(".hiden").hide();
		
	$.ajax({ 
		type: 'POST', 
		dataType: 'json',
		url : '{{ asset('/api/v1/sessions_recent_list') }}',
		data: {account: email2 ,offset:0,pageSize:80000, web:1}, 
		success: function (data) {
		        var dat =	data;
				delete data.account;
		       	var d 	=	dat.sessionsRecentList;

		       	for(var i=0;i< d.length; i++){
		        	  	d[i].action ="<span> <a href='javascript:void(0)' class='update'  id="+d[i].ID+"  onclick='editSession("+d[i].ID+")' data='tester'><i class='fa fa-edit inline btn btn-sm btn-default'></i></a><a class='brisi' id='deleteSession' href='javascript:void(0)' class='mailedit-box-attachment-name'><i class='fa fa-trash-o inline btn btn-sm btn-primary' data="+d[i].ID+"></i></a </span>";

		        	  	d[i].linkname    = "<a href='javascript:void(0)'><div id='nameSession"+d[i].ID+"'>"+d[i].session_name+"</div></a>";
		        	  	d[i].sessiondesc = "<div id='descSession"+d[i].ID+"'> "+d[i].description+" </div>";
		       	}

		var table = $('#my-sessions').DataTable({
		        "paging"  :   true,
		        "ordering":   true,
		        "info"    :   false,
		        "iDisplayLength": 25,
		        language: {
		           searchPlaceholder: "Search sessions..."
		        },
		        "data"	: d,
		        "columns" : [
				  	     	{ 'defaultContent'  : '' },
				  	     	{ 'data' : 'linkname' },
				  	     	{ 'data' : 'date' },
				  	     	{ 'data' : 'time' },
				  	     	{ 'data' : 'pwr_avg' },
				  	     	{ 'data' : 'dist' },
				  	     	{ 'data' : 'hr_avg' },
				  	     	{ 'data' : 'sessiondesc' },
				  	     	{ 'data' : 'action' },
				  	     	{ 'data' : 'ID'}		  	       	    
				  	     	],
				"columnDefs": [
		            {
		                "targets": [ 9 ],
		                "visible": false,
		                "searchable": false },
		            {  
		            	"searchable": false,
            			"orderable": false,
           				 "targets": 0 }
		            ],
		            "order": [[ 1, 'asc' ]],

				responsive: true
    	});

			table.on( 'order.dt search.dt', function () {
		        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = i+1;
		        } );
		    } ).draw();

			table.on('click', 'tr', function (e) {
					var ids = table.row( this ).data();
				    if(!$(e.target).is('i')){
				        window.location.href = "{{asset('profile/')}}/"+display_name+"/session/"+ids.ID;
				    }
   			});    
			//******** CLICK ON DELETE ICON *******/
   			$('#my-sessions tbody').on( 'click', 'i.fa-trash-o', function () {
   				var id    = $(this).attr("data"); // get user id
   				var rows   = table.row( $(this).parents('tr') );
   				vex.dialog.confirm({
				    message: 'Are you sure you want to delete the session?',
				    callback: function (value) {
				    	if(value == true){
				    		$.ajax({ 
						        type: 'POST', 
						        dataType: 'json',
						        url : '{{ asset("/api/v1/delete_session") }}',
						        data: {account: email2 ,id: id}, 
						        success: function (data3) {
						        	if(data3 == 200){	
						 				rows.remove().draw();
							    	}
						        }// end success
						    }) 				    	
				    	} // delete confirm
				    } // callback
				}) // vex dialog close	  
			});


    	} // success ajax
	});// end AJAX
} // function on load

/**** CLICK ON EDIT ICON ***/
function editSession(id)
{
	var ime  = document.getElementById('nameSession'+id);
	var opis = document.getElementById('descSession'+id);

vex.dialog.open({
    message: 'Session name:',
    input: [
        '<input name="InputNameSession" type="text" placeholder="Name of the session" value="'+ime.innerHTML+'"/>',
        '<label for="InputDescSession">Description: </label>',
        '<textarea name="InputDescSession" rows="4" placeholder="Description session" class="oneLine-input" id="textsesije">'+opis.innerHTML+'</textarea>'
    ].join(''),
    buttons: [
        $.extend({}, vex.dialog.buttons.YES, 	{ text: 'Save changes' }),
        $.extend({}, vex.dialog.buttons.NO, 	{ text: 'Cancel' })
    ],
    callback: function (data) {
        if (!data) {
        } else {
            $.ajax({ 
				        type: 'POST', 
				        dataType: 'json',
				        url : '{{asset("/api/v1/sessions_edit")}}',
				        data: {account: email2 ,id: id,name:data.InputNameSession,description:data.InputDescSession}, 
				        success: function (data4) {
				        	if(data4 == 200){
				      			ime.innerHTML  = data.InputNameSession;
				      			opis.innerHTML = data.InputDescSession;	
				      		}		    
				        } // success /
			})// ajax end
        } // if data
    }
}) // vex close		       		  			
} // end editSession

$(document).ready(function(){
	OnloadFunction();
});
</script>
@endsection
