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

	<div class="row">
		<div class="col-md-3">

			<!-- Profile Image -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<div class="img-circle-width">
						<a href="edit-profile.html"><span class="label-edit edit-img"><i class="fa fa-pencil"></i></span></a>
						<img class="profile-user-img img-responsive img-circle" src="{{ URL::asset('images/img/user2-160x160.jpg') }}" alt="User profile picture">
					</div>
					<h3 class="profile-username text-center">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
					<p class="text-muted text-center">({{ Auth::user()->display_name }})</p>

					<!-- <a href="edit-profile.html" class="btn btn-primary btn-block"><b>Edit Profile</b></a>-->
				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<!-- About Me Box -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-globe margin-right text-blue"></i>  About me</h3>
					<a href="/profile/edit" class="pull-right edit-icon"><span class="label-edit"><i class="fa fa-pencil"></i></span></a>
				</div>
				<div class="box-body">
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item no-border-first">
							Member Since: <span class="pull-right text-bold">{{ date('Y-m-d', strtotime(Auth::user()->created_at)) }}</span>
						</li>
						<li class="list-group-item no-border">
							Latest Session: <span class="pull-right text-bold">13 Apr 2015</span>
						</li>
						<li class="list-group-item no-border ">
							Peak Power: <span class="pull-right text-bold">2848</span>
						</li>
						<li class="list-group-item no-border">
							Peak AvgPower: <span class="pull-right text-bold">1962</span>
						</li><li class="list-group-item no-border ">
							Peak Cadence: <span class="pull-right text-bold">119</span>
						</li><li class="list-group-item no-border">
							Peak Power/Kg: <span class="pull-right text-bold">26.16</span>
						</li>
					</ul>
				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<!--I am Following -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-users margin-right text-blue"></i> I'm following</h3>
				</div>
				<div class="box-body">
					<div class="box-body no-padding">
						<ul class="users-list clearfix">
							@foreach($allWatching as $following)
								<li>
									{{ $following }}
								</li>
							@endforeach
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user1-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</a>--}}
								{{--<span class="users-list-date">Today</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user8-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Norman</a>--}}
								{{--<span class="users-list-date">Yesterday</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user7-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Jane</a>--}}
								{{--<span class="users-list-date">12 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user6-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">John</a>--}}
								{{--<span class="users-list-date">12 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Alexander</a>--}}
								{{--<span class="users-list-date">13 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user5-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Sarah</a>--}}
								{{--<span class="users-list-date">14 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user4-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Nora</a>--}}
								{{--<span class="users-list-date">15 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user3-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Nadia</a>--}}
								{{--<span class="users-list-date">15 Jan</span>--}}
							{{--</li>--}}
						</ul><!-- /.users-list -->
					</div><!-- /.box-body -->
					<div class="box-footer text-center padding-bottom-zero">
						<a href="" class="uppercase">View All Users</a>
					</div><!-- /.box-footer -->
				</div><!--/.box -->
			</div>


			<!-- Following me -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-users margin-right text-blue"></i>  Following me</h3>
				</div>
				<div class="box-body">
					<div class="box-body no-padding">
						<ul class="users-list clearfix">
							@foreach($allWatched as $followers)
								<li>{{ $followers }}</li>
							@endforeach
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user1-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</a>--}}
								{{--<span class="users-list-date">Today</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user8-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Norman</a>--}}
								{{--<span class="users-list-date">Yesterday</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user7-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Jane</a>--}}
								{{--<span class="users-list-date">12 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user6-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">John</a>--}}
								{{--<span class="users-list-date">12 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Alexander</a>--}}
								{{--<span class="users-list-date">13 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user5-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="diff-profile.html">Sarah</a>--}}
								{{--<span class="users-list-date">14 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user4-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="/profile">Nora</a>--}}
								{{--<span class="users-list-date">15 Jan</span>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<img src="{{ URL::asset('images/img/user3-128x128.jpg') }}" alt="User Image">--}}
								{{--<a class="users-list-name" href="/profile">Nadia</a>--}}
								{{--<span class="users-list-date">15 Jan</span>--}}
							{{--</li>--}}
						</ul><!-- /.users-list -->
					</div><!-- /.box-body -->
					<div class="box-footer text-center padding-bottom-zero">
						<a href="javascript::" class="uppercase">View All Users</a>
					</div><!-- /.box-footer -->
				</div><!--/.box -->
			</div>


		</div><!-- /.col -->

		<div class="col-md-9 margin-bottom ">
			<div class="row">
				<div class="col-sm-3 col-xs-12">
					<div class="description-block border-right">
						<h5 class="description-header">{{ $totalStatisticsParameters["training_sessions"][0] }}</h5>
						<span class="description-text">Total training sessions</span>
					</div><!-- /.description-block -->
				</div><!-- /.col -->
				<div class="col-sm-3 col-xs-12">
					<div class="description-block border-right">
						<h5 class="description-header">{{  gmdate("H:i:s", $totalStatisticsParameters["time"][0]) }}</h5>
						<span class="description-text">Total training time </span>
						<span class="description-percentage-small-small text-blue btn-block">[hh:mm:ss]</span>
					</div><!-- /.description-block -->
				</div><!-- /.col -->
				<div class="col-sm-3 col-xs-12">
					<div class="description-block border-right">
						<h5 class="description-header">{{ round($totalStatisticsParameters["distance"][0], 2) }}</h5>
						<span class="description-text">Total Distance</span>
						<span class="description-percentage-small text-blue btn-block">[km]</span>
					</div><!-- /.description-block -->
				</div><!-- /.col -->
				<div class="col-sm-3 col-xs-12">
					<div class="description-block">
						<h5 class="description-header">{{ round($totalStatisticsParameters["power_average"][0], 2) }}</h5>
						<span class="description-text">Total Power average </span>
						<span class="description-percentage-small text-blue btn-block">[W]</span>
					</div><!-- /.description-block -->
				</div>
			</div>

			<div class="row">
				<div class="col-sm-3 col-xs-12">
					<div class="description-block border-right">

						<h5 class="description-header">{{ $totalStatisticsParameters["stroke_count"][0] }}</h5>
						<span class="description-text">Total number of strokes</span>
					</div><!-- /.description-block -->
				</div><!-- /.col -->
				<div class="col-sm-3 col-xs-12">
					<div class="description-block border-right">
						<h5 class="description-header">{{ round($totalStatisticsParameters["stroke_distance_average"][0], 2) }}</h5>
						<span class="description-text">Total Stroke distance average </span>
						<span class="description-percentage-small text-blue inline">[spm]</span>
					</div><!-- /.description-block -->
				</div><!-- /.col -->
				<div class="col-sm-3 col-xs-12">
					<div class="description-block border-right">
						<h5 class="description-header">{{ round($totalStatisticsParameters["angle_average"][0], 2) }}</h5>
						<span class="description-text">Total Angle average</span>
						<span class="description-percentage-small text-blue btn-block">[°]</span>
					</div><!-- /.description-block -->
				</div><!-- /.col -->
				<div class="col-sm-3 col-xs-12">
					<div class="description-block">
						<h5 class="description-header">{{ round($totalStatisticsParameters["heart_rate_average"][0], 2) }}</h5>
						<span class="description-text ">Total HR average</span>
						<span class="description-percentage-small text-blue btn-block">[bmp]</span>


					</div><!-- /.description-block -->
				</div>
			</div>
		</div>
		<!-- graph -->
		<div class="col-md-9">
			<!-- Graph Block-->
			<div class="col-md-12 white-bg box box-primary box direct-chat">
				<div class="graphic-box">
					<div class="box-title">
						<h3>History</h3>
					</div>
					<div class="graphic-header">
						<ul class="pagination pagination-sm no-margin inline pull-left">
							<li class="shiftStatistics" id="leftDateOverview"><a><i class="fa fa-angle-double-left control-padding"></i></a></li>
							<li><a class="shiftStatistics" id="leftDateOverviewSmallStep"><i class="fa fa-angle-left control-padding"></i></a></li>
							<li><a class="shiftStatistics" id="rightDateOverviewSmallStep"><i class="fa fa-angle-right control-padding"></i></a></li>
							<li><a class="shiftStatistics" id="rightDateOverview"><i class="fa fa-angle-double-right control-padding"></i></a></li>
						</ul>

						<!-- Date and time range -->
						<div class="form-group">
							<div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; margin-left: 5px;">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
								<span>Choose the date</span> <b class="caret"></b>
							</div>
						</div>                  </div><!-- /.form group -->



					<div class="inline pull-right">
						<button class="btn btn-box-tool control-btn pull-right" data-toggle="tooltip" title="Choose Parametars" data-widget="chat-pane-toggle"><i class="fa fa-filter"></i></button>

						<li class="dropdown inline control-btn pull-right margin-r-5">

							<a class="dropdown-toggle control-btn-a" data-toggle="dropdown" href="#">
								Month <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li role="presentation" class="rangeTimeStat rangeTimeStatHistory">
									<a role="menuitem" tabindex="-1" href="#">Day</a>
								</li>
								<li role="presentation" class="rangeTimeStat rangeTimeStatHistory">
									<a role="menuitem" tabindex="-1" href="#" id="weekBtnOverview">Week</a>
								</li>
								<li role="presentation" class="rangeTimeStat rangeTimeStatHistory">
									<a role="menuitem" tabindex="-1" href="#">Month</a>
								</li>
								<li role="presentation" class="rangeTimeStat rangeTimeStatHistory">
									<a role="menuitem" tabindex="-1" href="#">Year</a>
								</li>
							</ul>
						</li>

					</div>
					<div class="graphic-body row transp-bg">

						<div class="historyGraph">
							<div id="history" style="height: 300px;"></div>
							<!-- Contacts are loaded here -->
							<div class="direct-chat-contacts param-box">
								<ul class="contacts-list checkbox icheck col-md-4 pull-right param-bg-dark">
									<h2>Choose three parametars</h2>
									<li>
										<label for="power">
											<input type="checkbox" name="power" id="power" checked>
											Power
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="hr">
											<input type="checkbox" name="hr" id="hr" checked>
											Heart rate(bmp)
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="speed">
											<input type="checkbox" name="speed" id="speed">
											Speed
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="time">
											<input type="checkbox" name="time" id="time">
											Time
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="distance">
											<input type="checkbox" name="distance" id="distance">
											Distance
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="stroke">
											<input type="checkbox" name="stroke" id="stroke">
											Stroke
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="angle">
											<input type="checkbox" name="angle" id="angle" >
											Angle
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="cal">
											<input type="checkbox" name="cal" id="cal">
											Calories
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="pace">
											<input type="checkbox" name="pace" id="pace">
											Pace
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="power-max">
											<input type="checkbox" name="power-max" id="power-max">
											Power Max
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="power-balance">
											<input type="checkbox" name="power-balance" id="power-balance">
											Power Balance
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="stroke-rate">
											<input type="checkbox" name="stroke-rate" id="stroke-rate" checked>
											Stroke rate
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="stroke-rate-max">
											<input type="checkbox" name="stroke-rate-max" id="stroke-rate-max">
											Stroke Rate Max
										</label>
									</li><!-- End Parametar Item -->
									<li>
										<label for="hr-max">
											<input type="checkbox" class="flat-blue" name="hr-max" id="hr-max">
											Heart Rate Max</label>
									</li><!-- End Parametar Item -->
								</ul><!-- /.contatcts-list -->
							</div><!-- /.direct-chat-pane -->
						</div>

					</div>
					{{--<div class="balance-graph">--}}
						{{--<h1 class="graph-h1">Balance</h1>--}}
						{{--<div class="left-right-balance">--}}
							{{--<p class="balance-left">left</p>--}}
							{{--<p class="balance-right">right</p>--}}
						{{--</div>--}}
						{{--<div id="balance" style="height: 300px;"></div>--}}
					{{--</div>--}}
				</div>

				<div class="graphic-footer row">
				</div>
			</div>
			<!-- /.Graph Block-->

			<!-- Graph Block-->
			<div class="col-md-12 white-bg box box-primary">
				<div class="graphic-box">
					<div class="box-title">
						<h3>Progress</h3>
					</div>
					<div class="graphic-header">
						<ul class="pagination pagination-sm no-margin inline pull-left">
							<li><a href="#"><i class="fa fa-angle-double-left control-padding"></i></a></li>
							<li><a href="#"><i class="fa fa-angle-left control-padding"></i></a></li>
							<li><a href="#"><i class="fa fa-angle-right control-padding"></i></a></li>
							<li><a href="#"><i class="fa fa-angle-double-right control-padding"></i></a></li>
						</ul>

						<!-- Date and time range -->
						<div class="form-group">
							<div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; margin-left: 5px;">
								<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
								<span>Choose the date</span> <b class="caret"></b>
							</div>
						</div>                  </div><!-- /.form group -->
					<div class="inline pull-right">
						<a href="/profile/edit" class="fa fa-filter control-btn"></a>
					</div>
					<li class="dropdown inline control-btn pull-right margin-r-5">

						<a class="dropdown-toggle control-btn-a" data-toggle="dropdown" href="#">
							Month <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Day</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Week</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Month</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Year</a></li>
						</ul>
					</li>
				</div>
				<div class="graphic-body">
					<div id="progress" style="height: 300px;"></div>

				</div>


			</div>
			<!-- /.Graph Block-->

			<!-- Graph Block-->
			<div class="col-md-12 white-bg box box-primary">
				<div class="graphic-box graphic-padding-b">
					<div class="box-title">
						<h3 class="pull-left graphic-padding-t ">Sessions</h3>
						<div class="pull-right">
							<a href="/profile/sessions" class="btn btn-primary pull-right">List</a>
							<a href="/sessions/calendar" class="btn btn-primary pull-right margin-r-5">Calendar</a>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<!-- /.Graph Block-->

		</div>
		<!-- /.graph -->

	</div><!-- /.row -->

	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '10%' // optional
			});

			<!-- Date Range Picker -->

			$(document).ready(function () {

				$('li.shiftStatistics').on('click', function(){
					console.log('clicked');
				});

				var cb = function (start, end, label) {
					console.log(start.toISOString(), end.toISOString(), label);
					$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
					//alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
				}

				var optionSet1 = {
					startDate: moment().subtract(29, 'days'),
					endDate: moment(),
					minDate: '01/01/2012',
					maxDate: '12/31/2015',
					dateLimit: {
						days: 60
					},
					showDropdowns: true,
					showWeekNumbers: true,
					timePicker: false,
					timePickerIncrement: 1,
					timePicker12Hour: true,
					ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					opens: 'left',
					buttonClasses: ['btn btn-default'],
					applyClass: 'btn-small btn-primary',
					cancelClass: 'btn-small',
					format: 'MM/DD/YYYY',
					separator: ' to ',
					locale: {
						applyLabel: 'Submit',
						cancelLabel: 'Clear',
						fromLabel: 'From',
						toLabel: 'To',
						customRangeLabel: 'Custom',
						daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
						monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
						firstDay: 1
					}
				};
				$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
				$('#reportrange').daterangepicker(optionSet1, cb);
				$('#reportrange').on('show.daterangepicker', function () {
					console.log("show event fired");
				});
				$('#reportrange').on('hide.daterangepicker', function () {
					console.log("hide event fired");
				});
				$('#reportrange').on('apply.daterangepicker', function (ev, picker) {
					console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
				});
				$('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
					console.log("cancel event fired");
				});
				$('#options1').click(function () {
					$('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
				});
				$('#options2').click(function () {
					$('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
				});
				$('#destroy').click(function () {
					$('#reportrange').data('daterangepicker').remove();
				});
			});

			/*
			 * LINE CHART
			 * ----------
			 */
			//LINE +ć


			$(function() {

				var days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
				var data9_1 = [
					[1, 1530], [2, 6580], [3, 1980],[4, 6630], [5, 8010], [6, 10800],
					[7, 8530],
				];
				var data9_2 = [
					[1, 1830], [2, 3580], [3, 1900],[4, 7630], [5, 2010], [6, 10000],
					[7, 3530],
				];
				var data9_3 = [
					[1, 5530], [2, 9580], [3, 2980],[4, 6630], [5, 10010], [6, 2800],
					[7, 5530],
				];


				function showTooltip(x, y, contents) {
					$('<div id="tooltip">' + contents + '</div>').css({
						position: 'absolute',
						display: 'none',
						top: y + 5,
						left: x + 20,
						border: '2px solid #ccc',
						padding: '5px',
						size: '10',
						'background-color': '#fff',
						opacity: 0.80
					}).appendTo("body").fadeIn(200);
				}


				$(function () {
					$.plot($("#history"),
							[{
								data: data9_1,
								label: 'Power(W)',
								color: "#3c8dbc",
								lines: { show: true, color: "#3c8dbc"},
								points: { show: true, fill:true }
							},{
								data: data9_2,
								label: 'Stroke rate',
								color: "#b8c7ce",
								lines: { show: true, color: "#b8c7ce" },
								points: { show: true, fill:true }
							},{
								data: data9_3,
								label: 'Heart rate(bmp)',
								color: "#536A7F",
								lines: { show: true, color: "#536A7F" },
								points: { show: true, fill:true }
							},

							],{
								grid: {
									hoverable: true,
									clickable: false,
									mouseActiveRadius: 30,
									backgroundColor: false,
									borderColor: "#f3f3f3",
									borderWidth: 1,
									tickColor: "#f3f3f3" ,
								},
								legend: {
									noColumns: 1,

								},
								yaxis: {
									show: true,
									labelWidth: 30
								},
								xaxis:{
									labelHeight: 30,
									ticks: [
										[1, "Mon"], [2, "Tue"], [3, "Wed"], [4, "Thu"], [5, "Fri"], [6, "Sat"],
										[7, "Sun"]
									]
								}
							}
					);

					$("#history").UseTooltip();

					var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Days of the week").appendTo($('#history'));

					var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#history'));
					yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
				});



			});

		});

		//Line Graph - Progress

		$(function() {

			var data9_1 = [
				[1, 1530], [2, 6580], [3, 1980],[4, 6630], [5, 8010], [6, 10800],
				[7, 8530]
			];
			var data9_2 = [
				[1, 1830], [2, 3580], [3, 1900],[4, 7630], [5, 2010], [6, 10000],
				[7, 3530]
			];
			var data9_3 = [
				[1, 5530], [2, 9580], [3, 2980],[4, 6630], [5, 10010], [6, 2800],
				[7, 5530]
			];

			$.fn.UseTooltip = function () {
				var previousPoint = null;

				$(this).bind("plothover", function (event, pos, item) {
					if (item) {
						if (previousPoint != item.dataIndex) {
							previousPoint = item.dataIndex;

							$("#tooltip").remove();

							var x = item.datapoint[0];
							var y = item.datapoint[1];

							showTooltip(item.pageX, item.pageY,
									days[x-1] + "<br/>" + "<strong>" + y + "</strong> (" + item.series.label + ")");
						}
					}
					else {
						$("#tooltip").remove();
						previousPoint = null;
					}
				});
			};

			function showTooltip(x, y, contents) {
				$('<div id="tooltip">' + contents + '</div>').css({
					position: 'absolute',
					display: 'none',
					top: y + 5,
					left: x + 20,
					border: '2px solid #ccc',
					padding: '5px',
					size: '10',
					'background-color': '#fff',
					opacity: 0.80
				}).appendTo("body").fadeIn(200);
			}


			$(function () {
				$.plot($("#progress"),
						[{
							data: data9_1,
							label: 'Power(W)',
							color: "#3c8dbc",
							lines: { show: true, color: "#3c8dbc", fillColor: "#3c8dbc" },
							points: { show: true, fill:true }
						},{
							data: data9_2,
							label: 'HR(bmp)',
							color: "#536A7F",
							lines: { show: true, color: "#536A7F", fillColor: "#536A7F" },
							points: { show: true, fill:true }
						},
							{
								data: data9_3,
								label: 'Stroke rate',
								color: "#b8c7ce",
								lines: { show: true, color: "#b8c7ce", fillColor: "#b8c7ce" },
								points: { show: true, fill:true }
							}
						],{
							grid: {
								hoverable: true,
								clickable: false,
								mouseActiveRadius: 30,
								backgroundColor: false,
								borderColor: "#f3f3f3",
								borderWidth: 1,
								tickColor: "#f3f3f3"
							},
							legend: {
								noColumns: 1,

							},
							yaxis: {
								show: true,
								labelWidth: 30
							},
							xaxis:{
								show: true,
								labelHeight: 30
							} ,
							legend: {
								show: true
							}

						}
				);

				$("#progress").UseTooltip();

				var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Time(sec)").appendTo($('#progress'));

				var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#progress'));
				yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
			});

		});


		/*
		 * Custom Label formatter
		 * ----------------------
		 */
		function labelFormatter(label, series) {
			return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
					+ label
					+ "<br>"
					+ Math.round(series.percent) + "%</div>";
		}

	</script>
	<!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->
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

