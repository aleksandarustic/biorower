@extends('layouts.main')
@section('page-scripts')
<script type="text/javascript">
    
     var urlBase = "<?php echo Request::root() ?>";
     var email1="<?php echo Auth::user()->email ?>"; 
     var display_name= "<?php echo Auth::user()->display_name ?>"; 
     var email2="biorower:"+email1;
     var idsesije="<?php echo $decodedID ?>"; 
     var leftColor='#FF8B00';
     var rightColor='#007ABB';
     var skaliranje2=500;
     var min=0;
     var max=null;
     var st3=0;
     var time4="<?php echo $sessionUser['sessionSummary']->time?>";
    var piktoBiorowerGraph = {
    historyPlot: null,
    historyData: null,
    duration:40,
    position:0,
    number:0,
    rv1:[[0,0]],
    rv2:[],
    rv3:[],
    rv4:[],
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
        var colors = ['#440064', '#007eff', '#00afc8', '#005764'];

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
            }

        }
        piktoBiorowerGraph.parameters = params;

        return rv;

    },
    loadHistoryData: function (start,duration) {
        var data = {
            account: email2,
            sesija:idsesije,
             graf:2,
             start:start,
             duration:duration,
             st:st3
        };
        
        piktoBiorowerGraph.duration=duration;
       
            
        $.post(urlBase +'/api/v1/graph', data, function (response) {
                var niz = [250,500,750,1000];
                    var ticksize=0;
                  if (response['max'] > niz[2] && response['max'] <= niz[3]) {
                response['max'] = niz[3];
                 ticksize=250;

                
            }
            if (response['max'] > niz[1] && response['max'] <= niz[2]) {
                response['max'] = niz[2];
               ticksize=150;

            }
            if (response['max'] > niz[0] && response['max']<= niz[1]) {
                response['max'] = niz[1];
                 ticksize=100;

            }
             if (response['max'] <= niz[0]) {
                response['max'] = niz[0];
                ticksize=50;
            }
            var niz=piktoBiorowerGraph.rv1;
             for(var i=0;i<response['frc_l'].length; i++){
                 if(niz[niz.length-1][0]<response['frc_l'][i][0]){
                         piktoBiorowerGraph.rv1.push(response['frc_l'][i]);
                         piktoBiorowerGraph.rv2.push(response['frc_r'][i]);
                         piktoBiorowerGraph.rv3.push(response['ang_l'][i]);
                         piktoBiorowerGraph.rv4.push(response['ang_r'][i]);
                 
                
                 }
               
                

             }
            

            piktoBiorowerGraph.historyData = [{data:piktoBiorowerGraph.rv1,yaxis:1,label:'Force L[N]'},{data:piktoBiorowerGraph.rv2,yaxis:1,label:'Force R[N]'},{data:piktoBiorowerGraph.rv3,yaxis:2,label:'Angle L[°]'},{data:piktoBiorowerGraph.rv4,yaxis:2,label:'Angle R[°]'}]
                    
           piktoBiorowerGraph.number=response['ang_l'][response['frc_l'].length - 1];
            var series = {lines: {show: true}, points: {show: true}};
            if (piktoBiorowerGraph.broj == 1) {
                series = {lines: {show: false}, points: {show: true}};
            }
            function formatter(val, axis) {
              /*  var minutes = Math.floor(val / 60);
                var seconds = val - minutes * 60;
                if(val<60){
                     return seconds+"s" ;
                }
                else{
                    return minutes+"min"+ seconds+"s" ;
                }  */
        
                      var hours   = Math.floor(val / 3600);
                      var minutes = Math.floor((val - (hours * 3600)) / 60);
                      var seconds = val - (hours * 3600) - (minutes * 60);
                      seconds = Math.round(seconds * 100) / 100;
                       var result = (hours < 1 ? '' : hours + ":");
                      result += (minutes < 10 ? "0" + minutes : minutes);
                       result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
                       return result;

                
            }
            
            if(piktoBiorowerGraph.duration==7){
                var max3=piktoBiorowerGraph.position+10;
                var min3=piktoBiorowerGraph.position;
                var tickSize=1;
            }
             else if(piktoBiorowerGraph.duration==40){
                var max3=piktoBiorowerGraph.position+60;
                var min3=piktoBiorowerGraph.position;
                                var tickSize=5;

            }
            else  if(piktoBiorowerGraph.duration==20){
                var max3=piktoBiorowerGraph.position+30;
                var min3=piktoBiorowerGraph.position;
                                var tickSize=5;

            }
             else{
                var max3=piktoBiorowerGraph.position+5;
                var min3=piktoBiorowerGraph.position;
               var tickSize=1;

            }
            if(min3<0){min3=0;}
            if(time4<5){
                time4=6
            }
            piktoBiorowerGraph.historyPlot = $.plot($("#signals-graph"),
            piktoBiorowerGraph.historyData , {
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
                        colors:[leftColor, rightColor, leftColor,rightColor],

                        legend: {
                            noColumns: 4,
                            position: "nw",
                        },
                       
                        yaxes: [{
                              axisLabelUseCanvas: true,
                                axisLabel: "Force[N]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                labelWidth: 20,
                                   min:0,
                                   tickSize:ticksize,
                                   max:response['max'],
                                    panRange: false,
                                    position:'left',
                            }, {
                              axisLabelUseCanvas: true,
                                axisLabel:'Angle[°]',
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                labelWidth: 20,
                                max: 60,
                                 min: -90,
                                 tickSize:30,
                                  panRange: false,
                                   position:'right',
                            }                        
                        ],
                        xaxis: {
                            show: true,
                            labelHeight: 30,
                           tickFormatter: formatter,
                            max:max3,
                            min:min3,
                             panRange: [0, time4-0.5],
                            tickSize:tickSize,
                            
                        

                          
            }
                    }
            );

            var opts = piktoBiorowerGraph.historyPlot.getOptions();
            var axes = piktoBiorowerGraph.historyPlot.getAxes();
          


            piktoBiorowerGraph.historyPlot.setupGrid();
            piktoBiorowerGraph.historyPlot.draw();
                           st3=st3+300;

        });

    }
};
var piktoBiorowerGraph2 = {
    progressPlot: null,
    historyData: null,
    startDate: null,
    sadasnjost: null,
    rangeType: 'all',
    parameters: [{slug:'spd', label: 'Speed', yaxis: 14},{slug:'dist', label: 'Distance', yaxis: 13}],
    start: null,
    groupType: 'week',
    position:0,
    maximum:0,
    transormData: function (historyData, parameter) {

       
        var rv = [];
        rv['label'] = parameter.label;
        rv['data'] = [];

        for (var i in historyData.stroke_count) {
            rv['data'].push([historyData.stroke_count[i], historyData[parameter.slug][i]]);
        }
        return rv;
        

    },
    getHistoryData: function (params) {

        var rv = [];
        var colors = ['#440064', '#007eff', '#00afc8', '#005764', '#804000', '#960000',
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
                case "Power":
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
                case "Power R":
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
    loadHistoryData: function (data2) {

         var data = {
            account: email2,
            sesija:idsesije,
             graf:3,
             parametar:data2
        };
       

         $.post(urlBase +'/api/v1/graph', data, function (response) {

            

            piktoBiorowerGraph2.historyData = response.historydata;
              var newHistoryData = piktoBiorowerGraph2.getHistoryData(data2);
              piktoBiorowerGraph2.maximum = response.max;
            if (response.max < 1000 && response.max > 200) {
               $("#stroke_1k").hide();
            }
              if (response.max < 200 && response.max > 50) {
               $("#stroke_1k").hide();
               $("#stroke_200").hide();

            }
             if (response.max < 50 ) {
               $("#stroke_1k").hide();
               $("#stroke_200").hide();
               $("#stroke_50").hide();


            }
           
            
            
            var broj = 0;

             function formatter(val, axis) {
              /*  var minutes = Math.floor(val / 60);
                var seconds = val - minutes * 60;
                if(val<60){
                     return seconds+"s" ;
                }
                else{
                    return minutes+"min"+ seconds+"s" ;
                }  */
        
                      var hours   = Math.floor(val / 3600);
                      var minutes = Math.floor((val - (hours * 3600)) / 60);
                      var seconds = val - (hours * 3600) - (minutes * 60);
                      seconds = Math.round(seconds * 100) / 100;
                       var result = (hours < 1 ? '' : hours + ":");
                      result += (minutes < 10 ? minutes : minutes);
                       result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
                       return result;

                
            }

            var colors = [];
            for (var i = 0; i < piktoBiorowerGraph2.parameters.length; i++) {
                colors.push(piktoBiorowerGraph2.parameters[i].color);
            }
           
           
            

            piktoBiorowerGraph2.progressPlot = $.plot($("#Strokes"),
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
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                min: 0.00000001,
                            }, {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Distance [km]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 20,
                                tickSize: 4, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Speed Max [m/s]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 10,
                                tickSize: 2, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 2km [mm.ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 1200,
                                tickFormatter: formatter, min: 0.00000001,
                                tickSize: 240,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "HR max [bmp]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 250,
                                tickSize: 50, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Calories [kCal]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 2,
                                tickSize:0.4,
                                min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Time [ss.hh]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                tickSize:1,
                                max: 5, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Dist.Max [km]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 20,
                                tickSize: 4, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 500m [mm.ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                tickFormatter: formatter,
                                tickSize: 60,
                                max: 300,
                                min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 2km Max [hh:mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20, tickSize: 240,
                                tickFormatter: formatter,
                                max: 1200, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Rate [spm]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 50,
                                tickSize: 10, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power L [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Distance [m]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 20,
                                tickSize: 4, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Speed [m/s]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 10,
                                tickSize: 2, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Pace 500m Max [hh:mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                tickFormatter: formatter,
                                max: 300, min: 0.00000001,
                                tickSize: 60,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "HR [bmp]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 250,
                                tickSize: 50, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Stroke Rate Max [spm]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 50,
                                tickSize: 10, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Average [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 1500,
                                tickSize: 300, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 1500,
                                tickSize: 300, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power L Max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power right average [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power right max [W]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 750,
                                tickSize: 150, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Balance [%]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Power Balance max [%]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle left average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle left max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle right average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle right max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle average [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "Angle max [°]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 150,
                                tickSize: 30, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "MML 2 Level [hh:mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                            {
                                axisLabelUseCanvas: true,
                                axisLabel: "MML 4 Level [hh:mm:ss]",
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 2,
                                panRange: false,
                                labelWidth: 20,
                                max: 100,
                                tickSize: 20, min: 0.00000001,
                            },
                        ],
                        xaxis: {
                            show: true,
                            labelHeight: 30,
                            min:min,
                            max:max,
                            panRange: [0, response.max],

                           
                         
         
                         
                        }
                    }
            );


            var opts = piktoBiorowerGraph2.progressPlot.getOptions();
            var axes = piktoBiorowerGraph2.progressPlot.getAxes();
         
         if(skaliranje2==1000){

                    for(var i=0;i<opts.yaxes.length; i++){

                          opts.yaxes[i].max =  opts.yaxes[i].max/2;
                           opts.yaxes[i].tickSize=opts.yaxes[i].tickSize/2;


                    }
                }
          if(skaliranje2==0){
                 for(var i=0;i<opts.yaxes.length; i++){

                          opts.yaxes[i].max =   opts.yaxes[i].max*2;
                          opts.yaxes[i].tickSize=opts.yaxes[i].tickSize*2;


                    }
              
          }
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
         

            piktoBiorowerGraph2.progressPlot.setupGrid();
            piktoBiorowerGraph2.progressPlot.draw();
        });
    }
};  
  $(function() {
   $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '10%' // optional
    });
    
        $.fn.UseTooltip = function () {
        var previousPoint = null;

        $("#Strokes").bind("plothover", function (event, pos, item) {

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
                        var y = datapoint + " sec ";
                    }
                    if (label == "Stroke Dist. Max") {
                        var y = (datapoint).toFixed(2) + " m ";
                    }
                    if (label.indexOf("MML") != -1) {
                        var y = datapoint.toFixed(2) + " mmol/l";
                    }
                    var x = item.datapoint[0];


                    showTooltip(item.pageX, item.pageY,
                            "<strong>" + item.series.label + ": " + y + "</strong>" + "<br/>" + "<strong>Strokes: " + x + "</strong><br />"

                            );
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        }
        
         function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y - 50,
            left: x + 25,
            border: '2px solid #ccc',
            padding: '5px',
            size: '10',
            color: 'black',
            'background-color': '#fff',
            opacity: 0.80,
            width: 250
        }).appendTo("body").fadeIn(200);
    }

    
    $("#Strokes").UseTooltip();

        $("#link2").click(function(){
           var r = piktoBiorowerGraph2.parameters;
            var duzina = r.length;
    
         for(var i=0;i<document.getElementsByClassName("parameters2").length; i++){
             for(var i2=0;i2<duzina;i2++){
                   if(document.getElementsByClassName("parameters2")[i].value==piktoBiorowerGraph2.parameters[i2].slug){
            
                 var id2=document.getElementsByClassName("parameters2")[i].id;
     
                $('#'+id2).iCheck('check');
      
             }
             }
 
    }
    
    $('.parameters2').on('ifUnchecked', function(event){
           if($('.parameters2').filter(':checked').length == 0){
                           
                     $("#dugme2").attr('disabled', true);


                 }


             });
    
        });
        $("#tooltip").css("width",'300px');
    
    
     

             $('.parameters2').on('ifClicked', function (event) {

                 $("#dugme2").attr('disabled', false);

                 if (this.checked == true) {

                 } else {


                     if ($('.parameters2').filter(':checked').length == 3) {
                         var s = $('.parameters2').filter(':checked')[2].id;

                         $('#' + s).iCheck('uncheck');

                     }
    
     
    }



        });
        
         if (time4 < 60 && time4 > 30) {
               $("#signal_1min").hide();
               piktoBiorowerGraph.duration=20;
            }
              if (time4 < 30 && time4 > 10) {
               $("#signal_1min").hide();
               $("#signal_30s").hide();
               piktoBiorowerGraph.duration=7;

            }
             if (time4 < 10  ) {
               $("#signal_1min").hide();
               $("#signal_30s").hide();
               $("#signal_10s").hide();
              piktoBiorowerGraph.duration=4;


            }
        
        $('#stroke_all').click(function(){
min=0;
max=null;
piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = null; 
piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = null; 
piktoBiorowerGraph2.progressPlot.setupGrid();
piktoBiorowerGraph2.progressPlot.draw();
            
        });
          $('#stroke_1k').click(function(){
           
            if(piktoBiorowerGraph2.position+1000>piktoBiorowerGraph2.maximum){
                  min=piktoBiorowerGraph2.maximum-1000; 
                  max=piktoBiorowerGraph2.maximum;
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = piktoBiorowerGraph2.maximum-1000;            
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = piktoBiorowerGraph2.maximum; 
            }
            else{
                 min=piktoBiorowerGraph2.position; 
                 max=piktoBiorowerGraph2.position+1000;
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = piktoBiorowerGraph2.position;            
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = piktoBiorowerGraph2.position+1000; 
               
            }
             piktoBiorowerGraph2.progressPlot.setupGrid();
             piktoBiorowerGraph2.progressPlot.draw();

        });
           $('#stroke_200').click(function(){
        
         if(piktoBiorowerGraph2.position+200>piktoBiorowerGraph2.maximum){
               min=piktoBiorowerGraph2.maximum-200; 
               max=piktoBiorowerGraph2.maximum;
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = piktoBiorowerGraph2.maximum-200;            
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = piktoBiorowerGraph2.maximum;              
            }
            else{
                 min=piktoBiorowerGraph2.position; 
                 max=piktoBiorowerGraph2.position+200;
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = piktoBiorowerGraph2.position;            
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = piktoBiorowerGraph2.position+200;           
            }
              piktoBiorowerGraph2.progressPlot.setupGrid();
              piktoBiorowerGraph2.progressPlot.draw();

        });
           $('#stroke_50').click(function(){
       
if(piktoBiorowerGraph2.position+50>piktoBiorowerGraph2.maximum){
                     min=piktoBiorowerGraph2.maximum-50; 
                     max=piktoBiorowerGraph2.maximum;
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = piktoBiorowerGraph2.maximum-50;            
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = piktoBiorowerGraph2.maximum;              
            }
            else{
                 min=piktoBiorowerGraph2.position; 
                 max=piktoBiorowerGraph2.position+50;
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.min = piktoBiorowerGraph2.position;            
                piktoBiorowerGraph2.progressPlot.getAxes().xaxis.options.max = piktoBiorowerGraph2.position+50;           
            }
              piktoBiorowerGraph2.progressPlot.setupGrid();
              piktoBiorowerGraph2.progressPlot.draw();
        });

          $('#skaliranje2').click(function(){
                
                     skaliranje2=skaliranje2+500;
                if(skaliranje2==500){
                     var opts = piktoBiorowerGraph2.progressPlot.getOptions();
                    for(var i=0;i<opts.yaxes.length; i++){

                          opts.yaxes[i].max =  opts.yaxes[i].max/2;
                           opts.yaxes[i].tickSize=opts.yaxes[i].tickSize/2;


                    }

                      piktoBiorowerGraph2.progressPlot.setupGrid();
                    piktoBiorowerGraph2.progressPlot.draw();





                    $('#skaliranje2').text("X1");

                }
                if(skaliranje2==1000){
                    $('#skaliranje2').text("X2");
                                        var opts = piktoBiorowerGraph2.progressPlot.getOptions();
                      for(var i=0;i<opts.yaxes.length; i++){

                                              opts.yaxes[i].max =  opts.yaxes[i].max/2;
                                               opts.yaxes[i].tickSize=opts.yaxes[i].tickSize/2;
                    }

                    piktoBiorowerGraph2.progressPlot.setupGrid();
                    piktoBiorowerGraph2.progressPlot.draw();
                }
                if(skaliranje2==1500){
                    $('#skaliranje2').text("1/2X");
                    var opts = piktoBiorowerGraph2.progressPlot.getOptions();
                        for(var i=0;i<opts.yaxes.length; i++){

                          opts.yaxes[i].max =   opts.yaxes[i].max*4;
                           opts.yaxes[i].tickSize=opts.yaxes[i].tickSize*4;


                    }

                    piktoBiorowerGraph2.progressPlot.setupGrid();
                    piktoBiorowerGraph2.progressPlot.draw();
                    skaliranje2=0;
                }


            });

     $.ajax({ 
            type: 'POST', 
            dataType: 'json',
            url : urlBase + '/api/v1/graph',
            data: {account: email2 ,
                sesija:idsesije,
                graf:1,
        }, 
            success: function (data9) {
                 var niz = [250,500,750,1000];
                 var ticksize=0;
                  if (data9['max'] > niz[2] && data9['max'] <= niz[3]) {
                data9['max'] = niz[3];
                 ticksize=250;

                
            }
            if (data9['max'] > niz[1] && data9['max'] <= niz[2]) {
                data9['max'] = niz[2];
               ticksize=150;

            }
            if (data9['max'] > niz[0] && data9['max']<= niz[1]) {
                data9['max'] = niz[1];
                 ticksize=100;

            }
             if (data9['max'] <= niz[0]) {
                data9['max'] = niz[0];
                ticksize=50;
            }
             

            $.plot($("#left-hand"),
                    data9['left'], {
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
                            interactive: false
                        },
                 
                        legend: {
                            noColumns: 3,
                            position: "nw",
                        },
                        colors:[leftColor],
                          yaxis: {
                             axisLabelUseCanvas: true,
                                axisLabel:'Force L[°]',
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 20,
                                 show: true,
                                 max:data9['max'],
                                 tickSize:ticksize
                               },
                        xaxis:{
                             axisLabelUseCanvas: true,
                                axisLabel:'Angle L[°]',
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 20,
                            tickSize:30,
                        show:true,
                        max:60,
                        min:-90,
                        }  
                    }
            );
               $.plot($("#right-hand"),
                    data9['right'], {
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
                            interactive: false
                        },
                       colors:[rightColor],
                                           
                        legend: {
                            noColumns: 3,
                            position: "nw",
                        },
                        yaxis: {
                             axisLabelUseCanvas: true,
                                axisLabel:'Force R[°]',
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 20,
                                 labelWidth: 20,
                                 show: true,
                                 max: data9['max'],
                                 tickSize:ticksize,
                               },
                        xaxis:{
                             axisLabelUseCanvas: true,
                                axisLabel:'Angle R[°]',
                                axisLabelFontSizePixels: 12,
                                axisLabelFontFamily: 'Verdana, Arial',
                                axisLabelPadding: 20,
                                 labelWidth: 20,
                          tickSize:30,  
                        show:true,
                        max:60,
                        min:-90,
                        }     
                    }
            );
    
    
    
            }
          });
          
          
   
          
          
          
          
          piktoBiorowerGraph.loadHistoryData(0,piktoBiorowerGraph.duration);         
         
          $("#signals-graph").bind("plotpan", function (event, plot) {
        var axes = piktoBiorowerGraph.historyPlot.getAxes();
        var start = axes.xaxis.options.min;
                      piktoBiorowerGraph.position=axes.xaxis.options.min;

       
      
    
      
    }); 
    
    
    setInterval(function(){ 
      var axes = piktoBiorowerGraph.historyPlot.getAxes();

        

     if(axes.xaxis.options.max>piktoBiorowerGraph.rv1[piktoBiorowerGraph.rv1.length-1][0]/2){
           
       
                    if(piktoBiorowerGraph.rv1[piktoBiorowerGraph.rv1.length-1][0]<time4-5){
                     
                                    piktoBiorowerGraph.loadHistoryData(piktoBiorowerGraph.rv1[piktoBiorowerGraph.rv1.length-1][0],piktoBiorowerGraph.duration);

                    }
      
        } 
    
    
  

    
    
    }, 2000);

    
    
     
       
          $("#Strokes").bind("plotpan", function (event, plot) {
        var axes = piktoBiorowerGraph2.progressPlot.getAxes();
        var start = axes.xaxis.options.min;
        piktoBiorowerGraph2.position=axes.xaxis.options.min;
    
      
    }); 
    
    
    
    
         /*    $("#signals-graph").mouseup(function(){
                 setTimeout(function(){
                     
         var axes = piktoBiorowerGraph.historyPlot.getAxes();
        var start = axes.xaxis.options.min;
     
         piktoBiorowerGraph.loadHistoryData(parseInt(start));
                     
                 }, 1);
                
             });     
    */
          
          
  
  

  

  
piktoBiorowerGraph2.loadHistoryData([{slug: 'spd', label: 'Speed', yaxis: 14},{slug: 'dist', label: 'Distance', yaxis: 13}]);


  });


</script> 
<!-- REQUIRED JS SCRIPTS --> 

@endsection


@section('content')
  <!-- Main content -->
  

<!-- Content Header (Page header) --> 
<!-- Main content -->

<section class="content">

  <div class="row"><!-- /.col -->
  <div class="col-md-8 col-left">
  <div class="col-md-12 no-padding">
  <!-- Sensor Graph -->
    <div class="col-md-12 row">
     <div class="no-background box-header margin-bottom">
        <p class="box-title "><span class="smaller-letters" id="uvod"></span></p>
        <div class="box-tools pull-right"> <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous" id="previous"><i class="fa fa-chevron-left"></i></a> <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next" id="next"><i class="fa fa-chevron-right"></i></a> </div>
        </div>
      <div class="margin-bottom white-bg padding-all  box box-primary">        
        <div class="signal-graphs">
        <h3 class="pull-left margin-top">Signals</h3>
        <div class="signals-bzns-right margin-bottom">
            <a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;margin-right: 40px" id="signal_1min" onclick="
     if(piktoBiorowerGraph.position+60>time4) {
         piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min=time4-60;
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max=time4;
     }
     else{
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min = piktoBiorowerGraph.position;           
                piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max = piktoBiorowerGraph.position+60; 
                 
     }
       piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.tickSize = 5;     
           
                piktoBiorowerGraph.duration=40;
            
             piktoBiorowerGraph.historyPlot.setupGrid();
             piktoBiorowerGraph.historyPlot.draw(); 
     
                      ">1min</a>
            <a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;" id="signal_30s" onclick="    
    
       if(piktoBiorowerGraph.position+30>time4) {
         piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min=time4-30;
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max=time4;
     }
     else{
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min = piktoBiorowerGraph.position;           
                piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max = piktoBiorowerGraph.position+30; 
                 
     }
 
                   piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.tickSize = 5;     
           
                piktoBiorowerGraph.duration=20;
            
             piktoBiorowerGraph.historyPlot.setupGrid();
             piktoBiorowerGraph.historyPlot.draw(); 
       ">30s</a>
            <a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;" id="signal_10s" onclick="
       if(piktoBiorowerGraph.position+10>time4) {
         piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min=time4-10;
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max=time4;
     }
     else{
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min = piktoBiorowerGraph.position;           
                piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max = piktoBiorowerGraph.position+10; 
                 
     }
    
  
                   piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.tickSize =1;     
           
                piktoBiorowerGraph.duration=7;
            
             piktoBiorowerGraph.historyPlot.setupGrid();
             piktoBiorowerGraph.historyPlot.draw();         
  
       ">10s</a>
            <a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;" id="signal_5s" onclick="
               if(piktoBiorowerGraph.position+5>time4) {
         piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min=time4-5;
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max=time4;
     }
     else{
          piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.min = piktoBiorowerGraph.position;           
                piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.max = piktoBiorowerGraph.position+5; 
                 
     }
                   piktoBiorowerGraph.historyPlot.getAxes().xaxis.options.tickSize = 1;     
           
                piktoBiorowerGraph.duration=4;
            
             piktoBiorowerGraph.historyPlot.setupGrid();
             piktoBiorowerGraph.historyPlot.draw();                                                                                                                                               
         ">5s</a>          <form class="pull-right">
          </form>
          </div> 
          <div class="clear"></div>
          <div id="signals-graph" class="demo-placeholder" style="height: 300px;"></div>
          <div class="graphic-footer row">
              
              <br><br><br><br>
                          </div>
          
<div class="clear margin-bottom"></div>

          <div class="hands-graph margin-bottom">
          <div class="col-md-6 left-hand">
          <h3>LEFT HAND</h3>
          <div id="left-hand" style="height: 300px;"></div>
          </div>
          <div class="col-md-6 right-hand">
          <h3>RIGHT HAND</h3>
          <div id="right-hand" style="height: 300px;"></div>
          </div>
          <div class="clear"></div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- /Sensor Graph -->
    </div>
    <!-- Training History Graph -->

    <div class="col-md-12 row">
        
    <div class="col-md-12 box box-primary no-padding">
      <div class="box-header margin-bottom graphic-box no-padding no-pad-top">
        <div class="traninig-graph">
            
<a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;margin-right: 40px" id="stroke_all">All</a>
<a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;" id="stroke_1k">1k STR</a>
<a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;" id="stroke_200">200 STR</a>
<a href="javascript:;" class="pull-right btn-param" style="margin:0px; margin-bottom: 15px;" id="stroke_50">50 STR</a>
              <h3 class="training-h3">Strokes </h3>

           
       
        <div id="Strokes" class="clear" style="height: 300px;margin-left: 3%;margin-right: 1%"></div>
        
        <div class="graphic-footer row">
                
                            <div class="graphic-footer row">
                                <a class="pull-left btn-param" href="#" style="margin-left:9.5%" data-toggle="modal" data-target="#myParam" id='link2'><i class="fa fa-cog"></i></a>
                                     <a href="javascript:;" class="pull-right btn-param" style=" margin-right: 10px;" id="skaliranje2"
                                                >X1</a>
                            </div>


                              <div class="example-modal">
                                    <div class="modal" id="myParam">
                                        <div class="modal-dialog">
                                            <div class="modal-content">


                                                <div class="modal-header no-border">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-param">
                                                        <h2>Choose parametars</h2>
                                                        <p>Choose three parametars from the list</p>
                                                    </div>
                                                 
                                                     <div id="progress-graph-params" class="param-box">
                                                          <ul class="checkbox icheck modalParm-list" >
                                                           
                                                           
                                                  
                                                            <li>
                                                                <label for="pace2km2">
                                                                    <input type="checkbox" class="parameters2" id="pace2km2" value="pace2k">
                                                                    <span class="pace2k2">Pace 2km</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                           
                                                            <li>
                                                                <label for="calories2">
                                                                    <input type="checkbox" class="parameters2" id="calories2" value="cal">
                                                                    <span class="cal2">Calories</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="time22">
                                                                    <input type="checkbox" class="parameters2" id="time22" value="time">
                                                                    <span class="time2">Time</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                          
                                                            <li>
                                                                <label for="pace500m2">
                                                                    <input type="checkbox" class="parameters2" id="pace500m2" value="pace500">
                                                                    <span class="pace5002">Pace 500m</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                           
                                                            <li>
                                                                <label for="strokeRate2">
                                                                    <input type="checkbox" class="parameters2" id="strokeRate2" value="srate">
                                                                    <span class="srate2">Stroke Rate</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="powerL2">
                                                                    <input type="checkbox" class="parameters2" id="powerL2" value="pwr_l">
                                                                    <span class="pwr_l2">Power L</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="distance22">
                                                                    <input type="checkbox" class="parameters2" id="distance22" value="dist">
                                                                    <span class="dist2">Distance</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="speed2">
                                                                    <input type="checkbox" class="parameters2" id="speed2" value="spd">
                                                                    <span class="spd2">Speed</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                         
                                                            <li>
                                                                <label for="hr2">
                                                                    <input type="checkbox" class="parameters2" id="hr2" value="hr">
                                                                    <span class="hr2">HR</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                           

                                                            <li>
                                                                <label for="power2">
                                                                    <input type="checkbox" class="parameters2" id="power2" value="pwr">
                                                                    <span class="pwr2">Power</span>
                                                                </label>
                                                            </li>
                                                            


                                                            <li>
                                                                <label for="powerR2">
                                                                    <input type="checkbox" class="parameters2" id="powerR2" value="pwr_r">
                                                                    <span class="pwr_r2">Power R</span>
                                                                </label>
                                                            </li>
                                                           
                                                            <li>
                                                                <label for="powerBalance2">
                                                                    <input type="checkbox" class="parameters2" id="powerBalance2" value="pwr_bal">
                                                                    <span class="pwr_bal2">Power balance</span>
                                                                </label>
                                                            </li>
                                                            
                                                            <li>
                                                                <label for="angleLeftAvg2">
                                                                    <input type="checkbox" class="parameters2" id="angleLeftAvg2" value="ang_l">
                                                                    <span class="ang_l2">Angle left average</span>
                                                                </label>
                                                            </li>
                                                           
                                                            <li>
                                                                <label for="angleRightAvg2">
                                                                    <input type="checkbox" class="parameters2" id="angleRightAvg2" value="ang_r">
                                                                    <span class="ang_r2">Angle right average</span>
                                                                </label>
                                                            </li>
                                                           
                                                            <li>
                                                                <label for="angle2">
                                                                    <input type="checkbox" class="parameters2" id="angle2" value="ang">
                                                                    <span class="ang2">Angle average</span>
                                                                </label>
                                                            </li>
                                                           
                                                           

                                                            <!-- End Parametar Item -->
                                                        </ul><!-- /.contatcts-list -->




                                                    </div>









                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                    

                                                    <button type="button" class="btn btn-primary  margin-r-5" id="dugme2"
                                                            onclick="var newHistoryParams = $('#progress-graph-params input:checked').map(function(){
                                                                    var value = $(this).val();
                                                                    var parameter = {
                                                                        slug: value,
                                                                        label: $('.'+value+'2').text(),
                                                                    }
                                                                    return parameter;
                                                                 }).get();
                                                                piktoBiorowerGraph2.loadHistoryData(newHistoryParams);           

                                                                  if(skaliranje2==500){

                                                                  }
                                                                  else if(skaliranje2==1000){

                                                                  }
                                                                  else if(skaliranje2==1500){
                                                    


                  
                                                                  }

                                                                 $('#myParam').modal('hide');">
                                                        Save changes
                                                    </button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div><!-- /.example-modal -->
                          </div>
         </div>
        </div>
        </div>
      </div>    <!-- /Training History Graph -->
     </div> 
      
      
      <div class="col-md-4 row no-padding col-right">
      
    <div class="margin-bottom row">
    <div class="box box-primary">
    <!-- Share Btn -->
    <div class="">
      <div class="pull-right">
      <div class="col-md-12 share-section">
      <button class="pull-right btn-link"><i class="fa fa-filter"></i></button>
