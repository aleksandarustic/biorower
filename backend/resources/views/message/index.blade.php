<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

@extends('layouts.myframe')

@section('page-script')

	<link rel="stylesheet" href="{{ Request::root() }}/js/jquery-validation-1.13.1/css/screen.css" type="text/css" />
	<script src="{{ Request::root() }}/js/jquery-validation-1.13.1/jquery.validate.js"></script>

    <script type="text/javascript">

    	$(function(){

			$("#formMessage").validate();

			$(document).on("click", "#sendMessageButton", function(){
				if($("#formMessage").valid()){
					socket.emit('emit_message', $("#receiver").val());
					$("#formMessage").submit();
				}
				return false;
			});

    		var urlBase = "<?php echo Request::root() ?>";

    		$(document).on("click", ".linkInbox", function(){
    			$this = $(this);
    			var idMessage = $this.attr("id").split("-")[1];

    			if (!$this.closest(".clsInboxRecord").next().is(":visible")){

	    			$gifBox = $this.closest(".clsInboxRecord").next().next();
	    			$gifBox.show();    				

		             $.ajax({
		                url: urlBase + '/message/read?id_message='+idMessage,
		                dataType: 'html',
		                success: function(data) {
		                	var clsBox = $this.closest(".clsInboxRecord");
		                	clsBox.next().show();
		                	clsBox.next().find("td").html(data);

		                	if ($("#newMessages").text() != "" && clsBox.hasClass("notReadMessage")){
		                		
			                	var br = parseInt(parseInt($("#newMessages").text()) - 1);
			                	if (br >= 1){
			                		$(".clsNewMessages").text(br);
			                	}
			                	else{
			                		$(".clsNewMessages").text("");
			                	}
		                	}

		                	$this.closest(".clsInboxRecord").removeClass("notReadMessage").addClass("readMessage");
		                	$gifBox.hide();
		                },
		                cache: false
		            });
	             }
	             else{
	             	$this.closest(".clsInboxRecord").next().hide();
	             }
    		});

			$(".btnChkMsg").each(function(){
				$(this).prop("checked", false);
			});


    		$(document).on("click", ".btnChkMsg", function(){
    			var tr = $(this).closest(".clsInboxRecord");

    			if (tr.hasClass("rowSelected")){
    				tr.removeClass("rowSelected");
    			}
    			else{
    				tr.addClass("rowSelected");
    			}

    			var selected = false;
    			$(".btnChkMsg").each(function(){
    				if ($(this).is(":checked")){
    					selected = true;
    				}
    			});

    			if (selected == true){
    				$("#markReadInboxMessageWrapper").show();
    				$("#deleteInboxMessageWrapper").show();
    			}
    			else{
    				$("#markReadInboxMessageWrapper").hide();
    				$("#deleteInboxMessageWrapper").hide();
    			}
    		});

    		$(document).on("click", ".deleteInboxMessage", function(){

    			var selected = false;
    			$(".btnChkMsg").each(function(){
    				if ($(this).is(":checked")){
    					selected = true;
    				}
    			});   
    			if (selected == true){
    				$("#formLoadedMessages").submit();
    			}
    			else{
    				alert('Nothing is selected');
    			}    			
    		});


    		$(document).on("click", ".markReadInboxMessage", function(){
    			var selected = false;
    			$(".btnChkMsg").each(function(){
    				if ($(this).is(":checked")){
    					selected = true;
    				}
    			});
    			if (selected == true){
		             $.ajax({
		                url: urlBase + '/message/mark-as-read',
		                dataType: 'json',
		                type: 'POST',
		                data: $("#formLoadedMessages").serialize(),
		                success: function(data) {
		                	var arrayMsgIDs = data;
		                	for(var i=0; i<arrayMsgIDs.length; i++){
		                		$("#idBtnChkMsg-"+arrayMsgIDs[i]).closest(".clsInboxRecord").removeClass("notReadMessage").addClass("readMessage");
		                		$("#idBtnChkMsg-"+arrayMsgIDs[i]).prop("checked", false);
		                		$("#idBtnChkMsg-"+arrayMsgIDs[i]).closest(".clsInboxRecord").removeClass("rowSelected");
		                	}

		                	var br = parseInt(parseInt($("#newMessages").text()) - arrayMsgIDs.length);
		                	if (br >= 1){
		                		$(".clsNewMessages").text(br);
		                	}
		                	else{
		                		$(".clsNewMessages").text("");
		                	}
		                },
		                cache: false
		            });
    			}
    			else{
    				alert('Nothing is selected');
    			}    			
    		});


    	});
    </script>
