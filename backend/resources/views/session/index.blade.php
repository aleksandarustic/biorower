
@extends('layouts.myframe')

@section('head-script')
	    <!-- <link rel="canonical" href="{{ Request::url() }}" /> -->

	    <meta property="fb:app_id" content="507802702573516" />
	    @if (isset($og_title))
	    	<meta property="og:title" content="{{$og_title}}"/>
	    @endif
	    <meta property="og:type"  content="article" /> 
	    <meta property="og:url" content="{{ Request::url() }}"/> 
	    @if (isset($og_description))
	    	<meta property="og:description" content="{{$og_description}}"/>
	    @endif
	    <meta property="og:image" content="http://www.servistest88.byethost6.com/public/images/beta.png"/>
@endsection


@section('title', 'Workout')

@section('page-script')

		{!! HTML::style('js/jquery-ui-multiselect-widget/jquery.multiselect.css') !!}

		{!! HTML::script('js/highcharts.js') !!}
		{!! HTML::script('js/highcharts-more.js') !!}
		{!! HTML::script('js/highcharts-3d.js') !!}

		{!! HTML::script('js/polar/dataPolar.js') !!}
		{!! HTML::script('js/polar/chartComponent.js') !!}

		{!! HTML::script('js/jquery-ui-multiselect-widget/src/jquery.multiselect.min.js') !!}

		<script type="text/javascript">


			function convertToMyJsonArray(jsonVar, parameters, exclude){ 
		        var jsonObjParameters = [];
				for (var ke in jsonVar) {
				   if (exclude){
					   if ($.inArray(ke, parameters) == -1)	
					   {
						   var tmpObject = new Object();
						   tmpObject.name = ke;
						   tmpObject.id = ke;
						   tmpObject.data = jsonVar[ke];
						   jsonObjParameters.push(tmpObject);
					   }
				   }
				   else{
					   if ($.inArray(ke, parameters) > -1)	
					   {
						   var tmpObject = new Object();
						   tmpObject.name = ke;
						   tmpObject.id = ke;
						   tmpObject.data = jsonVar[ke];
						   jsonObjParameters.push(tmpObject);
					   }					   	
				   }
				}
				return jsonObjParameters;
			};

			$(function(){

				var urlBase = "<?php echo Request::root() ?>";

				$(document).on("click", "#postComment", function(){

					$("#loadingGif").show();					
					$("#postComment").hide();

			        $.ajax({
			        	    url : urlBase + '/session/comment',
			        	    type: "POST",
				            data: $("#formComment").serialize(),
				        }).done(function (data) {

				        	if (data){
				        		$("#comments").append(data);

					        	$("#loadingGif").hide();
					        	$("#postComment").show();				        		

					        	$("#taComment").val("");
							}
							else{
							}

				        }).fail(function () {
			        });

				     return false;
				});

				$('#twitterbtn-link, #facebookbtn-link').click(function(event) {
				var width  = 575,
				    height = 400,
				    left   = ($(window).width()  - width)  / 2,
				    top    = ($(window).height() - height) / 2,
				    url    = this.href,
				    opts   = 'status=1' +
				             ',width='  + width  +
				             ',height=' + height +
				             ',top='    + top    +
				             ',left='   + left;

					window.open(url, '', opts);

					return false;
				});

				/*
	            $('#chartPolar').radarChart({
     	           size: [400, 400],
        	        step: 1,
            	    title: "Polar chart",
	                values: arrayValues,
	                avrGFAngle : 1.4718,
	                avrGSAngle : 1.4718,
	                strNum: 0,
	                showAxisLabels: true
    	        });
				*/
				
				var linedata = [[0,93],[5,93],[10,99],[15,105],[20,111],[25,117],[30,123],[35,129],[40,135],[45,141],[50,147],[55,153],[60,159],[65,165],[70,171],[75,176],[80,182],[85,188],[90,194],[95,200],[100,194],[105,188],[110,182],[115,176],[120,171],[125,165],[130,159],[135,153],[140,147],[145,141],[150,135],[155,129],[160,123],[165,117],[170,111],[175,105],[180,99],[185,93],[190,93],[195,99],[200,105],[205,112],[210,118],[215,124],[220,131],[225,137],[230,143],[235,150],[240,156],[245,162],[250,169],[255,175],[260,181],[265,188],[270,194],[275,200],[280,194],[285,188],[290,181],[295,175],[300,169],[305,162],[310,156],[315,150],[320,143],[325,137],[330,131],[335,124],[340,118],[345,112],[350,105],[355,99]];

			    /*
	        	var linedata = [[8.045145484399216, 91.95643367000729], 
	        		   [17.0308789634874, 96.58691423773578],
	        		   [28.370549174699388, 105.8803309586094],
	        		   [39.46386269142331, 108.4260716291433],

	        		   [51.20182786473858, 109.80267419867106],
	        		   [66.34615384615384,114.91490934831975],
	        		   [79.41827580245253,113.42105228616809],
	        		   [96.41814145298089,114.90666646784669],
	        		   [110.14547937713527,110.14547937713529],
	        		   [123.74564081152722,103.83492156474865],
	        		   [141.77631535771013,99.27284475306567],
	        		   [154.8853125999092,89.42307692307695],
	        		   [167.3183606836892,78.02183293674452],
	        		   [184.32432176954356,67.08856657541965],
	        		   [195.04271492375415,52.26153795339361],
	        		   [204.53699485638165,36.06539074620863],
	        		   [218.39652996626728,19.107220525448177],
	        		   [225,20.107220525448177],
	        		   [218.39652996626728,-19.107220525448103],
	        		   [204.53699485638165,-36.0653907462086],
	        		   [195.04271492375415,-52.261537953393585],
	        		   [184.3243217695436,-67.08856657541963],
	        		   [167.31836068368924,-78.02183293674449],
	        		   [154.88531259990924,-89.42307692307688],
	        		   [141.77631535771016,-99.27284475306563],
	        		   [123.74564081152722,-103.83492156474865],
	        		   [110.14547937713529,-110.14547937713527],
	        		   [96.41814145298092,-114.90666646784669],
	        		   [79.41827580245257,-113.42105228616806],
	        		   [66.34615384615384,-114.91490934831975],
	        		   [51.20182786473859,-109.80267419867106],
	        		   [39.46386269142333,-108.42607162914327],
	        		   [28.37054917469942,-105.8803309586094],
	        		   [17.03087896348743,-96.58691423773578],
	        		   [8.045145484399217,-91.95643367000729],
	        		   [10.891377993113237,-80.76923076923077]];
	        	*/

	        	var seriesData = [];
			    
			    // build the data
			    for (i = 0; i < 12; i++) { 
			        seriesData.push ({
			            "data": linedata
					});
			    }

				var chartPolar = new Highcharts.Chart({
			        chart: {
			            polar: true,
			            renderTo: 'chartPolar',
			        },


			        title: {
			            text: 'Polar chart'
			        },

			        /*
			        subtitle: {
			            text: 'Source: or.water.usgs.gov'
			        },
			        */

	                tooltip: {
	                    enabled: false
	                },
	                credits: {
	                    enabled: false
	                },
	                exporting: {
	                    enabled: false
	                },
	                legend: {
	                    enabled: false,
	                },

			        pane: {
			            size: '100%',
			            startAngle: 0,
			            endAngle: 360
			        },	                

					xAxis: {
						min: 0,
			            max: 360,
			             tickInterval: 45,
			        },

			        yAxis: {
			            min: 0,
						tickInterval: 25,

			            endOnTick: false,
			            showLastLabel: true,
			            labels: {
			                formatter: function () {
			                    return this.value;
			                }
			            }
			        },


			        plotOptions: {
	                    series: {
	                        animation: false,
	                        enableMouseTracking: false,
	                        pointStart: 0,
	                        states: {
	                            hover: {
	                                enabled: false
	                            }
	                        },
	                        tooltip: {
	                            enabled: false,
	                        },
	                        color: 'rgba(100, 100, 100, 0.1)'
	                    },
	                    column: {
	                        pointPadding: 0,
	                        groupPadding: 0
	                    },
	                    line: {
	                        marker: {
	                            enabled: false
	                        }
	                    }
			        },

					series: seriesData

			    });


		        $("#dialog-delete-comment-confirm").dialog({
		            autoOpen: false,
		            resizable: false,
		            height: 190,
		            width: 500,
		            modal: true,
		            buttons: {
		                SaveDialogButton: {
		                    click: function () {
						        $.ajax({
						        	    url : urlBase + '/session/delete-comment?id_comment='+ window.idComment +'&id_session='+$("#hiddenSessionId").val(),
							        }).done(function (data){
							        	if (data){
							        		if (data=="error"){
							        			$("#dialog-delete-comment-confirm").dialog("close");
							        			alert("error");
							        		}
							        		else{
							        			$("#idComment-"+window.idComment).closest(".commentElement").fadeOut(300, function() { $(this).remove(); });
							        			$("#dialog-delete-comment-confirm").dialog("close");
							        		}
										}
										else{
										}

							        }).fail(function () {
						        });
		                    },
		                    text: "Delete"
		                },
		                CancelDialogButton: {
		                    click: function () {

		                        $(this).dialog("close");

		                    },
		                    text: "Cancel"
		                }
		            }
		        });

				$(document).on("click", ".removeComment", function(){
	                window.idComment = $(this).attr("id").split("-")[1];
	                $('#dialog-delete-comment-confirm').dialog('open');
	                return false;
				});


		        $("#dialog-delete-session-confirm").dialog({
		            autoOpen: false,
		            resizable: false,
		            height: 190,
		            width: 500,
		            modal: true,
		            buttons: {
		                SaveDialogButton: {
		                    click: function () {

		                    	window.location = urlBase + '/session/delete-session?id_session='+ window.idSession;

		                    	/*
						        $.ajax({
						        	    url : urlBase + '/session/delete-session?id_session='+ window.idSession,
							        }).done(function (data){
							        	if (data){
							        	}

							        }).fail(function () {
						        });
								*/

		                    },
		                    text: "Delete"
		                },
		                CancelDialogButton: {
		                    click: function () {

		                        $(this).dialog("close");

		                    },
		                    text: "Cancel"
		                }
		            }
		        });

				$(document).on("click", ".clsDeleteSession", function(){
	                window.idSession = $(this).attr("id").split("-")[1];
	                $('#dialog-delete-session-confirm').dialog('open');
	                return false;
				});

				var parameterByStrokesValues = <?php echo json_encode($parameterByStrokesValues); ?>;
				var parameterByStrokes = convertToMyJsonArray(parameterByStrokesValues, [], true);
				
				window.varChartParameterByStrokesValues = parameterByStrokesValues;

				//alert(JSON.stringify(parameterByStrokes));

				/*
				var parameterByStrokesValuesRAW = <?php echo json_encode($summaryTotalData); ?>;
				var parameterByStrokes = convertToMyJsonArray(parameterByStrokesValuesRAW, [], true);
				*/
			
				window.varChartParameterByStrokes = {
			        chart: {
			        	renderTo: 'highchartContainer1ParameterByStrokes',
			        	type: 'column'
			        },
			        
			        title: {
			            text: 'Training History'
			        },
			        /*
			        subtitle: {
			            text: 'Source: WorldClimate.com'
			        },
			        */
			        xAxis: {

			            crosshair: true,
			            title: {
			                text: 'Strokes'
			            },

			        },
			        legend: {
				        	enabled: false
			        },

					credits: {
					    enabled: false
					},
			        yAxis: {
			            min: 0,
			            title: {
			                text: 'Power'
			            }
			        },
			        tooltip: {
			            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
			            footerFormat: '</table>',
			            shared: true,
			            useHTML: true
			        },
			        plotOptions: {
			            column: {
			                pointPadding: 0.2,
			                borderWidth: 0,
			            }
			        },
			        series: $.extend(true,[], [parameterByStrokes[0]])
			    };

				window.varChartParameterByStrokes = new Highcharts.Chart(window.varChartParameterByStrokes);

				$("#modulsDDParameterByStrokes").multiselect({
					   multiple: false,
					   header: "Select a module",
					   noneSelectedText: "Select a module",
					   selectedList: 1,
					   selectedText: function(numChecked, numTotal, checkedItems){
					      return 'Select module';
					   },

					   click: function(event, ui){
					      var clicked = $("#modulsDDParameterByStrokes option[value='" + ui.value + "']");

					      var index = parseInt(clicked.index());
					      var serie = convertToMyJsonArray(varChartParameterByStrokesValues, [], true);

						  serieIndex = serie[index];

			              window.varChartParameterByStrokes.series[0].setData(serieIndex.data);

			              window.varChartParameterByStrokes = new Highcharts.Chart(window.varChartParameterByStrokes.options);
					   },
				});

			})
		</script>

