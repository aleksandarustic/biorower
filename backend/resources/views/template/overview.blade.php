<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

@extends('layouts.myframe')

@section('title', 'Overview')

<?php
	$viewAll = (isset($user) && ($user->profile->privacy != 1 || $isApproved) || $user == null);
?>

@section('page-script')

		<script type="text/javascript" src="//d3js.org/d3.v3.min.js"></script>

		{!! HTML::style('css/cal-heatmap/cal-heatmap.css') !!}
		{!! HTML::style('js/jquery-ui-multiselect-widget/jquery.multiselect.css') !!}

		{!! HTML::script('js/cal-heatmap/cal-heatmap.min.js') !!}
		{!! HTML::script('js/highcharts.js') !!}
		{!! HTML::script('js/highcharts-more.js') !!}
		{!! HTML::script('js/highcharts-3d.js') !!}
		{!! HTML::script('js/no-data-to-display.js') !!}

		{!! HTML::script('js/date.js') !!}
		{!! HTML::script('js/jquery-ui-multiselect-widget/src/jquery.multiselect.min.js') !!}

		@if ($viewAll)

			<script type="text/javascript">
				function ShowOnlyThreeModules(chartVariable){
					for(var i=0; i<chartVariable.series.length; i++){
						if (i >= 3){
							chartVariable.series[i].hide();
						}
						else{
							chartVariable.series[i].show();	
						}
					}

					var i = 0;
					$("#modulsDD").multiselect("widget").find(":checkbox").each(function(){
						if (i >= 3){
							$(this).prop("checked", false);
						}
						else{
							$(this).prop("checked", true);
						}
						i++;
					});
				};

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

				function fillChartValueWithNewData(chartVal, jsonVar){
	                for (var i=0; i<jsonVar.length; i++){
	                	chartVal.options.series[i].data = jsonVar[i].data;
	                }
				};

				function getBalanceData(jsonVar, namedParameters){
			        var jsonObjParameters = [];
					for (var ke in jsonVar) {
					   if ($.inArray(ke, namedParameters) > -1)
					   {
						   var tmpObject = new Object();
						   tmpObject.name = ke;
						   tmpObject.data = jsonVar[ke];
						   jsonObjParameters.push(tmpObject);
					   }
					}					
					return jsonObjParameters;
				};

				function getNewCategoriesForShift(nmbr, startPoint){
					var categories = [];
					var index = startPoint;
					var m = 1;
					for(var i=0; i<nmbr; i++){
						if (index <= nmbr){
							categories.push(index);
						}
						else{
							categories.push(m);	
							m++;
						}
						index = index + 1;
					}

					return categories;

				   /*
				   for(var m=0; m<jsonVar[ke].data.length; m++)
				   {

				   	   var realPosition = positions[m]-1-(startingPoint-1);
				   	   if (realPosition<0){
				   	   	   realPosition = nmbr + realPosition;
				   	   }

				   	   tmpObject.data[realPosition] = jsonVar[ke].data[m];
				   }
				   */					
				}

				function fillWith0(jsonVar, positions, nmbr, startingPoint){
			        var jsonObjParameters = [];	

					for (var ke in jsonVar) {
					   var tmpObject = new Object();
					   tmpObject.name = jsonVar[ke].name;
					   tmpObject.id = jsonVar[ke].name;
					   //tmpObject.data = jsonVar[ke];

					   if (nmbr != 0){
					   	   tmpObject.data = [];
				           var i = 1;

						   for(var m=0; m<nmbr; m++)
						   {
						   		tmpObject.data.push(0);
						   }
						   for(var m=0; m<jsonVar[ke].data.length; m++)
						   {

						   	   var realPosition = positions[m]-1-(startingPoint-1);
						   	   if (realPosition<0){
						   	   	   realPosition = nmbr + realPosition;
						   	   }

						   	   tmpObject.data[realPosition] = jsonVar[ke].data[m];

						   	   /*
						   	   var index = $.inArray(i, positions);

						   	   alert(index);

							   if (index > -1){
							   		//alert(JSON.stringify(jsonVar[ke]));
							   		tmpObject.data[i-1] = jsonVar[ke].data[index];
							   }
						   	   i++;
						   	   */
						   }
					   }
					   else{
					   	    tmpObject.data = jsonVar[ke].data;
					   }

					   jsonObjParameters.push(tmpObject);
					}
					return jsonObjParameters;
				};


				function addDateToData(jsonVar, dates, multipleYaxis){
			        var jsonObjParameters = [];	
			        var i = 0;
					for (var ke in jsonVar) {
					   var tmpObject = new Object();
					   tmpObject.name = jsonVar[ke].name;
					   tmpObject.id = jsonVar[ke].name;
					   tmpObject.data = [];
					   
					   if (multipleYaxis && i<=28 && i>=1){
					   	  tmpObject.yAxis = i;
					   }
					   
					   i++;

					   for(var m=0; m<dates.length; m++)
					   {	
					   		//var dt = "2013,5,18";
 				   			var dt = new Date.parse(dates[m], "yyyy/MM/dd");

					   		tmpDate = [Date.UTC(dt.getFullYear(), dt.getMonth(), dt.getDate(), dt.getHours(), dt.getMinutes()), jsonVar[ke].data[m]];
					   		tmpObject.data.push(tmpDate);
					   }

					   jsonObjParameters.push(tmpObject);
					}
					return jsonObjParameters;
				};

				var excludeParametersHistory = ["position_in_date", "date", "training_sessions"];
				var excludeParametersProgress = ["position_in_date", "date"];

				var parametersPowerAverage = ["power_left_average", "power_right_average"];
				var parametersPowerPeak = ["power_left_max", "power_right_max"];
				var parametersAngleAverage = ["angle_left_average", "angle_right_average"];
				var parametersAnglePeak = ["angle_left_max", "angle_right_max"];

				$(function(){

					$("#modulsDD").multiselect({

						   selectedText: function(numChecked, numTotal, checkedItems){
						      //return numChecked + ' of ' + numTotal + ' checked';
						      return 'Select module';
						   },
						   click: function(event, ui){
						      //alert(ui.value + ' ' + (ui.checked ? 'checked' : 'unchecked'));
						      serie = window.varChartLeftHand.get(ui.value);

						      var i = 0;
					          $(".modulesAndLeftAndRight").find("input").each(function(){
					          		if ($(this).is(":checked")){
					          			i++;
					          		}
					          });

					          var clicked = $("#modulsDD option[value='" + ui.text + "']");

					          if (i >= 4 && !clicked.is(":checked"))
					          {
					          	alert('Maximum selected parameters is 3.')
					          	event.preventDefault();
					          }
					          else{
			    	              if(serie.visible) {
						              serie.hide();

						          }else{
						              serie.show();
						          }					          	
					          }
						   },

						   checkAll: function(){
						   	   for (var i = 0; i < window.varChartLeftHand.series.length; i++){
						   	   		window.varChartLeftHand.series[i].show();
						   	   }
						   },
						   uncheckAll: function(){
						   	   for (var i = 0; i < window.varChartLeftHand.series.length; i++){
						   	   		window.varChartLeftHand.series[i].hide();
						   	   }
						   },

						   classes : "modulesAndLeftAndRight",

						   open: function(){
								$(".ui-multiselect-all").hide();
						   },
					});

					$("#modulsDDProgress").multiselect({
						   multiple: false,
						   header: "Select a module",
						   noneSelectedText: "Select a module",
						   selectedList: 1,
						   selectedText: function(numChecked, numTotal, checkedItems){
						   		return 'Select module';
						      //return numChecked + ' of ' + numTotal + ' checked';
						      //return 'Select module';
						   },

						   click: function(event, ui){
						      //alert(ui.value + ' ' + (ui.checked ? 'checked' : 'unchecked'));

						      var clicked = $("#modulsDDProgress option[value='" + ui.value + "']");
						      var index = parseInt(clicked.index());

  							  var jsonObjParameters = convertToMyJsonArray(window.varChartProgresValues, excludeParametersProgress, true);

  							  /*
  							  var idOfActive = $(".rangeTimeStatProgress.active").attr("id");
							  var nmbr = 0;
							  switch(idOfActive){
									case ("weekBtnOverviewProgress"):
										nmbr = 53;
									break;
									case ("monthBtnOverviewProgress"):
										nmbr = 12;
									break;
							  };
							  */

							  var idOfActive = $(".rangeTimeStatProgress.active").attr("id");

							  var dsplitF = $("#firstShiftProgress").val().split("-");
							  var firstShift = new Date(dsplitF[2], dsplitF[1]-1, dsplitF[0]);

							  var startingPoint = 1;
							  var nmbr = 0;
							  switch(idOfActive){
									case ("weekBtnOverviewProgress"):
										nmbr = 53;
										startingPoint = firstShift.getWeek()+1;
										if (startingPoint >= 54){ startingPoint = 1; }
									break;
									case ("monthBtnOverviewProgress"):
										nmbr = 12;
										startingPoint = firstShift.getMonth()+1;
										if (startingPoint == 13){ startingPoint = 1; }
									break;
							  }

							  var jsonObjParametersFinal = fillWith0(jsonObjParameters, window.varChartProgresValues['position_in_date'], nmbr, startingPoint);
							  serie = jsonObjParametersFinal[index];

							  //alert(JSON.stringify(serie));

				              window.varChartProgresSegment.series[0].setData(JSON.parse(JSON.stringify(serie.data)));

				              if (nmbr == 0){ //znaci da je godina izabrana
				              	var jsonObjDate = convertToMyJsonArray(window.varChartProgresValues, ["date"], false);
				              	
				              	//[{"name":"date","id":"date","data":["2015-07-28 09:39:35"]}]

				              	var categories = [];
								for (var i=0; i < jsonObjDate[0].data.length; i++) {
								   var tmpDate = jsonObjDate[0].data[i].substring(0, 4);
								   categories.push(tmpDate);
								}

								window.varChartProgresSegment.xAxis[0].setCategories(categories, true);

				              }

				              window.varChartProgresSegment = new Highcharts.Chart(window.varChartProgresSegment.options);

							  window.varChartProgresSegment.yAxis[0].axisTitle.attr({
								        text: clicked.text()
							  });

						   },

						   /*
						   checkAll: function(){
						   	   for (var i = 0; i < window.varChartProgresSegment.series.length; i++){
						   	   		window.varChartProgresSegment.series[i].show();
						   	   }
						   },
						   uncheckAll: function(){
						   	   for (var i = 0; i < window.varChartProgresSegment.series.length; i++){
						   	   		window.varChartProgresSegment.series[i].hide();
						   	   }
						   },
						   */

						   classes : "progresSegment",						   
					});

					var datas =<?php echo json_encode($arrayHeatMap); ?>;

					var emptyChartsBoolHistory = <?php echo json_encode($emptyChartsBoolHistory); ?>;

					if (emptyChartsBoolHistory){
						var sessionsHistory = JSON.parse(<?php echo json_encode($sessionsHistory); ?>);
					}
					else{
						var sessionsHistory = <?php echo json_encode($sessionsHistory); ?>;
					}

			        var jsonObjParametersHistory = convertToMyJsonArray(sessionsHistory, excludeParametersHistory, true);
			        var jsonObjDate = convertToMyJsonArray(sessionsHistory, ["date"], false);

			        if (!emptyChartsBoolHistory){
			        	var jsonObjPreparedDataParametersHistory = addDateToData(jsonObjParametersHistory, jsonObjDate[0].data, true);
			        }
			        else{
			        	var jsonObjPreparedDataParametersHistory = jsonObjParametersHistory;
			        }

			        window.emptyChartsDataHistory = JSON.parse(<?php echo json_encode($emptyChartsDataHistory); ?>);

			        //alert(jsonObjPreparedDataParametersHistory.length);

					window.varChartLeftRightValues = sessionsHistory;
					var balancePreparedDataPowerAverage = getBalanceData(sessionsHistory, parametersPowerAverage);

					window.varChartLeftRight = {
				        chart: {
				        	renderTo: 'highchartContainer3',
				            type: 'area'
				        },

				        title: {
				            text: 'Hand Balance by strokes'
				        },
						credits: {
						    enabled: false
						},
				        legend: {
					        	enabled: false
				        },
				        /*
				        subtitle: {
				            text: 'Source: Wikipedia.org'
				        },
				        */
				        xAxis: {
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
				        series: $.extend(true, [], balancePreparedDataPowerAverage)
				    };

				    window.varChartLeftRight = new Highcharts.Chart(window.varChartLeftRight);

				    window.varChartLeftRight.renderer.text('LEFT',
				    		120, 130 ).
				    	css({
					      width: 160,
					      color: 'grey',
					      textAlign: 'left',
					      fontSize: '25px'
				    	}).attr({
				    	zIndex: 1
				    }).add();

				    window.varChartLeftRight.renderer.text('RIGHT',
				    		120, 230 ).
				    	css({
					      width: 160,
					      color: 'grey',
					      textAlign: 'left',
					      fontSize: '25px'
				    	}).attr({
				    	zIndex: 1
				    }).add();

					varChartLeftHandChart = {
				        chart: {
				        	renderTo: 'highchartContainer1',
				        	animation: false
				        },
				        /*
						loading: {
							hideDuration: 100,
							labelStyle: { "fontWeight": "bold", "position": "relative", "top": "45%" },
							showDuration: 100
						},
						*/
				        title: {
				            text: '',
				            //x: -20 //center
				        },
				        /*
				        subtitle: {
				            text: 'Source: WorldClimate.com',
				            x: -20
				        },
				        */
				        xAxis: {
				        	type: 'datetime',

				            title: {
				                text: ''
				            },			                
				        },
				        yAxis: [{
				        	showEmpty: false,
				            title: {
				                text: 'Stroke count [spm]'
				            }

				        }, { showEmpty: false, title: { text: 'Time [hh:mm:ss]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Distance [km]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Stroke distance average [spm]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Stroke distance max [spm]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Speed average [m/s]' }, opposite: true},
						   
						   { showEmpty: false, title: { text: 'Speed max [m/s]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Pace average [spm]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Pace max [spm]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Heart rate average [bmp]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Heart rate max [bmp]' }, opposite: true},

						   { showEmpty: false, title: { text: 'Stroke rate average' }, opposite: true},
				           { showEmpty: false, title: { text: 'Stroke rate max' }, opposite: true},
				           { showEmpty: false, title: { text: 'Power average [W]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Power max [W]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Power left average [W]' }, opposite: true},

						   { showEmpty: false, title: { text: 'Power left max [W]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Power right average [W]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Power right max [W]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Power balance [W]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Angle average [°]' }, opposite: true},

						   { showEmpty: false, title: { text: 'Angle max [°]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Angle left average [°]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Angle left max [°]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Angle right average [°]' }, opposite: true},
				           { showEmpty: false, title: { text: 'Angle right max [°]' }, opposite: true},

						   { showEmpty: false, title: { text: '2 level mml' }, opposite: true},
				           { showEmpty: false, title: { text: '4 level mml' }, opposite: true},
				        ],
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
						credits: {
						    enabled: false
						},


				        plotOptions: {
			                series: {
			                   animation: false, enableMouseTracking: true, stickyTracking: true, shadow: false, dataLabels: { style: { textShadow: false } }
			                },
				        },						
				        
				        series: jsonObjPreparedDataParametersHistory
				    };

					window.varChartLeftHand = new Highcharts.Chart(varChartLeftHandChart);
					ShowOnlyThreeModules(window.varChartLeftHand);

					var parametersProgress = <?php echo json_encode($parametersProgress); ?>;

					window.emptyChartsBoolHistory = '[{"name":"training_sessions","id":"training_sessions","data":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]}]';

					if (parametersProgress.length !== 0){
						window.varChartProgresValues = parametersProgress;

						var jsonObjParameters = convertToMyJsonArray(parametersProgress, excludeParametersProgress, true);
						var jsonObjParametersFinal = fillWith0(jsonObjParameters, parametersProgress['position_in_date'], 53, 1);
					}
					else{
						 
						 var tmpJSON = JSON.parse(window.emptyChartsBoolHistory);
						 var jsonObjParametersFinal = tmpJSON;

						 $("#modulsDDProgress").closest(".customLegend").hide();
					}

					var categories = getNewCategoriesForShift(53, 1);

					window.varChartProgresSegment = {
				        chart: {
				        	renderTo: 'highchartContainer1Progress',
				        	type: 'column'
				        },
				        
				        title: {
				            text: ''
				        },
				        /*
				        subtitle: {
				            text: 'Source: WorldClimate.com'
				        },
				        */
				        xAxis: {
				        	categories: categories,
				            crosshair: true,
				            tickInterval: 1,
				            startOnTick: true,
				            title: {
				                text: 'Weeks'
				            }				            
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
				                text: 'Training sessions'
				            }
				        },
				        tooltip: {
				        	/*
				            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
				            */
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
				        series: $.extend(true,[], [jsonObjParametersFinal[0]])
				    };

					window.varChartProgresSegment = new Highcharts.Chart(window.varChartProgresSegment);

					var obj = JSON.parse(datas);
		
					for (var i = 1, len = 13; i < len; i++) {

						// get date to start from
						var startMonth = new Date();
						startMonth.setMonth((startMonth.getMonth() - 12) + i);
						// build the chart
					    var calendar = new CalHeatMap();
					    calendar.init({
					        itemSelector: "#heatmap_"+i,
					        data: obj,
					        start: startMonth,
					        domain: "month",
					        subDomain: "day",
					        //subDomainTextFormat: subDomainTextFormat,
					        range: 1,
					        // legend: [20, 40, 60, 90],
					        displayLegend: false,
					        tooltip: true,
					        //itemName: "minute",
					        domainLabelFormat: "%b %Y",
					        //cellSize: customCellSize,
					        onClick: function(date, count) {
					        	linkDay = date.getDate()
					        	linkMonth = (date.getMonth()+1)
					        	linkYear = date.getFullYear()
					        	if(linkDay < 9){
					        		linkDay = '0'+linkDay
					        	}
					        	if(linkMonth < 9){
					        		linkMonth = '0'+linkMonth
					        	}
								window.location = "{{ Request::root() }}/{{ $userLinkname }}/sessions/"+linkYear+"-"+linkMonth+"-"+linkDay+"/"+linkYear+"-"+linkMonth+"-"+linkDay
							}
					    });

					}

				  });				

				</script>
			@endif


			<script type="text/javascript">
			  $(function(){			

				 var urlBase = "<?php echo Request::root() ?>";

				 $(document).on("click", ".followUserLink", function(){

					var userid = $(this).attr("id").split("-")[1];
					$this = $(this);

					$("#loadingGifFollow").show();
					$this.hide();
					
			        $.ajax({
			        	    url : urlBase + '/user/follow-user?user_ln='+ userid,
				        }).done(function (data) {

					        if (data != "error"){

					        	$this.removeClass("btn-danger");
					        	$this.addClass("unFollowUserLink");
					        	$this.addClass("btn-default");
					        	$this.text("Unfollow user");

					        	$this.removeClass("followUserLink");
							}
							else{
								alert("error");
							}

							$("#loadingGifFollow").hide();
							$this.show();

				        }).fail(function () {
			        });						

					return false;
				});

				$(document).on("click", ".unFollowUserLink", function(){

					var userid = $(this).attr("id").split("-")[1];
					$this = $(this);

					$("#loadingGifFollow").show();
					$this.hide();
					
			        $.ajax({
			        	    url : urlBase + '/user/unfollow-user?user_ln='+ userid,
				        }).done(function (data) {

					        if (data != "error"){
								$this.removeClass("btn-default");
					        	$this.addClass("followUserLink");
					        	$this.addClass("btn-danger");
					        	$this.text("Follow user");

					        	$this.removeClass("unFollowUserLink");
							}
							else{
								alert("error");
							}

							$("#loadingGifFollow").hide();
							$this.show();

				        }).fail(function () {
			        });						

					return false;
				});


				$(document).on("click", ".requestTofollowUserLink", function(){
					var userid = $(this).attr("id").split("-")[1];
					var encodedID = $(this).attr("id").split("-")[1];
					$this = $(this);

					$("#loadingGifFollow").show();
					$this.hide();
					
			        $.ajax({
			        	    url : urlBase + '/user/requesttofollow-user?user_ln='+ userid,
				        }).done(function (data) {

					        if (data != "error"){
								$this.removeClass("btn-danger");
								$this.addClass("btn-info");
					        	$this.text("Request has been sent");
							}
							else{
								alert("error");
							}

							$("#loadingGifFollow").hide();
							$this.show();
							$this.removeClass("requestTofollowUserLink");

							socket.emit('emit_message', encodedID);

				        }).fail(function () {
			        });

					return false;
				});

				$('[data-toggle="tooltip"]').tooltip();

				$(document).on("click", ".rowLink", function(){
					window.location = $(this).data("url");
				});

				$(document).on("click", ".removeUserFromListFollowing", function(event){
					var userid = $(this).attr("id").split("-")[1];
					$this = $(this);

			        $.ajax({
			        	    url : urlBase + '/user/cancel-user-following?user_ln='+ userid,
				        }).done(function (data) {
				        	//loadingGifApproved
				        	$this.closest(".wrapperApproveList").remove();

				        }).fail(function () {
			        });

				    return false;
				});

				$(document).on("click", ".acceptFollowing", function(event){

					var userid = $(this).attr("id").split("-")[1];
					$this = $(this);
					$this.closest(".wrapperApproveList").hide();

			        $.ajax({
			        	    url : urlBase + '/user/accept-following?user_ln='+ userid,
				        }).done(function (data) {

				        	var clone = $this.closest(".wrapperApproveList").find(".clsLinkApproved").clone();
				        	$("#watchedContainer").append(clone);
				        	$this.closest(".wrapperApproveList").remove();

				        }).fail(function () {
			        });

				    return false;
				});

				function convertToNormalMonth(month){
					if (month < 10){
						return "0"+month;
					}
					else{
						return month;	
					}
				}

			    var days = ['Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			    var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

			    Date.prototype.getMonthName = function() {
			        return months[ this.getMonth() ];
			    };
			    Date.prototype.getDayName = function() {
			        return days[ this.getDay() ];
			    };

			    Date.prototype.getDayAddition = function(){
			    	if (this.getDate() == 1)
			    	{
			    		return "st";
			    	}
			        else if (this.getDate() == 2)
			    	{
			    		return "nd";
			    	}
					else if (this.getDate() == 3)
			    	{
			    		return "rd";
			    	}
			    	else{
			    		return "th";
			    	}
			    };

				/**
				 * Returns the week number for this date.  dowOffset is the day of week the week
				 * "starts" on for your locale - it can be from 0 to 6. If dowOffset is 1 (Monday),
				 * the week returned is the ISO 8601 week number.
				 * @param int dowOffset
				 * @return int
				 */
				Date.prototype.getWeek = function (dowOffset) {
				/*getWeek() was developed by Nick Baicoianu at MeanFreePath: http://www.epoch-calendar.com */

					dowOffset = typeof(dowOffset) == 'int' ? dowOffset : 0; //default dowOffset to zero
					var newYear = new Date(this.getFullYear(),0,1);
					var day = newYear.getDay() - dowOffset; //the day of week the year begins on
					day = (day >= 0 ? day : day + 7);
					var daynum = Math.floor((this.getTime() - newYear.getTime() - 
					(this.getTimezoneOffset()-newYear.getTimezoneOffset())*60000)/86400000) + 1;
					var weeknum;
					//if the year starts before the middle of a week
					if(day < 4) {
						weeknum = Math.floor((daynum+day-1)/7) + 1;
						if(weeknum > 52) {
							nYear = new Date(this.getFullYear() + 1,0,1);
							nday = nYear.getDay() - dowOffset;
							nday = nday >= 0 ? nday : nday + 7;
							/*if the next year starts before the middle of
				 			  the week, it is week #1 of that year*/
							weeknum = nday < 4 ? 1 : 53;
						}
					}
					else {
						weeknum = Math.floor((daynum+day-1)/7);
					}
					return weeknum;
				};


			    $(document).on("click", "#balanceAngleAverage, #balancePowerAvrg, #balancePowerPeak, #balanceAnglePeak", function(event){

					if ($(this).attr("id") == "balancePowerAvrg"){

						$(".handButtonsRight").removeClass("active");
			    		$(this).addClass("active");

			    		var balancePreparedDataPowerAverage = getBalanceData(window.varChartLeftRightValues, parametersPowerAverage);
			    		fillChartValueWithNewData(window.varChartLeftRight, balancePreparedDataPowerAverage)
			    								
		               	window.varChartLeftRight = new Highcharts.Chart(window.varChartLeftRight.options);
					}			    	
					else if ($(this).attr("id") == "balancePowerPeak"){

						$(".handButtonsRight").removeClass("active");
			    		$(this).addClass("active");
			    								
			    		var balancePreparedDataPowerPeak = getBalanceData(window.varChartLeftRightValues, parametersPowerPeak);
			    		fillChartValueWithNewData(window.varChartLeftRight, balancePreparedDataPowerPeak)
			    						
						window.varChartLeftRight = new Highcharts.Chart(window.varChartLeftRight.options);
					}					
			    	else if ($(this).attr("id") == "balanceAngleAverage")
			    	{
			    		$(".handButtonsRight").removeClass("active");
			    		$(this).addClass("active");

			    		var balancePreparedDataAngleAverage = getBalanceData(window.varChartLeftRightValues, parametersAngleAverage);
			    		fillChartValueWithNewData(window.varChartLeftRight, balancePreparedDataAngleAverage)
			    								
						window.varChartLeftRight = new Highcharts.Chart(window.varChartLeftRight.options);
					}
					else if ($(this).attr("id") == "balanceAnglePeak"){

						$(".handButtonsRight").removeClass("active");
			    		$(this).addClass("active");
			    								
			    		var balancePreparedDataAnglePeak = getBalanceData(window.varChartLeftRightValues, parametersAnglePeak);
			    		fillChartValueWithNewData(window.varChartLeftRight, balancePreparedDataAnglePeak)
			    								
						window.varChartLeftRight = new Highcharts.Chart(window.varChartLeftRight.options);
					}
				});


				window.valuesBalancePower = "";

				$(document).on("click", ".rangeTimeStat, .shiftStatistics", function(event){
					/*
				    $('html, body').animate({
				        scrollTop: $(this).offset().top - 70
				    }, 2000);
					*/
					var loadingGif = ".loadingGif";
					var chart1 = "#highchartContainer1";
					var progress = false;
					var rangeTimeStat = ".rangeTimeStat";
					var rangeTimeStatSecondClass = ".rangeTimeStatHistory";
					var idHighchartContainer1ButtonsRight = "#idHighchartContainer1ButtonsRight";
					var firstShift = "#firstShift";
					var secondShift = "#secondShift";
					var leftDateOverview = "leftDateOverview";
					var leftDateOverviewSmallStep = "leftDateOverviewSmallStep";
					var rightDateOverviewSmallStep = "rightDateOverviewSmallStep";
					var rightDateOverview = "rightDateOverview";
					var weekBtnOverview = "weekBtnOverview";
					var monthBtnOverview = "monthBtnOverview";
					var yearBtnOverview = "yearBtnOverview";
					var firstShiftLabel = "#firstShiftLabel";
					var secondShiftLabel = "#secondShiftLabel";
					var totalBtnOverview = "totalBtnOverview";

					if ($(this).hasClass("progressOvr")){
						loadingGif = ".loadingGifProgress";
						chart1 = "#highchartContainer1Progress";
						rangeTimeStat = ".rangeTimeStatProgress";
						rangeTimeStatSecondClass = ".rangeTimeStatProgress";
						idHighchartContainer1ButtonsRight = "#idHighchartContainer1ButtonsRightProgress";
						firstShift = "#firstShiftProgress";
						secondShift = "#secondShiftProgress";
						leftDateOverview = "leftDateOverviewProgress";
						leftDateOverviewSmallStep = "leftDateOverviewProgressSmallStep";
						rightDateOverviewSmallStep = "rightDateOverviewProgressSmallStep";
						rightDateOverview = "rightDateOverviewProgress";
						weekBtnOverview = "weekBtnOverviewProgress";
						monthBtnOverview = "monthBtnOverviewProgress";
						yearBtnOverview = "yearBtnOverviewProgress";
						firstShiftLabel = "#firstShiftLabelProgress";
						secondShiftLabel = "#secondShiftLabelProgress";
						progress = true;
					}

					$(loadingGif).show();
					$(chart1).hide();

					if (!progress){
						$("#highchartContainer3").hide();
					}
					
					var id=$(this).attr("id");
					var type = "";
					var rangeTypeHistory = "";
					var rangeTypeProgress = "";

					if ($(this).hasClass("rangeTimeStat"))
					{
						$(rangeTimeStatSecondClass).removeClass("active");
						$(this).addClass("active");

						var date = new Date();

						if(progress){
							$("#overviewBtnAndTextProgress").show();
						}
						else{
							$("#overviewBtnAndText").show();
						}

						switch(id)
						{
							case (weekBtnOverview):
								var type = "week";
								
								if(progress){
									var thisYear = (new Date()).getFullYear();
									var firstDay = new Date("1/1/" + thisYear);
									var lastDay = new Date("12/31/" + thisYear);

									rangeTypeProgress = "year";
								}
								else{
									var curr = new Date;
									var firstDay = new Date(curr.setDate(curr.getDate() - curr.getDay()+1));
									var lastDay = new Date(curr.setDate(curr.getDate() - curr.getDay()+7));

									rangeTypeHistory = "week";
								}
							break;
							case (monthBtnOverview):
								var type = "month";

								if(progress){
									var thisYear = (new Date()).getFullYear();
									var firstDay = new Date("1/1/" + thisYear);
									var lastDay = new Date("12/31/" + thisYear);

									rangeTypeProgress = "year";
								}
								else{
									var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
									var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

									rangeTypeHistory = "month";
								}
							break;
							case (yearBtnOverview):
								var thisYear = (new Date()).getFullYear();
								var firstDay = new Date("1/1/" + thisYear);
								var lastDay = new Date("12/31/" + thisYear);
								type = "year";

								if(progress){
									rangeTypeProgress = "all";
									$("#overviewBtnAndTextProgress").hide();
								}
								else{
									rangeTypeHistory = "year";
								}
							break;
							case (totalBtnOverview):
								var firstDay = new Date("1/1/1970");
								var lastDay = new Date();

								rangeTypeProgress = "all";
								rangeTypeHistory = "all";
								type = "total";

								$("#overviewBtnAndText").hide();
							break;
						}
					}
					else if ($(this).hasClass("shiftStatistics")){

						var idOfActive = $(idHighchartContainer1ButtonsRight).find(".active").attr("id");
						var id = $(this).attr("id");

						var dsplitF = $(firstShift).val().split("-");
						var dsplitS = $(secondShift).val().split("-");

						var currentFirst = new Date(dsplitF[2], dsplitF[1]-1, dsplitF[0]);
						var currentSecond = new Date(dsplitS[2], dsplitS[1]-1, dsplitS[0]);

						switch(idOfActive){
							case (weekBtnOverview):

								if (!progress){
									if (id == leftDateOverview){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()-7);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+1));
										var lastDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+7));
									}
									else if (id == rightDateOverview){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()+7);
										currentFirst = new Date(currentFirst);									
										var firstDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+1));
										var lastDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+7));
									}
									else if (id == leftDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()-1);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst);
										var lastDay = new Date(currentFirst.setDate(currentFirst.getDate()+6));
									}
									else if (id == rightDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()+1);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst);
										var lastDay = new Date(currentFirst.setDate(currentFirst.getDate()+6));
									}

									rangeTypeHistory = "week";
								}
								else{
									if (id == leftDateOverview){
										var thisYear = currentFirst.getFullYear()-1;
										var firstDay = new Date("1/1/" + thisYear);
										var lastDay = new Date("12/31/" + thisYear);
									}
									else if (id == rightDateOverview){
										var thisYear = currentFirst.getFullYear()+1;
										var firstDay = new Date("1/1/" + thisYear);
										var lastDay = new Date("12/31/" + thisYear);
									}
									else if (id == leftDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()-7);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+1));
										var lastDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+7));
									}
									else if (id == rightDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()+7);
										currentFirst = new Date(currentFirst);									
										var firstDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+1));
										var lastDay = new Date(currentFirst.setDate(currentFirst.getDate() - currentFirst.getDay()+7));
									}

									rangeTypeProgress = "year";
								}

								type = "week";
							break;
							case (monthBtnOverview):
								if (!progress){							
									if (id == leftDateOverview){
										var firstDay = new Date(currentSecond.getFullYear(), currentSecond.getMonth() - 1, 1);
										var lastDay = new Date(currentSecond.getFullYear(), currentSecond.getMonth(), 0);
									}
									else if (id == rightDateOverview){
										var firstDay = new Date(currentSecond.getFullYear(), currentSecond.getMonth() + 1, 1);
										var lastDay = new Date(currentSecond.getFullYear(), currentSecond.getMonth() + 2, 0);
									}
									else if (id == leftDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()-1);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst);
										var lastDay = new Date(currentSecond.setDate(currentSecond.getDate()-1));
									}
									else if (id == rightDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()+1);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst);
										var lastDay = new Date(currentSecond.setDate(currentSecond.getDate()+1));
									}

									rangeTypeHistory = "month";
								}
								else{
									if (id == leftDateOverview){
										var thisYear = currentFirst.getFullYear()-1;
										var firstDay = new Date("1/1/" + thisYear);
										var lastDay = new Date("12/31/" + thisYear);
									}
									else if (id == rightDateOverview){
										var thisYear = currentFirst.getFullYear()+1;
										var firstDay = new Date("1/1/" + thisYear);
										var lastDay = new Date("12/31/" + thisYear);
									}
									else if (id == leftDateOverviewSmallStep){
										var firstDay = new Date(currentFirst.getFullYear(), currentFirst.getMonth() - 1, 1);
										var lastDay = new Date(currentFirst.getFullYear(), currentFirst.getMonth(), 0);
									}
									else if (id == rightDateOverviewSmallStep){
										var firstDay = new Date(currentFirst.getFullYear(), currentFirst.getMonth() + 1, 1);
										var lastDay = new Date(currentFirst.getFullYear(), currentFirst.getMonth() + 2, 0);
									}

									rangeTypeProgress = "year";								
								}

								type = "month";

							break;
							case (yearBtnOverview):
								if (!progress){								
									if (id == leftDateOverview){
										var thisYear = currentFirst.getFullYear()-1;
										var firstDay = new Date("1/1/" + thisYear);
										var lastDay = new Date("12/31/" + thisYear);									
									}
									else if (id == rightDateOverview){
										var thisYear = currentFirst.getFullYear()+1;
										var firstDay = new Date("1/1/" + thisYear);
										var lastDay = new Date("12/31/" + thisYear);									
									}
									else if (id == leftDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()-1);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst);
										var lastDay = new Date(currentSecond.setDate(currentSecond.getDate()-1));
									}
									else if (id == rightDateOverviewSmallStep){
										currentFirst = new Date(currentFirst).setDate(currentFirst.getDate()+1);
										currentFirst = new Date(currentFirst);
										var firstDay = new Date(currentFirst);
										var lastDay = new Date(currentSecond.setDate(currentSecond.getDate()+1));
									}

									rangeTypeHistory = "year";
								}
								else{
									rangeTypeProgress = "all";
								}

								type = "year";
							break;
						}
					}

					var firstNew = firstDay.getDate() + '-' + convertToNormalMonth(firstDay.getMonth()+1) + '-' +  firstDay.getFullYear();
					var lastNew = lastDay.getDate() + '-' + convertToNormalMonth(lastDay.getMonth()+1) + '-' +  lastDay.getFullYear()

					$(firstShift).val(firstNew);
					$(secondShift).val(lastNew);
					
					var firstNewDate = Date.parseExact(firstNew, "d-MM-yyyy");
					var lastNewDate = Date.parseExact(lastNew, "d-MM-yyyy");

					$(firstShiftLabel).text(firstNewDate.getDayName()+" "+firstNewDate.getDate()+firstNewDate.getDayAddition()+" "+firstNewDate.getMonthName());
					$(secondShiftLabel).text(lastNewDate.getDayName()+" "+lastNewDate.getDate()+lastNewDate.getDayAddition()+" "+lastNewDate.getMonthName()+" "+lastNewDate.getFullYear());

					var firstDayUrl = firstDay.getFullYear()+'-'+convertToNormalMonth(firstDay.getMonth()+1)+'-'+firstDay.getDate();
					var lastDayUrl = lastDay.getFullYear()+'-'+convertToNormalMonth(lastDay.getMonth()+1)+'-'+lastDay.getDate();
					

					var action = 'get-statistics';
					var groupType = "";
					if (progress){
						groupType = type;
					}

					var rangeType = "";
					rangeType = rangeTypeHistory;
					if (progress){
						rangeType = rangeTypeProgress;
					}
					
			        $.ajax({
			        	    url : urlBase + '/template/'+action+'?start_date='+firstDayUrl+'&stop_date='+lastDayUrl+'&groupType='+groupType+'&rangeType='+rangeType,
				        }).done(function (data) {

					        var jsonVar = JSON.parse(data);

					        if (!progress){

					        	var jsonObjParameters = convertToMyJsonArray(jsonVar, excludeParametersHistory, true);

								if (jsonVar.length !== 0){
									$("#modulsDD").closest(".customLegend").show();
								}else{
									$("#modulsDD").closest(".customLegend").hide();
								}

					        	$("#highchartContainer1").show();
					        	$("#highchartContainer3").show();

					        	var jsonObjDate = convertToMyJsonArray(jsonVar, ["date"], false);

					        	if (jsonObjDate.length !== 0){
									var jsonObjParametersPreparedData = addDateToData(jsonObjParameters, jsonObjDate[0].data, true);
								}
								else{
									var jsonObjParametersPreparedData = convertToMyJsonArray(window.emptyChartsDataHistory, excludeParametersHistory, true);
								}

				                fillChartValueWithNewData(window.varChartLeftHand, jsonObjParametersPreparedData);
			                	window.varChartLeftHand = new Highcharts.Chart(window.varChartLeftHand.options);

				                ShowOnlyThreeModules(window.varChartLeftHand);
					        	window.varChartLeftRightValues = jsonVar;

					        	if (jsonObjDate.length !== 0){
									var balancePreparedDataPowerAverage = getBalanceData(window.varChartLeftRightValues, parametersPowerAverage);
								}
								else{
									var balancePreparedDataPowerAverage = getBalanceData(window.emptyChartsDataHistory, parametersPowerAverage);
								}
					    		
					    		fillChartValueWithNewData(window.varChartLeftRight, balancePreparedDataPowerAverage);
							 	window.varChartLeftRight = new Highcharts.Chart(window.varChartLeftRight.options);

								if ($("#balanceAngleAverage").hasClass("active"))
								{
									$("#balanceAngleAverage").removeClass("active");
								}

								$("#balancePowerAvrg").addClass("active");
								
							}
							else{
								$("#highchartContainer1Progress").show();

								var jsonObjParameters = convertToMyJsonArray(jsonVar, excludeParametersProgress, true);

								if (jsonVar.length !== 0){
										$("#modulsDDProgress").closest(".customLegend").show();
									var dsplitF = $("#firstShiftProgress").val().split("-");
									var firstShift = new Date(dsplitF[2], dsplitF[1]-1, dsplitF[0]);

									var startingPoint = 1;
									var nmbr = 0;
									switch(type){
										case ("week"):
											nmbr = 53;
											startingPoint = firstShift.getWeek()+1;
											if (startingPoint >= 54){ startingPoint = 1; }
										break;
										case ("month"):
											nmbr = 12;
											startingPoint = firstShift.getMonth()+1;
											if (startingPoint == 13){ startingPoint = 1; }
										break;
									}

									var jsonObjParametersFinal = fillWith0(jsonObjParameters, jsonVar['position_in_date'], nmbr, startingPoint);

									if (nmbr != 0){
										var categories = getNewCategoriesForShift(nmbr, startingPoint);
										window.varChartProgresSegment.xAxis[0].setCategories(categories, true);
									}

									window.varChartProgresSegment.options.series[0].data = jsonObjParametersFinal[0].data;

						            if (nmbr == 0){ //znaci da je godina izabrana
						              	var jsonObjDate = convertToMyJsonArray(jsonVar, ["date"], false);

						              	var categories = [];
										for (var i=0; i < jsonObjDate[0].data.length; i++) {
										   var tmpDate = jsonObjDate[0].data[i].substring(0, 4);
										   categories.push(tmpDate);
										}

										window.varChartProgresSegment.xAxis[0].setCategories(categories, true);

							            window.varChartProgresSegment = new Highcharts.Chart(window.varChartProgresSegment.options);
								
						            }
						            else{
						            	window.varChartProgresSegment = new Highcharts.Chart(window.varChartProgresSegment.options);
						            }

						            var capitalFirstLetterType = type.substring(0,1).toUpperCase() + type.substring(1);

									window.varChartProgresSegment.xAxis[0].axisTitle.attr({
									       text: capitalFirstLetterType+"s"
									});					            

									window.varChartProgresValues = jsonVar;

						            $(".progresSegment").find(".ui-state-active").removeClass("ui-state-active");
						            $(".progresSegment").find(".ui-multiselect-checkboxes").find(".ui-corner-all").first().addClass("ui-state-active");

								}else{
									$("#modulsDDProgress").closest(".customLegend").hide();

									var tmpJSON = JSON.parse(window.emptyChartsBoolHistory);

									window.varChartProgresSegment.options.series[0].data = tmpJSON;

									window.varChartProgresSegment = new Highcharts.Chart(window.varChartProgresSegment.options);
								}
							}

							$(loadingGif).hide();
							
				        }).fail(function () {
			        });

				});

			});

		</script>

