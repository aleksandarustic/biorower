


$(function () {
    
    
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });



    $(document).ready(function () {
            
       

        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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
        $('#reportrange1 span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange1').daterangepicker(optionSet1, cb);
        $('#reportrange1').on('show.daterangepicker', function () {
            console.log("show event fired");
        });
        $('#reportrange1').on('hide.daterangepicker', function () {
            console.log("hide event fired");
        });
        $('#reportrange1').on('apply.daterangepicker', function (ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange1').on('cancel.daterangepicker', function (ev, picker) {
            console.log("cancel event fired");
        });
        $('#options1').click(function () {
            $('#reportrange1').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function () {
            $('#reportrange1').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function () {
            $('#reportrange1').data('daterangepicker').remove();
        });
    });

    /*
     * LINE CHART
     * ----------
     */
    //LINE +ć

  
  

        var email2 = 'biorower:' + $('#user-email').val();

     
        var data2 = {
            account: 'biorower:' + $('#user-email').val(),
            rangeType: 'all',
            groupType:'week',


        };

                   

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url : 'api/v1/sessions_recent_list',
            data: {account: email2 ,offset:0,pageSize:1, web: 1
            },
            success: function (response) {
                var json = JSON.parse(JSON.stringify(response.sessionsRecentList));
                // PRIKAZ PODATAKA POSLEDNJE SESIJE
                if (response.sessionsRecentList.length !== 0) {
                    $('.time3').append(json[0].time);
                    $('.distance').append(json[0].dist);
                    $('.power-average').append(json[0].pwr_avg);
                    $('.heart-rate-avg').append(json[0].hr_avg);
                    var latest_session = json[0].date;
                    $('.latest-session').append(moment(latest_session).format('MMM Do YYYY h:mm a'));

                }else{
                    $('.time').append('-');
                    $('.distance').append('-');
                    $('.power-average').append('-');
                    $('.heart-rate-avg').append('-');
                    $('.latest-session').append('No workouts');
                }





                  


                        /* History Graph */

                   


               
                        data_test = piktoBiorowerGraph.getHistoryData(piktoBiorowerGraph.parameters);
                        data_test2 = piktoBiorowerGraph2.getHistoryData(piktoBiorowerGraph2.parameters);
                        
                       
                        
                        
                        
                      

                        
                        //console.log(data_dates);

                        
                       


                  
               
            }
        });



    var data = {
        account: 'biorower:' + $('#user-email').val(),
        rangeType: 'all',


    };
    var data2 = {
        account: 'biorower:' + $('#user-email').val(),
        rangeType: 'all',
        groupType:'week',


    };


    $.post('api/v1/sessions_history', data, function (response) {

        piktoBiorowerGraph.start=moment( response.historydata.date[0]);
        


        var end= moment();
        var s=new Date("October 10, 2016 11:13:00");
        var s2=new Date("October 10, 2017 11:13:00");
        var dr2=moment.range(s, s2);
        var range2=moment.range(piktoBiorowerGraph.start, end);


        if(range2<dr2){
          
            piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'year',moment().startOf('year'));
              $("#year_history").css("text-decoration","underline");             
              
            $("#all_history").hide();
       
            
           
            


        }
        else{
            piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'all','');
               $("#all_history").css("background-color","#286090");
             
             
             
        }








    });

    $.post('api/v1/sessions_history', data2, function (response) {
        piktoBiorowerGraph2.start=moment( response.historydata.date[0]);
         piktoBiorowerGraph2.groupType="week";


        var end= moment();
        var s=new Date("October 10, 2016 11:13:00");

        var s2=new Date("October 10, 2017 11:13:00");

       

        var dr2=moment.range(s, s2);

        var range3=moment.range(piktoBiorowerGraph2.start, end);
        


        if(range3<dr2){
            piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'year',moment().startOf('year'),'week');
            $("#all_progress").hide();
            $("#year_progress").css("text-decoration","underline");     
           
            



        }
        else{
              piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'all','','week');
              $("#all_progress").css("background-color","#286090");
               
            
        }




    })
    
    
    
    
                        function showTooltip(x, y, contents) {
                            $('<div id="tooltip">' + contents + '</div>').css({
                                position: 'absolute',
                                display: 'none',
                                top: y - 5,
                                left: x + 20,
                                border: '2px solid #fff',
                                padding: '5px',
                                'box-shadow': '0px 0px 2px 0px rgba(0, 0, 0, 0.196)',
                                size: '10',
                                'background-color': '#fff',
                                opacity: 0.80
                            }).appendTo("body").fadeIn(200);
                        }

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
                                            "<span class='x-asis'>" + days[x - 1] + "</span>" + "<br/>" + "<br/>" + "<p>" + y + "W" + "</p>" + "<i>" + item.series.label + "") + "</i>";
                                    }
                                } else {
                                    $("#tooltip").remove();
                                    previousPoint = null;
                                }
                            });
                        };


                        





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
                                                "<span class='x-asis'>" + x + "</span>" + "<br/>" + "<p>" + y + "W" + "</p>" + "<i>" + item.series.label + "") + "</i>";
                                        }
                                    } else {
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



                         

                            $("#progress").UseTooltip();

                            var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Time(sec)").appendTo($('#progress'));

                            var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#progress'));
                            yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);


                        

                            $("#history").UseTooltip();


    
    
    
    







   

});
//Line Graph - Progress



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
function selectTab() {
    $('[role="tab"]').has("a[href='#" + history + "']").first().trigger("click");
}


