$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });

    <!-- Date Range Picker -->

    $(document).ready(function () {

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

    <!-- Date Range Picker 1 -->

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


    $(function() {

        var data = {
            account: 'biorower:'+$('#user-email').val(),
            rangeType: 'all'
        };

        $.post('/api/v1/sessions_history', data, function(response){
            console.log(response);
            /* About Me */
            if(response.historydata.length !== 0) {
                $('.power-max').append(Math.max.apply(Math, response.historydata.power_max));
                $('.power-average').append(Math.max.apply(Math, response.historydata.power_average));
                $('.stroke-rate-max').append(Math.max.apply(Math, response.historydata.stroke_rate_max));
                $('.stroke-distance-max').append(Math.max.apply(Math, response.historydata.stroke_distance_max));
                var latest_session = response.historydata.date[response.historydata.date.length - 1];
                $('.latest-session').append(moment(latest_session).format('MMM Do YYYY h:mm a'));
            } else {
                $('.power-max').append('0');
                $('.power-average').append('0');
                $('.stroke-rate-max').append('0');
                $('.stroke-distance-max').append('0');
                $('.latest-session').append('No sessions yet');
            }

            /* History Graph */
            var arr = [],
                power = [];
            var power_max = response.historydata.power_max;
            var dates = response.historydata.date;

            power_max.forEach(function(value, index){
                arr.push([value, dates[index]]);
                power.push(arr[arr.length - 1]);
                //console.log(power);
            });
            //console.log(power);
            //console.log(power.length);

            var days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            var data9_1 = [
                [1, 926.13135], [2, 6580], [3, 1980],[4, 6630], [5, 8010], [6, 10800],
                [7, 8530], [8, 300], [9, 6580], [10, 1980],[11, 6630], [12, 8010], [13, 10800],
                [14, 8530],
            ];

            var data_test = [];
            for(var i = 1; i<power.length; i++) {
                var one_p = [i, power[i][0]];
                data_test.push(one_p);
            }

            var data_dates = [];
            for(var j = 1; j<dates.length; j++) {
                var one_d = [j, dates[j]];
                data_dates.push(one_d);
            }

            var data_dates_show_x = [];
            for(var x = 0; x<data_dates.length; x++) {
                if(x == 12) {
                    var z = 0;
                    data_dates_show_x.push([z+1, data_dates[z][0]]);
                }
                data_dates_show_x.push([x+1, data_dates[x][0]]);
            }

            console.log(data_dates_show_x);

            //console.log(data_test);
            console.log(data_dates);
            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' +  contents + '</div>').css({
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
                                "<span class='x-asis'>" + days[x-  1] + "</span>" + "<br/>" + "<br/>" +"<p>" + y + "W" + "</p>" + "<i>" + item.series.label + "") + "</i>";
                        }
                    }
                    else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            };


            $(function () {
                $.plot($("#history"),
                    [{
                        data: data_test,
                        label: 'Power Max(W)',
                        color: "#3c8dbc",
                        lines: { show: true, color: "#3c8dbc" },
                        points: { show: true, fill:true },
                    }

                    ],{

                        grid: {
                            hoverable: true,
                            clickable: true,
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
                            ticks: data_dates_show_x
                        }
                    }
                );

                $("#history").UseTooltip();

                var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Days of the week").appendTo($('#history'));

                var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power Max(W)").appendTo($('#history'));
                yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
            });


        });




    });

});
//Line Graph - Progress

$(function() {

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
                        "<span class='x-asis'>" + days[x-  1] + "</span>" + "<br/>" + "<p>" + y + "W" + "</p>" + "<i>" + item.series.label + "") + "</i>";
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
                label: '<a href="#">Power(W)</a>',
                color: "#3c8dbc",
                lines: { show: true, color: "#3c8dbc", fillColor: "#3c8dbc" },
                points: { show: true, fill:true }
            },{
                data: data9_2,
                label: '<a href="#">HR(bmp)</a>',
                color: "#536A7F",
                lines: { show: true, color: "#536A7F", fillColor: "#536A7F" },
                points: { show: true, fill:true }
            },
                {
                    data: data9_3,
                    label: '<a href="#">Stroke rate</a>',
                    color: "#b8c7ce",
                    labelColor:"#b8c7ce",
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
function selectTab() {
    $('[role="tab"]').has("a[href='#" + history + "']").first().trigger("click");
}