@endsection


@section('content')

    <div class="container-fluid" id="rightColumn">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3" >


			  <ul class="nav nav-tabs" role="tablist" id="tabsRaces">
			    <li role="presentation" class="active"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
			    <li role="presentation"><a href="#new_message" aria-controls="profile" role="tab" data-toggle="tab">New message</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="messages">
	            	<h2 style="float:left">Inbox:</h2>

					<div class="loadingGifSendRequest" style="display:none;">
	                    {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
	                </div>

	                <div style="float:right; position:relative">
			            <span id="markReadInboxMessageWrapper" style="position:absolute; top:15px; right:80px;">
			            	<a href="#" class="btn btn-default markReadInboxMessage" style="display:inline;">  Mark as read</a>
			            </span>
			            <span id="deleteInboxMessageWrapper" style="position:absolute; top:15px; right:0px;">
			            	<a href="#" class="btn btn-default deleteInboxMessage" style="display:inline;"> Delete</a>
			            </span>
	                </div>

	                <div style="clear:both"></div>

					{!! Form::open(array('url' => '/message/delete-messages', 'method' => 'POST', 'id'=>'formLoadedMessages')) !!}
					<table class="table table-hover">
						 <tr>
						 	<th></th>
						 	<th>Date </th> <!-- <a href="#" class="sort sort-email sort-asc"><span class=" glyphicon glyphicon-triangle-bottom"></span></a><a href="#" class="sort sort-email sort-desc"><span class=" glyphicon glyphicon-triangle-top"></span></a> -->
						 	<th>Subject </th>
						 	<th>From user </th>
						 	<th>Sender name </th>
						 	<th></th>
						 </tr>
						 @foreach ($messages as $key => $value)
				 	 	 <?php 
							$hashids = new Hashids(GlobalFunctions::getEncKeyForMessages());
							$encodedID = $hashids->encode($value->id);
				 	 	  ?>
				 	 	  <?php
				 	 	  	$read = "notReadMessage";
				 	 	  	if ($value->read == 1){
				 	 	  		$read = "readMessage";
				 	 	  	}
				 	 	  ?>
					 	 <tr class="{{ $read }} clsInboxRecord" data-url="">
					 	 	 <td>{!! Form::checkbox('chkMessage[]', $encodedID, null, ['class' => 'btnChkMsg', 'id' => 'idBtnChkMsg-'.$encodedID]) !!}</td>
					 	 	 <td>{{ $value->date }}</td>
						 	 <td><a href="#" class="linkInbox" id="idMessageSbj-{{ $encodedID }}">{{ $value->subject }}</a></td>
						 	 <td>{{ $value->sender->display_name }}</a></td>
						 	 <td>{{ $value->sender->first_name }} {{ $value->sender->last_name }}</td>
					 	 </tr>
					 	 <tr class="containerInbox">
					 	 	<td colspan="5">
					 	 	</td>
					 	 </tr>
					 	 <tr class="containerGif">
					 	 	<td colspan="5">
								<div class="loadingGifReadMessage">
				                    {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
				                </div>
					 	 	</td>
					 	 </tr>				 	 
					   	 @endforeach
					</table>
					{!! $messages !!}
					{!! Form::close() !!}						            
			    </div>
			    <div role="tabpanel" class="tab-pane" id="new_message">
					{!! Form::open(array('url' => '/message/send-message', 'method' => 'POST', 'id'=>'formMessage')) !!}
					<fieldset>
						<legend>Send message</legend>
						<div class="form-group">
								{!! Form::label('receiver', 'Receiver', array('class' => '')) !!}
								<br />
								{!! Form::select('receiver',  array('' => '- Please select -') + $listsWatchedList, '0', array('class' => 'required')) !!}
						</div>
						<div class="form-group">
								{!! Form::label('subject', 'Subject', array('class' => '')) !!}
								<br />
								{!! Form::text('subject',  '', array('class' => 'required')) !!}
						</div>						
						<div class="form-group">
								{!! Form::label('text', 'Text', array('class' => '')) !!}
								<br />
								{!! Form::textarea('message', '', array('id' => 'id_message_text', 'rows' => 3, 'class' => 'required')) !!}
						</div>
						<a href="#" class="btn btn-default btn-primary" id="sendMessageButton"><span class="glyphicon glyphicon-send"></span> Send</a>
					</fieldset>
					{!! Form::close() !!}							    	
			    </div>
			  </div>

			</div>
		</div>

	</div>

@endsection