<button class="pull-right margin-right btn-link"> <a  data-toggle="modal" data-target="#share-tranning"><i class="fa fa-share-alt  margin-right"></i> Share trainning</a>
 </button>

</div>

 
   <div class="share-tranning-modal">
            <div class="modal" id="share-tranning">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Share your tranning </h4>
                  </div>
                  <div class="modal-body">
                  <div class="modal-choose">
                                      <!-- Twitter -->
      <a rel="nofollow" data-shared="sharing-twitter-650" class="btn btn-social-icon btn-sm btn-twitter margin-right" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=twitter&amp;nb=1" target="_blank" title="Click to share on Twitter"><i class="fa fa-twitter"></i></a>
 <!-- Facebook -->
<a rel="nofollow" data-shared="sharing-facebook-650" class="btn btn-social-icon btn-sm btn-facebook margin-right" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=facebook&amp;nb=1" target="_blank" title="Click to share on Facebook"><i class="fa fa-facebook"></i></a>
<!-- Google+ -->
<a rel="nofollow" data-shared="sharing-google-650" class="btn btn-social-icon btn-sm btn-google margin-right" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=google-plus-1&amp;nb=1" target="_blank" title="Click to share on Google+"><i class="fa fa-google-plus"></i></a>
<!-- Pinterest -->
<a rel="nofollow" data-shared="sharing-pinterest-650" class="btn btn-social-icon btn-sm btn-pinterest margin-right" href="http://blog.himpfen.com/social-sharing-buttons-bootstrap-font-awesome/?share=pinterest&amp;nb=1" target="_blank" title="Click to share on Pinterest"><i class="fa fa-pinterest"></i></a>

            </div>
                  </div>
                  <div class="clear">
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
                <div class="box-body">
                </div><!-- /.box-body -->
             
