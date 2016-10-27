


$(function () {
    
    
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });
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
                    $('.stroke-rate').append(json[0].srate);
                    var latest_session = json[0].date;
                    $('.latest-session').append(moment(latest_session).format('MMM Do YYYY h:mm a'));

                }else{
                    $('.time').append('-');
                    $('.distance').append('-');
                    $('.power-average').append('-');
                    $('.heart-rate-avg').append('-');
                    $('.stroke-rate').append('-');
                    $('.latest-session').append('No workouts');
                }

  
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
 if(!response.historydata.date){
           $("#all_history").hide();
                
        }
        if (response.historydata.date.length > 0) {
       
            piktoBiorowerGraph.start = moment(response.historydata.date[0]);
            piktoBiorowerGraph.broj = response.historydata.date.length;
            var s = new Date("October 10, 2017 11:13:00");
            var s2 = new Date("October 11, 2018 11:13:00");
            var dr2 = moment.range(s, s2);
            var range2 = moment.range(moment(piktoBiorowerGraph.start), moment());
            
            if (range2 < dr2) {
                $("#year_history").css("text-decoration", "underline");
                $("#all_history").hide();
            } else {
                $("#all_history").css("background-color", "#286090");
            }

        }
        if (response.historydata.date.length < 1) {
            $("#all_history").hide();
        }

    });

    $.post('api/v1/sessions_history', data2, function (response) {
        if(!response.historydata.date){
           $("#all_progress").hide();
                $("#year_progress").hide(); 
        }
        
        if (response.historydata.date.length > 0) {
            piktoBiorowerGraph2.start = moment(response.historydata.date[0]);
            piktoBiorowerGraph2.groupType = "week";
            piktoBiorowerGraph2.broj = response.historydata.date.length;
            var s = new Date("October 10, 2017 11:13:00");
            var s2 = new Date("October 11, 2018 11:13:00");
            var dr2 = moment.range(s, s2);
            var range3 = moment.range(moment(piktoBiorowerGraph2.start), moment());
            if (range3 < dr2) {

                $("#all_progress").hide();
                $("#year_progress").hide();

            } else {

                $("#year_progress").show();
                $("#all_progress").show();
                $("#all_progress").css("background-color", "#286090");

            }

        }
        if (response.historydata.date.length < 1) {
            $("#all_progress").hide();
            $("#year_progress").hide();
        }
    })
    
    $("#history").bind("plotpan plotzoom", function (event, plot) {
        var axes = piktoBiorowerGraph.historyPlot.getAxes();
        piktoBiorowerGraph.startDate = moment(axes.xaxis.options.min);
        $("#next2").css('opacity', '1');
        $("#next1").css('opacity', '1');

     /*  if (moment(piktoBiorowerGraph.startDate).add(1, piktoBiorowerGraph.rangeType).add(1, 'day') < moment()) {
            $("#next1").show();
        }*/
        if (moment(piktoBiorowerGraph.startDate).add(2, piktoBiorowerGraph.rangeType).add(1, 'day') > moment()) {
                   $("#next1").css('opacity', '0.30');

        }/*
        if (moment(piktoBiorowerGraph.startDate) > piktoBiorowerGraph.start) {
            $("#next2").show();
        }*/

        if (moment(piktoBiorowerGraph.startDate).subtract(1, piktoBiorowerGraph.rangeType).subtract(1, 'day') < piktoBiorowerGraph.start) {
                   $("#next2").css('opacity', '0.30');
        }

        $('#tekst').html("History" + '&nbsp;&nbsp;&nbsp;&nbsp' + " " + moment(axes.xaxis.options.min).format('MMMM Do YYYY') + " - "
                + moment(axes.xaxis.options.max).format('MMMM Do YYYY'));
    });
    $("#progress").bind("plotpan plotzoom", function (event, plot) {
        var axes = piktoBiorowerGraph2.progressPlot.getAxes();
        piktoBiorowerGraph2.startDate = moment(axes.xaxis.options.min);
        $("#next3").css('opacity', '1');
        $("#next4").css('opacity', '1');


        if (moment(piktoBiorowerGraph2.startDate).add(1, piktoBiorowerGraph2.rangeType).add(1, 'day') < moment()) {
            $("#next4").show();
        }
        if (moment(piktoBiorowerGraph2.startDate).add(2, piktoBiorowerGraph2.rangeType).add(1, 'day') > moment()) {
             $("#next4").css('opacity', '0.3');

        }
        if (moment(piktoBiorowerGraph2.startDate) > piktoBiorowerGraph2.start) {
            $("#next3").show();
        }

        if (moment(piktoBiorowerGraph2.startDate).subtract(1, piktoBiorowerGraph2.rangeType).subtract(1, 'day') < piktoBiorowerGraph2.start) {
            $("#next4").css('opacity', '0.3');
        }
        $('#tekst2').html("Progress" + '&nbsp;&nbsp;&nbsp;&nbsp' + " " + moment(axes.xaxis.options.min).format('MMMM Do YYYY') + " - "
                + moment(axes.xaxis.options.max).format('MMMM Do YYYY'));
    });
       $.fn.UseTooltip = function () {
        var previousPoint = null;

        $("#history").bind("plothover", function (event, pos, item) {
            

            if (item) {
                if (previousPoint != pos.pageY) {
                    previousPoint = pos.pageY;
                    var label = item.series.label;
                    var datapoint = item.datapoint[1];
                    var x = item.datapoint[0];
                    $("#tooltip").remove();
                    if (label == "Distance") {
                        var y = (datapoint * 1000).toFixed(2) + " m ";
                    }
                    if (label.indexOf("Stroke Rate") != -1) {
                        var y = datapoint.toFixed(2) + " spm ";
                    }
                    if (label.indexOf("Power") != -1) {
                        var y = datapoint.toFixed(2) + " W ";
                    }
                    if (label.indexOf("Angle") != -1) {
                        var y = datapoint.toFixed(2) + " ° ";
                    }
                    if (label == "Stroke Count") {
                        var y = datapoint;
                    }
                    if (label == "Stroke Distance") {
                        var y = (datapoint).toFixed(2) + " m ";
                    }
                    if (label.indexOf("Speed") != -1) {
                        var y = datapoint.toFixed(2) + " m/s ";
                    }
                    if (label.indexOf("Pace") != -1) {
                        var y = parseInt(datapoint / 60) % 60 + " min ";
                    }
                    if (label.indexOf("HR") != -1) {
                        var y = datapoint.toFixed(2) + " bpm ";
                    }
                    if (label == "Calories") {
                        var y = datapoint.toFixed(1) + " kCal ";
                    }
                    if (label == "Time") {
                        var y = parseInt(datapoint / 60) % 60 + " min ";
                    }
                    if (label == "Stroke Dist. Max") {
                        var y = (datapoint).toFixed(2) + " m ";
                    }
                    if (label.indexOf("MML") != -1) {
                        var y = datapoint.toFixed(2) + " mmol/l";
                    }
                    var x = item.datapoint[0];


                    showTooltip(item.pageX, item.pageY,
                            "<strong>" + item.series.label + ": " + y + "</strong>" + "<br/>" + "<strong>Date: " + moment(x).format('Do MMM YYYY') + "</strong><br />"
                            + "<strong>Time: " + moment(x).format('hh:mm:ss') + "</strong>"

                            );
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        $("#tooltip").css("width",'300px');
        $("#progress").bind("plothover", function (event, pos, item) {
            

            if (item) {
                if (previousPoint != pos.pageY) {
                    previousPoint = pos.pageY;
                    var label = item.series.label;
                    var datapoint = item.datapoint[1];
                    var x = item.datapoint[0];
                    $("#tooltip").remove();
                    if (label == "Distance") {
                        var y = (datapoint * 1000).toFixed(2) + " m ";
                    }
                    if (label.indexOf("Stroke Rate") != -1) {
                        
                        var y = datapoint.toFixed(2) + " spm ";
                    }
                    if (label.indexOf("Power") != -1) {
                        var y = datapoint.toFixed(2) + " W ";
                    }
                    if (label.indexOf("Angle") != -1) {
                        var y = datapoint.toFixed(2) + " ° ";
                    }
                    if (label == "Stroke Count") {
                        var y = datapoint.toFixed(0);
                    }
                    if (label == "Stroke Distance") {
                        var y = (datapoint).toFixed(2) + " m ";
                    }
                    if (label.indexOf("Speed") != -1) {
                        var y = datapoint.toFixed(2) + " m/s ";
                    }
                    if (label.indexOf("Pace") != -1) {
                        var y = parseInt(datapoint / 60) % 60 + " min ";
                    }
                    if (label.indexOf("HR") != -1) {
                        var y = datapoint.toFixed(2) + " bpm ";
                    }
                    if (label == "Calories") {
                        var y = datapoint.toFixed(1) + " kCal ";
                    }
                    if (label == "Time") {
                        var y = parseInt(datapoint / 60) % 60 + " min ";
                    }
                    if (label == "Stroke Dist. Max") {
                        var y = (datapoint).toFixed(2) + " m ";
                    }
                    if (label.indexOf("MML") != -1) {
                        var y = datapoint + " mmol/l ";
                    }
                    var x = item.datapoint[0];
                    if(piktoBiorowerGraph2.groupType=='month'){
                         showTooltip(item.pageX, item.pageY,
                            "<strong>" + item.series.label + ": " + y + "</strong>"+ "<br/>" + "<strong>Date: " + moment(x).format(' MMM YYYY') +"</strong><br />" 
                            

                            );
                    }
                    else{
                             
                           showTooltip(item.pageX, item.pageY,
                            "<strong>" + item.series.label + ": " + y + "</strong>" + "<br/>" + "<strong>Date: " + moment(x).format('Do MMM YYYY') + "-"+moment(x).add(6,'day').format('Do MMM YYYY')+"</strong><br />"
                            

                            );
                    }


                   
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
            left: x - 180,
            border: '2px solid #ccc',
            padding: '5px',
            size: '10',
            color: 'black',
            'background-color': '#fff',
            opacity: 0.80,
            width: 250
        }).appendTo("body").fadeIn(200);
    }

    
    $("#progress").UseTooltip();

  
    $("#history").UseTooltip();


});
//Line Graph - Progress

/* Custom Label formatter
 * ----------------------
 */


var piktoBiorowerGraph = {
    historyPlot: null,
    historyData: null,
    startDate: null,
    rangeType: 'all',
    parameters: [{slug: 'scnt', label: 'Stroke Count', yaxis: 1, color: '#FF440064'}],
    start: null,
    sadasnjost: null,
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
        var colors = ['#440064', '#007eff', '#00afc8', '#960000', '#005764', '#ae00ff',
            '#660096', '#0063c8', '#ff0000', '#640000', '#004a96', '#ff8a00', '#8800c8',
            '#00deff', '#bf0000', '#008396', '#003163', '#06ff00', '#05c800', '#c86c00', '#965100',
            '#643600', '#049600', '#026400', '#00ff96', '#00c876',
            '#009658', '#00643b', '#fffc00', '#c8c600', '#969400', '#646300'];

        for (var i in params) {

            rv.push(this.transormData(this.historyData, params[i]));
            switch (rv[i]['label']) {
                case "Stroke Count":
                    rv[i]['yaxis'] = 1;
                    params[i]['yaxis'] = 1;
                    params[i]['color'] = colors[0];
                    break;
                case "Stroke Distance":
                    rv[i]['yaxis'] = 2;
                    params[i]['yaxis'] = 2;
                    params[i]['color'] = colors[1];
                    break;
                case "Speed Max":
                    rv[i]['yaxis'] = 3;
                    params[i]['yaxis'] = 3;
                    params[i]['color'] = colors[2];
                    break;
                case "Pace 2km":
                    rv[i]['yaxis'] = 4;
                    params[i]['yaxis'] = 4;
                    params[i]['color'] = colors[3];
                    break;
                case "HR Max":
                    rv[i]['yaxis'] = 5;
                    params[i]['yaxis'] = 5;
                    params[i]['color'] = colors[4];
                    break;
                case "Calories":
                    rv[i]['yaxis'] = 6;
                    params[i]['yaxis'] = 6;
                    params[i]['color'] = colors[5];
                    break;
                case "Time":
                    rv[i]['yaxis'] = 7;
                    params[i]['yaxis'] = 7;
                    params[i]['color'] = colors[6];
                    break;
                case "Stroke Dist. Max":
                    rv[i]['yaxis'] = 8;
                    params[i]['yaxis'] = 8;
                    params[i]['color'] = colors[7];
                    break;
                case "Pace 500m":
                    rv[i]['yaxis'] = 9;
                    params[i]['yaxis'] = 9;
                    params[i]['color'] = colors[8];
                    break;
                case "Pace 2km Max":
                    rv[i]['yaxis'] = 10;
                    params[i]['yaxis'] = 10;
                    params[i]['color'] = colors[9];
                    break;
                case "Stroke Rate":
                    rv[i]['yaxis'] = 11;
                    params[i]['yaxis'] = 11;
                    params[i]['color'] = colors[10];
                    break;
                case "Power L":
                    rv[i]['yaxis'] = 12;
                    params[i]['yaxis'] = 12;
                    params[i]['color'] = colors[11];
                    break;
                case "Distance":
                    rv[i]['yaxis'] = 13;
                    params[i]['yaxis'] = 13;
                    params[i]['color'] = colors[12];
                    break;
                case "Speed":
                    rv[i]['yaxis'] = 14;
                    params[i]['yaxis'] = 14;
                    params[i]['color'] = colors[13];
                    break;
                case "Pace 500m Max":
                    rv[i]['yaxis'] = 15;
                    params[i]['yaxis'] = 15;
                    params[i]['color'] = colors[14];
                    break;
                case "HR":
                    rv[i]['yaxis'] = 16;
                    params[i]['yaxis'] = 16;
                    params[i]['color'] = colors[15];
                    break;
                case "Stroke Rate Max":
                    rv[i]['yaxis'] = 17;
                    params[i]['yaxis'] = 17;
                    params[i]['color'] = colors[16];
                    break;
                case "Power average":
                    rv[i]['yaxis'] = 18;
                    params[i]['yaxis'] = 18;
                    params[i]['color'] = colors[17];
                    break;
                case "Power max":
                    rv[i]['yaxis'] = 19;
                    params[i]['yaxis'] = 19;
                    params[i]['color'] = colors[18];
                    break;
                case "Power L Max":
                    rv[i]['yaxis'] = 20;
                    params[i]['yaxis'] = 20;
                    params[i]['color'] = colors[19];
                    break;
                case "Power right average":
                    rv[i]['yaxis'] = 21;
                    params[i]['yaxis'] = 21;
                    params[i]['color'] = colors[20];
                    break;
                case "Power right max":
                    rv[i]['yaxis'] = 22;
                    params[i]['yaxis'] = 22;
                    params[i]['color'] = colors[21];
                    break;
                case "Power balance":
                    rv[i]['yaxis'] = 23;
                    params[i]['yaxis'] = 23;
                    params[i]['color'] = colors[22];
                    break;
                case "Power balance max":
                    rv[i]['yaxis'] = 24;
                    params[i]['yaxis'] = 24;
                    params[i]['color'] = colors[23];
                    break;
                case "Angle left average":
                    rv[i]['yaxis'] = 25;
                    params[i]['yaxis'] = 25;
                    params[i]['color'] = colors[24];
                    break;
                case "Angle left Max":
                    rv[i]['yaxis'] = 26;
                    params[i]['yaxis'] = 26;
                    params[i]['color'] = colors[25];
                    break;
                case "Angle right average":
                    rv[i]['yaxis'] = 27;
                    params[i]['yaxis'] = 27;
                    params[i]['color'] = colors[26];
                    break;
                case "Angle right max":
                    rv[i]['yaxis'] = 28;
                    params[i]['yaxis'] = 28;
                    params[i]['color'] = colors[27];
                    break;
                case "Angle average":
                    rv[i]['yaxis'] = 29;
                    params[i]['yaxis'] = 29;
                    params[i]['color'] = colors[28];
                    break;
                case "Angle max":
                    rv[i]['yaxis'] = 30;
                    params[i]['yaxis'] = 30;
                    params[i]['color'] = colors[29];
                    break;
                case "MML 2 Level":
                    rv[i]['yaxis'] = 31;
                    params[i]['yaxis'] = 31;
                    params[i]['color'] = colors[30];
                    break;
                case "MML 4 Level":
                    rv[i]['yaxis'] = 32;
                    params[i]['yaxis'] = 32;
                    params[i]['color'] = colors[31];
                    break;
            }

        }
        piktoBiorowerGraph.parameters = params;

        return rv;

    },
    loadHistoryData: function (account, rangeType, startDate) {
        var data = {
            account: 'biorower:' + account,
            rangeType: 'all',
            dateStart: startDate ? startDate.format('YYYY-MM-DD') : ''
        };

        piktoBiorowerGraph.startDate = startDate;
        piktoBiorowerGraph.rangeType = rangeType;
         $("#next2").css('opacity', '1');
         $("#next1").css('opacity', '1');


        if (piktoBiorowerGraph.rangeType != "all") {
            $('#strelice').show();
        }

        if (moment(piktoBiorowerGraph.startDate) < moment().subtract(1, piktoBiorowerGraph.rangeType)) {
        //    $("#next1").show();
        }

        if (moment(piktoBiorowerGraph.startDate) > moment(piktoBiorowerGraph.start)) {
        //    $("#next2").show();

        }

        if (moment(piktoBiorowerGraph.startDate) < moment(piktoBiorowerGraph.start)) {

            if (piktoBiorowerGraph.rangeType == 'year') {
                piktoBiorowerGraph.startDate = moment(piktoBiorowerGraph.start).subtract(1, "month");
          }
          else{
             piktoBiorowerGraph.startDate = moment(piktoBiorowerGraph.start);
 
          }

          //  $("#next2").hide();
           $("#next2").css('opacity', '0.30');
           
        }
        if (moment(piktoBiorowerGraph.startDate) > moment().subtract(1, piktoBiorowerGraph.rangeType).subtract(1,'day')) {
            piktoBiorowerGraph.startDate = moment().subtract(1, piktoBiorowerGraph.rangeType);
         //   $("#next1").hide();
          $("#next1").css('opacity', '0.30');
        }

        $.post('api/v1/sessions_history', data, function (response) {

            piktoBiorowerGraph.historyData = response.historydata;
            var newHistoryData = piktoBiorowerGraph.getHistoryData(piktoBiorowerGraph.parameters);
            var dr2 = moment.range(moment(piktoBiorowerGraph.startDate), moment(piktoBiorowerGraph.startDate).add(1, piktoBiorowerGraph.rangeType));
            var broj = 0;
            for (var i = 0; i < piktoBiorowerGraph.historyData.date.length; i++) {

                if (dr2.contains(moment(piktoBiorowerGraph.historyData.date[i])) == true) {

                    broj = broj + 1;
                }

            }
            var r = piktoBiorowerGraph.parameters;
            var duzina = r.length;
            var colors = [];
            for (var i = 0; i < piktoBiorowerGraph.parameters.length; i++) {
                colors.push(piktoBiorowerGraph.parameters[i].color);
            }

            function formatter(val, axis) {
               
                if(axis.options.axisLabel=='Time [hh:mm:ss:t]'){
                      var hours   = Math.floor(val / 3600);
                      var minutes = Math.floor((val - (hours * 3600)) / 60);
                      var seconds = val - (hours * 3600) - (minutes * 60);
                      seconds = Math.round(seconds * 100) / 100;
                       var result = (hours < 1 ? '' : hours + ":");
                       result += (minutes < 10 ? "0" + minutes : minutes);
                       result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
                       return result;
                }
                else{
                 var minutes = Math.floor(val / 60);
                var seconds = val - minutes * 60;
                
                var result="";
                result +=  (minutes < 10 ? "0" + minutes : minutes);
                result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
                return result; 
                }
              
            }
            var series = {lines: {show: true}, points: {show: true}};
            if (piktoBiorowerGraph.broj == 1) {
                series = {lines: {show: false}, points: {show: true}};
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
                        pan: {
                            interactive: true
                        },
                        series: series,
                        legend: {
                            noColumns: 3,
                            position: "nw",
                        },
                        colors: colors,
                        yaxes: [{
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Count",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                min: 0.01,
                            }, {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Distance [m]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 20,
                                tickSize: 4, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Speed Max [m/s]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 10,
                                tickSize: 2, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 2km [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 1200,
                                tickFormatter: formatter, min: 0.01,
                                tickSize: 240,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "HR max [bmp]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 250,
                                tickSize: 50, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Calories [kCal]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 2000,
                                tickSize: 400, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Time [hh:mm:ss:t]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                tickFormatter: formatter,
                                max: 9000, min: 0.01,
                                tickSize: 1800,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Dist.Max [m]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 20,
                                tickSize: 4, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 500m [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                tickFormatter: formatter,
                                tickSize: 60,
                                max: 300,
                                min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 2km Max [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30, tickSize: 240,
                                tickFormatter: formatter,
                                max: 1200, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Rate [spm]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 50,
                                tickSize: 10, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power L [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Distance [km]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 20,
                                tickSize: 4, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Speed [m/s]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 10,
                                tickSize: 2, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 500m Max [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                tickFormatter: formatter,
                                max: 300, min: 0.01,
                                tickSize: 60,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "HR [bmp]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 250,
                                tickSize: 50, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Rate Max [spm]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 50,
                                tickSize: 10, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Average [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 1500,
                                tickSize: 300, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 1500,
                                tickSize: 300, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power L Max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power right average [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power right max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Balance [%]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Balance max [%]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle left average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle left max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle right average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle right max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "MML 2 Level [mmol/l]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.01,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "MML 4 Level [mmol/l]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.01,
                            },
                        ],
                        xaxis: {
                            show: true,
                            labelHeight: 30,
                            mode: 'time',
                            timeformat: "%b",
                            tickSize: [1, "month"],
                            panRange: [piktoBiorowerGraph.start, new Date()],
                        }
                    }
            );

            var opts = piktoBiorowerGraph.historyPlot.getOptions();
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
            var niz = [10, 20, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 20000];
            var cal = response.historydata.cal;
            var time = response.historydata.time;
            var scnt = response.historydata.scnt;
            var dist = response.historydata.dist;
            var cal2 = 0;
            var time2 = 0;
            var scnt2 = 0;
            var dist2 = 0;
            if (cal) {
                cal2 = Math.max.apply(Math, cal);
            }
            if (time) {
                time2 = Math.max.apply(Math, time);
            }
            if (scnt) {
                scnt2 = Math.max.apply(Math, scnt);
            }
            if (dist) {
                dist2 = Math.max.apply(Math, dist);
            }
            if (dist2 > niz[8] && dist2 <= niz[9]) {
                dist2 = niz[9];
            }
            if (dist2 > niz[7] && dist2 <= niz[8]) {
                dist2 = niz[8];
            }
            if (dist2 > niz[6] && dist2 <= niz[7]) {
                dist2 = niz[7];
            }
            if (dist2 > niz[5] && dist2 <= niz[6]) {
                dist2 = niz[6];
            }
            if (dist2 > niz[4] && dist2 <= niz[5]) {
                dist2 = niz[5];
            }
            if (dist2 > niz[3] && dist2 <= niz[4]) {
                dist2 = niz[4];
            }
            if (dist2 > niz[2] && dist2 <= niz[3]) {
                dist2 = niz[3];
            }
            if (dist2 > niz[1] && dist2 <= niz[2]) {
                dist2 = niz[2];
            }
            if (dist2 > niz[0] && dist2 <= niz[1]) {
                dist2 = niz[1];
            }
            if (dist2 <= niz[0]) {
                dist2 = niz[1];
            }
            if (time2 > niz[8] && time2 <= niz[9]) {
                time2 = niz[9];
            }
            if (time2 > niz[7] && time2 <= niz[8]) {
                time2 = niz[8];
            }
            if (time2 > niz[6] && time2 <= niz[7]) {
                time2 = niz[7];
            }
            if (time2 > niz[5] && time2 <= niz[6]) {
                time2 = niz[6];
            }
            if (time2 > niz[4] && time2 <= niz[5]) {
                time2 = niz[5];
            }
            if (time2 > niz[3] && time2 <= niz[4]) {
                time2 = niz[4];
            }
            if (time2 > niz[2] && time2 <= niz[3]) {
                time2 = niz[3];
            }
            if (time2 > niz[1] && time2 <= niz[2]) {
                time2 = niz[2];
            }
            if (time2 > niz[0] && time2 <= niz[1]) {
                time2 = niz[1];
            }
            if (time2 <= niz[0]) {
                time2 = niz[1];
            }
            if (cal2 > niz[8] && cal2 <= niz[9]) {
                cal2 = niz[9];
            }
            if (cal2 > niz[7] && cal2 <= niz[8]) {
                cal2 = niz[8];
            }
            if (cal2 > niz[6] && cal2 <= niz[7]) {
                cal2 = niz[7];
            }
            if (cal2 > niz[5] && cal2 <= niz[6]) {
                cal2 = niz[6];
            }
            if (cal2 > niz[4] && cal2 <= niz[5]) {
                cal2 = niz[5];
            }
            if (cal2 > niz[3] && cal2 <= niz[4]) {
                cal2 = niz[4];
            }
            if (cal2 > niz[2] && cal2 <= niz[3]) {
                cal2 = niz[3];
            }
            if (cal2 > niz[1] && cal2 <= niz[2]) {
                cal2 = niz[2];
            }
            if (cal2 > niz[0] && cal2 <= niz[1]) {
                cal2 = niz[1];
            }
            if (cal2 <= niz[0]) {
                cal2 = niz[1];
            }
            if (scnt2 > niz[8] && scnt2 <= niz[9]) {
                scnt2 = niz[9];
            }
            if (scnt2 > niz[7] && scnt2 <= niz[8]) {
                scnt2 = niz[8];
            }
            if (scnt2 > niz[6] && scnt2 <= niz[7]) {
                scnt2 = niz[7];
            }
            if (scnt2 > niz[5] && scnt2 <= niz[6]) {
                scnt2 = niz[6];
            }
            if (scnt2 > niz[4] && scnt2 <= niz[5]) {
                scnt2 = niz[5];
            }
            if (scnt2 > niz[3] && scnt2 <= niz[4]) {
                scnt2 = niz[4];
            }
            if (scnt2 > niz[2] && scnt2 <= niz[3]) {
                scnt2 = niz[3];
            }
            if (scnt2 > niz[1] && scnt2 <= niz[2]) {
                scnt2 = niz[2];
            }
            if (scnt2 > niz[0] && scnt2 <= niz[1]) {
                scnt2 = niz[1];
            }
            if (scnt2 <= niz[0]) {
                scnt2 = niz[1];
            }

            opts.yaxes[0].max = scnt2;
            opts.yaxes[0].tickSize = scnt2 / 5;
            opts.yaxes[5].max = cal2;
            opts.yaxes[5].tickSize = cal2 / 5;
            opts.yaxes[6].max = time2;
            opts.yaxes[6].tickSize = time2 / 5;
            opts.yaxes[12].max = dist2;
            opts.yaxes[12].tickSize = dist2 / 5;

            var r = piktoBiorowerGraph.parameters;
            var duzina = r.length;

            if (duzina == 1) {
                
                opts.yaxes[piktoBiorowerGraph.parameters[0].yaxis - 1].position = 'left';
            }
            if (duzina == 2) {
                
                opts.yaxes[piktoBiorowerGraph.parameters[0].yaxis - 1].position = 'left';
                opts.yaxes[piktoBiorowerGraph.parameters[1].yaxis - 1].position = 'right';
            }
            if (duzina == 3) {
                
                opts.yaxes[piktoBiorowerGraph.parameters[0].yaxis - 1].position = 'left';
                opts.yaxes[piktoBiorowerGraph.parameters[1].yaxis - 1].position = 'right';
                opts.yaxes[piktoBiorowerGraph.parameters[2].yaxis - 1].position = 'right';

            }


            if (piktoBiorowerGraph.rangeType == 'all') {

                var end = moment();
                var s = new Date("October 10, 2017 11:13:00");
                var s2 = new Date("October 11, 2018 11:13:00");
                var dr2 = moment.range(s, s2);
                var range3 = moment.range(moment(response.historydata.date[0]), end);
                if (range3 > dr2) {

                    var axes = piktoBiorowerGraph.historyPlot.getAxes();
                    axes.xaxis.options.timeformat = "%m";

                }
                if (range3 < dr2) {
                    axes.xaxis.options.timeformat = "%b";
                }

                $('#strelice').hide();
                $("#year_history").css("text-decoration", "none");
                $("#week_history").css("text-decoration", "none");
                $("#month_history").css("text-decoration", "none");
                $("#all_history").css("background-color", "#286090");
                axes.xaxis.options.min = undefined;
                axes.xaxis.options.max = undefined;
                axes.xaxis.options.tickSize = [1, "month"];

                $('#tekst').html("History " + "&nbsp;&nbsp;&nbsp;&nbsp" + " " + moment(response.historydata.date[0]).format('MMMM Do YYYY') + " - "
                        + moment().format('MMMM Do YYYY'));

                piktoBiorowerGraph.historyPlot.setupGrid();
                piktoBiorowerGraph.historyPlot.draw();
                var end = moment();

            }

            if (piktoBiorowerGraph.rangeType == "week") {
                $("#year_history").css("text-decoration", "none");
                $("#week_history").css("text-decoration", "underline");
                $("#month_history").css("text-decoration", "none");
                $("#all_history").css("background-color", "#3c8dbc");
                var axes = piktoBiorowerGraph.historyPlot.getAxes();
                axes.xaxis.options.timeformat = "%a %d";
                axes.xaxis.options.tickSize = [1, "day"];
                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate).add(1, 'week');
                $('#tekst').html("History" + '&nbsp;&nbsp;&nbsp;&nbsp' + " " + moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY') + " - "
                        + moment(piktoBiorowerGraph.startDate).add(1, 'week').format('MMMM Do YYYY'));

                piktoBiorowerGraph.historyPlot.setupGrid();
                piktoBiorowerGraph.historyPlot.draw();

            }
            if (piktoBiorowerGraph.rangeType == "year") {
                $("#year_history").css("text-decoration", "underline");
                $("#week_history").css("text-decoration", "none");
                $("#month_history").css("text-decoration", "none");
                $("#all_history").css("background-color", "#3c8dbc");
                var axes = piktoBiorowerGraph.historyPlot.getAxes();
                axes.xaxis.options.timeformat = "%b";
                axes.xaxis.options.tickSize = [1, "month"];
                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate).add(1, 'year');
                $('#tekst').html("History" + "&nbsp;&nbsp;&nbsp;&nbsp" + " " + moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY') + " - "
                        + moment(piktoBiorowerGraph.startDate).add(1, 'year').format('MMMM Do YYYY'));
                piktoBiorowerGraph.historyPlot.setupGrid();
                piktoBiorowerGraph.historyPlot.draw();

            }
            if (piktoBiorowerGraph.rangeType == "month") {

                $("#year_history").css("text-decoration", "none");
                $("#week_history").css("text-decoration", "none");
                $("#month_history").css("text-decoration", "underline");
                $("#all_history").css("background-color", "#3c8dbc");

                var axes = piktoBiorowerGraph.historyPlot.getAxes();
                axes.xaxis.options.timeformat = "%d";
                axes.xaxis.options.tickSize = [1, "day"];

                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate).add(1, 'month');

                $('#tekst').html("History" + "&nbsp;&nbsp;&nbsp;&nbsp" + " " + moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY') + " - "
                        + moment(piktoBiorowerGraph.startDate).add(1, 'month').format('MMMM Do YYYY'));

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
    sadasnjost: null,
    rangeType: 'all',
    parameters: [{slug: 'scnt', label: 'Stroke Count', yaxis: 1}],
    start: null,
    groupType: 'week',
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
        var colors = ['#440064', '#007eff', '#00afc8', '#960000', '#005764', '#ae00ff',
            '#660096', '#0063c8', '#ff0000', '#640000', '#004a96', '#ff8a00', '#8800c8',
            '#00deff', '#bf0000', '#008396', '#003163', '#06ff00', '#05c800', '#c86c00', '#965100',
            '#643600', '#049600', '#026400', '#00ff96', '#00c876',
            '#009658', '#00643b', '#fffc00', '#c8c600', '#969400', '#646300'];

        for (var i in params) {

            rv.push(this.transormData(this.historyData, params[i]));
            switch (rv[i]['label']) {
                case "Stroke Count":
                    rv[i]['yaxis'] = 1;
                    params[i]['yaxis'] = 1;
                    params[i]['color'] = colors[0];
                    break;
                case "Stroke Distance":
                    rv[i]['yaxis'] = 2;
                    params[i]['yaxis'] = 2;
                    params[i]['color'] = colors[1];

                    break;
                case "Speed Max":
                    rv[i]['yaxis'] = 3;
                    params[i]['yaxis'] = 3;
                    params[i]['color'] = colors[2];
                    break;
                case "Pace 2km":
                    rv[i]['yaxis'] = 4;
                    params[i]['yaxis'] = 4;
                    params[i]['color'] = colors[3];
                    break;
                case "HR Max":
                    rv[i]['yaxis'] = 5;
                    params[i]['yaxis'] = 5;
                    params[i]['color'] = colors[4];
                    break;
                case "Calories":
                    rv[i]['yaxis'] = 6;
                    params[i]['yaxis'] = 6;
                    params[i]['color'] = colors[5];
                    break;
                case "Time":
                    rv[i]['yaxis'] = 7;
                    params[i]['yaxis'] = 7;
                    params[i]['color'] = colors[6];
                    break;
                case "Stroke Dist. Max":
                    rv[i]['yaxis'] = 8;
                    params[i]['yaxis'] = 8;
                    params[i]['color'] = colors[7];
                    break;
                case "Pace 500m":
                    rv[i]['yaxis'] = 9;
                    params[i]['yaxis'] = 9;
                    params[i]['color'] = colors[8];
                    break;
                case "Pace 2km Max":
                    rv[i]['yaxis'] = 10;
                    params[i]['yaxis'] = 10;
                    params[i]['color'] = colors[9];
                    break;
                case "Stroke Rate":
                    rv[i]['yaxis'] = 11;
                    params[i]['yaxis'] = 11;
                    params[i]['color'] = colors[10];
                    break;
                case "Power L":
                    rv[i]['yaxis'] = 12;
                    params[i]['yaxis'] = 12;
                    params[i]['color'] = colors[11];
                    break;
                case "Distance":
                    rv[i]['yaxis'] = 13;
                    params[i]['yaxis'] = 13;
                    params[i]['color'] = colors[12];
                    break;
                case "Speed":
                    rv[i]['yaxis'] = 14;
                    params[i]['yaxis'] = 14;
                    params[i]['color'] = colors[13];
                    break;
                case "Pace 500m Max":
                    rv[i]['yaxis'] = 15;
                    params[i]['yaxis'] = 15;
                    params[i]['color'] = colors[14];
                    break;
                case "HR":
                    rv[i]['yaxis'] = 16;
                    params[i]['yaxis'] = 16;
                    params[i]['color'] = colors[15];
                    break;
                case "Stroke Rate Max":
                    rv[i]['yaxis'] = 17;
                    params[i]['yaxis'] = 17;
                    params[i]['color'] = colors[16];
                    break;
                case "Power average":
                    rv[i]['yaxis'] = 18;
                    params[i]['yaxis'] = 18;
                    params[i]['color'] = colors[17];
                    break;
                case "Power max":
                    rv[i]['yaxis'] = 19;
                    params[i]['yaxis'] = 19;
                    params[i]['color'] = colors[18];
                    break;
                case "Power L Max":
                    rv[i]['yaxis'] = 20;
                    params[i]['yaxis'] = 20;
                    params[i]['color'] = colors[19];
                    break;
                case "Power right average":
                    rv[i]['yaxis'] = 21;
                    params[i]['yaxis'] = 21;
                    params[i]['color'] = colors[20];
                    break;
                case "Power right max":
                    rv[i]['yaxis'] = 22;
                    params[i]['yaxis'] = 22;
                    params[i]['color'] = colors[21];
                    break;
                case "Power balance":
                    rv[i]['yaxis'] = 23;
                    params[i]['yaxis'] = 23;
                    params[i]['color'] = colors[22];
                    break;
                case "Power balance max":
                    rv[i]['yaxis'] = 24;
                    params[i]['yaxis'] = 24;
                    params[i]['color'] = colors[23];
                    break;
                case "Angle left average":
                    rv[i]['yaxis'] = 25;
                    params[i]['yaxis'] = 25;
                    params[i]['color'] = colors[24];
                    break;
                case "Angle left Max":
                    rv[i]['yaxis'] = 26;
                    params[i]['yaxis'] = 26;
                    params[i]['color'] = colors[25];
                    break;
                case "Angle right average":
                    rv[i]['yaxis'] = 27;
                    params[i]['yaxis'] = 27;
                    params[i]['color'] = colors[26];
                    break;
                case "Angle right max":
                    rv[i]['yaxis'] = 28;
                    params[i]['yaxis'] = 28;
                    params[i]['color'] = colors[27];
                    break;
                case "Angle average":
                    rv[i]['yaxis'] = 29;
                    params[i]['yaxis'] = 29;
                    params[i]['color'] = colors[28];
                    break;
                case "Angle max":
                    rv[i]['yaxis'] = 30;
                    params[i]['yaxis'] = 30;
                    params[i]['color'] = colors[29];
                    break;
                case "MML 2 Level":
                    rv[i]['yaxis'] = 31;
                    params[i]['yaxis'] = 31;
                    params[i]['color'] = colors[30];
                    break;
                case "MML 4 Level":
                    rv[i]['yaxis'] = 32;
                    params[i]['yaxis'] = 32;
                    params[i]['color'] = colors[31];
                    break;
            }

        }
        piktoBiorowerGraph2.parameters = params;
        return rv;

    },
    loadHistoryData: function (account, rangeType, startDate, groupType) {
        var data = {
            account: 'biorower:' + account,
            rangeType: 'all',
            dateStart: startDate ? startDate.format('YYYY-MM-DD') : '',
            groupType: groupType,
        };
        piktoBiorowerGraph2.startDate = startDate;
        piktoBiorowerGraph2.rangeType = rangeType;
        piktoBiorowerGraph2.groupType = groupType;

        if (piktoBiorowerGraph2.rangeType != "all") {
            $('#strelice2').show();
        }

        $.post('api/v1/sessions_history', data, function (response) {
            var dr2 = moment.range(moment(piktoBiorowerGraph2.startDate), moment(piktoBiorowerGraph2.startDate).add(1, piktoBiorowerGraph2.rangeType));

            for (var i = 0; i < response.historydata.date.length; i++) {
                if (piktoBiorowerGraph2.groupType == 'month') {
                    response.historydata.date[i] = moment(response.historydata.date[i]).startOf('month').add(14, 'day');
                }
                if (piktoBiorowerGraph2.groupType == 'week') {
                    response.historydata.date[i] = moment(response.historydata.date[i]).startOf('week');
                }

                if (dr2.contains(moment(response.historydata.date[i])) == true) {
                    broj = broj + 1;
                }

            }

            var d = moment.range(moment(response.historydata.date[0]), moment(response.historydata.date[response.historydata.date.length - 1]));
            var c = [];
            if (piktoBiorowerGraph2.groupType == 'month') {

                d.by('month', function (moment2) {
                    c.push(moment(moment2).startOf('month').add(14, 'day'));
                });

                for (var i = 0; i < c.length; i++) {

                    if (moment(c[i]).diff(moment(response.historydata.date[i])) != 0) {
                        response.historydata.date.splice(i, 0, c[i]);
                        response.historydata.scnt.splice(i, 0, 0.00001);
                        response.historydata.ang_avg.splice(i, 0, 0.00001);
                        response.historydata.ang_l_avg.splice(i, 0, 0.00001);
                        response.historydata.ang_r_avg.splice(i, 0, 0.00001);
                        response.historydata.ang_l_max.splice(i, 0, 0.00001);
                        response.historydata.ang_r_max.splice(i, 0, 0.00001);
                        response.historydata.cal.splice(i, 0, 0.00001);
                        response.historydata.dist.splice(i, 0, 0.00001);
                        response.historydata.hr_avg.splice(i, 0, 0.00001);
                        response.historydata.hr_max.splice(i, 0, 0.00001);
                        response.historydata.mml2.splice(i, 0, 0.00001);
                        response.historydata.mml4.splice(i, 0, 0.00001);
                        response.historydata.pace2k_avg.splice(i, 0, 0.00001);
                        response.historydata.pace2k_max.splice(i, 0, 0.00001);
                        response.historydata.pace500_avg.splice(i, 0, 0.00001);
                        response.historydata.pace500_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_bal_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_bal_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_l_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_l_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_r_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_r_max.splice(i, 0, 0.00001);
                        response.historydata.sdist_avg.splice(i, 0, 0.00001);
                        response.historydata.sdist_max.splice(i, 0, 0.00001);
                        response.historydata.spd_avg.splice(i, 0, 0.00001);
                        response.historydata.spd_max.splice(i, 0, 0.00001);
                        response.historydata.srate_avg.splice(i, 0, 0.00001);
                        response.historydata.srate_max.splice(i, 0, 0.00001);
                        response.historydata.time.splice(i, 0, 0.00001);


                    }

                }
            }
            if (piktoBiorowerGraph2.groupType == 'week') {

                d.by('week', function (moment2) {
                    c.push(moment(moment2).startOf('week'));
                });

                for (var i = 0; i < c.length; i++) {

                    if (moment(c[i]).diff(moment(response.historydata.date[i])) != 0) {
                        response.historydata.date.splice(i, 0, c[i]);
                        response.historydata.scnt.splice(i, 0, 0.00001);
                        response.historydata.ang_avg.splice(i, 0, 0.00001);
                        response.historydata.ang_l_avg.splice(i, 0, 0.00001);
                        response.historydata.ang_r_avg.splice(i, 0, 0.00001);
                        response.historydata.ang_l_max.splice(i, 0, 0.00001);
                        response.historydata.ang_r_max.splice(i, 0, 0.00001);
                        response.historydata.cal.splice(i, 0, 0.00001);
                        response.historydata.dist.splice(i, 0, 0.00001);
                        response.historydata.hr_avg.splice(i, 0, 0.00001);
                        response.historydata.hr_max.splice(i, 0, 0.00001);
                        response.historydata.mml2.splice(i, 0, 0.00001);
                        response.historydata.mml4.splice(i, 0, 0.00001);
                        response.historydata.pace2k_avg.splice(i, 0, 0.00001);
                        response.historydata.pace2k_max.splice(i, 0, 0.00001);
                        response.historydata.pace500_avg.splice(i, 0, 0.00001);
                        response.historydata.pace500_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_bal_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_bal_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_l_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_l_max.splice(i, 0, 0.00001);
                        response.historydata.pwr_r_avg.splice(i, 0, 0.00001);
                        response.historydata.pwr_r_max.splice(i, 0, 0.00001);
                        response.historydata.sdist_avg.splice(i, 0, 0.00001);
                        response.historydata.sdist_max.splice(i, 0, 0.00001);
                        response.historydata.spd_avg.splice(i, 0, 0.00001);
                        response.historydata.spd_max.splice(i, 0, 0.00001);
                        response.historydata.srate_avg.splice(i, 0, 0.00001);
                        response.historydata.srate_max.splice(i, 0, 0.00001);
                        response.historydata.time.splice(i, 0, 0.00001);


                    }


                }

            }

            piktoBiorowerGraph2.historyData = response.historydata;
            var newHistoryData = piktoBiorowerGraph2.getHistoryData(piktoBiorowerGraph2.parameters);
            var broj = 0;
            piktoBiorowerGraph2.historyData = response.historydata;

              function formatter(val, axis) {
               
                if(axis.options.axisLabel=='Time [hh:mm:ss:t]'){
                      var hours   = Math.floor(val / 3600);
                      var minutes = Math.floor((val - (hours * 3600)) / 60);
                      var seconds = val - (hours * 3600) - (minutes * 60);
                      seconds = Math.round(seconds * 100) / 100;
                       var result = (hours < 1 ? '' : hours + ":");
                       result += (minutes < 10 ? "0" + minutes : minutes);
                       result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
                       return result;
                }
                else{
                 var minutes = Math.floor(val / 60);
                var seconds = val - minutes * 60;
                
                var result="";
                result +=  (minutes < 10 ? "0" + minutes : minutes);
                result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
                return result; 
                }
              
            }

            var colors = [];
            for (var i = 0; i < piktoBiorowerGraph2.parameters.length; i++) {
                colors.push(piktoBiorowerGraph2.parameters[i].color);
            }

            var series = {lines: {show: true}, points: {show: true}};
            if (piktoBiorowerGraph2.broj == 1) {
                series = {lines: {show: false}, points: {show: true}};
            }


            piktoBiorowerGraph2.progressPlot = $.plot($("#progress"),
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
                        pan: {
                            interactive: true
                        },
                        series: series,
                        legend: {
                            noColumns: 3,
                            position: "nw",
                        },
                        colors: colors,
                        yaxes: [{
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Count",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                min: 0.00000001,
                            }, {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Distance [m]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 20,
                                tickSize: 4, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Speed Max [m/s]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 10,
                                tickSize: 2, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 2km [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 1200,
                                tickFormatter: formatter, min: 0.00000001,
                                tickSize: 240,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "HR max [bmp]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 250,
                                tickSize: 50, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Calories [kCal]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 2000,
                                tickSize: 400, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Time [hh:mm:ss:t]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                tickFormatter: formatter,
                                max: 9000, min: 0.00000001,
                                tickSize: 1800,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Dist.Max [m]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 20,
                                tickSize: 4, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 500m [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                tickFormatter: formatter,
                                tickSize: 60,
                                max: 300,
                                min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 2km Max [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30, tickSize: 240,
                                tickFormatter: formatter,
                                max: 1200, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Rate [spm]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 50,
                                tickSize: 10, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power L [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Distance [km]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 20,
                                tickSize: 4, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Speed [m/s]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 10,
                                tickSize: 2, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 500m Max [mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                tickFormatter: formatter,
                                max: 300, min: 0.00000001,
                                tickSize: 60,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "HR [bmp]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 250,
                                tickSize: 50, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Rate Max [spm]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 50,
                                tickSize: 10, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Average [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 1500,
                                tickSize: 300, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 1500,
                                tickSize: 300, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power L Max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power right average [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power right max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Balance [%]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Balance max [%]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle left average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle left max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle right average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle right max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "MML 2 Level [mmol/l]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "MML 4 Level [mmol/l]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 3,
                                panRange: false,
                                labelWidth: 30,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                        ],
                        xaxis: {
                            show: true,
                            labelHeight: 30,
                            mode: 'time',
                            timeformat: "%b",
                            tickSize: [1, "month"],
                            panRange: [piktoBiorowerGraph2.start, new Date()],
                        }
                    }
            );


            var opts = piktoBiorowerGraph2.progressPlot.getOptions();
            var axes = piktoBiorowerGraph2.progressPlot.getAxes();
            var niz = [10, 20, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 20000];
            var cal = response.historydata.cal;
            var time = response.historydata.time;
            var scnt = response.historydata.scnt;
            var dist = response.historydata.dist;
            var cal2 = 0;
            var time2 = 0;
            var scnt2 = 0;
            var dist2 = 0;
            if (cal) {
                cal2 = Math.max.apply(Math, cal);
            }
            if (time) {
                time2 = Math.max.apply(Math, time);
            }
            if (scnt) {
                scnt2 = Math.max.apply(Math, scnt);
            }
            if (dist) {
                dist2 = Math.max.apply(Math, dist);
            }
            if (dist2 > niz[8] && dist2 <= niz[9]) {
                dist2 = niz[9];
            }
            if (dist2 > niz[7] && dist2 <= niz[8]) {
                dist2 = niz[8];
            }
            if (dist2 > niz[6] && dist2 <= niz[7]) {
                dist2 = niz[7];
            }
            if (dist2 > niz[5] && dist2 <= niz[6]) {
                dist2 = niz[6];
            }
            if (dist2 > niz[4] && dist2 <= niz[5]) {
                dist2 = niz[5];
            }
            if (dist2 > niz[3] && dist2 <= niz[4]) {
                dist2 = niz[4];
            }
            if (dist2 > niz[2] && dist2 <= niz[3]) {
                dist2 = niz[3];
            }
            if (dist2 > niz[1] && dist2 <= niz[2]) {
                dist2 = niz[2];
            }
            if (dist2 > niz[0] && dist2 <= niz[1]) {
                dist2 = niz[1];
            }
            if (dist2 <= niz[0]) {
                dist2 = niz[1];
            }
            if (time2 > niz[8] && time2 <= niz[9]) {
                time2 = niz[9];
            }
            if (time2 > niz[7] && time2 <= niz[8]) {
                time2 = niz[8];
            }
            if (time2 > niz[6] && time2 <= niz[7]) {
                time2 = niz[7];
            }
            if (time2 > niz[5] && time2 <= niz[6]) {
                time2 = niz[6];
            }
            if (time2 > niz[4] && time2 <= niz[5]) {
                time2 = niz[5];
            }
            if (time2 > niz[3] && time2 <= niz[4]) {
                time2 = niz[4];
            }
            if (time2 > niz[2] && time2 <= niz[3]) {
                time2 = niz[3];
            }
            if (time2 > niz[1] && time2 <= niz[2]) {
                time2 = niz[2];
            }
            if (time2 > niz[0] && time2 <= niz[1]) {
                time2 = niz[1];
            }
            if (time2 <= niz[0]) {
                time2 = niz[1];
            }

            if (cal2 > niz[8] && cal2 <= niz[9]) {
                cal2 = niz[9];
            }
            if (cal2 > niz[7] && cal2 <= niz[8]) {
                cal2 = niz[8];
            }
            if (cal2 > niz[6] && cal2 <= niz[7]) {
                cal2 = niz[7];
            }
            if (cal2 > niz[5] && cal2 <= niz[6]) {
                cal2 = niz[6];
            }
            if (cal2 > niz[4] && cal2 <= niz[5]) {
                cal2 = niz[5];
            }
            if (cal2 > niz[3] && cal2 <= niz[4]) {
                cal2 = niz[4];
            }
            if (cal2 > niz[2] && cal2 <= niz[3]) {
                cal2 = niz[3];
            }
            if (cal2 > niz[1] && cal2 <= niz[2]) {
                cal2 = niz[2];
            }
            if (cal2 > niz[0] && cal2 <= niz[1]) {
                cal2 = niz[1];
            }
            if (cal2 <= niz[0]) {
                cal2 = niz[1];
            }


            if (scnt2 > niz[8] && scnt2 <= niz[9]) {
                scnt2 = niz[9];
            }
            if (scnt2 > niz[7] && scnt2 <= niz[8]) {
                scnt2 = niz[8];
            }
            if (scnt2 > niz[6] && scnt2 <= niz[7]) {
                scnt2 = niz[7];
            }
            if (scnt2 > niz[5] && scnt2 <= niz[6]) {
                scnt2 = niz[6];
            }
            if (scnt2 > niz[4] && scnt2 <= niz[5]) {
                scnt2 = niz[5];
            }
            if (scnt2 > niz[3] && scnt2 <= niz[4]) {
                scnt2 = niz[4];
            }
            if (scnt2 > niz[2] && scnt2 <= niz[3]) {
                scnt2 = niz[3];
            }
            if (scnt2 > niz[1] && scnt2 <= niz[2]) {
                scnt2 = niz[2];
            }
            if (scnt2 > niz[0] && scnt2 <= niz[1]) {
                scnt2 = niz[1];
            }
            if (scnt2 <= niz[0]) {
                scnt2 = niz[1];
            }

            opts.yaxes[0].max = scnt2;
            opts.yaxes[0].tickSize = scnt2 / 5;
            opts.yaxes[5].max = cal2;
            opts.yaxes[5].tickSize = cal2 / 5;
            opts.yaxes[6].max = time2;
            opts.yaxes[6].tickSize = time2 / 5;
            opts.yaxes[12].max = dist2;
            opts.yaxes[12].tickSize = dist2 / 5;


            var r = piktoBiorowerGraph2.parameters;
            var duzina = r.length;
            

            if (duzina == 1) {
                opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis - 1].position = 'left';
            }
            if (duzina == 2) {
                opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis - 1].position = 'left';
                opts.yaxes[piktoBiorowerGraph2.parameters[1].yaxis - 1].position = 'right';
            }
            if (duzina == 3) {
                opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis - 1].position = 'left';
                opts.yaxes[piktoBiorowerGraph2.parameters[1].yaxis - 1].position = 'right';
                opts.yaxes[piktoBiorowerGraph2.parameters[2].yaxis - 1].position = 'right';
            }
              $("#next4").css('opacity', '1');
              $("#next3").css('opacity', '1');
            if (moment(piktoBiorowerGraph2.startDate) < moment().subtract(1, piktoBiorowerGraph2.rangeType)) {
                $("#next4").show();
            }
            if (moment(piktoBiorowerGraph2.startDate) > moment().subtract(1, piktoBiorowerGraph2.rangeType)) {
                 $("#next4").css('opacity', '0.3');
                piktoBiorowerGraph2.startDate = moment().subtract(1, piktoBiorowerGraph2.rangeType);
            }
            if (moment(piktoBiorowerGraph2.startDate) > moment(piktoBiorowerGraph2.start)) {
                $("#next3").show();
            }

            if (moment(piktoBiorowerGraph2.startDate) < moment(piktoBiorowerGraph2.start)) {
                 $("#next3").css('opacity', '0.3');
                piktoBiorowerGraph2.startDate = moment(piktoBiorowerGraph2.start).subtract(1, 'month');

            }
            $('#izbor1').text("Group by " + piktoBiorowerGraph2.groupType);


            if (piktoBiorowerGraph2.rangeType == "year") {
                $("#year_progress").css("text-decoration", "underline");
                $("#all_progress").css("background-color", "#3c8dbc");

                var axes = piktoBiorowerGraph2.progressPlot.getAxes();
                axes.xaxis.options.timeformat = "%b";
                axes.xaxis.options.tickSize = [1, "month"];
                axes.xaxis.options.min = piktoBiorowerGraph2.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph2.startDate).add(1, 'year');
                $('#tekst2').html("Progress" + "&nbsp;&nbsp;&nbsp;&nbsp" + " " + moment(piktoBiorowerGraph2.startDate.format('YYYY-MM-DD')).format('MMMM Do YYYY') + " - "
                        + moment(piktoBiorowerGraph2.startDate).add(1, 'year').format('MMMM Do YYYY'));
            }

            if (piktoBiorowerGraph2.rangeType == 'all') {
                $('#strelice2').hide();
                $("#year_progress").css("text-decoration", "none");
                $("#all_progress").css("background-color", "#286090");

                var s = new Date("October 10, 2017 11:13:00");
                var s2 = new Date("October 11, 2018 11:13:00");
                var dr2 = moment.range(s, s2);
                var range3 = moment.range(moment(response.historydata.date[0]), moment());

                if (range3 > dr2) {

                    var axes = piktoBiorowerGraph2.progressPlot.getAxes();
                    axes.xaxis.options.timeformat = "%m";

                }
                if (range3 < dr2) {
                    axes.xaxis.options.timeformat = "%b";
                }

                axes.xaxis.options.min = undefined;
                axes.xaxis.options.max = undefined;
                axes.xaxis.options.tickSize = [1, "month"];
                $('#tekst2').html("Progress " + "&nbsp;&nbsp;&nbsp;&nbsp" + " " + moment(response.historydata.date[0]).format('MMMM Do YYYY') + " - "
                        + moment().format('MMMM Do YYYY'));

            }
            piktoBiorowerGraph2.progressPlot.setupGrid();
            piktoBiorowerGraph2.progressPlot.draw();
        });
    }
};
