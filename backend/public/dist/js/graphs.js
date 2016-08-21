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


    $(function () {

        var email2 = 'biorower:' + $('#user-email').val();

        var data = {
            account: 'biorower:' + $('#user-email').val(),
            rangeType: 'all',


        };
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
                    $('.time').append(json[0].time);
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


                $.post('api/v1/sessions_history', data, function (response3) {





                    $.post('api/v1/sessions_history', data2, function (response2) {


                        /* History Graph */

                        var power_max = response3.historydata.pwr_max;
                        var dates = response3.historydata.date;


                        //console.log(power);
                        //console.log(power.length);

                        var days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];


                        piktoBiorowerGraph.historyData = response3.historydata;
                        piktoBiorowerGraph2.historyData = response2.historydata;
                        data_test = piktoBiorowerGraph.getHistoryData([{slug:'scnt',label:'Stroke Count'}]);
                        data_test2 = piktoBiorowerGraph2.getHistoryData([{slug:'scnt',label:'Stroke Count'}]);
                        $('#tekst').text("History "+" "+" "+moment(response3.historydata.date[0]).format('MMMM Do YYYY')+" - "
                        +moment().format('MMMM Do YYYY'));
                        $('#tekst2').text("Progress "+" "+" "+moment(response2.historydata.date[0]).format('MMMM Do YYYY')+" - "
                        +moment().format('MMMM Do YYYY'));

                        console.log(data_test);
                        //console.log(data_dates);

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


                        $(function () {





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



                            piktoBiorowerGraph2.progressPlot=$.plot($("#progress"),
                                data_test2, {
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
                                        noColumns: 1
                                    },
                                    yaxis: {
                                        show: true,
                                        labelWidth: 30,
                                        max:500,
                                    },
                                    xaxis: {
                                        show: true,
                                        labelHeight: 30,
                                        mode: 'time',
                                        timeformat: "%d.%m.%Y"
                                    },
                                    legend: {
                                        show: true
                                    }

                                }
                            );

                            $("#progress").UseTooltip();

                            var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Time(sec)").appendTo($('#progress'));

                            var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#progress'));
                            yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

















                            piktoBiorowerGraph.historyPlot = $.plot($("#history"),
                                data_test, {
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
                                        noColumns: 3
                                    },
                                    yaxis: {
                                        show: true,
                                        labelWidth: 30,
                                        max:100,
                                    },
                                    xaxis: {
                                        show: true,
                                        labelHeight: 30,
                                        mode: 'time',

                                    }
                                }
                            );

                            $("#history").UseTooltip();
                        });


                    });
                });
            }
        });




    });

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
    parameters: null,
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
        piktoBiorowerGraph.parameters = params;
        var rv = [];
        for(var i in params) {
            rv.push(this.transormData(this.historyData, params[i]));
        }
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

            $('#tekst').text("History        "+" "+" "+moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).
                startOf(piktoBiorowerGraph.rangeType).format('MMMM Do YYYY')+" - "
            +moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).endOf(piktoBiorowerGraph.rangeType).format('MMMM Do YYYY'));

        }


        $.post('api/v1/sessions_history', data, function (response) {
            piktoBiorowerGraph.historyData = response.historydata;
            var newHistoryData = piktoBiorowerGraph.getHistoryData(piktoBiorowerGraph.parameters);
            piktoBiorowerGraph.historyPlot.setData(newHistoryData);
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
            if(piktoBiorowerGraph.rangeType=='all'){
                $('#strelice').hide();
                axes.xaxis.options.min = undefined;
                axes.xaxis.options.max = undefined;
                $('#tekst').text("History "+" "+" "+moment(response.historydata.date[0]).format('MMMM Do YYYY')+" - "
                +moment().format('MMMM Do YYYY'));

            } else {
                $('#strelice').show();
                axes.xaxis.options.min = piktoBiorowerGraph.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph.startDate.format('YYYY-MM-DD')).endOf(piktoBiorowerGraph.rangeType);
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
    rangeType: 'all',
    parameters: null,
    groupType2:'month',
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
        }
        return rv;
    },
    loadHistoryData: function (account, rangeType, startDate,groupType="week") {
        var data = {
            account: 'biorower:' + account,
            rangeType: rangeType,
            dateStart: startDate?startDate.format('YYYY-MM-DD'):'',
            groupType: groupType,
        };
        piktoBiorowerGraph2.startDate = startDate;
        piktoBiorowerGraph2.rangeType = rangeType;
        if(piktoBiorowerGraph2.rangeType!="all"){

            $('#tekst2').text("Progress        "+" "+" "+moment(piktoBiorowerGraph2.startDate.format('YYYY-MM-DD')).
                startOf(piktoBiorowerGraph2.rangeType).format('MMMM Do YYYY')+" - "
            +moment(piktoBiorowerGraph2.startDate.format('YYYY-MM-DD')).endOf(piktoBiorowerGraph2.rangeType).format('MMMM Do YYYY'));

        }
        $.post('api/v1/sessions_history', data, function (response) {
            piktoBiorowerGraph2.historyData = response.historydata;
            var newHistoryData = piktoBiorowerGraph2.getHistoryData(piktoBiorowerGraph2.parameters);
            piktoBiorowerGraph2.progressPlot.setData(newHistoryData);
            var axes = piktoBiorowerGraph2.progressPlot.getAxes();
            if(piktoBiorowerGraph2.rangeType=='all'){
                $('#strelice2').hide();
                axes.xaxis.options.min = undefined;
                axes.xaxis.options.max = undefined;
                $('#tekst2').text("Progress "+" "+" "+moment(response.historydata.date[0]).format('MMMM Do YYYY')+" - "
                +moment().format('MMMM Do YYYY'));
            } else {
                $('#strelice2').show();
                axes.xaxis.options.min = piktoBiorowerGraph2.startDate;
                axes.xaxis.options.max = moment(piktoBiorowerGraph2.startDate.format('YYYY-MM-DD')).endOf(piktoBiorowerGraph2.rangeType);
            }
            piktoBiorowerGraph2.progressPlot.setupGrid();
            piktoBiorowerGraph2.progressPlot.draw();
        });
    }
};