var piktoBiorowerGraph = {
    historyPlot: null,
    historyData: null,
    startDate: null,
    rangeType: 'all',
    parameters: [{slug:'scnt',label:'Stroke Count',yaxis:1}],
    start:null,
    sadasnjost:null,
    transormData: function (historyData, parameter) {
        var rv = [];
        rv['label'] = parameter.label;
        rv['data'] = [];
       
    
        for (var i in historyData.date) {

            rv['data'].push([new Date(historyData.date[i]).getTime(), historyData[parameter.slug][i]]);
        }
       
        return rv;
    },
    getHistoryData: function (params) {
          
        
        var rv = [];
        

        
        for(var i in params) {
            
            
            
            
            rv.push(this.transormData(this.historyData, params[i]));
             switch (rv[i]['label']) {
                    case "Stroke Count":
                        rv[i]['yaxis'] = 1; 
                         params[i]['yaxis']=1;
                        
                        break;
                    case "Stroke Distance":
                        rv[i]['yaxis'] = 2;
                          params[i]['yaxis']=2;
                      
                        break;
                    case "Speed Max":
                        rv[i]['yaxis'] = 3; 
                          params[i]['yaxis']=3;
                        break;
                    case "Pace 2km":
                        rv[i]['yaxis'] = 4; 
                            params[i]['yaxis']=4;
                        break;
                    case "HR Max":
                        rv[i]['yaxis'] = 5; 
                           params[i]['yaxis']=5;
                        break;
                    case "Calories":
                        rv[i]['yaxis'] = 6; 
                            params[i]['yaxis']=6;
                        break;
                     case "Time":
                        rv[i]['yaxis'] = 7; 
                           params[i]['yaxis']=7;
                        break; 
                     case "Stroke Dist. Max":
                        rv[i]['yaxis'] = 8; 
                          params[i]['yaxis']=8;
                        break;    
                    case "Pace 500m":
                        rv[i]['yaxis'] = 9; 
                    params[i]['yaxis']=9;
                        break; 
                      case "Pace 2km Max":
                        rv[i]['yaxis'] = 10; 
                            params[i]['yaxis']=10;
                         break; 
                     case "Stroke Rate":
                        rv[i]['yaxis'] = 11; 
                            params[i]['yaxis']=11;
                        break;      
                     case "Power L":
                        rv[i]['yaxis'] = 12; 
                            params[i]['yaxis']=12;
                        break;    
                     case "Distance":
                        rv[i]['yaxis'] = 13; 
                            params[i]['yaxis']=13;
                        break; 
                       case "Speed":
                        rv[i]['yaxis'] = 14; 
                          params[i]['yaxis']=14;
                        break;    
                    case "Pace 500m Max":
                        rv[i]['yaxis'] = 15; 
                         params[i]['yaxis']=15;
                        break; 
                      case "HR":
                        rv[i]['yaxis'] = 16; 
                            params[i]['yaxis']=16;
                         break; 
                     case "Stroke Rate Max":
                        rv[i]['yaxis'] = 17; 
                          params[i]['yaxis']=17;
                        break;      
                     case "Power average":
                        rv[i]['yaxis'] = 18;
                            params[i]['yaxis']=18;
                        break;    
                     case "Power max":
                        rv[i]['yaxis'] = 19;
                      params[i]['yaxis']=19;
                        break; 
                      case "Power L Max":
                        rv[i]['yaxis'] = 20; 
                            params[i]['yaxis']=20;
                        break;    
                     case "Power right average":
                        rv[i]['yaxis'] = 21; 
                          params[i]['yaxis']=21;
                        break; 
                       case "Power right max":
                        rv[i]['yaxis'] = 22; 
                          params[i]['yaxis']=22;
                        break;    
                    case "Power balance":
                        rv[i]['yaxis'] = 23; 
                        params[i]['yaxis']=23;
                        break; 
                      case "Power balance max":
                        rv[i]['yaxis'] = 24; 
                            params[i]['yaxis']=24;
                         break; 
                     case "Angle left average":
                        rv[i]['yaxis'] = 25; 
                          params[i]['yaxis']=25;
                        break;      
                     case "Angle left Max":
                        rv[i]['yaxis'] = 26; 
                          params[i]['yaxis']=26;
                        break;    
                     case "Angle right average":
                        rv[i]['yaxis'] = 27; 
                           params[i]['yaxis']=27;
                        break;    
                     case "Angle right max":
                        rv[i]['yaxis'] = 28; 
                          params[i]['yaxis']=28;
                        break;  
                     case "Angle average":
                        rv[i]['yaxis'] = 29; 
                           params[i]['yaxis']=29;
                        break;  
                       case "Angle max":
                        rv[i]['yaxis'] = 30; 
                      params[i]['yaxis']=30;
                        break; 
                     case "MML 2 Level":
                        rv[i]['yaxis'] = 31; 
                           params[i]['yaxis']=31;
                        break;  
                       case "MML 4 Level":
                        rv[i]['yaxis'] = 32; 
                           params[i]['yaxis']=32;
                        break;    
                }
             
        }
        piktoBiorowerGraph.parameters = params;
       
  
  
       
      
        return rv;
        
    },
    loadHistoryData: function (account, rangeType, startDate) {
        var data = {
            account: 'biorower:' + account,
            rangeType: rangeType,
            dateStart: startDate?startDate.format('YYYY-MM-DD'):''
        };

        piktoBiorowerGraph.startDate = startDate;
        piktoBiorowerGraph.rangeType = rangeType;
        
        
        
          if(piktoBiorowerGraph.rangeType!="all"){
               $('#strelice').show();
          }
     
      
        
         
                        var end= moment();
                                             
                           if(moment(piktoBiorowerGraph.startDate).endOf(piktoBiorowerGraph.rangeType)>end.subtract(1, piktoBiorowerGraph.rangeType)){
                               $("#next1").hide();
                                                            
                           }
                          
                            else{
                                 $("#next1").show();
                            }
                            if(moment(piktoBiorowerGraph.startDate)<piktoBiorowerGraph.start){
                                $("#next2").hide();
                            }
                             else{
                                 $("#next2").show();
                            }
                          
                        
        
        
       
        
       

        $.post('api/v1/sessions_history', data, function (response) {
             piktoBiorowerGraph.historyData = response.historydata;
            var newHistoryData = piktoBiorowerGraph.getHistoryData(piktoBiorowerGraph.parameters);
            
            
            
               function formatter(val, axis) {
                   var minutes = parseInt( val / 60 ) % 60;
        
                   
                   
    return minutes+":00" ; 
}
       
            
                piktoBiorowerGraph.historyPlot = $.plot($("#history"),
                                newHistoryData, {
                                    grid: {
                                        hoverable: true,
                                        clickable: true,
                                        mouseActiveRadius: 30,
                                        backgroundColor: false,
                                        borderColor: "#f3f3f3",
                                        borderWidth: 1,
                                        tickColor: "#f3f3f3",
                                    },
                                    legend: {
                                        noColumns: 3,
                                        position:"nw"
                                        
                                    },
                                    colors:["#FF0000FF","#FF000080","#FFFF0000","#FFFF8000","#FF804000","#FFFFFF60",
                                        "#FF0000FF","#FF00FF00","#FFFF0000","#FFFF8000","#FFFFFF60","#FFFFFF60","#FF0000FF",
                                        "#FFFFFFFF","#FFFF8000","#FF804000","#FFFFFF60","#FF606060","#FF606060","#FFFFFF60","#FF008000",
                                        "#FF008000","#FF606060","#FF606060","#FF606060","#FF606060",
                                        "#FF606060","#FF606060","#FF606060","#FF606060","#FF606060","#FF606060"],
                                    yaxes:[ {

                                        labelWidth: 30,

                                        min:0,

                                    },{

                                        labelWidth: 30,
                                        max:20,
                                         tickSize: 4 ,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                        max:10,
                                        tickSize: 2 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:1200,
                                       tickFormatter: formatter ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:250,
                                         tickSize: 50 ,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                        max:2000,
                                         tickSize: 400 ,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                       tickFormatter: formatter ,
                                         max:9000,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                        max:20,
                                         tickSize: 4 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        tickFormatter: formatter ,
                                        max:300,
                                        min:0
                                    },
                                     {

                                        labelWidth: 30,
                                         tickFormatter: formatter ,
                                         max:1200,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:50,
                                         tickSize: 10 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:750,
                                         tickSize: 150 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:20,
                                         tickSize: 4 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:20,
                                        tickSize: 4 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                          tickFormatter: formatter ,
                                         max:300,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:250,
                                        tickSize: 50 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:50,
                                        tickSize: 10 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:1500,
                                        tickSize: 300,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:1500,
                                        tickSize: 300,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:750,
                                        tickSize: 150,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:750,
                                        tickSize: 150,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:750,
                                        tickSize: 150,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,


                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },




                                ],
                                    xaxis: {
                                        show: true,
                                        labelHeight: 30,
                                        mode: 'time',

                                        timeformat:"%b",
                                        tickSize:[1,"month"],


                                    }
                                }
                            );




        if(piktoBiorowerGraph.rangeType=="month"){
            
              var end= moment();
                 $("#year_history").css("text-decoration","none");
                 $("#week_history").css("text-decoration","none");
                 $("#month_history").css("text-decoration","underline");
                 $("#all_history").css("background-color","#3c8dbc");
                 
               if(moment(piktoBiorowerGraph.startDate).endOf(piktoBiorowerGraph.rangeType)>moment().startOf("month")){
                  
                   piktoBiorowerGraph.sadasnjost="ss";
                   
                               
                                   piktoBiorowerGraph.startDate = end.subtract(1, "month"); 
                                   
                           }
                           else{
                                  piktoBiorowerGraph.sadasnjost=null;
                           }
                        
             
            
            
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
            axes.xaxis.options.timeformat="%d";
            axes.xaxis.options.tickSize=[1,"day"];
              
                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate).add(1, 'month');
            
            $('#tekst').html("History"+"&nbsp;&nbsp;&nbsp;&nbsp"+" "+moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY')+" - "
            +moment(piktoBiorowerGraph.startDate).add(1,'month').format('MMMM Do YYYY'));
           
        }
         if(piktoBiorowerGraph.rangeType=="week"){
             var end=moment();
                $("#year_history").css("text-decoration","none");
                 $("#week_history").css("text-decoration","underline");
                 $("#month_history").css("text-decoration","none");
                 $("#all_history").css("background-color","#3c8dbc");
                 if(moment(piktoBiorowerGraph.startDate).endOf(piktoBiorowerGraph.rangeType)>end){
                              piktoBiorowerGraph.sadasnjost="ss";
                            
                                   piktoBiorowerGraph.startDate = end.subtract(1, "week"); 
                                   
                           }
                            else{
                                  piktoBiorowerGraph.sadasnjost=null;
                           }
             
             
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
            axes.xaxis.options.timeformat="%a %d";
            axes.xaxis.options.tickSize=[1,"day"];
            
                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate).add(1, 'week');
                 $('#tekst').html("History"+'&nbsp;&nbsp;&nbsp;&nbsp'+" "+moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY')+" - "
            +moment(piktoBiorowerGraph.startDate).add(1,'week').format('MMMM Do YYYY'));
        }
         if(piktoBiorowerGraph.rangeType=="year"){
                 var end= moment();
                 $("#year_history").css("text-decoration","underline");
                 $("#week_history").css("text-decoration","none");
                 $("#month_history").css("text-decoration","none");
                 $("#all_history").css("background-color","#3c8dbc");
                  
               if(moment(piktoBiorowerGraph.startDate).endOf(piktoBiorowerGraph.rangeType)>end){
                               piktoBiorowerGraph.sadasnjost="s";
                                   piktoBiorowerGraph.startDate = end.subtract(1, "year"); 
                                   
                           }
                            else{
                                  piktoBiorowerGraph.sadasnjost=null;
                           }
             
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
            axes.xaxis.options.timeformat="%b";
            axes.xaxis.options.tickSize=[1,"month"];
              
                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate).add(1, 'year');
                 $('#tekst').html("History"+"&nbsp;&nbsp;&nbsp;&nbsp"+" "+moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY')+" - "
            +moment(piktoBiorowerGraph.startDate).add(1,'year').format('MMMM Do YYYY'));
        }
            
            
            
            
            
            var opts = piktoBiorowerGraph.historyPlot.getOptions();
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
            var niz=[10,20,50,100,200,500,1000,2000,5000,10000,20000];
            var cal=response.historydata.cal;
            var time=response.historydata.time;
            var scnt=response.historydata.scnt;
            var dist=response.historydata.dist;
            var cal2=0;
            var time2=0;
            var scnt2=0;
            var dist2=0;
            if(cal){
                cal2 = Math.max.apply(Math, cal);
            }
            if(time){
                time2 = Math.max.apply(Math, time);
            }
            if(scnt){

                scnt2 = Math.max.apply(Math, scnt);

            }
            if(dist){
                dist2 = Math.max.apply(Math, dist);
            }

            if(dist2>niz[8] && dist2<=niz[9]){
                dist2=niz[10];
            }
            if(dist2>niz[7] && dist2<=niz[8]){
                dist2=niz[9];
            }
            if(dist2>niz[6] && dist2<=niz[7]){
                dist2=niz[8];
            }
            if(dist2>niz[5] && dist2<=niz[6]){
                dist2=niz[7];
            }
            if(dist2>niz[4] && dist2<=niz[5]){
                dist2=niz[6];
            }
            if(dist2>niz[3] && dist2<=niz[4]){
                dist2=niz[5];
            }
            if(dist2>niz[2] && dist2<=niz[3]){
                dist2=niz[4];
            }
            if(dist2>niz[1] && dist2<=niz[2]){
                dist2=niz[4];
            }
            if(dist2>niz[0] && dist2<=niz[1]){
                dist2=niz[3];
            }
            if(dist2<=niz[0]){

                dist2=niz[2];
            }

            if(time2>niz[8] && time2<=niz[9]){
                time2=niz[10];
            }
            if(time2>niz[7] && time2<=niz[8]){
                time2=niz[9];
            }
            if(time2>niz[6] && time2<=niz[7]){
                time2=niz[8];
            }
            if(time2>niz[5] && time2<=niz[6]){
                time2=niz[7];
            }
            if(time2>niz[4] && time2<=niz[5]){
                time2=niz[6];
            }
            if(time2>niz[3] && time2<=niz[4]){
                time2=niz[5];
            }
            if(time2>niz[2] && time2<=niz[3]){
                time2=niz[4];
            }
            if(time2>niz[1] && time2<=niz[2]){
                time2=niz[4];
            }
            if(time2>niz[0] && time2<=niz[1]){
                time2=niz[3];
            }
            if(time2<=niz[0]){

                time2=niz[2];
            }


            if(cal2>niz[8] && cal2<=niz[9]){
                cal2=niz[10];
            }
            if(cal2>niz[7] && cal2<=niz[8]){
                cal2=niz[9];
            }
            if(cal2>niz[6] && cal2<=niz[7]){
                cal2=niz[8];
            }
            if(cal2>niz[5] && cal2<=niz[6]){
                cal2=niz[7];
            }
            if(cal2>niz[4] && cal2<=niz[5]){
                cal2=niz[6];
            }
            if(cal2>niz[3] && cal2<=niz[4]){
                cal2=niz[5];
            }
            if(cal2>niz[2] && cal2<=niz[3]){
                cal2=niz[4];
            }
            if(cal2>niz[1] && cal2<=niz[2]){
                cal2=niz[4];
            }
            if(cal2>niz[0] && cal2<=niz[1]){
                cal2=niz[3];
            }
            if(cal2<=niz[0]){

                cal2=niz[2];
            }



            if(scnt2>niz[8] && scnt2<=niz[9]){
                scnt2=niz[10];
            }
            if(scnt2>niz[7] && scnt2<=niz[8]){
                scnt2=niz[9];
            }
            if(scnt2>niz[6] && scnt2<=niz[7]){
                scnt2=niz[8];
            }
            if(scnt2>niz[5] && scnt2<=niz[6]){
                scnt2=niz[7];
            }
            if(scnt2>niz[4] && scnt2<=niz[5]){
                scnt2=niz[6];
            }
            if(scnt2>niz[3] && scnt2<=niz[4]){
                scnt2=niz[5];
            }
            if(scnt2>niz[2] && scnt2<=niz[3]){
                scnt2=niz[4];
            }
            if(scnt2>niz[1] && scnt2<=niz[2]){
                scnt2=niz[4];
            }
            if(scnt2>niz[0] && scnt2<=niz[1]){
                scnt2=niz[3];
            }
            if(scnt2<=niz[0]){

                scnt2=niz[2];
            }

              opts.yaxes[0].max = scnt2;
              opts.yaxes[0].tickSize=scnt2/5;
              opts.yaxes[5].max = cal2;
              opts.yaxes[5].tickSize=cal2/5;
              opts.yaxes[6].max = time2;
              opts.yaxes[6].tickSize=time2/5;
              opts.yaxes[12].max = dist2;
              opts.yaxes[12].tickSize=dist2/5;
      
            var r= piktoBiorowerGraph.parameters;
            var duzina=r.length;



            if(duzina==1){

                opts.yaxes[piktoBiorowerGraph.parameters[0].yaxis-1].position='left';

            }
            if(duzina==2){
                opts.yaxes[piktoBiorowerGraph.parameters[0].yaxis-1].position='left';


                opts.yaxes[piktoBiorowerGraph.parameters[1].yaxis-1].position='right';
            }
            if(duzina==3){


                opts.yaxes[piktoBiorowerGraph.parameters[0].yaxis-1].position='left';
                opts.yaxes[piktoBiorowerGraph.parameters[1].yaxis-1].position='right';
                opts.yaxes[piktoBiorowerGraph.parameters[2].yaxis-1].position='left';
            }









           
                 
                        
                     
            
            
            if(piktoBiorowerGraph.rangeType=='all'){
                $('#strelice').hide();
                  $("#year_history").css("text-decoration","none");
                 $("#week_history").css("text-decoration","none");
                 $("#month_history").css("text-decoration","none");
                  $("#all_history").css("background-color","#286090");
               
               
                
                   var end= moment();
               if(moment(piktoBiorowerGraph.startDate).endOf(piktoBiorowerGraph.rangeType)>end){
                               piktoBiorowerGraph.sadasnjost="s";
                                  
                                   
                           }
                            else{
                                $
                                  piktoBiorowerGraph.sadasnjost=null;
                           }
                
                
                
                axes.xaxis.options.min = undefined;
                axes.xaxis.options.max = undefined;
               
            axes.xaxis.options.timeformat="%b";
            axes.xaxis.options.tickSize=[1,"month"];
                

         
            
       
                $('#tekst').html("History "+"&nbsp;&nbsp;&nbsp;&nbsp"+" "+moment(response.historydata.date[0]).format('MMMM Do YYYY')+" - "
                +moment().format('MMMM Do YYYY'));
          

            } 
         
            piktoBiorowerGraph.historyPlot.setupGrid();
            piktoBiorowerGraph.historyPlot.draw();
        });
    }
};


