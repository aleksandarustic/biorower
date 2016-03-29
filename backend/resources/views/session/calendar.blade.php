
@extends('layouts.myframe')

@section('head-script')
@endsection


@section('title', 'Calendar')
@endsection

@section('page-script')

	{!! HTML::script('js/jquery.cookie.js') !!}

	{!! HTML::style('js/jquery-frontier-cal-1.3.2/css/frontierCalendar/jquery-frontier-cal-1.3.2.css') !!}
	{!! HTML::style('js/jquery-frontier-cal-1.3.2/css/colorpicker/colorpicker.css') !!}

	{!! HTML::script('js/jquery-frontier-cal-1.3.2/js/jquery-qtip-1.0.0-rc3140944/jquery.qtip-1.0.min.js') !!} 
	{!! HTML::script('js/jquery-frontier-cal-1.3.2/js/lib/jshashtable-2.1.js') !!}
	{!! HTML::script('js/jquery-frontier-cal-1.3.2/js/colorpicker/colorpicker.js') !!}
	{!! HTML::script('js/jquery-frontier-cal-1.3.2/js/frontierCalendar/jquery-frontier-cal-1.3.2.js') !!}

	{!! HTML::script('js/moment.min.js') !!}

	{!! HTML::script('js/highcharts.js') !!}
	{!! HTML::script('js/highcharts-more.js') !!}
	{!! HTML::script('js/highcharts-3d.js') !!}	


	<script type="text/javascript">
		$(function(){

			/* center modal */
			/*
			 window.adjustModalMaxHeightAndPosition = function(){
			  $('.modal').each(function(){
			    if($(this).hasClass('in') === false){
			      $(this).show();
			    }
			    var contentHeight = $(window).height() - 60;
			    var headerHeight = $(this).find('.modal-header').outerHeight() || 2;
			    var footerHeight = $(this).find('.modal-footer').outerHeight() || 2;

			    $(this).find('.modal-content').css({
			      'max-height': function () {
			        return contentHeight;
			      }
			    });

			    $(this).find('.modal-body').css({
			      'max-height': function () {
			        return contentHeight - (headerHeight + footerHeight);
			      }
			    });

			    $(this).find('.modal-dialog').addClass('modal-dialog-center').css({
			      'margin-top': function () {
			        return -($(this).outerHeight() / 2);
			      },
			      'margin-left': function () {
			        return -($(this).outerWidth() / 2);
			      }
			    });
			    if($(this).hasClass('in') === false){
			      $(this).hide();
			    }
			  });
			}
			if ($(window).height() >= 320){
			  $(window).resize(adjustModalMaxHeightAndPosition).trigger("resize");
			}
			*/

        	var OpetDialogCalendar = "Open";
        	var CancelDialogCalendar = "Cancel";

            var afCalendarJSON = JSON.parse('{"Status":1,"Items":[{"Item":{"idFile":40167,"Date":"16/10/2014 11:57:57","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40168,"Date":"16/10/2014 11:59:38","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40169,"Date":"17/10/2014 09:32:07","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40170,"Date":"17/10/2014 10:10:44","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40171,"Date":"17/10/2014 10:11:14","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40172,"Date":"21/10/2014 06:39:51","AllUsers":"isabella,mika,pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40173,"Date":"21/10/2014 06:41:05","AllUsers":"isabella,mika,pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40174,"Date":"21/10/2014 06:42:15","AllUsers":"isabella,mika,pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40177,"Date":"05/06/2015 12:13:16","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40185,"Date":"22/10/2014 06:39:26","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40186,"Date":"22/10/2014 06:46:27","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40187,"Date":"22/10/2014 06:50:38","AllUsers":"pera,vini","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40188,"Date":"05/06/2015 08:09:25","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40189,"Date":"05/06/2015 08:11:32","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40190,"Date":"04/06/2015 08:19:20","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40191,"Date":"05/06/2015 08:29:06","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40192,"Date":"05/06/2015 08:30:34","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40197,"Date":"05/06/2015 12:20:40","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40198,"Date":"05/06/2015 12:21:07","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40181,"Date":"21/10/2014 12:29:23","AllUsers":"isabella,pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40184,"Date":"05/06/2015 06:37:00","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40199,"Date":"05/06/2015 12:28:46","AllUsers":"pera","Device":"20","Activity":1,"Privilege":3}},{"Item":{"idFile":40200,"Date":"05/06/2015 15:18:44","AllUsers":"emma,isabella,pera","Device":"20","Activity":1,"Privilege":3}}]}');

	        var clickDate = "";
	        var clickAgendaItem = "";

	        /*
	            * Initializes calendar with current year & month
	            * specifies the callbacks for day click & agenda item click events
	            * then returns instance of plugin object
	        */

	        var jfcalplugin = $("#mycal").jFrontierCal({
		        date: new Date(),
		        dayClickCallback: myDayClickHandler,
		        agendaClickCallback: myAgendaClickHandler,
		        agendaDropCallback: myAgendaDropHandler,
		        agendaMouseoverCallback: myAgendaMouseoverHandler,
		        applyAgendaTooltipCallback: myApplyTooltip,
		        agendaDragStartCallback : myAgendaDragStart,
		        agendaDragStopCallback : myAgendaDragStop,
		        dragAndDropEnabled: false
	        }).data("plugin");

	        /**
	            * Do something when dragging starts on agenda div
	        */
	        function myAgendaDragStart(eventObj,divElm,agendaItem){
		        // destroy our qtip tooltip
		        if(divElm.data("qtip")){
			        divElm.qtip("destroy");
		        }	
	        };
	
	        /**
	            * Do something when dragging stops on agenda div
	            */
	        function myAgendaDragStop(eventObj,divElm,agendaItem){
		        //alert("drag stop");
	        };
	
	        /**
	            * Custom tooltip - use any tooltip library you want to display the agenda data.
	            * for this example we use qTip - http://craigsworks.com/projects/qtip/
	            *
	            * param divElm - jquery object for agenda div element
	            * param agendaItem - javascript object containing agenda data.
	            */
	        function myApplyTooltip(divElm,agendaItem){

		        // Destroy currrent tooltip if present
		        if(divElm.data("qtip")){
			        divElm.qtip("destroy");
		        }
		
		        var displayData = "";
		
		        var title = agendaItem.title;
		        var startDate = agendaItem.startDate;
		        var endDate = agendaItem.endDate;
		        var allDay = agendaItem.allDay;
		        var data = agendaItem.data;
                 
                 /*
	                var slika = $("#IDtempDevice-"+data["idDevice"]).val();

			        displayData += "<div style=\" background-image: url(/Images/device/"+ slika +"); margin-left:auto; margin-right:auto; height: 24px; width: 24px;  background-color:#fff; border: 1px solid #c0c0c0;\"></div><b></b><br>";

			        if(allDay){
				        displayData += "(All day event)<br><br>";
			        }else{
				        displayData += "<b>Start:</b> " + $.format.date(startDate, "dd/MM/yyyy, HH:MM:ss")  + "<br><br>";
			        }
		        */


				displayData = "<p>"+agendaItem.startDate+"</p>";

		        for (var propertyName in data) {
			        /* displayData += "<b>" + propertyName + ":</b> " + data[propertyName] + "<br>" */
		        }
		        // use the user specified colors from the agenda item.
		        var backgroundColor = agendaItem.displayProp.backgroundColor;
		        var foregroundColor = agendaItem.displayProp.foregroundColor;
		        var myStyle = {
		        	width: 310,
			        border: {
				        width: 2,
				        radius: 5
			        },
			        padding: 8, 
			        textAlign: "left",
			        tip: true,
			        name: "dark" // other style properties are inherited from dark theme		
		        };
		        if(backgroundColor != null && backgroundColor != ""){
			        myStyle["backgroundColor"] = backgroundColor;
		        }
		        if(foregroundColor != null && foregroundColor != ""){
			        myStyle["color"] = foregroundColor;
		        }
		        // apply tooltip
		        divElm.qtip({
			        content: displayData,
			        position: {
				        corner: {
					        tooltip: "bottomMiddle",
					        target: "topMiddle"			
				        },
				        adjust: { 
					        mouse: true,
					        x: 0,
					        y: -15
				        },
				        target: "mouse"
			        },
			        show: { 
				        when: { 
					        event: 'mouseover'
				        }
			        },
			        style: myStyle
		        });

	        };

	        /**
	            * Make the day cells roughly 3/4th as tall as they are wide. this makes our calendar wider than it is tall. 
	        */

	        jfcalplugin.setAspectRatio("#mycal",0.75);

	        /**
	            * Called when user clicks day cell
	            * use reference to plugin object to add agenda item
	            */
	        function myDayClickHandler(eventObj){
		        // Get the Date of the day that was clicked from the event object
		        var date = eventObj.data.calDayDate;
		        // store date in our global js variable for access later
		        clickDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate();
		        // open our add event dialog
		        
                /* $('#add-event-form').dialog('open'); */ 
	        };
	
	        /**
	            * Called when user clicks and agenda item
	            * use reference to plugin object to edit agenda item
	            */
	        function myAgendaClickHandler(eventObj){
		        // Get ID of the agenda item from the event object
		        var agendaId = eventObj.data.agendaId;		
		        // pull agenda item from calendar
		        var agendaItem = jfcalplugin.getAgendaItemById("#mycal", agendaId);
		        clickAgendaItem = agendaItem;
		        $('#myModal').modal('show');
		        //$("#display-event-form").dialog('open');
	        };
	
	        /**
	            * Called when user drops an agenda item into a day cell.
	            */
	        function myAgendaDropHandler(eventObj){
		        // Get ID of the agenda item from the event object
		        var agendaId = eventObj.data.agendaId;
		        // date agenda item was dropped onto
		        var date = eventObj.data.calDayDate;
		        // Pull agenda item from calendar
		        var agendaItem = jfcalplugin.getAgendaItemById("#mycal",agendaId);		
		        alert("You dropped agenda item " + agendaItem.title + 
			        " onto " + date.toString() + ". Here is where you can make an AJAX call to update your database.");
	        };
	
	        /**
	            * Called when a user mouses over an agenda item	
	            */
	        function myAgendaMouseoverHandler(eventObj){
		        var agendaId = eventObj.data.agendaId;
		        var agendaItem = jfcalplugin.getAgendaItemById("#mycal", agendaId);
		        //alert("You moused over agenda item " + agendaItem.title + " at location (X=" + eventObj.pageX + ", Y=" + eventObj.pageY + ")");
	        };
	        /**
	            * Initialize jquery ui datepicker. set date format to yyyy-mm-dd for easy parsing
	            */
	        $("#dateSelect").datepicker({
		        showOtherMonths: true,
		        selectOtherMonths: true,
		        changeMonth: true,
		        changeYear: true,
		        showButtonPanel: true,
		        dateFormat: 'yy-mm-dd'
	        });
	
	        /**
	            * Set datepicker to current date
	            */
	        $("#dateSelect").datepicker('setDate', new Date());
	        /**
	            * Use reference to plugin object to a specific year/month
	            */
	        $("#dateSelect").bind('change', function() {
		        var selectedDate = $("#dateSelect").val();
		        var dtArray = selectedDate.split("-");
		        var year = dtArray[0];
		        // jquery datepicker months start at 1 (1=January)		
		        var month = dtArray[1];
		        // strip any preceeding 0's		
		        month = month.replace(/^[0]+/g,"")		
		        var day = dtArray[2];
		        // plugin uses 0-based months so we subtrac 1
		        jfcalplugin.showMonth("#mycal",year,parseInt(month-1).toString());
	        });	

	        /**
	            * Initialize previous month button
	        */
	        //$("#BtnPreviousMonth").button();
	        $("#BtnPreviousMonth").click(function(evt) {
                //evt.preventDefault();
                
				$(".JFrontierCal-Agenda-Item").hide();

		        jfcalplugin.showPreviousMonth("#mycal");

		        $( "#mycal" ).hide( "fade", { direction: "left" }, "fast" );
		        $( "#mycal" ).show( "fade", { direction: "right" }, "fast" );

		        // update the jqeury datepicker value
		        var calDate = jfcalplugin.getCurrentDate("#mycal"); // returns Date object
		        var cyear = calDate.getFullYear();
		        // Date month 0-based (0=January)
		        var cmonth = calDate.getMonth();
		        var cday = calDate.getDate();
		        // jquery datepicker month starts at 1 (1=January) so we add 1
		        $("#dateSelect").datepicker("setDate",cyear+"-"+(cmonth+1)+"-"+cday);
                return false;
	        });
	        /**
	            * Initialize next month button
	            */
	        //$("#BtnNextMonth").button();

	        window.checkIfPressed = 0;

	        $("#BtnNextMonth").click(function() {


			        jfcalplugin.showNextMonth("#mycal");

			        $( "#mycal" ).hide( "fade", { direction: "right" }, "fast" );
			        $( "#mycal" ).show( "fade", { direction: "left" }, "fast" );

			        // update the jqeury datepicker value
			        var calDate = jfcalplugin.getCurrentDate("#mycal"); // returns Date object
			        var cyear = calDate.getFullYear();
			        // Date month 0-based (0=January)
			        var cmonth = calDate.getMonth();
			        var cday = calDate.getDate();
			        // jquery datepicker month starts at 1 (1=January) so we add 1
			        $("#dateSelect").datepicker("setDate",cyear+"-"+(cmonth+1)+"-"+cday);		
   		        	
   		        	return false;
	        });
	
	        /**
	            * Initialize delete all agenda items button
	            */
	        $("#BtnDeleteAll").button();
	        $("#BtnDeleteAll").click(function() {	
		        jfcalplugin.deleteAllAgendaItems("#mycal");	
		        return false;
	        });
	
	        /**
	            * Initialize iCal test button
	            */
	        $("#BtnICalTest").button();
	        $("#BtnICalTest").click(function() {
		        // Please note that in Google Chrome this will not work with a local file. Chrome prevents AJAX calls
		        // from reading local files on disk.		
		        jfcalplugin.loadICalSource("#mycal",$("#iCalSource").val(),"html");	
		        return false;
	        });	

	        /**
	          * Initialize add event modal form
	        */


	        /*
	        $("#add-event-form").dialog({
		        autoOpen: false,
		        height: 400,
		        width: 400,
		        modal: true,
		        buttons: {
			        'Add Event': function() {
                        
				        var what = jQuery.trim($("#what").val());
			
				        if(what == ""){
					        alert("Please enter a short event description into the \"what\" field.");
				        }else{
				
					        var startDate = $("#startDate").val();
					        var startDtArray = startDate.split("-");
					        var startYear = startDtArray[0];
					        // jquery datepicker months start at 1 (1=January)		
					        var startMonth = startDtArray[1];		
					        var startDay = startDtArray[2];
					        // strip any preceeding 0's		
					        startMonth = startMonth.replace(/^[0]+/g,"");
					        startDay = startDay.replace(/^[0]+/g,"");
					        var startHour = jQuery.trim($("#startHour").val());
					        var startMin = jQuery.trim($("#startMin").val());
					        var startMeridiem = jQuery.trim($("#startMeridiem").val());
					        startHour = parseInt(startHour.replace(/^[0]+/g,""));
					        if(startMin == "0" || startMin == "00"){
						        startMin = 0;
					        }else{
						        startMin = parseInt(startMin.replace(/^[0]+/g,""));
					        }
					        if(startMeridiem == "AM" && startHour == 12){
						        startHour = 0;
					        }else if(startMeridiem == "PM" && startHour < 12){
						        startHour = parseInt(startHour) + 12;
					        }

					        var endDate = $("#endDate").val();
					        var endDtArray = endDate.split("-");
					        var endYear = endDtArray[0];
					        // jquery datepicker months start at 1 (1=January)		
					        var endMonth = endDtArray[1];		
					        var endDay = endDtArray[2];
					        // strip any preceeding 0's		
					        endMonth = endMonth.replace(/^[0]+/g,"");

					        endDay = endDay.replace(/^[0]+/g,"");
					        var endHour = jQuery.trim($("#endHour").val());
					        var endMin = jQuery.trim($("#endMin").val());
					        var endMeridiem = jQuery.trim($("#endMeridiem").val());
					        endHour = parseInt(endHour.replace(/^[0]+/g,""));
					        if(endMin == "0" || endMin == "00"){
						        endMin = 0;
					        }else{
						        endMin = parseInt(endMin.replace(/^[0]+/g,""));
					        }
					        if(endMeridiem == "AM" && endHour == 12){
						        endHour = 0;
					        }else if(endMeridiem == "PM" && endHour < 12){
						        endHour = parseInt(endHour) + 12;
					        }
					
					        //alert("Start time: " + startHour + ":" + startMin + " " + startMeridiem + ", End time: " + endHour + ":" + endMin + " " + endMeridiem);

					        // Dates use integers
					        var startDateObj = new Date(parseInt(startYear),parseInt(startMonth)-1,parseInt(startDay),startHour,startMin,0,0);
					        var endDateObj = new Date(parseInt(endYear),parseInt(endMonth)-1,parseInt(endDay),endHour,endMin,0,0);

					        // add new event to the calendar
					        jfcalplugin.addAgendaItem(
						        "#mycal",
						        what,
						        startDateObj,
						        endDateObj,
						        false,
						        {
							        fnamedf: "Santa",
							        lname: "Claus",
							        leadReindeer: "Rudolph",
							        myDate: new Date(),
							        myNum: 42
						        },
						        {
							        backgroundColor: $("#colorBackground").val(),
							        foregroundColor: $("#colorForeground").val()
						        }
					        );

					        $(this).dialog('close');

				        }
				
			        },
			        Cancel: function() {
				        $(this).dialog('close');
			        }
		        },
		        open: function(event, ui){
			        // initialize start date picker
			        $("#startDate").datepicker({
				        showOtherMonths: true,
				        selectOtherMonths: true,
				        changeMonth: true,
				        changeYear: true,
				        showButtonPanel: true,
				        dateFormat: 'yy-mm-dd'
			        });
			        // initialize end date picker
			        $("#endDate").datepicker({
				        showOtherMonths: true,
				        selectOtherMonths: true,
				        changeMonth: true,
				        changeYear: true,
				        showButtonPanel: true,
				        dateFormat: 'yy-mm-dd'
			        });
			        // initialize with the date that was clicked
			        $("#startDate").val(clickDate);
			        $("#endDate").val(clickDate);
			        // initialize color pickers
			        $("#colorSelectorBackground").ColorPicker({
				        color: "#111111",
				        onShow: function (colpkr) {
					        $(colpkr).css("z-index","10000");
					        $(colpkr).fadeIn(500);
					        return false;
				        },
				        onHide: function (colpkr) {
					        $(colpkr).fadeOut(500);
					        return false;
				        },
				        onChange: function (hsb, hex, rgb) {
					        $("#colorSelectorBackground div").css("backgroundColor", "#" + hex);
					        $("#colorBackground").val("#" + hex);
				        }
			        });
			        //$("#colorBackground").val("#1040b0");		
			        $("#colorSelectorForeground").ColorPicker({
				        color: "#ffffff",
				        onShow: function (colpkr) {
					        $(colpkr).css("z-index","10000");
					        $(colpkr).fadeIn(500);
					        return false;
				        },
				        onHide: function (colpkr) {
					        $(colpkr).fadeOut(500);
					        return false;
				        },
				        onChange: function (hsb, hex, rgb) {
					        $("#colorSelectorForeground div").css("backgroundColor", "#" + hex);
					        $("#colorForeground").val("#" + hex);
				        }
			        });
			        //$("#colorForeground").val("#ffffff");				
			        // put focus on first form input element
			        $("#what").focus();
		        },
		        close: function() {
			        // reset form elements when we close so they are fresh when the dialog is opened again.
			        $("#startDate").datepicker("destroy");
			        $("#endDate").datepicker("destroy");
			        $("#startDate").val("");
			        $("#endDate").val("");
			        $("#startHour option:eq(0)").attr("selected", "selected");
			        $("#startMin option:eq(0)").attr("selected", "selected");
			        $("#startMeridiem option:eq(0)").attr("selected", "selected");
			        $("#endHour option:eq(0)").attr("selected", "selected");
			        $("#endMin option:eq(0)").attr("selected", "selected");
			        $("#endMeridiem option:eq(0)").attr("selected", "selected");			
			        $("#what").val("");
			        //$("#colorBackground").val("#1040b0");
			        //$("#colorForeground").val("#ffffff");
		        }
	        });
			*/
	
	        /**
	            * Initialize display event form.
	            */
	        $("#display-event-form").dialog({
		        autoOpen: false,
		        height: 250,
		        width: 250,
		        modal: true,
		        buttons: {		
			        OpetDialogCalendar: {
                        click: function() {
                          var idFile = $(this).find("input[name='linkHidden']").val();
                          window.location.href = "/Files/FileStrokesZones/"+idFile;
                       },
                       text: OpetDialogCalendar
			        },
			        CancelDialogCalendar: {
                        click: function() {
				            $(this).dialog('close');
                         },
                       text: CancelDialogCalendar
			        },

                    /*
			        'Edit': function() {
				        alert("Make your own edit screen or dialog!");
			        },
			        'Delete': function() {
				        if(confirm("Are you sure you want to delete this agenda item?")){
					        if(clickAgendaItem != null){
						        jfcalplugin.deleteAgendaItemById("#mycal",clickAgendaItem.agendaId);
						        //jfcalplugin.deleteAgendaItemByDataAttr("#mycal","myNum",42);
					        }
					        $(this).dialog('close');
				        }
			        }
                    */

		        },
		        open: function(event, ui){
			        if(clickAgendaItem != null){
				        var title = clickAgendaItem.title;
				        var startDate = clickAgendaItem.startDate;
				        var endDate = clickAgendaItem.endDate;
				        var allDay = clickAgendaItem.allDay;
				        var data = clickAgendaItem.data;
				        // in our example add agenda modal form we put some fake data in the agenda data. we can retrieve it here.

				        /*
                        var slika = $("#IDtempDevice-"+data["idDevice"]).val();

				        $("#display-event-form").append(
                            "<div style=\" background-image: url(/Images/device/"+ slika +"); margin-left:auto; margin-right:auto; height: 24px; width: 24px; border: 1px solid #c0c0c0;\"></div><b></b><br>"
				        );
				        */				
				        if(allDay){
					        $("#display-event-form").append(
						        "(All day event)<br><br>"				
					        );				
				        }else{
					            $("#display-event-form").append(
					            	"<p>Test</p>"

					            	/*
						            "<b>Start:</b> " + $.format.date(startDate, "dd/MM/yyyy, HH:MM:ss")  + "<br><br>" + 
                                    "<input type=\"hidden\" name=\"linkHidden\" value=\""+data["idFile"]+"\">"
                                    */

                                    /*"<u><a href=\"/Files/FileStrokesZones/" + data["idFile"] + "\">Open file</a><br></u><br><br>" */
                                    /* + "<b>Ends:</b> " + endDate + "<br><br>" */	
					            );
                           			
				        }
				        for (var propertyName in data) {
					       /* $("#display-event-form").append("<b>" + propertyName + ":</b> " + data[propertyName] + "<br>"); */
				        }			
			        }		
		        },
		        close: function() {
			        // clear agenda data
			        $("#display-event-form").html("");
		        }
	        });	 
            
            var prvi = new Date(2013,0,24,11,33,0);
            var drugi = new Date(2013,0,24,12,33,0);
            /* ViewBag.afCalendarJSON */

            if (afCalendarJSON.Status != 0){
                    $.each(afCalendarJSON.Items, function(index, val){

                        var datumvreme = val.Item.Date.split(" ");

                        //if ($.cookie('language')=="en")
                        //{


                            var a = moment(val.Item.Date, "DD/MM/YYYY HH:mm:ss");
                            var l = a.format("MM/DD/YYYY HH:mm:ss");

                            var dt = new Date(l);
                            
                            var strDatumVreme = dt.toString("MM/dd/yyyy HH:mm:ss");



                            /*
                            var datum = datumvreme[0].split("/");
                            var strDatum = datum[2] + "," + datum[1] + "," + datum[0];

                            if (datumvreme[2] == "PM")
                            {
                                var datumvremeSplit = datumvreme[1].split(":");

                                if (datumvremeSplit[0] == "10")
                                    datumvremeSplit[0] = "22";
                                else if (datumvremeSplit[0] == "11")
                                    datumvremeSplit[0] = "23";
                                else
                                {
                                    var t = parseInt(datumvremeSplit[0]) + 2;
                                    datumvremeSplit[0]="1"+t;
                                }

                                datumvreme[1] =  datumvremeSplit[0]+":"+datumvremeSplit[1]+":"+datumvremeSplit[2];
                            }

                            var strDatumVreme = strDatum+","+datumvreme[1];

                            */

                        /*
                        }
                        else
                        {
                            var datum = datumvreme[0].split(".");
                            var strDatum = datum[2] + "," + datum[1] + "," + datum[0];
                            var strDatumVreme = strDatum+","+datumvreme[1];
                        }
                        */

                        //alert(strDatumVreme);

                        var prviDatum = new Date(strDatumVreme);
                        var drugiDatum = new Date(strDatumVreme);

                        jfcalplugin.addAgendaItem(
				            "#mycal",
    			            "",
				            prviDatum,
				            drugiDatum,
				            false,
				            {
                                users: val.Item.AllUsers,
                                idDevice: val.Item.Device,
                                idFile: val.Item.idFile,
				            },
				            {
					            backgroundColor: $("#colorBackground").val(),
					            foregroundColor: $("#colorForeground").val()
				            }
			            );

                    });
            }


			$('#myModal').on('show.bs.modal', function (e) {
			  var allData = clickAgendaItem.data;

			  if (allData != undefined){
			  	$("#idOfItem").text(allData["idFile"]);
			  }
			});

			$('#myModal').on('show.bs.modal', function (e) {
				$("#chkPublicInput").prop("checked", false);
					$(".snetwClass").css("opacity", "0.6");
					$(".snetwClass").css("cursor", "default");				
				$("#idOfItem").text(window.idFile);
			});			

			$('#myModalMore, #myModal').on('shown.bs.modal', function() {
			    $(this).find('.modal-dialog').css({
			        'margin-top': function () {
			            return -($(this).outerHeight() / 2);
			        },
			        'margin-left': function () {
			            return -($(this).outerWidth() / 2);
			        }
			    });
			});

			$("#chkPublicInput").prop("checked", false);

			$(document).on("click", "#chkPublicInput" ,function (e) {
				if ($(this).is(":checked")){
					$(".snetwClass").css("opacity", "1");
					$(".snetwClass").css("cursor", "pointer");
				}
				else{
					$(".snetwClass").css("opacity", "0.6");
					$(".snetwClass").css("cursor", "default");
				}
			});

			$(".snetwClass").on("click", function(){

			});


		    varChartModalCalendar = {
		        chart: {
		            renderTo: 'chartModalCalendar',
		            width: 670,
		            backgroundColor: "#DFDDDD",
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

			varChartModalCalendar = new Highcharts.Chart(varChartModalCalendar);

			$("#myModal").draggable({
			    handle: ".modal-header"
			});

		})
	</script>


	<style type="text/css">
		.modal-dialog {
		    margin: 0;
		    position: absolute;
		    top: 50%;
		    left: 50%;
		}
	</style>

@endsection

@section('content')

		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">
				  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2" >

				  		<div style="width:100%">
				  			<div style="margin:0 auto; width:345px;">
				                <button id="BtnPreviousMonth" class="btn btn-primary btn-default">Prev</button>
				                &nbsp;&nbsp;&nbsp;
				                <input type="text" id="dateSelect" size="20"/>
				                &nbsp;&nbsp;&nbsp;
				                <button id="BtnNextMonth" class="btn btn-primary btn-default">Next</button>
				           </div>
				           <br />
			           </div>				                
				                <!--
		                            <button id="BtnDeleteAll">Delete All</button>
				                    <button id="BtnICalTest">iCal Test</button>
				                    <input type="text" id="iCalSource" size="30" value="extra/fifa-world-cup-2010.ics"/>
		                        -->
			                    <!--
			                    	<div id="toolbar" class="ui-widget-header ui-corner-all" style="padding:3px; vertical-align: middle; white-space:nowrap; overflow: hidden;">
								</div>
								-->
				                <div id="mycal">
				                </div>

				                <!-- debugging-->
				               <div id="calDebug"></div>

				               
				               <div id="display-event-form">
				               </div>

					           <input type="hidden" name="tempDevice1" id="IDtempDevice-3" class="tempDevice" value="PNG_WATTBIKE-A.png" /><br />
					           <input type="hidden" name="tempDevice1" id="IDtempDevice-20" class="tempDevice" value="PNG_WATTBIKE-B.png" /><br />

					</div>
		  	  </div>
		  	</div>  
	    </section>

		<div class="modal fade" id="myModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <!--
		        <h4 class="modal-title">Show details for training</h4>
		        <br/>dasdasd
		        -->
		        <div><span id="calDateModal">THURSDAY&nbsp;&nbsp;&nbsp;Mar 19,&nbsp;&nbsp;&nbsp;2015</span></div>

		        <div id="calModalWrapper">
		        	<div><span id="calTimeModal">0:03:16</span>&nbsp;&nbsp;&nbsp;<span id="calDistanceModal">2.30</span><span class="unitModal">km</span>&nbsp;&nbsp;&nbsp;<span id="calHrModal">1.7</span><span>TSS</span></div>
		        </div>

		      </div>
		      <div class="modal-body">
		        <p>ID of session is: <span id="idOfItem"></span> </p>
				<div id="chartModalCalendar" class="">
				</div>	
	        
		      </div>
		      <div class="modal-footer">
		      	<div id="idShareModalCalendar">
		      		<span id="chkPublic"><input type="checkbox" name="chkPublic" id="chkPublicInput" />&nbsp;Public&nbsp;</span>
		      		<div style="position: relative; display:inline">
		      			<div class="snetwClass"><div id="snetwTwitter"></div></div>
		      			<div class="snetwClass"><div id="snetwFacebook"></div></div>
		      			<div class="snetwClass"><div id="snetwMail"></div></div>
		      			<a href="mailto:?subject=Dusan%20has%20shared%20a%20workout%20with%20you&body=Dusan%20completed%20a%2012.9%20km%20bike%20workout%20on%203%2F19%20in%200%3A18%3A54%20with%2043.9%20TSS.%0A%0Ahttp%3A%2F%2Ftpks.ws%2FlFfa"><div class="snetwClass"><div id="snetwLink" ></div></div></a>
		      		</div>
		      	</div>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="myModalMore">
		  <div class="modal-dialog" id="modal-more-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">All trainings</h4>
		      </div>
		      <div class="modal-body" id="modalMore">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Close</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

@endsection

