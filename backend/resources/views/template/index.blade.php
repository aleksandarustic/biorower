@extends('layouts.myframe')

@section('title', 'Workout')

@section('page-script')
		{!! HTML::style('plugins/jQuery/jQuery-2.1.4.min.js') !!}
		{!! HTML::script('js/highcharts.js') !!}
		{!! HTML::script('js/highcharts-more.js') !!}
		{!! HTML::script('js/highcharts-3d.js') !!}
@stop

@section('content')
		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
			  	<div class="wrapperHeader col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  		<div class="row">
							<div id="headerOpenedFileWrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							    <div id="headerOpenedFile">

							    	{!! HTML::image('images/avatar_empty.png', 'a picture', array('class' => 'headerAvatarOpenedFile', 'width' => '50', 'height' => '50')) !!}
							        <div class="sessionTitleTextContainer">
							            <h2 id="sessionTitle" class="">
							                Thu 27th Nov 2014
							            </h2>
							            <span>
							                <strong>
							                     gaboroki (gaboroki) 
							                </strong>
							            </span>
							        </div>
							    </div>
							</div>
						</div>

						<br />
						<br />

						<div class="row">
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
								    <div class="tmodulesRight">
								        <span class="tmodulesLFSecond">
								            21399
								        </span>
								        <span class="tmodulesRFUnit">
								            m
								        </span>
								    </div>
								    <div class="tmodulesLFFirst">
								        <a id="clickModule-4205" class="btnModule" href="#">
								            Distance
								        </a>
								    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
								    <div class="tmodulesRight">
								        <span class="tmodulesLFSecond">
								            21399
								        </span>
								        <span class="tmodulesRFUnit">
								            m
								        </span>
								    </div>
								    <div class="tmodulesLFFirst">
								        <a id="clickModule-4205" class="btnModule" href="#">
								            Distance
								        </a>
								    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            21399
							        </span>
							        <span class="tmodulesRFUnit">
							            m
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Distance
							        </a>
							    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            21399
							        </span>
							        <span class="tmodulesRFUnit">
							            m
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Distance
							        </a>
							    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            21399
							        </span>
							        <span class="tmodulesRFUnit">
							            m
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Distance
							        </a>
							    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            21399
							        </span>
							        <span class="tmodulesRFUnit">
							            m
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Distance
							        </a>
							    </div>
							</div>
						  </div>

					</div>								
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-9" >
						<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
									<div class="wrapperChart">
										<a class="glyClass btn-lg" href="#" data-toggle="modal" data-target="#myModal">
											<span class="glyphicon glyphicon-info-sign"></span>
										</a>									
										<div id="highchartContainer1" class="chart">
										</div>				
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="wrapperChart">
											<a class="glyClass btn-lg" href="#" data-toggle="modal" data-target="#myModal">
												<span class="glyphicon glyphicon-info-sign"></span>
											</a>																		
											<div id="highchartContainer2" class="chart">
											</div>
										</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
									<div class="wrapperChart">
										<div id="highchartContainer3" class="chart">
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
									<div class="wrapperChart">
										<div id="highchartContainer4" class="chart">
										</div>
									</div>
									<br />
									<!--
									<div id="sliders">
										<table>
											<tr><td>Alpha Angle</td><td><input id="R0" type="range" min="0" max="45" value="15"/> <span id="R0-value" class="value"></span></td></tr>
										    <tr><td>Beta Angle</td><td><input id="R1" type="range" min="0" max="45" value="15"/> <span id="R1-value" class="value"></span></td></tr>
										</table>
									</div>	
									-->
								</div>
								<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-4">
									<div class="wrapperChart">
										<div id="highchartContainer5" class="chart">
										</div>
									</div>
								</div>
	
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-3">
					    <div id="rightWrapperShareFileAndComments">
					        <div id="rightBarShareFileDetailsWrapper" class="">
					            <div id="rightBarShareFileDetails">
					                <h2>Share this Session</h2>
					                <h4>
					                    <span class="glyphicon glyphicon-random" aria-hidden="true"></span>
					                     &nbsp;Social
					                </h4>
					                <button id="facebookShare" class="btn btn-custom-facebook btn-lg" usr="gaboroki" sess="353cdfa480600d044bf25a894d70e46b">
					                    <i class="fa-facebook"></i>
					                    Share on Facebook
					                </button>
					                <button id="twitterShare" class="btn btn-custom-twitter btn-lg" >
					                    <i class="fa fa-twitter"></i>
					                    Share on Twitter
					                </button>
					                <h4>
					                    <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
					                    &nbsp;Link
					                </h4>
					                <div class="row">
						                <input type="text" style="width:95%; margin-left: 15px;" value="http://hub.wattbike.com/gaboroki/session/353cdfa480600d044bf25a894d70e46b" onclick="this.setSelectionRange(0, this.value.length)">
					                </div>

					            </div>
					        </div>

					        <div id="rightBarCommentsDetailsWrapper">
					            <div id="rightBarCommentsDetails">
					                <h2>Comments</h2>
					                <div id="comments">
					                </div>
					                <p>You must be logged in to post a comment</p>
					            </div>
					        </div>
					    </div>	

					</div>
				</div>


				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br />
						<br />
						<br />
						<br />
					</div>
				</div>		
		  </div>
	  </section>

	<div class="modal fade" id="myModal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        <p>One fine body&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	  

		<script type="text/javascript">
			$(function(){
	            /*
				window.onresize = displayWindowSize;
				function displayWindowSize() {
				    alert(window.innerWidth);
				};
				*/
			    varChart1Options = {
			        chart: {
			            renderTo: 'highchartContainer1',
			        },
			        title: {
			            text: 'Monthly Average Temperature',
			            x: -20 //center
			        },
			        subtitle: {
			            text: 'Source: WorldClimate.com',
			            x: -20
			        },
			        xAxis: {
			            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
			                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			        },
			        yAxis: {
			            title: {
			                text: 'Temperature (°C)'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        tooltip: {
			            valueSuffix: '°C'
			        },
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series: [{
			            name: 'Tokyo',
			            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
			        }, {
			            name: 'New York',
			            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			        }, {
			            name: 'Berlin',
			            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
			        }, {
			            name: 'London',
			            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
			        }]
			    };		

				varChart1 = new Highcharts.Chart(varChart1Options);

				var chart2 = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'highchartContainer2',
			            type: 'column'
			        },
			        title: {
			            text: 'Column chart with negative values'
			        },
			        xAxis: {
			            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
			        },
			        credits: {
			            enabled: false
			        },
			        series: [{
			            name: 'John',
			            data: [5, 3, 4, 7, 2]
			        }, {
			            name: 'Jane',
			            data: [2, -2, -3, 2, 1]
			        }, {
			            name: 'Joe',
			            data: [3, 4, 4, -2, 5]
			        }]
			    });


				var chart3 = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'highchartContainer3',
			            type: 'pie',
			            options3d: {
			                enabled: true,
			                alpha: 45
			            }
			        },
			        title: {
			            text: 'Contents of Highsoft\'s weekly fruit delivery'
			        },
			        subtitle: {
			            text: '3D donut in Highcharts'
			        },
			        plotOptions: {
			            pie: {
			                innerSize: 100,
			                depth: 45
			            }
			        },
			        series: [{
			            name: 'Delivered amount',
			            data: [
			                ['Bananas', 8],
			                ['Kiwi', 3],
			                ['Mixed nuts', 1],
			                ['Oranges', 6],
			                ['Apples', 8],
			                ['Pears', 4],
			                ['Clementines', 4],
			                ['Reddish (bag)', 1],
			                ['Grapes (bunch)', 1]
			            ]
			        }]
			    });
			    
			    var chart5 = new Highcharts.Chart({
			        chart: {
			            polar: true,
			            renderTo: 'highchartContainer5',
			        },

			        title: {
			            text: 'Highcharts Polar Chart'
			        },

			        pane: {
			            startAngle: 0,
			            endAngle: 360
			        },

			        xAxis: {
			            tickInterval: 45,
			            min: 0,
			            max: 360,
			            labels: {
			                formatter: function () {
			                    return this.value + '°';
			                }
			            }
			        },

			        yAxis: {
			            min: 0
			        },

			        plotOptions: {
			            series: {
			                pointStart: 0,
			                pointInterval: 45
			            },
			            column: {
			                pointPadding: 0,
			                groupPadding: 0
			            }
			        },

			        series: [{
			            type: 'column',
			            name: 'Column',
			            data: [8, 7, 6, 5, 4, 3, 2, 1],
			            pointPlacement: 'between'
			        }, {
			            type: 'line',
			            name: 'Line',
			            data: [1, 2, 3, 4, 5, 6, 7, 8]
			        }, {
			            type: 'area',
			            name: 'Area',
			            data: [1, 8, 2, 7, 3, 6, 4, 5]
			        }]
			    });	
			    	    
			    var chart = new Highcharts.Chart({
			        chart: {
			            renderTo: 'highchartContainer4',
			            type: 'column',
			            margin: 75,
			            options3d: {
			                enabled: true,
			                alpha: 15,
			                beta: 15,
			                depth: 50,
			                viewDistance: 25
			            }
			        },
			        title: {
			            text: 'Chart rotation demo'
			        },
			        subtitle: {
			            text: 'Test options by dragging the sliders below'
			        },
			        plotOptions: {
			            column: {
			                depth: 25
			            }
			        },
			        series: [{
			            data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
			        }]
			    }, function(){
		            var currentLeft = parseInt($(".footer").position().top) - $('#lastItemInLeftMenu').height();
            		$('#lastItemInLeftMenu').css("height", currentLeft);

		            var currentRight = parseInt($(".footer").position().top) - $('#lastItemInRightMenu').height();
            		$('#lastItemInRightMenu').css("height", currentRight);
			    });

			    function showValues() {
			        $('#R0-value').html(chart.options.chart.options3d.alpha);
			        $('#R1-value').html(chart.options.chart.options3d.beta);
			    }

            });
</script>

@endsection