var piktoBiorowerGraph2 = {
    progressPlot: null,
    historyData: null,
    startDate: null,
    sadasnjost:null,
    rangeType: 'all',
    parameters: [{slug:'scnt',label:'Stroke Count',yaxis:1}],
    start:null,
    groupType:'week',
    transormData: function (historyData, parameter) {
        var rv = [];
        rv['label'] = parameter.label;
        rv['data'] = [];
        for (var i in historyData.date) {
            rv['data'].push([new Date(historyData.date[i]).getTime(), historyData[parameter.slug][i]]);
        }
        return rv;
    },
    getHistoryData: function (params) {
        piktoBiorowerGraph2.parameters = params;
        var rv = [];
        for(var i in params) {
            rv.push(this.transormData(this.historyData, params[i]));
             switch (rv[i]['label']) {
                    case "Stroke Count":
                        rv[i]['yaxis'] = 1; 
                         params[i]['yaxis']=1;
                        
                        break;
                    case "Stroke Distance":
                        rv[i]['yaxis'] = 2;
                          params[i]['yaxis']=2;
                      
                        break;
                    case "Speed Max":
                        rv[i]['yaxis'] = 3; 
                          params[i]['yaxis']=3;
                        break;
                    case "Pace 2km":
                        rv[i]['yaxis'] = 4; 
                            params[i]['yaxis']=4;
                        break;
                    case "HR Max":
                        rv[i]['yaxis'] = 5; 
                           params[i]['yaxis']=5;
                        break;
                    case "Calories":
                        rv[i]['yaxis'] = 6; 
                            params[i]['yaxis']=6;
                        break;
                     case "Time":
                        rv[i]['yaxis'] = 7; 
                           params[i]['yaxis']=7;
                        break; 
                     case "Stroke Dist. Max":
                        rv[i]['yaxis'] = 8; 
                          params[i]['yaxis']=8;
                        break;    
                    case "Pace 500m":
                        rv[i]['yaxis'] = 9; 
                    params[i]['yaxis']=9;
                        break; 
                      case "Pace 2km Max":
                        rv[i]['yaxis'] = 10; 
                            params[i]['yaxis']=10;
                         break; 
                     case "Stroke Rate":
                        rv[i]['yaxis'] = 11; 
                            params[i]['yaxis']=11;
                        break;      
                     case "Power L":
                        rv[i]['yaxis'] = 12; 
                            params[i]['yaxis']=12;
                        break;    
                     case "Distance":
                        rv[i]['yaxis'] = 13; 
                            params[i]['yaxis']=13;
                        break; 
                       case "Speed":
                        rv[i]['yaxis'] = 14; 
                          params[i]['yaxis']=14;
                        break;    
                    case "Pace 500m Max":
                        rv[i]['yaxis'] = 15; 
                         params[i]['yaxis']=15;
                        break; 
                      case "HR":
                        rv[i]['yaxis'] = 16; 
                            params[i]['yaxis']=16;
                         break; 
                     case "Stroke Rate Max":
                        rv[i]['yaxis'] = 17; 
                          params[i]['yaxis']=17;
                        break;      
                     case "Power average":
                        rv[i]['yaxis'] = 18;
                            params[i]['yaxis']=18;
                        break;    
                     case "Power max":
                        rv[i]['yaxis'] = 19;
                      params[i]['yaxis']=19;
                        break; 
                      case "Power L Max":
                        rv[i]['yaxis'] = 20; 
                            params[i]['yaxis']=20;
                        break;    
                     case "Power right average":
                        rv[i]['yaxis'] = 21; 
                          params[i]['yaxis']=21;
                        break; 
                       case "Power right max":
                        rv[i]['yaxis'] = 22; 
                          params[i]['yaxis']=22;
                        break;    
                    case "Power balance":
                        rv[i]['yaxis'] = 23; 
                        params[i]['yaxis']=23;
                        break; 
                      case "Power balance max":
                        rv[i]['yaxis'] = 24; 
                            params[i]['yaxis']=24;
                         break; 
                     case "Angle left average":
                        rv[i]['yaxis'] = 25; 
                          params[i]['yaxis']=25;
                        break;      
                     case "Angle left Max":
                        rv[i]['yaxis'] = 26; 
                          params[i]['yaxis']=26;
                        break;    
                     case "Angle right average":
                        rv[i]['yaxis'] = 27; 
                           params[i]['yaxis']=27;
                        break;    
                     case "Angle right max":
                        rv[i]['yaxis'] = 28; 
                          params[i]['yaxis']=28;
                        break;  
                     case "Angle average":
                        rv[i]['yaxis'] = 29; 
                           params[i]['yaxis']=29;
                        break;  
                       case "Angle max":
                        rv[i]['yaxis'] = 30; 
                      params[i]['yaxis']=30;
                        break; 
                     case "MML 2 Level":
                        rv[i]['yaxis'] = 31; 
                           params[i]['yaxis']=31;
                        break;  
                       case "MML 4 Level":
                        rv[i]['yaxis'] = 32; 
                           params[i]['yaxis']=32;
                        break;    
                }
                
        }
        
         piktoBiorowerGraph2.parameters = params;
        return rv;
    },
    loadHistoryData: function (account, rangeType, startDate, groupType) {
        var data = {
            account: 'biorower:' + account,
            rangeType: rangeType,
            dateStart: startDate?startDate.format('YYYY-MM-DD'):'',
            groupType: groupType,
        };
        piktoBiorowerGraph2.startDate = startDate;
        piktoBiorowerGraph2.rangeType = rangeType;
         piktoBiorowerGraph2.groupType = groupType;
        
       if(piktoBiorowerGraph2.rangeType!="all"){
               $('#strelice2').show();
          }
        
             var end= moment();
             
                          
       
        
        
      
        $.post('api/v1/sessions_history', data, function (response) {
            
            piktoBiorowerGraph2.historyData = response.historydata;
            var newHistoryData = piktoBiorowerGraph2.getHistoryData(piktoBiorowerGraph2.parameters);
            
            
            
                function formatter(val, axis) {
                   var minutes = parseInt( val / 60 ) % 60;
        
                   
                   
    return minutes+":00" ; 
}
            
            
            
               piktoBiorowerGraph2.progressPlot=$.plot($("#progress"),
                                newHistoryData, {
                                    grid: {
                                        hoverable: true,
                                        clickable: true,
                                        mouseActiveRadius: 30,
                                        backgroundColor: false,
                                        borderColor: "#f3f3f3",
                                        borderWidth: 1,
                                        tickColor: "#f3f3f3",
                                    },
                                    legend: {
                                        noColumns: 3,
                                        position:"nw",
                                    },
                                    colors:["#FF0000FF","#FF000080","#FFFF0000","#FFFF8000","#FF804000","#FFFFFF60",
                                        "#FF0000FF","#FF00FF00","#FFFF0000","#FFFF8000","#FFFFFF60","#FFFFFF60","#FF0000FF",
                                        "#FFFFFFFF","#FFFF8000","#FF804000","#FFFFFF60","#FF606060","#FF606060","#FFFFFF60","#FF008000",
                                        "#FF008000","#FF606060","#FF606060","#FF606060","#FF606060",
                                        "#FF606060","#FF606060","#FF606060","#FF606060","#FF606060","#FF606060"],
                                    yaxes:[ {

                                        labelWidth: 30,

                                        min:0,

                                    },{

                                        labelWidth: 30,
                                        max:20,
                                         tickSize: 4 ,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                        max:10,
                                        tickSize: 2 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:1200,
                                       tickFormatter: formatter ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:250,
                                         tickSize: 50 ,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                        max:2000,
                                         tickSize: 400 ,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                       tickFormatter: formatter ,
                                         max:9000,min:0,
                                    },
                                    {

                                        labelWidth: 30,
                                        max:20,
                                         tickSize: 4 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        tickFormatter: formatter ,
                                        max:300,
                                        min:0
                                    },
                                     {

                                        labelWidth: 30,
                                         tickFormatter: formatter ,
                                         max:1200,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:50,
                                         tickSize: 10 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:750,
                                         tickSize: 150 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:20,
                                         tickSize: 4 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:20,
                                        tickSize: 4 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                          tickFormatter: formatter ,
                                         max:300,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:250,
                                        tickSize: 50 ,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:50,
                                        tickSize: 10 ,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:1500,
                                        tickSize: 300,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:1500,
                                        tickSize: 300,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:750,
                                        tickSize: 150,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:750,
                                        tickSize: 150,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:750,
                                        tickSize: 150,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },
                                     {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,


                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                       {

                                        labelWidth: 30,
                                        max:150,
                                        tickSize: 30,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },
                                      {

                                        labelWidth: 30,
                                        max:100,
                                        tickSize: 20,min:0,
                                    },




                                ],
                                    xaxis: {
                                        show: true,
                                        labelHeight: 30,
                                        mode: 'time',

                                        timeformat:"%b",
                                        tickSize:[1,"month"],


                                    }
                                }
                            );
            
            
            var axes = piktoBiorowerGraph2.progressPlot.getAxes();
            
               var opts = piktoBiorowerGraph2.progressPlot.getOptions();
               
               
      
        
                            
                         
        
        
        
        
        
        
        
             if(piktoBiorowerGraph2.rangeType=="year"){
                 var end= moment();
                   $("#year_progress").css("text-decoration","underline");
                 $("#all_progress").css("background-color","#3c8dbc");
                  
               if(moment(piktoBiorowerGraph2.startDate).endOf(piktoBiorowerGraph2.rangeType)>end){
                               piktoBiorowerGraph2.sadasnjost="s";
                                   piktoBiorowerGraph2.startDate = end.subtract(1, "year"); 
                                  
                                   
                           }
                            else{
                                  piktoBiorowerGraph2.sadasnjost=null;
                           }
             
            var axes = piktoBiorowerGraph2.progressPlot.getAxes();
            axes.xaxis.options.timeformat="%b";
            axes.xaxis.options.tickSize=[1,"month"];
              
                axes.xaxis.options.min = piktoBiorowerGraph2.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph2.startDate).add(1, 'year');
                 $('#tekst2').html("Progress"+"&nbsp;&nbsp;&nbsp;&nbsp"+" "+moment(piktoBiorowerGraph2.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY')+" - "
            +moment(piktoBiorowerGraph2.startDate).add(1,'year').format('MMMM Do YYYY'));
        }
        
        
        
        
          if(piktoBiorowerGraph2.rangeType=='all'){
                $('#strelice2').hide();
               $("#year_progress").css("text-decoration","none");
               
                  $("#all_progress").css("background-color","#286090");
                
                
                   var end= moment();
               if(moment(piktoBiorowerGraph2.startDate).endOf(piktoBiorowerGraph2.rangeType)>end){
                               piktoBiorowerGraph2.sadasnjost="s";
                                  
                                   
                           }
                            else{
                                
                                  piktoBiorowerGraph2.sadasnjost=null;
                           }
                
                
                
                axes.xaxis.options.min = undefined;
                axes.xaxis.options.max = undefined;
               
            axes.xaxis.options.timeformat="%b";
            axes.xaxis.options.tickSize=[1,"month"];
                

         
            
       
                $('#tekst2').html("Progress "+"&nbsp;&nbsp;&nbsp;&nbsp"+" "+moment(response.historydata.date[0]).format('MMMM Do YYYY')+" - "
                +moment().format('MMMM Do YYYY'));
          

            } 
        
        
        
            
        
        







            var opts = piktoBiorowerGraph2.progressPlot.getOptions();
            var axes = piktoBiorowerGraph2.progressPlot.getAxes();
            var niz=[10,20,50,100,200,500,1000,2000,5000,10000,20000];
            var cal=response.historydata.cal;
            var time=response.historydata.time;
            var scnt=response.historydata.scnt;
            var dist=response.historydata.dist;
            var cal2=0;
            var time2=0;
            var scnt2=0;
            var dist2=0;
            if(cal){
                cal2 = Math.max.apply(Math, cal);
            }
            if(time){
                time2 = Math.max.apply(Math, time);
            }
            if(scnt){

                scnt2 = Math.max.apply(Math, scnt);


            }
            if(dist){
                dist2 = Math.max.apply(Math, dist);
            }




            if(dist2>niz[8] && dist2<=niz[9]){
                dist2=niz[10];
            }
            if(dist2>niz[7] && dist2<=niz[8]){
                dist2=niz[9];
            }
            if(dist2>niz[6] && dist2<=niz[7]){
                dist2=niz[8];
            }
            if(dist2>niz[5] && dist2<=niz[6]){
                dist2=niz[7];
            }
            if(dist2>niz[4] && dist2<=niz[5]){
                dist2=niz[6];
            }
            if(dist2>niz[3] && dist2<=niz[4]){
                dist2=niz[5];
            }
            if(dist2>niz[2] && dist2<=niz[3]){
                dist2=niz[4];
            }
            if(dist2>niz[1] && dist2<=niz[2]){
                dist2=niz[4];
            }
            if(dist2>niz[0] && dist2<=niz[1]){
                dist2=niz[3];
            }
            if(dist2<=niz[0]){

                dist2=niz[2];
            }

            if(time2>niz[8] && time2<=niz[9]){
                time2=niz[10];
            }
            if(time2>niz[7] && time2<=niz[8]){
                time2=niz[9];
            }
            if(time2>niz[6] && time2<=niz[7]){
                time2=niz[8];
            }
            if(time2>niz[5] && time2<=niz[6]){
                time2=niz[7];
            }
            if(time2>niz[4] && time2<=niz[5]){
                time2=niz[6];
            }
            if(time2>niz[3] && time2<=niz[4]){
                time2=niz[5];
            }
            if(time2>niz[2] && time2<=niz[3]){
                time2=niz[4];
            }
            if(time2>niz[1] && time2<=niz[2]){
                time2=niz[4];
            }
            if(time2>niz[0] && time2<=niz[1]){
                time2=niz[3];
            }
            if(time2<=niz[0]){

                time2=niz[2];
            }


            if(cal2>niz[8] && cal2<=niz[9]){
                cal2=niz[10];
            }
            if(cal2>niz[7] && cal2<=niz[8]){
                cal2=niz[9];
            }
            if(cal2>niz[6] && cal2<=niz[7]){
                cal2=niz[8];
            }
            if(cal2>niz[5] && cal2<=niz[6]){
                cal2=niz[7];
            }
            if(cal2>niz[4] && cal2<=niz[5]){
                cal2=niz[6];
            }
            if(cal2>niz[3] && cal2<=niz[4]){
                cal2=niz[5];
            }
            if(cal2>niz[2] && cal2<=niz[3]){
                cal2=niz[4];
            }
            if(cal2>niz[1] && cal2<=niz[2]){
                cal2=niz[4];
            }
            if(cal2>niz[0] && cal2<=niz[1]){
                cal2=niz[3];
            }
            if(cal2<=niz[0]){

                cal2=niz[2];
            }



            if(scnt2>niz[8] && scnt2<=niz[9]){
                scnt2=niz[10];
            }
            if(scnt2>niz[7] && scnt2<=niz[8]){
                scnt2=niz[9];
            }
            if(scnt2>niz[6] && scnt2<=niz[7]){
                scnt2=niz[8];
            }
            if(scnt2>niz[5] && scnt2<=niz[6]){
                scnt2=niz[7];
            }
            if(scnt2>niz[4] && scnt2<=niz[5]){
                scnt2=niz[6];
            }
            if(scnt2>niz[3] && scnt2<=niz[4]){
                scnt2=niz[5];
            }
            if(scnt2>niz[2] && scnt2<=niz[3]){
                scnt2=niz[4];
            }
            if(scnt2>niz[1] && scnt2<=niz[2]){
                scnt2=niz[4];
            }
            if(scnt2>niz[0] && scnt2<=niz[1]){
                scnt2=niz[3];
            }
            if(scnt2<=niz[0]){

                scnt2=niz[2];
            }







            opts.yaxes[0].max = scnt2;
            opts.yaxes[0].tickSize=scnt2/5;
            opts.yaxes[5].max = cal2;
            opts.yaxes[5].tickSize=cal2/5;
            opts.yaxes[6].max = time2;
            opts.yaxes[6].tickSize=time2/5;
            opts.yaxes[12].max = dist2;
            opts.yaxes[12].tickSize=dist2/5;








            var opts = piktoBiorowerGraph2.progressPlot.getOptions();
            var r= piktoBiorowerGraph2.parameters;
            var duzina=r.length;



            if(duzina==1){

                opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].position='left';

            }
            if(duzina==2){
                opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].position='left';


                opts.yaxes[piktoBiorowerGraph2.parameters[1].yaxis-1].position='right';
            }
            if(duzina==3){


                opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].position='left';
                opts.yaxes[piktoBiorowerGraph2.parameters[1].yaxis-1].position='right';
                opts.yaxes[piktoBiorowerGraph2.parameters[2].yaxis-1].position='left';
            }
            
            
            
            
            
        


  if(moment(piktoBiorowerGraph2.startDate).add(2,'year')>end){
                               $("#next4").hide();
                              
                                                            
                           }
                            else{
                                 $("#next4").show();
                            }
                            if(moment(piktoBiorowerGraph2.startDate)< piktoBiorowerGraph2.start){
                                $("#next3").hide();
                            }
                             else{
                                 $("#next3").show();
                            }

















           
            piktoBiorowerGraph2.progressPlot.setupGrid();
            piktoBiorowerGraph2.progressPlot.draw();
        });
    }
};