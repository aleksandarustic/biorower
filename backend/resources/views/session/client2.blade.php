
@extends('layouts.myframe')

@section('title', 'Live')
@endsection

@section('page-script')


		<script type="text/javascript">

			var urlBase = "<?php echo Request::root(); ?>"

			$(function(){

              function requestData2() {
			    $.ajax({
			        url: urlBase + '/session/ajaxData2',
			        success: function(point) {
			        	/*
			            var series = chart.series[0],
			                shift = series.data.length > 20; // shift if the series is 
			                                                 // longer than 20
			            // add the point
			            chart.series[0].addPoint(eval(point), true, shift);
			            
			            // call it again after one second
			            */

			            setTimeout(requestData2, 100);    
			        },
			        cache: false
			    });
			  }

			  requestData2();
			});
		</script>

@endsection


@section('content')
		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
			  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


			  	</div>
			  </div>
			</div>
		</section>
@endsection