@endsection

@section('content')

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=507802702573516";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		@if (Auth::user()->id == $sessionUser->user->id)
		<div id="strafta">
			<div id="straftaText"><h2 class="h2Title"></h2></div>
		    <div id="straftaButtons">
				<a href="#" class="btn btn-default btn-small clsDeleteSession" style="float:right;" id="idDeleteSession-{{ $sessionUser->id }}">Delete session</a>
		    </div>
		</div>		
		@endif

		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
			  	<div class="wrapperHeader col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  		<div class="row">
							<div id="headerOpenedFileWrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							    <div id="headerOpenedFile">
							    	@if (isset($sessionUser->user->profile->image_id))
							    		<img src="{{ Request::root().'/../storage/profile_images'.$session->user->profile->image->name }}" class="headerAvatarOpenedFile" width='50' height='50' />
							    	@else
							    		{!! HTML::image('images/avatar_empty.png', 'a picture', array('class' => 'headerAvatarOpenedFile', 'width' => '50', 'height' => '50')) !!}
							    	@endif
							        <div class="sessionTitleTextContainer">
							            <h2 id="sessionTitle" class="">
							            	{{ date('D dS F Y', strtotime($sessionUser->date)) }}
							            </h2>
							            <span>
							                <strong>
							                     {{ $sessionUser->user->display_name }}  (<a href="{{ url('/'.$sessionUser->user->linkname) }}">{{ $sessionUser->user->linkname }}</a>)
							                </strong>
							            </span>
							        </div>
							    </div>
							</div>
						</div>

						<br />
						<br />
						
						<!--
						<div class="row">
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
								    <div class="tmodulesRight">
								        <span class="tmodulesLFSecond">
								            2139
								        </span>
								        <span class="tmodulesRFUnit">
								            W
								        </span>
								    </div>
								    <div class="tmodulesLFFirst">
								        <a id="clickModule-4205" class="btnModule" href="#">
								            Power
								        </a>
								    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
								    <div class="tmodulesRight">
								        <span class="tmodulesLFSecond">
								            35
								        </span>
								        <span class="tmodulesRFUnit">
								            °
								        </span>
								    </div>
								    <div class="tmodulesLFFirst">
								        <a id="clickModule-4205" class="btnModule" href="#">
								            Angle
								        </a>
								    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            211
							        </span>
							        <span class="tmodulesRFUnit">
							            m
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Stroke
							        </a>
							    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            78
							        </span>
							        <span class="tmodulesRFUnit">
							            bpm
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Heart rate
							        </a>
							    </div>
							</div>
							<div class="oneModuleDiv col-xs-12 col-sm-6 col-md-4 col-lg-2">
							    <div class="tmodulesRight">
							        <span class="tmodulesLFSecond">
							            21
							        </span>
							        <span class="tmodulesRFUnit">
							            %
							        </span>
							    </div>
							    <div class="tmodulesLFFirst">
							        <a id="clickModule-4205" class="btnModule" href="#">
							            Balance P
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
						  -->


						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
								<h4 class="titleModul">Stroke count</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->stroke_count }}</div>
									<!-- <div>all time sessions</div> -->
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">Training time [hh:mm:ss]</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{  gmdate("H:i:s", $summaryTotalData->time) }}</div>
									<!-- <div>all time kilometers</div> -->
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">Distance [km]</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->distance }}</div> 
									<!-- <div>all time hours</div> -->
								</div>
							</div>		

							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">Power average [W]</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->power_average }}</div>
									<!-- <div>kilometers this month</div> -->
								</div>
							</div>																										
						</div>

						<div class="row">
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">Power max</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->power_max }}</div>
									<!-- <div>kilometers this month</div> -->
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">Speed average [spm]</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->speed_average }}</div>
									<!-- <div>hours this month</div> -->
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">Angle average [°]</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->angle_average }}</div> 
									<!-- <div>kilometers this week</div> -->
								</div>
							</div>																		
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
								<h4 class="titleModul">HR average [bmp]</h4>
								<div class="wrapperBoxes ovrRightValues">
									<div class="ovrMidValues">{{ $summaryTotalData->heart_rate_average }}</div> 
									<!-- <div>hours this week</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-9" >
						<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
											<div class="wrapperChart">
												<a class="glyClass btn-lg" href="#" data-toggle="modal" data-target="#myModal">
													<span class="glyphicon glyphicon-info-sign"></span>
												</a>									
												<div id="leftHand" class="chart">
												</div>				
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
											<div class="wrapperChart">
												<a class="glyClass btn-lg" href="#" data-toggle="modal" data-target="#myModal">
													<span class="glyphicon glyphicon-info-sign"></span>
												</a>									
												<div id="rightHand" class="chart">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="wrapperBoxes">
										<div id="highchartContainer1ParameterByStrokes" class="chart">
										</div>
										<div class="highchartContainer1ButtonsRight">
												<div class="customLegend">
													<select name="demo" id="modulsDDParameterByStrokes" >
														<option value="time" selected="selected">Time [hh:mm:ss]</option>
														<option value="speed">Speed</option>
														<option value="distance">Distance</option>
														<option value="pace">Pace</option>
														<option value="pwr">Power</option>
														<option value="pwr_l">Power left</option>
														<option value="pwr_r">Power right</option>
														<option value="pwr_bal">Power balance</option>
														<option value="srate">Stroke rate</option>
														<option value="ang">Angle</option>
														<option value="ang_l">Angle left</option>
														<option value="ang_r">Angle right</option>
														<option value="hr">Heart rate</option>
													</select>
												</div>
											    <div style="width:100%;">
											        <div class="loadingGifProgress" style="margin:0 auto; display:none; width:120px;">
											            Loading...
											            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
											        </div>
										        </div>														
										</div>
										<div style="clear:both"></div>													
									</div>
								</div>


								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
											<div class="wrapperChart">
												<a class="glyClass btn-lg" href="#" data-toggle="modal" data-target="#myModal">
													<span class="glyphicon glyphicon-info-sign"></span>
												</a>																		
												<div id="powerStroke" class="chart">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
											<div class="wrapperChart">
												<div id="chartPolar" class="chart">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="wrapperChart">
												<div id="allModules" class="chart">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">								
											<div class="wrapperChart">
												<div id="leftRightPercentage" class="chart">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
											<div class="wrapperChart">
												<div id="allModulesByStroke" class="chart">
												</div>
											</div>										
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

							        <?php 
							        	$link = urlencode(Request::url());
							        ?>

									<a title="send to Facebook"  href="http://www.facebook.com/dialog/share?&display=popup
										&app_id=507802702573516
										&href={{$link}}
										&redirect_uri={{$link}}"
									  target="_blank" class="btn btn-custom-facebook btn-lg fb-share-button" id="facebookbtn-link">
									  <span>
									    Share on Facebook
									  </span>
									</a>

							        <?php 
							        	$link = urlencode(Request::url());
							        	$text = $sessionUser->display_name."@".strtolower(config('app.title'))."sportconn on ".$sessionUser->date;
							        ?>

									<a title="send to Twitter" rel="canonical" data-url="{{ $link }}" href="https://twitter.com/share?url={{ $link }}&text={{ $text }}&hashtags=sportconn"
									  target="_blank" class="btn btn-custom-twitter btn-lg" id="twitterbtn-link">
									  <span>
									    Share on Twitter
									  </span>
									</a>

									<!--
					                <button id="twitterShare" class="btn btn-custom-twitter btn-lg" >
					                    <i class="fa fa-twitter"></i>
					                    Share on Twitter
					                </button>
									-->

					                <h4>
					                    <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
					                    &nbsp;Link
					                </h4>
					                <div class="row">
						                <input type="text" style="width:95%; margin-left: 15px;" value="{{ Request::url() }}" onclick="this.setSelectionRange(0, this.value.length)">
					                </div>

					            </div>
					        </div>

					        <div id="rightBarCommentsDetailsWrapper">
					            <div id="rightBarCommentsDetails">
					                <h2>Comments</h2>
					                <div id="comments">
					                	{!! $allComments !!} 
					                </div>

					                @if (Auth::check())
						                <div id="comment_form">
						                	{!! Form::open(array('id'=>'formComment')) !!}

						                		<?php $current_params = Route::current()->parameters(); ?>

												<div class="form-group">
														{!! Form::textarea('comment', '', array('rows'=>'3', 'id'=>'taComment')) !!}
														<input type="hidden" value="{!! $current_params['session'] !!}" name="session_id" id="hiddenSessionId" />
												</div>

											    <div style="width:100%;">
											        <div id="loadingGif" style="margin:0 auto; display:none; width:120px;">
											            Loading...
											            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
											        </div>
										        </div>

												<a href="#" class="btn btn-default" id="postComment">Post comment</a>

											{!! Form::close() !!}
						                </div>
					                @else
					                	<p>You must be logged in to post a comment</p>
					                @endif
				                
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


    <div id="dialog-delete-comment-confirm" title="Delete comment">
        <p>Are you sure you want to delete this comment?</p>
    </div>

    <div id="dialog-delete-session-confirm" title="Delete session">
        <p>Are you sure you want to delete this session?</p>
    </div>    

		<script type="text/javascript">
			$(function(){
	            /*
				window.onresize = displayWindowSize;
				function displayWindowSize() {
				    alert(window.innerWidth);
				};
				*/
			    varChartLeftHand = {
			        chart: {
			            renderTo: 'leftHand',
			        },

			        title: {
			            text: 'Left',
			            x: -20 //center
			        },
			        /*
			        subtitle: {
			            text: 'Source: WorldClimate.com',
			            x: -20
			        },
			        */
			        xAxis: {
			            categories: ['4', '10', '15', '50', '70', '90',
			                '120', '130', '160', '170', '190', '210'],
			            title: {
			                text: 'Angle [°]'
			            },			                
			        },
			        yAxis: {
			            title: {
			                text: 'Force [N]'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        tooltip: {
			            valueSuffix: 'N'
			        },
			        
			        legend: {
			        	enabled: false
			        	/*
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			            */
			        },
			        
			        series: [{
			            name: 'Force',
			            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
			        }, {
			            name: 'Force',
			            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			        }, {
			            name: 'Force',
			            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
			        }, {
			            name: 'Force',
			            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
			        }]
			    };

				varChartLeftHand = new Highcharts.Chart(varChartLeftHand);

			    varChartRightHand = {
			        chart: {
			            renderTo: 'rightHand',
			        },
			        title: {
			            text: 'Right',
			            x: -20 //center
			        },
			        /*
			        subtitle: {
			            text: 'Source: WorldClimate.com',
			            x: -20
			        },
			        */
			        xAxis: {
			            categories: ['4', '10', '15', '50', '70', '90',
			                '120', '130', '160', '170', '190', '210'],
			            title: {
			                text: 'Angle[°]'
			            },			                
			        },
			        yAxis: {
			            title: {
			                text: 'Force[N]'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        tooltip: {
			            valueSuffix: 'N'
			        },
			        
			        legend: {
			        	enabled: false
			        	/*
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			            */
			        },
			        
			        series: [{
			            name: 'Force',
			            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
			        }, {
			            name: 'Force',
			            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
			        }, {
			            name: 'Force',
			            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
			        }, {
			            name: 'Force',
			            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
			        }]
			    };

				varChartRightHand = new Highcharts.Chart(varChartRightHand);

				var powerStroke = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'powerStroke',
						type: 'scatter',
            			zoomType: 'xy'
			        },
			        title: {
			            text: 'Stroke/Power'
			        },
			        /*
			        subtitle: {
			            text: 'Source: Heinz  2003'
			        },
			        */
			        xAxis: {
			            title: {
			                enabled: true,
			                text: 'Stroke [spm]'
			            },
			            startOnTick: true,
			            endOnTick: true,
			            showLastLabel: true
			        },
			        yAxis: {
			            title: {
			                text: 'Power[W]' 
			            }
			        },
			        legend: {
			        	enabled: false
			        	/*
			            layout: 'vertical',
			            align: 'left',
			            verticalAlign: 'top',
			            x: 100,
			            y: 70,
			            floating: true,
			            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
			            borderWidth: 1
			            */
			        },
			        plotOptions: {
			            scatter: {
			                marker: {
			                    radius: 5,
			                    states: {
			                        hover: {
			                            enabled: true,
			                            lineColor: 'rgb(100,100,100)'
			                        }
			                    }
			                },
			                states: {
			                    hover: {
			                        marker: {
			                            enabled: false
			                        }
			                    }
			                },
			                tooltip: {
			                    headerFormat: '<b>{series.name}</b><br>',
			                    pointFormat: '{point.x} spm, {point.y} W'
			                }
			            }
			        },
			        series: [{
			            name: 'Power',
			            color: 'rgba(223, 83, 83, .5)',
			            data: [
			            	[161.2, 51.6], [167.5, 59.0], [159.5, 49.2], [157.0, 63.0], [155.8, 53.6],
			                [170.0, 59.0], [159.1, 47.6], [166.0, 69.8], [176.2, 66.8], [160.2, 75.2],
			                [172.5, 55.2], [170.9, 54.2], [172.9, 62.5], [153.4, 42.0], [160.0, 50.0],
			                [147.2, 49.8], [168.2, 49.2], [175.0, 73.2], [157.0, 47.8], [167.6, 68.8],
			                [159.5, 50.6], [175.0, 82.5], [166.8, 57.2], [176.5, 87.8], [170.2, 72.8],
			                [174.0, 54.5], [173.0, 59.8], [179.9, 67.3], [170.5, 67.8], [160.0, 47.0],
			                [154.4, 46.2], [162.0, 55.0], [176.5, 83.0], [160.0, 54.4], [152.0, 45.8],
			                [162.1, 53.6], [170.0, 73.2], [160.2, 52.1], [161.3, 67.9], [166.4, 56.6],
			                [168.9, 62.3], [163.8, 58.5], [167.6, 54.5], [160.0, 50.2], [161.3, 60.3],
			                [167.6, 58.3], [165.1, 56.2], [160.0, 50.2], [170.0, 72.9], [157.5, 59.8],
			                [167.6, 61.0], [160.7, 69.1], [163.2, 55.9], [152.4, 46.5], [157.5, 54.3],
			                [168.3, 54.8], [180.3, 60.7], [165.5, 60.0], [165.0, 62.0], [164.5, 60.3],
			                [156.0, 52.7], [160.0, 74.3], [163.0, 62.0], [165.7, 73.1], [161.0, 80.0],
			                [162.0, 54.7], [166.0, 53.2], [174.0, 75.7], [172.7, 61.1], [167.6, 55.7],
			                [151.1, 48.7], [164.5, 52.3], [163.5, 50.0], [152.0, 59.3], [169.0, 62.5],
			                [164.0, 55.7], [161.2, 54.8], [155.0, 45.9], [170.0, 70.6], [176.2, 67.2],
			                [170.0, 69.4], [162.5, 58.2], [170.3, 64.8], [164.1, 71.6], [169.5, 52.8],
			                [163.2, 59.8], [154.5, 49.0], [159.8, 50.0], [173.2, 69.2], [170.0, 55.9],
			                [161.4, 63.4], [169.0, 58.2], [166.2, 58.6], [159.4, 45.7], [162.5, 52.2],
			                [159.0, 48.6], [162.8, 57.8], [159.0, 55.6], [179.8, 66.8], [162.9, 59.4],
			                [161.0, 53.6], [151.1, 73.2], [168.2, 53.4], [168.9, 69.0], [173.2, 58.4],
			                [171.8, 56.2], [178.0, 70.6], [164.3, 59.8], [163.0, 72.0], [168.5, 65.2],
			                [166.8, 56.6], [172.7, 105.2], [163.5, 51.8], [169.4, 63.4], [167.8, 59.0],
			                [159.5, 47.6], [167.6, 63.0], [161.2, 55.2], [160.0, 45.0], [163.2, 54.0],
			                [162.2, 50.2], [161.3, 60.2], [149.5, 44.8], [157.5, 58.8], [163.2, 56.4],
			                [172.7, 62.0], [155.0, 49.2], [156.5, 67.2], [164.0, 53.8], [160.9, 54.4],
			                [162.8, 58.0], [167.0, 59.8], [160.0, 54.8], [160.0, 43.2], [168.9, 60.5],
			                [158.2, 46.4], [156.0, 64.4], [160.0, 48.8], [167.1, 62.2], [158.0, 55.5],
			                [167.6, 57.8], [156.0, 54.6], [162.1, 59.2], [173.4, 52.7], [159.8, 53.2],
			                [170.5, 64.5], [159.2, 51.8], [157.5, 56.0], [161.3, 63.6], [162.6, 63.2],
			                [160.0, 59.5], [168.9, 56.8], [165.1, 64.1], [162.6, 50.0], [165.1, 72.3],
			                [166.4, 55.0], [160.0, 55.9], [152.4, 60.4], [170.2, 69.1], [162.6, 84.5],
			                [170.2, 55.9], [158.8, 55.5], [172.7, 69.5], [167.6, 76.4], [162.6, 61.4],
			                [167.6, 65.9], [156.2, 58.6], [175.2, 66.8], [172.1, 56.6], [162.6, 58.6],
			                [160.0, 55.9], [165.1, 59.1], [182.9, 81.8], [166.4, 70.7], [165.1, 56.8],
			                [177.8, 60.0], [165.1, 58.2], [175.3, 72.7], [154.9, 54.1], [158.8, 49.1],
			                [172.7, 75.9], [168.9, 55.0], [161.3, 57.3], [167.6, 55.0], [165.1, 65.5],
			                [175.3, 65.5], [157.5, 48.6], [163.8, 58.6], [167.6, 63.6], [165.1, 55.2],
			                [165.1, 62.7], [168.9, 56.6], [162.6, 53.9], [164.5, 63.2], [176.5, 73.6],
			                [168.9, 62.0], [175.3, 63.6], [159.4, 53.2], [160.0, 53.4], [170.2, 55.0],
			                [162.6, 70.5], [167.6, 54.5], [162.6, 54.5], [160.7, 55.9], [160.0, 59.0],
			                [157.5, 63.6], [162.6, 54.5], [152.4, 47.3], [170.2, 67.7], [165.1, 80.9],
			                [172.7, 70.5], [165.1, 60.9], [170.2, 63.6], [170.2, 54.5], [170.2, 59.1],
			                [161.3, 70.5], [167.6, 52.7], [167.6, 62.7], [165.1, 86.3], [162.6, 66.4],
			                [152.4, 67.3], [168.9, 63.0], [170.2, 73.6], [175.2, 62.3], [175.2, 57.7],
			                [160.0, 55.4], [165.1, 104.1], [174.0, 55.5], [170.2, 77.3], [160.0, 80.5],
			                [167.6, 64.5], [167.6, 72.3], [167.6, 61.4], [154.9, 58.2], [162.6, 81.8],
			                [175.3, 63.6], [171.4, 53.4], [157.5, 54.5], [165.1, 53.6], [160.0, 60.0],
			                [174.0, 73.6], [162.6, 61.4], [174.0, 55.5], [162.6, 63.6], [161.3, 60.9],
			                [156.2, 60.0], [149.9, 46.8], [169.5, 57.3], [160.0, 64.1], [175.3, 63.6],
			                [169.5, 67.3], [160.0, 75.5], [172.7, 68.2], [162.6, 61.4], [157.5, 76.8],
			                [176.5, 71.8], [164.4, 55.5], [160.7, 48.6], [174.0, 66.4], [163.8, 67.3],
			                [174.0, 65.6], [175.3, 71.8], [193.5, 80.7], [186.5, 72.6], [187.2, 78.8],
			                [181.5, 74.8], [184.0, 86.4], [184.5, 78.4], [175.0, 62.0], [184.0, 81.6],
			                [180.0, 76.6], [177.8, 83.6], [192.0, 90.0], [176.0, 74.6], [174.0, 71.0],
			                [184.0, 79.6], [192.7, 93.8], [171.5, 70.0], [173.0, 72.4], [176.0, 85.9],
			                [176.0, 78.8], [180.5, 77.8], [172.7, 66.2], [176.0, 86.4], [173.5, 81.8],
			                [178.0, 89.6], [180.3, 82.8], [180.3, 76.4], [164.5, 63.2], [173.0, 60.9],
			                [183.5, 74.8], [175.5, 70.0], [188.0, 72.4], [189.2, 84.1], [172.8, 69.1],
			                [170.0, 59.5], [182.0, 67.2], [170.0, 61.3], [177.8, 68.6], [184.2, 80.1],
			                [186.7, 87.8], [171.4, 84.7], [172.7, 73.4], [175.3, 72.1], [180.3, 82.6],
			                [182.9, 88.7], [188.0, 84.1], [177.2, 94.1], [172.1, 74.9], [167.0, 59.1],
			                [169.5, 75.6], [174.0, 86.2], [172.7, 75.3], [182.2, 87.1], [164.1, 55.2],
			                [163.0, 57.0], [171.5, 61.4], [184.2, 76.8], [174.0, 86.8], [174.0, 72.2],
			                [177.0, 71.6], [186.0, 84.8], [167.0, 68.2], [171.8, 66.1], [182.0, 72.0],
			                [167.0, 64.6], [177.8, 74.8], [164.5, 70.0], [192.0, 101.6], [175.5, 63.2],
			                [171.2, 79.1], [181.6, 78.9], [167.4, 67.7], [181.1, 66.0], [177.0, 68.2],
			                [174.5, 63.9], [177.5, 72.0], [170.5, 56.8], [182.4, 74.5], [197.1, 90.9],
			                [180.1, 93.0], [175.5, 80.9], [180.6, 72.7], [184.4, 68.0], [175.5, 70.9],
			                [180.6, 72.5], [177.0, 72.5], [177.1, 83.4], [181.6, 75.5], [176.5, 73.0],
			                [175.0, 70.2], [174.0, 73.4], [165.1, 70.5], [177.0, 68.9], [192.0, 102.3],
			                [176.5, 68.4], [169.4, 65.9], [182.1, 75.7], [179.8, 84.5], [175.3, 87.7],
			                [184.9, 86.4], [177.3, 73.2], [167.4, 53.9], [178.1, 72.0], [168.9, 55.5],
			                [157.2, 58.4], [180.3, 83.2], [170.2, 72.7], [177.8, 64.1], [172.7, 72.3],
			                [165.1, 65.0], [186.7, 86.4], [165.1, 65.0], [174.0, 88.6], [175.3, 84.1],
			                [185.4, 66.8], [177.8, 75.5], [180.3, 93.2], [180.3, 82.7], [177.8, 58.0],
			                [177.8, 79.5], [177.8, 78.6], [177.8, 71.8], [177.8, 116.4], [163.8, 72.2],
			                [188.0, 83.6], [198.1, 85.5], [175.3, 90.9], [166.4, 85.9], [190.5, 89.1],
			                [166.4, 75.0], [177.8, 77.7], [179.7, 86.4], [172.7, 90.9], [190.5, 73.6],
			                [185.4, 76.4], [168.9, 69.1], [167.6, 84.5], [175.3, 64.5], [170.2, 69.1],
			                [190.5, 108.6], [177.8, 86.4], [190.5, 80.9], [177.8, 87.7], [184.2, 94.5],
			                [176.5, 80.2], [177.8, 72.0], [180.3, 71.4], [171.4, 72.7], [172.7, 84.1],
			                [172.7, 76.8], [177.8, 63.6], [177.8, 80.9], [182.9, 80.9], [170.2, 85.5],
			                [167.6, 68.6], [175.3, 67.7], [165.1, 66.4], [185.4, 102.3], [181.6, 70.5],
			                [172.7, 95.9], [190.5, 84.1], [179.1, 87.3], [175.3, 71.8], [170.2, 65.9],
			                [193.0, 95.9], [171.4, 91.4], [177.8, 81.8], [177.8, 96.8], [167.6, 69.1],
			                [167.6, 82.7], [180.3, 75.5], [182.9, 79.5], [176.5, 73.6], [186.7, 91.8],
			                [188.0, 84.1], [188.0, 85.9], [177.8, 81.8], [174.0, 82.5], [177.8, 80.5],
			                [171.4, 70.0], [185.4, 81.8], [185.4, 84.1], [188.0, 90.5], [188.0, 91.4],
			                [182.9, 89.1], [176.5, 85.0], [175.3, 69.1], [175.3, 73.6], [188.0, 80.5],
			                [188.0, 82.7], [175.3, 86.4], [170.5, 67.7], [179.1, 92.7], [177.8, 93.6],
			                [175.3, 70.9], [182.9, 75.0], [170.8, 93.2], [188.0, 93.2], [180.3, 77.7],
			                [177.8, 61.4], [185.4, 94.1], [168.9, 75.0], [185.4, 83.6], [180.3, 85.5],
			                [174.0, 73.9], [167.6, 66.8], [182.9, 87.3], [160.0, 72.3], [180.3, 88.6],
			                [167.6, 75.5], [186.7, 101.4], [175.3, 91.1], [175.3, 67.3], [175.9, 77.7],
			                [175.3, 81.8], [179.1, 75.5], [181.6, 84.5], [177.8, 76.6], [182.9, 85.0],
			                [177.8, 102.5], [184.2, 77.3], [179.1, 71.8], [176.5, 87.9], [188.0, 94.3],
			                [174.0, 70.9], [167.6, 64.5], [170.2, 77.3], [167.6, 72.3], [188.0, 87.3],
			                [174.0, 80.0], [176.5, 82.3], [180.3, 73.6], [167.6, 74.1], [188.0, 85.9],
			                [180.3, 73.2], [167.6, 76.3], [183.0, 65.9], [183.0, 90.9], [179.1, 89.1],
			                [170.2, 62.3], [177.8, 82.7], [179.1, 79.1], [190.5, 98.2], [177.8, 84.1],
			                [180.3, 83.2], [180.3, 83.2]
			                ]
			        }]
			    });


				var chart3 = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'allModules',
						zoomType: 'xy'
			        },

			        title: {
			            text: 'All modules by time'
			        },
			        /*
			        subtitle: {
			            text: 'Source: WorldClimate.com'
			        },
			        */
			        xAxis: [{
			            categories: ['5', '10', '15', '20', '25', '30',
			                '35', '40', '45', '50', '55', '60'],
			            crosshair: true,

			            title: {
			                text: 'Time [s]',
			            },			            

			        }],
			        yAxis: [{ // Primary yAxis
			            labels: {
			                format: '{value} [bpm]',
			                style: {
			                    color: Highcharts.getOptions().colors[2]
			                }
			            },
			            title: {
			                text: 'Heart rate',
			                style: {
			                    color: Highcharts.getOptions().colors[2]
			                }
			            },
			            opposite: true

			        }, { // Secondary yAxis
			            gridLineWidth: 0,
			            title: {
			                text: 'Force',
			                style: {
			                    color: Highcharts.getOptions().colors[0]
			                }
			            },
			            labels: {
			                format: '{value} [N]',
			                style: {
			                    color: Highcharts.getOptions().colors[0]
			                }
			            }

			        }, { // Tertiary yAxis
			            gridLineWidth: 0,
			            title: {
			                text: 'Angle',
			                style: {
			                    color: Highcharts.getOptions().colors[1]
			                }
			            },
			            labels: {
			                format: '{value} [°]',
			                style: {
			                    color: Highcharts.getOptions().colors[1]
			                }
			            },

			            opposite: true
			        }, {

			            gridLineWidth: 0,
			            title: {
			                text: 'Stroke',
			                style: {
			                    color: Highcharts.getOptions().colors[3]
			                }
			            },
			            labels: {
			                format: '{value} [str]',
			                style: {
			                    color: Highcharts.getOptions().colors[3]
			                }
			             },
			             opposite: true
					}],

			        tooltip: {
			            shared: true
			        },
			        legend: {
			            //layout: 'bottom',
			            //align: 'left',
			            //x: 80,
			            //verticalAlign: 'top',
			            //y: 55,
			            //floating: true,
			            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
			        },
			        series: [{
			            name: 'Force',
			            type: 'spline',
			            yAxis: 1,
			            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
			            tooltip: {
			                valueSuffix: ' N'
			            }

			        }, {
			            name: 'HR',
			            type: 'spline',
			            yAxis: 2,
			            data: [1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7],
			            marker: {
			                enabled: false
			            },
			            dashStyle: 'shortdot',
			            tooltip: {
			                valueSuffix: ' bpm'
			            }
			        }, {
			            name: 'Ang',
			            type: 'spline',
			            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
			            tooltip: {
			                valueSuffix: ' °C'
			            }
			        }, {
			            name: 'Stroke',
			            type: 'spline',
			            yAxis: 3,
			            data: [5.0, 6.6, 1.5, 4.5, 13.2, 21.5, 25.2, 46.5, 23.3, 2.3, 13.9, 1.6],
			            tooltip: {
			                valueSuffix: ' °C'
			            }
			        }]
			    });
			    
			    /*
				var chartLeftRightPercentage = new Highcharts.Chart({
			        chart: {
			            renderTo: 'leftRightPercentage',
			            //type: 'column',
			        },					

		            rangeSelector : {
		                selected : 1
		            },

		            title : {
		                text : 'USD to EUR exchange rate'
		            },

		            yAxis : {
		                title : {
		                    text : 'Exchange rate'
		                },
		                plotLines : [{
		                    value : 0.6738,
		                    color : 'green',
		                    dashStyle : 'shortdash',
		                    width : 2,
		                    label : {
		                        text : 'Last quarter minimum'
		                    }
		                }, {
		                    value : 0.7419,
		                    color : 'red',
		                    dashStyle : 'shortdash',
		                    width : 2,
		                    label : {
		                        text : 'Last quarter maximum'
		                    }
		                }]
		            },

		            series : [{
		                name : 'USD to EUR',
		                data : data,
		                tooltip : {
		                    valueDecimals : 4
		                }
		            }]					
				});
				*/

			   	
			    var chartAllModulesByStroke = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'allModulesByStroke',
						zoomType: 'xy'
			        },

			        title: {
			            text: 'All modules by strokes'
			        },

			        /*
			        subtitle: {
			            text: 'Source: WorldClimate.com'
			        },
			        */

			        xAxis: [{
			            categories: ['1', '2', '3', '4', '5', '6',
			                '7', '8', '9', '10', '11', '12'],
			            crosshair: true,

			            title: {
			                text: 'Stroke [s]',
			            },			            

			        }],
			        yAxis: [{ // Primary yAxis
			            labels: {
			                format: '{value} [bpm]',
			                style: {
			                    color: Highcharts.getOptions().colors[2]
			                }
			            },
			            title: {
			                text: 'Heart rate',
			                style: {
			                    color: Highcharts.getOptions().colors[2]
			                }
			            },
			            opposite: true

			        }, { // Secondary yAxis
			            gridLineWidth: 0,
			            title: {
			                text: 'Force',
			                style: {
			                    color: Highcharts.getOptions().colors[0]
			                }
			            },
			            labels: {
			                format: '{value} [N]',
			                style: {
			                    color: Highcharts.getOptions().colors[0]
			                }
			            }

			        }, { // Tertiary yAxis
			            gridLineWidth: 0,
			            title: {
			                text: 'Angle',
			                style: {
			                    color: Highcharts.getOptions().colors[1]
			                }
			            },
			            labels: {
			                format: '{value} [°]',
			                style: {
			                    color: Highcharts.getOptions().colors[1]
			                }
			            },

			            opposite: true
			        }, {

			            gridLineWidth: 0,
			            title: {
			                text: 'Stroke',
			                style: {
			                    color: Highcharts.getOptions().colors[3]
			                }
			            },
			            labels: {
			                format: '{value} [str]',
			                style: {
			                    color: Highcharts.getOptions().colors[3]
			                }
			             },
			             opposite: true
					}],

			        tooltip: {
			            shared: true
			        },
			        legend: {
			            //layout: 'bottom',
			            //align: 'left',
			            //x: 80,
			            //verticalAlign: 'top',
			            //y: 55,
			            //floating: true,
			            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
			        },
			        series: [{
			            name: 'Force',
			            type: 'spline',
			            yAxis: 1,
			            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
			            tooltip: {
			                valueSuffix: ' N'
			            }

			        }, {
			            name: 'HR',
			            type: 'spline',
			            yAxis: 2,
			            data: [1016, 1016, 1015.9, 1015.5, 1012.3, 1009.5, 1009.6, 1010.2, 1013.1, 1016.9, 1018.2, 1016.7],
			            marker: {
			                enabled: false
			            },
			            dashStyle: 'shortdot',
			            tooltip: {
			                valueSuffix: ' bpm'
			            }
			        }, {
			            name: 'Ang',
			            type: 'spline',
			            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
			            tooltip: {
			                valueSuffix: ' °C'
			            }
			        }, {
			            name: 'Stroke',
			            type: 'spline',
			            yAxis: 3,
			            data: [5.0, 6.6, 1.5, 4.5, 13.2, 21.5, 25.2, 46.5, 23.3, 2.3, 13.9, 1.6],
			            tooltip: {
			                valueSuffix: ' °C'
			            }
			        }]
			    }, function(){
		            var currentLeft = parseInt($(".footer").position().top) - $('#lastItemInLeftMenu').height();
            		$('#lastItemInLeftMenu').css("height", currentLeft);

		            var currentRight = parseInt($(".footer").position().top) - $('#lastItemInRightMenu').height();
            		$('#lastItemInRightMenu').css("height", currentRight);
			    });

			    function showValues() {
			        $('#R0-value').html(chartAllModulesByStroke.options.chart.options3d.alpha);
			        $('#R1-value').html(chartAllModulesByStroke.options.chart.options3d.beta);
			    }
			    
			    
			    /*****************/


				var leftRight = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'leftRightPercentage',
			            type: 'area'
			        },

			        title: {
			            text: 'Hand Balance by strokes'
			        },
			        /*
			        subtitle: {
			            text: 'Source: Wikipedia.org'
			        },
			        */
			        xAxis: {
			            categories: ['1', '2', '3', '4', '5', '6', '7',
			   			             '8', '9', '10', '11', '12', '13', '14',
						             '15', '16', '17', '18', '19', '20', '21'],
			            title: {
			                enabled: false
			            },

			            title: {
			                text: 'Stroke [spm]',
			            },
			        },
			        yAxis: {
			            title: {
			                text: 'Percent'
			            },

		                plotLines : [{
		                    value : 55,
		                    color : 'green',
		                    dashStyle : 'shortdash',
		                    width : 2,
		                    label : {
		                    	x : 0,
		                        text : '55%'
		                    }
		                }, {
		                    value : 45,
		                    color : 'green',
		                    dashStyle : 'shortdash',
		                    width : 2,
		                    label : {
		                    	x : 0,		                    	
		                        text : '45%'
		                    }
		                }]

			        },
			        tooltip: {
			            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f})<br/>',
			            shared: true
			        },
			        plotOptions: {
			            area: {
			                stacking: 'percent',
			                lineColor: '#ffffff',
			                lineWidth: 1,
			                marker: {
			                	enabled: false,
			                	/*
			                    lineWidth: 1,
			                    lineColor: '#ffffff'
			                    */
			                    states: {
									hover: {
										enabled: false
									}
								}
			                }
			            }
			        },
			        series: [{
			            name: 'Left',
			            data: [200, 400, 300, 947, 1402, 3634, 5268,
			            	   200, 400, 300, 947, 1402, 3634, 5268,
			            	   200, 400, 300, 947, 1402, 3634, 5268]
			        }, {
			            name: 'Right',
			            data: [106, 107, 111, 133, 221, 767, 1766,
			            	   106, 107, 111, 133, 221, 767, 1766,
			            	   106, 107, 111, 133, 221, 767, 1766]
			        }]
			    });

			    leftRight.renderer.text('LEFT',
			    		120, 130 ).
			    	css({
				      width: 160,
				      color: 'grey',
				      textAlign: 'left',
				      fontSize: '25px'
			    	}).attr({
			    	zIndex: 1
			    }).add();

			    leftRight.renderer.text('RIGHT',
			    		120, 230 ).
			    	css({
				      width: 160,
				      color: 'grey',
				      textAlign: 'left',
				      fontSize: '25px'
			    	}).attr({
			    	zIndex: 1
			    }).add();			    	

            });
</script>

@endsection

