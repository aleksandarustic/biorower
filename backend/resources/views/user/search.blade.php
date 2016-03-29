@extends('layouts.myframe')

@section('title', 'Overview')

@section('page-script')
	<script type="text/javascript">
		$(function(){

			$(document).on("click", "#idButtonSearch", function () {

				$("#userAjaxcontainer").empty();
				$("#loadingGif").show();
				
				var url = "<?php echo $app->make('url')->to('/'); ?>" + "/user/search-users-ajax"; //SearchUsersAjax

	            $.ajax({
	                url: url,
	                type: 'POST',
	                dataType: 'json',
	                data: $("#formSearch").serialize(),
	                success: function (data) {
	                    if (data) {
	                    	//alert(JSON.stringify(data));
	                    	$("#userAjaxcontainer").html(data);
	                    	$("#loadingGif").hide();
	                    }
	                    else {
	                    }
	                }
	            });
			});

			$(document).keypress(function(e) {
			    if(e.which == 13) {
			        $("#idButtonSearch").click();
			        return false;
			    }
			});

		});
	</script>
@stop


@section('content')

		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
			  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1>Search Users</h1>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							{!! Form::open(array('id' => 'formSearch')) !!}
								{!! Form::text('search_name', '', array('style'=>'width:100%')) !!}
								<a href="#" id="idButtonSearch" class='btn btn-primary btn-large' >Search Users</a>
							{!! Form::close() !!}
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
						</div>						
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div id="loadingGif" style="margin:0 auto; display:none; text-align:center">
					        Loading...
					        {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
					    </div>		
					    <br />		
						<div id="userAjaxcontainer">
					    </div>
					</div>
				</div>		
		  </div>
	  </section>

@endsection

