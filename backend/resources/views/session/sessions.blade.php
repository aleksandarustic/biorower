@extends('layouts.myframe')

@section('head-script')

	<script type="text/javascript">

		function convertToNormalMonth(month){
			if (month < 10)
				return "0"+month;
		}

		$(function(){

			var urlCurrent = "<?php echo Request::url() ?>";

			var date = new Date();

			/*
			if (urlCurrent.split("sessions")[1].length > 6){
				var url = urlCurrent.split("sessions")[0] + "sessions/"+firstDayUrl+"/"+lastDayUrl;
			}
			else{
				var url = urlCurrent + "/"+firstDayUrl+"/"+lastDayUrl;
			}
			*/

			var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
			var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

			$("#first_date").datepicker();
			$("#first_date").datepicker( "option", "dateFormat", "yy-mm-dd" );
			$("#first_date").datepicker("setDate", firstDay);

			$("#last_date").datepicker();
			$("#last_date").datepicker( "option", "dateFormat", "yy-mm-dd" );			
			$("#last_date").datepicker("setDate", lastDay);

			window.history.pushState(null, null, urlCurrent);

			function loadContent(url){
				$("#loadingGif").show();
				$("#ptContainer").empty();
				$("#ptContainer").hide();

		        $.ajax({
		        	    url : url,
			        }).done(function (data) {
						$("#ptContainer").html(data);
						$("#ptContainer").show();
						$("#loadingGif").hide();
			
			        }).fail(function() {
		        });	

		        return false;			
			}

			window.onhashchange = function(){
				var hash = window.location.hash.replace("#", "");
			};



			$(document).on("click", ".btnSearchSessions", function(event){
				var id=$(this).attr("id");

				switch(id){
					case ("id_this_week"):
						var curr = new Date;
						firstDay = new Date(curr.setDate(curr.getDate() - curr.getDay()));
						lastDay = new Date(curr.setDate(curr.getDate() - curr.getDay()+6));
					break;
					case ("id_this_month"):
						firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
						lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
					break;
					case ("id_thirty_days"):
						var curr1 = new Date;
						var curr2 = new Date;
						lastDay = new Date(curr1.setDate(curr1.getDate()));
						firstDay = new Date(curr2.setDate(curr2.getDate()-30));
					break;
					case ("id_filter"):
						firstDay = $("#first_date").datepicker("getDate");
						lastDay = $("#last_date").datepicker("getDate");
					break;
				}

				if (id != "id_filter"){
					$("#first_date").datepicker("setDate", firstDay);
					$("#last_date").datepicker("setDate", lastDay);		
				}

				var firstDayUrl = firstDay.getFullYear()+'-'+convertToNormalMonth(firstDay.getMonth()+1)+'-'+firstDay.getDate();
				var lastDayUrl = lastDay.getFullYear()+'-'+convertToNormalMonth(lastDay.getMonth()+1)+'-'+lastDay.getDate();

				if (urlCurrent.split("sessions")[1].length > 6){
					var url = urlCurrent.split("sessions")[0] + "sessions/"+firstDayUrl+"/"+lastDayUrl;
				}
				else{
					var url = urlCurrent + "/"+firstDayUrl+"/"+lastDayUrl;
				}

				window.history.pushState(null, null, url);
				loadContent(url);
			});

			window.onpopstate = function(e) {

				link = location.pathname.split('/');
				var firstDayUrl = '';
				var lastDayUrl = '';
				var url = '';

				if (link[link.length-1] == "sessions"){
					var url = '';
				}
				else{
					firstDayUrl = link[link.length-2];
					lastDayUrl = link[link.length-1];
				}

				url = urlCurrent + "/"+firstDayUrl+"/"+lastDayUrl;

				loadContent(url);
			};

			$(document).on("click", ".rowLink", function(){
				window.location = $(this).data("url");
			});			
			
		})
	</script>

@endsection

@section('title', 'Sessions')

@section('content')

		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
			  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  		<div class="row">
			  			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					  		<br />
							<div class="form-group">

								{!! Form::text('first_date', '', array('id' => 'first_date', 'class' => 'elSearch elInput')) !!}
								{!! Form::text('last_date', '', array('id' => 'last_date', 'class' => 'elSearch elInput')) !!}

								<span class="btn btn-default elSearch btnSearchSessions" id="id_filter"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filter</span>
								<span class="elSearchText">or</span>
								<span class="btn btn-default elSearch btnSearchSessions" id="id_this_week"> This Week</span>
								<span href="#" class="btn btn-default elSearch btnSearchSessions" id="id_this_month"> This Month</span>
								<span href="#" class="btn btn-default elSearch btnSearchSessions" id="id_thirty_days"> 30 Days</span>

								<div style="clear:both"></div>
							</div>
						</div>
					</div>

			  		<div class="row">
			  			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

						    <div style="width:100%;">
						        <div id="loadingGif" style="margin:0 auto; display:none; width:120px;">
						            Loading...
						            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
						        </div>
					        </div>			  			
					  		<br />
					  		
					  		<div id="ptContainer">
					  			{!! $partialTable !!}
					  		</div>

						</div>
					</div>

			  	</div>
			  </div>
			</div>
		</section>

@endsection