@stop

@section('content')
		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
			  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  		<div class="row">
							
				  			<?php 
				  				$classView = "col-xs-12 col-sm-12 col-md-4 col-lg-3";
				  			?>

   	  					    @if (!$viewAll)
   	  					    	<?php $classView = "col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4" ?>
   	  					    @endif

							<div id="" class="{{ $classView }}">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
										<div class="wrapperBoxes">
									    	<div>
												@if (isset($imageid))
													@if (isset($user))
														<?php $imageName = $user->profile->image->name; ?>
													@else
														<?php $imageName = Auth::user()->profile->image->name; ?>
													@endif
													<img src="{{ Request::root().'/../storage/profile_images'.$imageName }}" class="avatarOverview" />
												@else
													{!! HTML::image('images/avatar_empty_big.png', 'a picture', array('class' => 'avatarOverview', 'width' => '200', 'height' => '200')) !!}												
												@endif
									    	</div>

									    	<br />							
									    	<div>
										 		<div class="username">
											 		@if (isset($user))
										 				 {{ $user->display_name }}
										 				 <br />
										 				 {{ $user->first_name }} {{ $user->last_name }}
										 				 <br />
														 <a href="{{ url('/'.$user->linkname) }}">
														 	({{ $user->linkname }})
														 </a>

										 			@else 
										 				{{ Auth::user()->display_name }}
										 				<br />
														 <a href="{{ url('/'.Auth::user()->linkname) }}">
														 	({{ Auth::user()->linkname }})
														 </a>										 				
										 			@endif
										 		</div>

												@if ($isMyProfile)
													<a href="{{ url('/user/edit') }}" class="btn btn-primary" id="editProfileLink">Edit profile</a>
												@else

											        <div id="loadingGifFollow" style="margin:0 auto; display:none;">
											            Loading...
											            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
											        </div>

											        @if ($isApproved)
											        	<a href="#" class="btn btn-default unFollowUserLink" id="userLinkname-{{ $userLinkname }}">Unfollow user</a>
											        @elseif ($requestToFollowUserAlreadySent)
											        	<a href="#" class="btn btn-info" id="requestAlreadySent">Request has been sent </a>
											        @elseif ($notSentRequest)
											        	<a href="#" class="btn btn-danger requestTofollowUserLink" id="userLinkname-{{ $userLinkname }}-{{ $encodedID }}">Request to follow user</a>
											        @else
											        	<a href="#" class="btn btn-danger followUserLink" id="userLinkname-{{ $userLinkname }}">Follow user</a>
													@endif

												@endif

											</div>
										</div>
									</div>

									<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12 hidden-xs">
										<div class="wrapperBoxes">

											@if (isset($user))
												<div class="ovrData"><span class="ovrLeftColumnData">Member Since: </span> <span class="ovrRightColumnData">{{ date('l dS F Y', strtotime($user->created_at)) }} </span></div>
											@else
												<div class="ovrData"><span class="ovrLeftColumnData">Member Since: </span> <span class="ovrRightColumnData">{{ Auth::user()->created_at }}</span></div>
											@endif

											@if ($viewAll)
												<div class="ovrData"><span class="ovrLeftColumnData">Latest Session: </span> <span class="ovrRightColumnData">13 Apr 2015</span></div>
												<div class="ovrData"><span class="ovrLeftColumnData">Peak Power: </span> <span class="ovrRightColumnData">2848</span></div>
												<div class="ovrData"><span class="ovrLeftColumnData">Peak AvgPower: </span> <span class="ovrRightColumnData">1962</span></div>
												<div class="ovrData"><span class="ovrLeftColumnData">Peak Cadence: </span> <span class="ovrRightColumnData">119</span></div>
												<div class="ovrData"><span class="ovrLeftColumnData">Peak Power/Kg: </span> <span class="ovrRightColumnData">26.16</span></div>
											@endif

										</div>
									</div>
								</div>

								<!--
								<div class="row">
									<div class="visible-xs-block" style="text-align:center;">
										<a href="/gaboroki/session/796c9e3c789c610639c3fa9363600701" class="btn btn-primary btn-lg" style="color:white">View Your Latest Session</a>
									</div>			
								</div>
								-->

								@if ($viewAll)

									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-sm hidden-xs">
											<div class="wrapperBoxes">
												<div class="ovrData"><span class="ovrLeftColumnData">Watching: </span> <span class="ovrRightColumnData"></span>
													<br />
													<div id="watchingContainer">

														@foreach ($allWatching as $el)
															@if ($el->approved == 1)
															<div class="wtchWrapperCtn">
																<a href="{{ url('/'.$el->user2->linkname) }}" class="" data-toggle="tooltip" data-placement="right" title="{{ $el->user2->first_name }} {{ $el->user2->last_name }}">	
																	@if (isset($el->user2->profile->image_id))
																		<img class="avatarOverviewFollow" src="{{ '../storage/profile_images'.$el->user2->profile->image->name }}" height="50" width="50">
																	@else
																		{!! HTML::image('images/avatar_empty.png', 'a picture', array('class' => 'avatarOverviewFollow', 'width' => '50', 'height' => '50')) !!}
																	@endif
																</a>
															</div>
															@endif
														@endforeach

													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-sm hidden-xs">
											<div class="wrapperBoxes">
												<div class="ovrData"><span class="ovrLeftColumnData">Watched by: </span> <span class="ovrRightColumnData"></span>
													<br />
													<div id="watchedContainer">

														@foreach ($allWatched as $el)
															@if ($el->approved == 1)
															<a href="{{ url('/'.$el->user1->linkname) }}" class="" data-toggle="tooltip" data-placement="top" title="{{ $el->user1->first_name }} {{ $el->user1->last_name }}">
																@if (isset($el->user1->profile->image_id))
																		<img class="avatarOverviewFollow" src="{{ '../storage/profile_images'.$el->user1->profile->image->name }}"  height="50" width="50">
																@else
																		{!! HTML::image('images/avatar_empty.png', 'a picture', array('class' => 'avatarOverviewFollow', 'width' => '50', 'height' => '50')) !!}
																@endif
															</a>
															@endif
														@endforeach

													</div>
												</div>
											</div>									
										</div>
									</div>	

									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="wrapperBoxes">
												<div class="ovrData"><span class="ovrLeftColumnData">Followers who are waiting on approve: </span> <span class="ovrRightColumnData"></span>
													<br />
													<br />
													<div id="waitingContainer">

														@foreach ($allWatched as $el)
															@if ($el->approved == 0)
														        <div class="loadingGifApproved" style="margin:0 auto; display:none;">
														            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
														        </div>															
																<div style="width:98px; position:relative;" class="wrapperApproveList">
																	<a href="#">
																		<span class="glyphicon glyphicon-remove removeUserFromListFollowing" id="idUser-{{ $el->user1->linkname }}"></span>
																	</a>

																	<a href="{{ url('/'.$el->user1->linkname) }}" class="clsLinkApproved" data-toggle="tooltip" data-placement="top" title="{{ $el->user1->first_name }} {{ $el->user1->last_name }}">
																		@if (isset($el->user1->profile->image_id))
																				<img class="avatarOverviewFollow" src="{{ '../storage/profile_images'.$el->user1->profile->image->name }}"  height="50" width="50">
																		@else
																				{!! HTML::image('images/avatar_empty.png', 'a picture', array('class' => 'avatarOverviewFollow', 'width' => '50', 'height' => '50')) !!}
																		@endif
																	</a>
																	
																	<a href="#" class="btn btn-small btn-primary acceptFollowing"  id="idAcceptFollowing-{{  $el->user1->linkname }}">Accept</a>
																</div>
															@endif
														@endforeach

													</div>
												</div>
											</div>									
										</div>
									</div>	

								@endif																							
							</div>

							@if ($viewAll)

								<div id="" class="col-xs-12 col-sm-12 col-md-8 col-lg-9">

									<div class="row">
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total training sessions</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ $totalStatisticsParameters["training_sessions"][0] }}</div>
												<!-- <div>all time sessions</div> -->
											</div>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total training time [hh:mm:ss]</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{  gmdate("H:i:s", $totalStatisticsParameters["time"][0]) }}</div>
												<!-- <div>all time kilometers</div> -->
											</div>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total Distance [km]</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ round($totalStatisticsParameters["distance"][0], 2) }}</div> 
												<!-- <div>all time hours</div> -->
											</div>
										</div>		

										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total Power average [W]</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ round($totalStatisticsParameters["power_average"][0], 2) }}</div>
												<!-- <div>kilometers this month</div> -->
											</div>
										</div>																										
									</div>

									<div class="row">
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total number of strokes</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ $totalStatisticsParameters["stroke_count"][0] }}</div>
												<!-- <div>kilometers this month</div> -->
											</div>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total Stroke distance average [spm]</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ round($totalStatisticsParameters["stroke_distance_average"][0], 2) }}</div>
												<!-- <div>hours this month</div> -->
											</div>
										</div>
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total Angle average [°]</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ round($totalStatisticsParameters["angle_average"][0], 2) }}</div> 
												<!-- <div>kilometers this week</div> -->
											</div>
										</div>																		
										<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
											<h4 class="titleModul">Total HR average [bmp]</h4>
											<div class="wrapperBoxes ovrRightValues">
												<div class="ovrMidValues">{{ round($totalStatisticsParameters["heart_rate_average"][0], 2) }}</div> 
												<!-- <div>hours this week</div> -->
											</div>
										</div>
									</div>

									<div class="row">								
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="row" style="margin: 15px;">
												<div class="wrapperBoxesHeatMap"> 
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_1"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_2"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_3"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_4"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_5"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_6"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_7"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_8"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_9"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 hidden-xs"><div id="heatmap_10"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6"><div id="heatmap_11"></div></div>
													<div class="col-lg-1 col-md-2 col-sm-2 col-xs-6"><div id="heatmap_12"></div></div>
												</div>
											</div>					
										</div>
									</div>

									<div class="row">								
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<h1 style="margin-left:15px;">Last Session Data</h1>	
										</div>
									</div>									

									<div class="row">								
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="wrapperBoxes">
												<div class="highchartContainer1ButtonsLeft" id="overviewBtnAndText">
													<a class="btn btn-small btn-default shiftStatistics" id="leftDateOverview"><<</a>
													<a class="btn btn-small btn-default shiftStatistics" id="leftDateOverviewSmallStep"><</a>
													<a class="btn btn-small btn-default shiftStatistics" id="rightDateOverviewSmallStep">></a>
													<a class="btn btn-small btn-default shiftStatistics" id="rightDateOverview">>></a>
													<span id="firstShiftLabel">{{ date('D dS F', strtotime($monday)) }}</span> - <span id="secondShiftLabel">{{ date('D dS F Y', strtotime($sunday)) }}</span>
													<input type="hidden" id="firstShift" value="{{ $monday }}" />
													<input type="hidden" id="secondShift" value="{{ $sunday }}" />
												</div>											
												<div class="highchartContainer1ButtonsRight" id="idHighchartContainer1ButtonsRight">
													<a class="btn btn-small btn-default rangeTimeStat rangeTimeStatHistory active" id="weekBtnOverview">Week</a>
													<a class="btn btn-small btn-default rangeTimeStat rangeTimeStatHistory" id="monthBtnOverview">Month</a>
													<a class="btn btn-small btn-default rangeTimeStat rangeTimeStatHistory" id="yearBtnOverview">Year</a>
													<a class="btn btn-small btn-default rangeTimeStat rangeTimeStatHistory" id="totalBtnOverview">Total</a>
												</div>
												<div style="clear:both"></div>
												<div id="highchartContainer1" class="chart">
												</div>

											    <div style="width:100%;">
											        <div class="loadingGif" style="margin:0 auto; display:none; width:120px;">
											            Loading...
											            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
											        </div>
										        </div>
												
												<div class="highchartContainer1ButtonsRight">
													<div class="customLegend">
														<select name="demo" id="modulsDD"  multiple="multiple">
															<option value="stroke_count" selected="selected">Stroke count [spm]</option>
															<option value="time">Time [hh:mm:ss]</option>
															<option value="distance" selected="selected">Distance [km]</option>
															<option value="stroke_distance_average">Stroke distance average [spm]</option>
															<option value="stroke_distance_max">Stroke distance max [spm]</option>
															<option value="speed_average">Speed average [m/s]</option>
															<option value="speed_max">Speed max [m/s]</option>
															<option value="pace_average">Pace average [spm]</option>
															<option value="pace_max">Pace max [spm]</option>
															<option value="heart_rate_average">Heart rate average [bmp]</option>
															<option value="heart_rate_max">Heart rate max [bmp]</option>
															<option value="stroke_rate_average">Stroke rate average</option>	
															<option value="stroke_rate_max">Stroke rate max</option>
															<option value="power_average">Power average [W]</option>
															<option value="power_max">Power max [W]</option>
															<option value="power_left_average">Power left average [W]</option>
															<option value="power_left_max">Power left max [W]</option>
															<option value="power_right_average">Power right average [W]</option>
															<option value="power_right_max">Power right max [W]</option>
															<option value="power_balance">Power balance [W]</option>
															<option value="angle_average">Angle average [°]</option>
															<option value="angle_max">Angle max [°]</option>
															<option value="angle_left_average">Angle left average [°]</option>
															<option value="angle_left_max">Angle left max [°]</option>
															<option value="angle_right_average">Angle right average [°]</option>
															<option value="angle_right_max">Angle right max [°]</option>
															<option value="mml_2_level">2 level mml</option>
															<option value="mml_4_level">4 level mml</option>
														</select>
													</div>
												</div>
												<div style="clear:both"></div>						
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="wrapperBoxes">
												<div id="highchartContainer3" class="chart">
												</div>
											    <div style="width:100%;">
											        <div class="loadingGif" style="margin:0 auto; display:none; width:120px;">
											            Loading...
											            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
											        </div>
										        </div>												
												<div class="highchartContainer1ButtonsRight">
													<a class="btn btn-small btn-default active handButtonsRight" id="balancePowerAvrg">Power average L&R [W]</a>
													<a class="btn btn-small btn-default handButtonsRight" id="balancePowerPeak">Power Peak L&R [W]</a>
													<a class="btn btn-small btn-default handButtonsRight" id="balanceAngleAverage">Angle average L&R [°]</a>
													<a class="btn btn-small btn-default handButtonsRight" id="balanceAnglePeak">Angle peak L&R [°]</a>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>											
									</div>

									<div class="row">								
										<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
											<div class="wrapperBoxes">
												<div class="highchartContainer1ButtonsLeft" id="overviewBtnAndTextProgress">
													<a class="btn btn-small btn-default shiftStatistics progressOvr shiftStatisticsProgress" id="leftDateOverviewProgress"><<</a>
													<a class="btn btn-small btn-default shiftStatistics progressOvr shiftStatisticsProgress" id="leftDateOverviewProgressSmallStep"><</a>
													<a class="btn btn-small btn-default shiftStatistics progressOvr shiftStatisticsProgress" id="rightDateOverviewProgressSmallStep">></a>
													<a class="btn btn-small btn-default shiftStatistics progressOvr shiftStatisticsProgress" id="rightDateOverviewProgress">>></a>
													<span id="firstShiftLabelProgress">{{ date('D dS F', strtotime($firstDayOfYear)) }}</span> - <span id="secondShiftLabelProgress">{{ date('D dS F Y', strtotime($lastDayOfYear)) }}</span>
													<input type="hidden" id="firstShiftProgress" value="{{ $firstDayOfYear }}" />
													<input type="hidden" id="secondShiftProgress" value="{{ $lastDayOfYear }}" />
												</div>											
												<div class="highchartContainer1ButtonsRight" id="idHighchartContainer1ButtonsRightProgress">
													<a class="btn btn-small btn-default rangeTimeStat active progressOvr rangeTimeStatProgress" id="weekBtnOverviewProgress">Week</a>
													<a class="btn btn-small btn-default rangeTimeStat progressOvr rangeTimeStatProgress" id="monthBtnOverviewProgress">Month</a>
													<a class="btn btn-small btn-default rangeTimeStat progressOvr rangeTimeStatProgress" id="yearBtnOverviewProgress">Year</a>
												</div>
												<div style="clear:both"></div>
											    <div style="width:100%;">
											        <div class="loadingGifProgress" style="margin:0 auto; display:none; width:120px;">
											            Loading...
											            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
											        </div>
										        </div>												
												<div id="highchartContainer1Progress" class="chart">
												</div>
												<div class="highchartContainer1ButtonsRight">
														<div class="customLegend">
															<select name="demo" id="modulsDDProgress" >
																<option value="training_sessions" selected="selected">Training sessions </option>
																<option value="stroke_count">Stroke count [spm]</option>
																<option value="time">Time [hh:mm:ss]</option>
																<option value="distance" selected="selected">Distance [km]</option>
																<option value="stroke_distance_average">Stroke distance average [spm]</option>
																<option value="stroke_distance_max">Stroke distance max [spm]</option>
																<option value="speed_average">Speed average [m/s]</option>
																<option value="speed_max">Speed max [m/s]</option>
																<option value="pace_average">Pace average [spm]</option>
																<option value="pace_max">Pace max [spm]</option>
																<option value="heart_rate_average">Heart rate average [bmp]</option>
																<option value="heart_rate_max">Heart rate max [bmp]</option>
																<option value="stroke_rate_average">Stroke rate average</option>	
																<option value="stroke_rate_max">Stroke rate max</option>
																<option value="power_average">Power average [W]</option>
																<option value="power_max">Power max [W]</option>
																<option value="power_left_average">Power left average [W]</option>
																<option value="power_left_max">Power left max [W]</option>
																<option value="power_right_average">Power right average [W]</option>
																<option value="power_right_max">Power right max [W]</option>
																<option value="power_balance">Power balance [W]</option>
																<option value="angle_average">Angle average [°]</option>
																<option value="angle_max">Angle max [°]</option>
																<option value="angle_left_average">Angle left average [°]</option>
																<option value="angle_left_max">Angle left max [°]</option>
																<option value="angle_right_average">Angle right average [°]</option>
																<option value="angle_right_max">Angle right max [°]</option>
																<option value="mml_2_level">2 level mml</option>
																<option value="mml_4_level">4 level mml</option>
															</select>
														</div>
												</div>
												<div style="clear:both"></div>													
											</div>
										</div>

										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
											<div class="wrapperBoxes">
												<div id="highchartContainer4" class="chart">
												</div>
											</div>
										</div>										
									</div>

									<div class="row">								
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="wrapperBoxTable">
												<h1>Recent Session List</h1>
										        <div id="loadingGif" style="margin:0 auto; display:none;">
										            Loading...
										            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
										        </div>
												<div class="table-responsive">
													<div id="pagContainer">
														<table class="table table-hover">
														 <tr>
														 	<th>Date </th>
														 	<th>Data version </th>
														 	<th>Device type </th>
														 	<th>Serial number </th>
														 	<th>Firmware version </th>
														 	<th>Mobile agent </th>
														 	<th>Duration </th>
														 </tr>
															 @foreach ($allSessions as $key => $value)
													 	 	 <?php 
																$hashids = new Hashids(GlobalFunctions::getEncKey());
																$encodedID = $hashids->encode($value->id);
													 	 	  ?>		 
														 	 <tr class="rowLink" data-url="{{ url( $userLinkname.'/session/'.$encodedID) }}">
															 	 <td>{{ $value->date }} </td>
															 	 <td>{{ $value->dataVersion }}</td>
															 	 <td>{{ $value->deviceType }}</td>
															 	 <td>{{ $value->serialNumber }}</td>
															 	 <td>{{ $value->firmwareVersion }}</td>
															 	 <td>{{ $value->mobileUserAgent }}</td>
															 	 <td>{{ $value->duration }}</td>
														 	 </tr>
														 	@endforeach
														</table>
	     											</div>
												</div>								
										</div>
									</div>		
									<!--
									<div class="row">								
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="wrapperBoxTable">
												<h1>Some test data created for sort & pagination if it would be needed</h1>
										        <div id="loadingGif" style="margin:0 auto; display:none;">
										            Loading...
										            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
										        </div>
												<div class="table-responsive">
													<div id="pagContainer">

												  	</div>
	     										</div>
												<input type="hidden" value="" id="fieldSort" /> 
												<input type="hidden" value="" id="orderSort" /> 
											</div>								
										</div>
									</div>								
									-->
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="wrapperBoxTable">
											<h1 style="float:left">Sessions</h1>
												<div class="highchartContainer1ButtonsRight">
													<a class="btn btn-small btn-default" href="{{ url('/sessions/calendar') }}">Calendar</a>
													@if (isset($user))
														<a class="btn btn-small btn-default" href="{{ url('/'.$user->linkname.'/sessions') }}">List</a>
													@else
														<a class="btn btn-small btn-default" href="{{ url('/'.Auth::user()->linkname.'/sessions') }}">List</a>
													@endif
												</div>
												<div style="clear:both"></div>
										</div>
									</div>		
								</div>

							</div>

						@endif

						<br />
						<br />

					</div>								
				</div>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<br />
						<br />
					</div>
				</div>		
		  </div>
	  </section>

	@if ($viewAll)	  

    <script type="text/javascript">

  	  		var dataChartJson = JSON.parse(<?php echo $jsonChart ?>);

  	  		var tmpArrayFinalAlfaLeft = [];
  	  		var tmpArrayFinalBetaLeft = [];
			var tmpArrayFinalAlfaRight = [];
			var tmpArrayFinalBetaRight = [];
			var tmpAllFinalValues = [];

  			var alphaValue = 0;
  			var betaValue = 0;

  			minutes = 1;
  			seconds = 1;
  			var punacLeva = 0;
  			var punacDesna = 0;

			function getMaxOfArray(numArray) {
			  return Math.max.apply(null, numArray);
			}  			

  	  		$.each(dataChartJson[0], function(index, value){
  	  			var tmpArrayLeftAlfa = 0;
  	  			var tmpArrayRightAlfa = 0;
  	  			var tmpArrayLeftBeta = 0;
  	  			var tmpArrayRightBeta = 0;

  				alphaValue = alphaValue + value.left.alpha;
  				betaValue = betaValue + value.left.beta;

  				alphaValue = alphaValue + value.right.alpha;
  				betaValue = betaValue + value.right.beta;

  	  			var i = 0;
  	  			$.each(value.left.raw, function(index1, value1){
					punacLeva = punacLeva + value1;
  	  				if (i <= 63){
  	  					tmpArrayLeftAlfa = tmpArrayLeftAlfa - value1;
  	  				}
  	  				else{
  	  					tmpArrayLeftBeta = tmpArrayLeftBeta - value1;
  	  				}
  	  				i++;
  	  			});

				var i = 0;
  	  			$.each(value.right.raw, function(index1, value1){
					punacDesna = punacDesna + value1;
  	  				if (i <= 63){
  	  					tmpArrayRightAlfa = tmpArrayRightAlfa + value1;
  	  				}
  	  				else{
  	  					tmpArrayRightBeta = tmpArrayRightBeta + value1;
  	  				}
  	  				i++;
  	  			});

  	  			seconds = seconds + 1;

  	  			if (seconds % 60 == 0 || seconds < 60){
  	  				minutes++;
  	  				tmpArrayFinalAlfaLeft.push(tmpArrayLeftAlfa);
  	  				tmpArrayFinalBetaLeft.push(tmpArrayLeftBeta);
  	  				tmpArrayFinalAlfaRight.push(tmpArrayRightAlfa);
  	  				tmpArrayFinalBetaRight.push(tmpArrayRightBeta);
  	  				punacLeva = 0;
  	  				punacDesna = 0;

  	  				tmpAllFinalValues.push(Math.abs(tmpArrayLeftAlfa));
  	  				tmpAllFinalValues.push(Math.abs(tmpArrayLeftBeta));
  	  				tmpAllFinalValues.push(Math.abs(tmpArrayRightAlfa));
  	  				tmpAllFinalValues.push(Math.abs(tmpArrayRightBeta));
  	  			}
  	  		});  

			var maxOfArray = getMaxOfArray(tmpAllFinalValues);
			
			categoriesArray = [];
			if (minutes != 0){
				for(var i=1; i<minutes; i++){
					categoriesArray.push(i);
				}
			}
		
			$(function(){
			    var categories = categoriesArray;

		        $('#highchartContainer4').highcharts({
		            chart: {
		                type: 'bar'
		            },
		            title: {
		                text: 'Left and right side of the brain'
		            },
		            subtitle: {
		                //text: 'Source: <a href="http://populationpyramid.net/germany/2015/">Population Pyramids of the World from 1950 to 2100</a>'
		            },
		            xAxis: [{
		                categories: categories,
		                reversed: false,
		                labels: {
		                    step: 1
		                }
		            }, { // mirror axis on right side
		                opposite: true,
		                reversed: false,
		                categories: categories,
		                linkedTo: 0,
		                labels: {
		                    step: 1
		                }
		            }],
		            yAxis: {
		            	max: maxOfArray,
		                title: {
		                    text: null
		                },
		                labels: {
		                    formatter: function () {
		                        return Math.abs(this.value);
		                    }
		                }
		            },

		            plotOptions: {
		                series: {
		                   // stacking: 'normal'
		                }
		            },

		            tooltip: {
		                formatter: function () {
		                    return '<b>' + this.series.name + ', minute ' + this.point.category + '</b><br/>' +
		                        'sum: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
		                }
		            },

		            //text: 'α and β'
		            series: [{
		                name: 'α left',
		                color: '#058DC7',
		                data: tmpArrayFinalAlfaLeft
		            }, {
		                name: 'α right',
		                color: '#058DC7',
		                data: tmpArrayFinalAlfaRight,
		                pointPlacement: -0.15
		            }, {
		                name: 'β left',
		                color: '#ED561B',
		                data: tmpArrayFinalBetaLeft
		            },{
		                name: 'β right',
		                color: '#ED561B',
		                data: tmpArrayFinalBetaRight,
		                pointPlacement: -0.15
		            }]
		        });


				/*
				var chart2 = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'highchartContainer2',
			            type: 'bar'
			        },
			        title: {
			            text: 'Left side of the brain'
			        },
			        
			        xAxis: {
			        	min: 1,
			        	labels:{
			        		enabled: false
			        	}			        	
			            //categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
			        },
			        
			        credits: {
			            enabled: false
			        },
			        series: tmpArrayFinalLeft

			    	}, function(){
			    });
				*/



   				/*

				var chart3 = new Highcharts.Chart({
			        chart: {
			        	renderTo: 'highchartContainer3',
			        	type: 'bar'
			        },
			        title: {
			            text: 'Right side of the brain'
			        },
			        
			        xAxis: {
			        	min: 1,
			        	reversed: true,
			            //categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
			        },
			        yAxis: {
			        	reversed: true,
			            //categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
			        },			        
			        
			        credits: {
			            enabled: false
			        },
			        series: tmpArrayFinalRight

			    }, function(){
		            var currentLeft = parseInt($(".footer").position().top) - $('#lastItemInLeftMenu').height();
            		$('#lastItemInLeftMenu').css("height", currentLeft);

		            var currentRight = parseInt($(".footer").position().top) - $('#lastItemInRightMenu').height();
            		$('#lastItemInRightMenu').css("height", currentRight);
			    });
				*/



				/*
				$(".clsOModule").each(function(){
					//$(this).find("input").prop("checked", "true");
					$(this).find("input").click();
				});
				*/

				//varChartLeftHand = new Highcharts.Chart(varChartLeftHand);
				/*
					var cal = new CalHeatMap();
					cal.init({
						itemSelector: "#cal-heatmap",
						domain: "month",
						subDomain: "day",
						displayLegend: false,
						domainMargin: 23,
						domainLabelFormat: "%B %Y"
					});
				*/

		        $(document).on('click', '.pagination a, .sort', function (e) {
		            var page = $(this).attr('href').split('page=')[1];

		            $('#pagContainer').empty();
		            $('#loadingGif').show();

		            var url = "<?php echo Request::url(); ?>" + "?page=" + page;
					
					if ($(this).hasClass("sort")){
						var field = $(this).attr('class').split(' ')[1].split('-')[1];
						var order = $(this).attr('class').split(' ')[2].split('-')[1];

						$("#fieldSort").val(field);
						$("#orderSort").val(order);

						$(".pagination").find(".active")
						url = url + "&sort="+ field + "&order=" + order;
					}
					else{
						if ($("#fieldSort").val() != ""){
							var field = $("#fieldSort").val();
						}
						if ($("#orderSort").val() != ""){
							var order = $("#orderSort").val();
							url = url + "&sort="+ field + "&order=" + order;
						}
					}

			        $.ajax({
		        	    url : url,
			            dataType: 'json',
			        }).done(function (data) {
			            $('#pagContainer').html(data);
			            $('#loadingGif').hide();
			            location.hash = page;

			        }).fail(function () {
			            alert('Users could not be loaded.');
			        });

		            e.preventDefault();
		        });

				/*
				$(".ui-multiselect-checkboxes").find("[type='checkbox']").each(function(){
					//alert('aa');
					$(this).prop('checked', true);
				});
				*/
            });
		</script>

	@endif

@endsection