</div>
      </div>
     <!-- ./ End of Share Btn -->
      <div class="row">
      <br><br><br>
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="time">{{  gmdate(config('parameters.time.format'), $sessionUser['sessionSummary']->time) }}</h5>
            <span class="description-text">Time</span> {{  config('parameters.time.unit') }} </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col -->
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="stroke_count">{{$sessionUser['sessionSummary']->stroke_count}}</h5>
            <span class="description-text">Stroke Count</span> </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col -->
        
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="distance"> <span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->distance, config('parameters.dist.format'))}}</h5>
            <span class="description-text">Distance </span> {{ config('parameters.dist.unit') }} </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col -->
        <div class="col-sm-6 col-xs-12">
          <div class="description-block">
            <h5 class="description-header" id="stroke_rate"><span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->stroke_rate_average, config('parameters.srate_avg.format'))}}</h5>
            <span class="description-text">Stroke rate Average</span> {{ config('parameters.srate_avg.unit') }} </div>
          <!-- /.description-block --> 
        </div>
      </div>
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="stroke_rate_max"> <span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->stroke_rate_max, config('parameters.srate_max.format'))}}</h5>
          <span class="description-text">Stroke rate MAX</span> {{ config('parameters.srate_max.unit') }} </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="hr"> <span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->heart_rate_average, config('parameters.hr_avg.format'))}}</h5>
          <span class="description-text">Heart Rate Average</span> {{ config('parameters.hr_avg.unit') }}  </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="hr_max"><span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->heart_rate_max, config('parameters.hr_nax.format'))}}</h5>
          <span class="description-text">Heart Rate MAX</span> {{ config('parameters.hr_max.unit') }}  </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="pace">{{gmdate(config('parameters.pace500_avg.format'), round($sessionUser['sessionSummary']->pace_average))}}</h5>
          <span class="description-text">Pace 500m</span> {{ config('parameters.pace500_avg.unit') }}  </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="speed"> <span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->speed_average, config('parameters.spd_avg.format'))}}</h5>
          <span class="description-text">Speed Average</span> {{ config('parameters.spd_avg.unit') }}  </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="power"> <span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->power_average, config('parameters.pwr_avg.format'))}}</h5>
          <span class="description-text">Power Average</span> {{ config('parameters.pwr_avg.unit') }}  </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="power_max"> <span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->power_max, config('parameters.pwr_max.format'))}}</h5>
          <span class="description-text">Power MAX</span> {{ config('parameters.pwr_max.unit') }}  </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff-h2" id="power_balance">{{round($sessionUser['sessionSummary']->power_balance, config('parameters.pwr_bal_avg.format'))}}</h5>
          <span class="description-text">Power Balance</span> {{ config('parameters.pwr_bal_avg.unit') }} </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="clear"></div>
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="angle">{{round($sessionUser['sessionSummary']->angle_average, config('parameters.ang_avg.format'))}}</h5>
            <span class="description-text">Angle</span> {{ config('parameters.ang_avg.unit') }} </div>
          <!-- /.description-block -->
        </div> 
        <!-- /.col -->
        <div class="col-sm-6 col-xs-12">
          <div class="description-block">
            <h5 class="description-header diff" id="calories"><span class="description-percentage"></span>{{round($sessionUser['sessionSummary']->calories, config('parameters.cal.format'))}}</h5>
            <span class="description-text">Calories</span> {{ config('parameters.cal.unit') }} </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col --> 
        </div>
      </div>
      <div class="clear"></div>
      
      

    </div>
    <div class="row pull-right">
    <div class="box box-primary">
       <!-- Note/CommentS --> 
      <div class="note-comment">
      <div class="">
       <!-- Note Section -->
       <div class="note">
       <div class="note-bg">
       <p>I need to work on my strength</p>
       </div>
       <div class="note-footer-bg">
        <div class="btn-group pull-left">
                      <button class="btn btn-link btn-sm"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-link btn-sm"><i class="fa fa-times"></i></button>
            <button class="btn btn-link btn-sm"><i class="fa fa-plus"></i></button>
                    </div>
       <p class="pull-right">February 15, 2016 20:00<p>
       <div class="clear"></div>
       </div>
       </div>
<form>
<textarea placeholder="Leave a note" class="note-textarea" row="5"></textarea>
</form>
                   <!-- ./Note Section -->

      <!-- Comments Section --> 
<div class="leave-a-comment">

                <div class="box-footer">
                  <form action="<?php echo Request::root() ?>/sessions/comment" method="post">
                  <input type="hidden" id="session_id" name="session_id" value="<?php echo $decodedID  ?>">
                    <img class="img-responsive img-circle img-sm" src="dist/img/user4-128x128.jpg" alt="alt text">
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push">
                      <input type="text" class="form-control input-sm" placeholder="Press enter to post comment" name="comment" id="comment" value="fafsf">
                    </div>
                  </form>
                </div><!-- /.box-footer -->
                <div class='box-footer box-comments'>
                <?php echo $allComments; ?>
                </div><!-- /.box-footer -->

</div>      
 <!-- ./Comments Section --> 
 </div>
</div>
</div>
 </div>
 </div>
  </div>
  </div>

  <!-- /.row --> 
  
</section>
<!-- /.content -->

<!-- /.content-wrapper --> 

       

      <!-- /.row --> 
      

    <!-- /.content --> 
    
    <aside class="control-sidebar control-sidebar-dark chat-open-right">
    <div>
          <!-- Home tab content -->
          <div class="tab-pane chat-panel" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
            <li class="activity-li">
                <a href="javascript::;">
            <div class="pull-left chat-user-image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                  <div class="activity-item">
                     <p class="activity-news">
                              <span class="activity-username">Count Dracula</span> was training today, see his profile
                              <small class="activity-date btn-block text-left text-muted">28 THU 2016</small>
                            </p>
                  </div>
                </a>
              </li>
              
              <!-- Activity 1-->
              <li class="activity-li">
                <a href="javascript::;" >
            <div class="pull-left chat-user-image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                  <div class="activity-item">
                    <p class="activity-news"><span class="activity-username">Langdon Gold</span> was online 3 minutes ago 
                     <small class="activity-date btn-block text-left text-muted">3 minutes ago</small>
                     </p>
                  </div>
                </a>
              </li>
              <!-- Activity 2 -->
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading no-margin">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="#chat-1" data-toggle="collapse">
                  <div class="pull-left chat-user-image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p class="user-state"><i class="fa fa-circle text-warning"></i> Online</p>
                  </div>
                </a>
             </li><!-- Contact 1 -->
              <li>
                <a href="#chat-2" data-toggle="collapse">
                  <div class="pull-left chat-user-image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p class="user-state"><i class="fa fa-circle text-success"></i> Online</p>
                  </div>
                </a>
              </li><!-- Contact 2 -->
              <li>
                <a href="#chat-3" data-toggle="collapse">
                  <div class="pull-left chat-user-image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p class="user-state"><i class="fa fa-circle text-danger"></i> Online</p>
                  </div>
                </a>
              </li><!-- Contact 3 -->
              <li>
                <a href="#chat-3" data-toggle="collapse">
            <div class="pull-left chat-user-image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p class="user-state"><i class="fa fa-circle text-muted"></i> Online</p>
                  </div>
                </a>
              </li><!-- Contact 4 -->
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
        </div>
      </aside>

 
@endsection
