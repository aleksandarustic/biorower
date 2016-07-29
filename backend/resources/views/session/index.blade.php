

@extends('layouts.main')
@section('page-scripts')
    <!-- DataTables -->
  <!-- <link rel="canonical" href="{{ Request::url() }}" /> -->
     <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/skin-blue.min.css') }}">
     
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    
    <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">    
<script src="{{ URL::asset('js/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 --> 
<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
<!-- AdminLTE App --> 
<script src="{{ URL::asset('js/jquery-ui-multiselect-widget/jquery.multiselect.css') }}"></script>
<!-- FLOT CHeartS --> 
<script src="{{ URL::asset('plugins/flot/jquery.flot.min.js') }}"></script>

 <script src="{{ Request::root() }}/../node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
 


<!-- FLOT RESIZE PLUGIN - allows the cHeart to redraw when the window is resized --> 

<script src="{{ URL::asset('plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.canvas.js') }}"></script>

<script src="{{ URL::asset('plugins/flot/jquery.flot.animator.min.js') }}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar cHearts --> 
<script src="{{ URL::asset('plugins/flot/jquery.flot.categories.min.js') }}"></script>

<script src="{{ URL::asset('plugins/flot/jquery.flot.navigate.js') }}"></script>

<script type="text/javascript">

  $(function() {

      var urlBase = "<?php echo Request::root() ?>";
     var email1="<?php echo Auth::user()->email ?>"; 
     var display_name= "<?php echo Auth::user()->display_name ?>"; 
     
     var email2="biorower:"+email1;
     var idsesije="<?php echo $decodedID ?>"; 
     var niz =[];
     niz.push(idsesije);

          $.ajax({ 
            type: 'POST', 
            dataType: 'json',
            url : urlBase + '/api/v1/sessions_recent',
            data: {account: email2 
          

        }, 
            success: function (data) {
             
              var sesije=data.sessionIdsUTCs;
              var idijevi=[];

           
               for(var i=0;i< sesije.length; i++){
                idijevi.push(sesije[i].sessionID);


               }

                 var next=document.getElementById("next");
     var previous=document.getElementById("previous");
  previous.addEventListener('click', function() {
       for(var i=0;i< idijevi.length; i++){
              if(idijevi[i]==idsesije){
                
                
                
                previous.setAttribute("href", urlBase+"/profile/"+display_name+"/session/"+idijevi[i+1]);
               

              }


               }
               

    }, false);


     next.addEventListener('click', function() {
       for(var i=0;i< idijevi.length; i++){
              if(idijevi[i]==idsesije){
                
                next.setAttribute("href", urlBase+"/profile/"+display_name+"/session/"+idijevi[i-1]);
               

              }


               }
               

    }, false);

              

            }
          });






    



    
     
     



     
     
        
          $.ajax({ 
            type: 'POST', 
            dataType: 'json',
            url : urlBase + '/api/v1/sessions_get',
            data: {account: email2 ,sessionIds:niz
          

        }, 
            success: function (data) {
              
              var dat=data.sessions;
              var sesija2;
              var split;
             

                for(var i=0;i< dat.length; i++){
                  
                 
                   sesija2=dat[i].summary;
                   split=dat[i].splits;

             
            }



            
            document.getElementById("time").innerHTML = sesija2.time;
            document.getElementById("stroke_count").innerHTML = sesija2.stroke_count;
            document.getElementById("distance").innerHTML = sesija2.distance+"<span class='description-percentage'>km</span>";
            document.getElementById("stroke_rate").innerHTML = sesija2.stroke_rate_average+"<span class='description-percentage'>spm</span>";
            document.getElementById("stroke_rate_max").innerHTML = sesija2.stroke_rate_max+"<span class='description-percentage'>spm</span>";
            document.getElementById("hr").innerHTML = sesija2.heart_rate_average+"<span class='description-percentage'>bpm</span>";
            document.getElementById("hr_max").innerHTML = sesija2.heart_rate_max+"<span class='description-percentage'>bpm</span>";
            document.getElementById("pace").innerHTML = sesija2.pace_average;
            document.getElementById("speed").innerHTML = sesija2.speed_average+"<span class='description-percentage'>km/h</span>";
            document.getElementById("power").innerHTML = sesija2.power_average+"<span class='description-percentage'>W</span>";
            document.getElementById("power_max").innerHTML = sesija2.power_max+"<span class='description-percentage'>W</span>";
            document.getElementById("power_balance").innerHTML = sesija2.power_balance+"<span class='description-percentage'>W</span>";
            document.getElementById("angle").innerHTML = sesija2.angle_average;

            document.getElementById("calories").innerHTML ="<span class='description-percentage'>kCal</span>";
            document.getElementById("uvod").innerHTML="BY <a href='profile.html'><?php echo $id; ?></a>"+" "+dat[0].date;
           

                      

            
          }
          });




    // generate data set from a parametric function with a fractal look
     var sin = [], cos = [];
        for (var i = 0; i < 14; i += 0.25) {
          sin.push([i, Math.sin(i)]);
        }
        var d1 = {
          data: sin,
          color: "#3c8dbc",
      label: 'Left Forse',
        };

    var d2 = {
      label:'Right Forse',
      data: [[0, 5], [1, 5], [2, 35], [2.2, 36], [2.4, 36.6], [2.6, 37.2], [2.8, 37.4], [3, 36.6],[3.5, 36.2], [3.7, 35.7], [4, 35], [5, 5], [7, 25], [8, 24], [1, 21], [2, 16], [3, 10], [4, 7]]};
    var d3 = {
    label:'Right Forse',
    data: [[5, 3], [6, 2], [9, 8], [5, 12]]};

    var data =
     [ d1, d2, d3 ]
      placeholder = $("#signals-graph");

    var plot = $.plotAnimator(placeholder, data,
    
     {
      
      grid: {
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3",
      },
      splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
      series: {
        lines: {
          show: true,
          //fill: true
        },
        shadowSize: 0,
        legend: {
          noColumns: 5,
        },
      },
      xaxis: {
        zoomRange: [0.1, 10],
        panRange: [-10, 10]
      },
      yaxis: {
        zoomRange: [0.1, 10],
        panRange: [-10, 10]
      },
      zoom: {
        interactive: true
      },
      pan: {
        interactive: true
      }
    });

    placeholder.bind("plotzoom", function (event, plot) {
      var axes = plot.getAxes();
      $(".message").html("Zooming to x: "  + axes.xaxis.min.toFixed(2)
      + " &ndash; " + axes.xaxis.max.toFixed(2)
      + " and y: " + axes.yaxis.min.toFixed(2)
      + " &ndash; " + axes.yaxis.max.toFixed(2));
    });

    // add zoom out button 

    $("<div class='button fa fa-icon' id='icon-zoomOut' style='right:44px; top:46px;'></div>")
      .appendTo(placeholder)
      .click(function (event) {
        event.preventDefault();
        plot.zoomOut();
      });

$("<div class='button' id='icon-zoomIn' style='right:44px; top:22px;'></div>")
      .appendTo(placeholder)
      .click(function (event) {
        event.preventDefault();
        plot.zoom();
      });
      
      var axes = plot.getAxes(),
    xaxis = axes.xaxis.options,
    yaxis = axes.yaxis.options;
xaxis.min = null;
xaxis.max = null;
yaxis.min = null;
yaxis.max = null;

// Don't forget to redraw the plot
plot.setupGrid();
plot.draw();
    // and add panning buttons

    // little helper for taking the repetitive work out of placing
    // panning arrows
 var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Time(s)").appendTo($('#signals-graph'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#signals-graph'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
  });


 //Line Graph - Left Hand

  $(function() {
  var xAsis = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
    var d1 = [[1264982400000, 13], [1267401600000, 15], [1270080000000, 18], [1272672000000, 23], [1275350400000, 27], [1277942400000, 30], [1280620800000, 30], [1283299200000, 27], [1285891200000, 22], [1288569600000, 16], [1291161600000, 13]];
var d2 = [[1264982400000, 12], [1291161600000, 12]];
  
 
$(function () {        
    $.plotAnimator($("#left-hand"),
        [{
              data: d1,
        color: "#536A7F",
        lines: { show: true, color: "#536A7F", fillColor: "#536A7F" },
        points: { show: false, fill:true }
            },
      {
              data: d2,
        color: "#3c8dbc",
        lines: { show: true, color: "#3c8dbc" },
        points: { show: false, fill:true }
            }
        ],{            
            grid: {
                hoverable: false, 
                clickable: false, 
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3" 
            },
      shadowSize: 0,
      legend: {
          noColumns: 1,
        },
      yaxis: {
            show: true,
          },
            xaxis:{
         ticks: [
                            [1262304000000, ""], [1264982400000, "-90°" ], [1267401600000, ""], [1270080000000, ""], [ 1272672000000, ""], [1275350400000, ""], [1277942400000, "0"], [1280620800000, ""], [1285891200000, ""], [1285891200000, ""], [1288569600000, ""], [1291161600000, "60°"]
                   ]
            }     
        }
    );
   var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Angle(°)").appendTo($('#left-hand'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Forse(N)").appendTo($('#left-hand'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

});
  }); 

 //Line Graph - Right Hand

  $(function() {
  var xAsis = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
    var d1 = [[1264982400000, 13], [1267401600000, 15], [1270080000000, 18], [1272672000000, 23], [1275350400000, 27], [1277942400000, 30], [1280620800000, 30], [1283299200000, 27], [1285891200000, 22], [1288569600000, 16], [1291161600000, 13]];
var d2 = [[1264982400000, 12], [1291161600000, 12]];
  
 
$(function () {        
    $.plotAnimator($("#right-hand"),
        [{
              data: d1,
        color: "#3c8dbc",
        lines: { show: true, color: "#3c8dbc", fillColor: "#3c8dbc" },
        points: { show: false, fill:true }
            },
      {
              data: d2,
        color: "#3c8dbc",
        lines: { show: true, color: "3c8dbc" },
        points: { show: false, fill:true }
            }
        ],{            
            grid: {
                hoverable: false, 
                clickable: false, 
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3" 
            },
      shadowSize: 0,
      legend: {
          noColumns: 1,
        },
      yaxis: {
            show: true,
          },
            xaxis:{
         ticks: [
                            [1262304000000, ""], [1264982400000, "-90°" ], [1267401600000, ""], [1270080000000, ""], [ 1272672000000, ""], [1275350400000, ""], [1277942400000, "0"], [1280620800000, ""], [1285891200000, ""], [1285891200000, ""], [1288569600000, ""], [1291161600000, "60°"]
                   ]
            }     
        }
    );
   var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Angle(°)").appendTo($('#right-hand'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Forse(N)").appendTo($('#right-hand'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

});

  }); 

<!--  Traoining History Graph -->

  $(function() {

var d1 = [
    [0, 650], [1.5,420], [3.5, 420],[4.2, 220], [5, 420], [20, 420], [20, 420], 
];
 var d2 = [
    [0,190], [1,190], [3.5, 190], [3.5, 190], [4.2, 20], [5, 190], [20, 190],
];
var d3 = [
     [0,0], [20,0],
];


$(function () {        
    $.plotAnimator($("#train-history"),
        [{
              data: d1,
        label:'Power(W)',
        color: "#3c8dbc",
        lines: { show: true, color: "#3c8dbc" },
        points: { show: false }
            },{
      data: d2,
      label:'Stroke rate(spm)',
        color: "#b8c7ce",
        lines: { show: true, color: "#b8c7ce" },
        points: { show: false }
            },
      {
              data: d3,
        label:'Heart rate(bpm)',
        color: "#536A7F",
        lines: { show: true, color: "#536A7F" },
        points: { show: false }
            },
        ],{            
            grid: {
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3" 
            },
      shadowSize: 0,
      legend: {
          noColumns: 1,
        },
      yaxis: {
            show: true,
          },
            xaxis:{
        show: true,
            }     
        }
    );
 var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Strokes(spm)").appendTo($('#train-history'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#train-history'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

});

  }); 
  
  
  </script> 
<!-- REQUIRED JS SCRIPTS --> 


<script type="text/javascript">

  $(function() {

    // generate data set from a parametric function with a fractal look
     var sin = [], cos = [];
        for (var i = 0; i < 14; i += 0.25) {
          sin.push([i, Math.sin(i)]);
        }
        var d1 = {
          data: sin,
          color: "#3c8dbc",
      label: 'Left Forse',
        };

    var d2 = {
      label:'Right Forse',
      data: [[0, 5], [1, 5], [2, 35], [2.2, 36], [2.4, 36.6], [2.6, 37.2], [2.8, 37.4], [3, 36.6],[3.5, 36.2], [3.7, 35.7], [4, 35], [5, 5], [7, 25], [8, 24], [1, 21], [2, 16], [3, 10], [4, 7]]};
    var d3 = {
    label:'Right Forse',
    data: [[5, 3], [6, 2], [9, 8], [5, 12]]};

    var data =
     [ d1, d2, d3 ]
      placeholder = $("#signals-graph");

    var plot = $.plotAnimator(placeholder, data,
    
     {
      
      grid: {
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3",
      },
      splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
      series: {
        lines: {
          show: true,
          //fill: true
        },
        shadowSize: 0,
        legend: {
          noColumns: 5,
        },
      },
      xaxis: {
        zoomRange: [0.1, 10],
        panRange: [-10, 10]
      },
      yaxis: {
        zoomRange: [0.1, 10],
        panRange: [-10, 10]
      },
      zoom: {
        interactive: true
      },
      pan: {
        interactive: true
      }
    });

    placeholder.bind("plotzoom", function (event, plot) {
      var axes = plot.getAxes();
      $(".message").html("Zooming to x: "  + axes.xaxis.min.toFixed(2)
      + " &ndash; " + axes.xaxis.max.toFixed(2)
      + " and y: " + axes.yaxis.min.toFixed(2)
      + " &ndash; " + axes.yaxis.max.toFixed(2));
    });

    // add zoom out button 

    $("<div class='button fa fa-icon' id='icon-zoomOut' style='right:44px; top:46px;'></div>")
      .appendTo(placeholder)
      .click(function (event) {
        event.preventDefault();
        plot.zoomOut();
      });

$("<div class='button' id='icon-zoomIn' style='right:44px; top:22px;'></div>")
      .appendTo(placeholder)
      .click(function (event) {
        event.preventDefault();
        plot.zoom();
      });
      
      var axes = plot.getAxes(),
    xaxis = axes.xaxis.options,
    yaxis = axes.yaxis.options;
xaxis.min = null;
xaxis.max = null;
yaxis.min = null;
yaxis.max = null;

// Don't forget to redraw the plot
plot.setupGrid();
plot.draw();
    // and add panning buttons

    // little helper for taking the repetitive work out of placing
    // panning arrows
 var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Time(s)").appendTo($('#signals-graph'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#signals-graph'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
  });


 //Line Graph - Left Hand

  $(function() {
  var xAsis = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
    var d1 = [[1264982400000, 13], [1267401600000, 15], [1270080000000, 18], [1272672000000, 23], [1275350400000, 27], [1277942400000, 30], [1280620800000, 30], [1283299200000, 27], [1285891200000, 22], [1288569600000, 16], [1291161600000, 13]];
var d2 = [[1264982400000, 12], [1291161600000, 12]];
  
 
$(function () {        
    $.plotAnimator($("#left-hand"),
        [{
              data: d1,
        color: "#536A7F",
        lines: { show: true, color: "#536A7F", fillColor: "#536A7F" },
        points: { show: false, fill:true }
            },
      {
              data: d2,
        color: "#3c8dbc",
        lines: { show: true, color: "#3c8dbc" },
        points: { show: false, fill:true }
            }
        ],{            
            grid: {
                hoverable: false, 
                clickable: false, 
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3" 
            },
      shadowSize: 0,
      legend: {
          noColumns: 1,
        },
      yaxis: {
            show: true,
          },
            xaxis:{
         ticks: [
                            [1262304000000, ""], [1264982400000, "-90°" ], [1267401600000, ""], [1270080000000, ""], [ 1272672000000, ""], [1275350400000, ""], [1277942400000, "0"], [1280620800000, ""], [1285891200000, ""], [1285891200000, ""], [1288569600000, ""], [1291161600000, "60°"]
                   ]
            }     
        }
    );
   var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Angle(°)").appendTo($('#left-hand'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Forse(N)").appendTo($('#left-hand'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

});
  }); 

 //Line Graph - Right Hand

  $(function() {
  var xAsis = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
    var d1 = [[1264982400000, 13], [1267401600000, 15], [1270080000000, 18], [1272672000000, 23], [1275350400000, 27], [1277942400000, 30], [1280620800000, 30], [1283299200000, 27], [1285891200000, 22], [1288569600000, 16], [1291161600000, 13]];
var d2 = [[1264982400000, 12], [1291161600000, 12]];
  
 
$(function () {        
    $.plotAnimator($("#right-hand"),
        [{
              data: d1,
        color: "#3c8dbc",
        lines: { show: true, color: "#3c8dbc", fillColor: "#3c8dbc" },
        points: { show: false, fill:true }
            },
      {
              data: d2,
        color: "#3c8dbc",
        lines: { show: true, color: "3c8dbc" },
        points: { show: false, fill:true }
            }
        ],{            
            grid: {
                hoverable: false, 
                clickable: false, 
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3" 
            },
      shadowSize: 0,
      legend: {
          noColumns: 1,
        },
      yaxis: {
            show: true,
          },
            xaxis:{
         ticks: [
                            [1262304000000, ""], [1264982400000, "-90°" ], [1267401600000, ""], [1270080000000, ""], [ 1272672000000, ""], [1275350400000, ""], [1277942400000, "0"], [1280620800000, ""], [1285891200000, ""], [1285891200000, ""], [1288569600000, ""], [1291161600000, "60°"]
                   ]
            }     
        }
    );
   var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Angle(°)").appendTo($('#right-hand'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Forse(N)").appendTo($('#right-hand'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

});

  }); 

<!--  Traoining History Graph -->

  $(function() {

var d1 = [
    [0, 650], [1.5,420], [3.5, 420],[4.2, 220], [5, 420], [20, 420], [20, 420], 
];
 var d2 = [
    [0,190], [1,190], [3.5, 190], [3.5, 190], [4.2, 20], [5, 190], [20, 190],
];
var d3 = [
     [0,0], [20,0],
];


$(function () {        
    $.plotAnimator($("#train-history"),
        [{
              data: d1,
        label:'Power(W)',
        color: "#3c8dbc",
        lines: { show: true, color: "#3c8dbc" },
        points: { show: false }
            },{
      data: d2,
      label:'Stroke rate(spm)',
        color: "#b8c7ce",
        lines: { show: true, color: "#b8c7ce" },
        points: { show: false }
            },
      {
              data: d3,
        label:'Heart rate(bpm)',
        color: "#536A7F",
        lines: { show: true, color: "#536A7F" },
        points: { show: false }
            },
        ],{            
            grid: {
                backgroundColor: false,
         borderColor: "#f3f3f3",
            borderWidth: 1,
            tickColor: "#f3f3f3" 
            },
      shadowSize: 0,
      legend: {
          noColumns: 1,
        },
      yaxis: {
            show: true,
          },
            xaxis:{
        show: true,
            }     
        }
    );
 var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Strokes(spm)").appendTo($('#train-history'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#train-history'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);

});

  }); 
  
  
  </script> 

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
                    <div class="btn btn-primary btn-sm pull-right">Reset Zoom</div>
          <form class="pull-right">
          <input type="text" placeholder="Go to" name="go-to-zoom" class="go-to-zoom margin-r-5 btn-sm">
          </form>
          </div>
          <div class="clear"></div>
          <div id="signals-graph" class="demo-placeholder" style="height: 300px;"></div>
          <div class="graphic-footer row">
                  <div class="pull-right btn-param"><i class="fa fa-cog"></i></div>
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
        <div class="traninig-graph-header">
              <h3 class="training-h3">Training History</h3>

        <div class="traninig-graph-tab graphBtn-tab pull-right">
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
                  <li class="active"><a href="#revenue-chart" data-toggle="tab" aria-expanded="true">All</a></li>
                  <li class=""><a href="#sales-chart" data-toggle="tab" aria-expanded="false">Week</a></li>
                  <li class=""><a href="#revenue-chart" data-toggle="tab" aria-expanded="false">Month</a></li>
                  <li class=""><a href="#sales-chart" data-toggle="tab" aria-expanded="false">Year</a></li>
                </ul>
</div>
     </div>   
        <div id="train-history" class="clear" style="height: 300px;"></div>
        <div class="graphic-footer row">
                  <div class="pull-right btn-param"><i class="fa fa-cog"></i></div>
                          </div>
        </div>
        </div>
      </div>    <!-- /Training History Graph -->
      </div>
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
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="time"></h5>
            <span class="description-text">Time</span> </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col -->
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="stroke_count"></h5>
            <span class="description-text">Stroke Count</span> </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col -->
        
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="distance"> <span class="description-percentage">km</span></h5>
            <span class="description-text">Distance </span> </div>
          <!-- /.description-block --> 
        </div>
        <!-- /.col -->
        <div class="col-sm-6 col-xs-12">
          <div class="description-block">
            <h5 class="description-header" id="stroke_rate"><span class="description-percentage">spm</span></h5>
            <span class="description-text">Stroke rate</span> </div>
          <!-- /.description-block --> 
        </div>
      </div>
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="stroke_rate_max"> <span class="description-percentage">spm</span></h5>
          <span class="description-text">Stroke rate MAX</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="hr"> <span class="description-percentage">bpm</span></h5>
          <span class="description-text">HR</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="hr_max"><span class="description-percentage">bpm</span></h5>
          <span class="description-text">HR MAX</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="pace"></h5>
          <span class="description-text">Pace 500m</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="speed"> <span class="description-percentage">km/h</span></h5>
          <span class="description-text">Speed</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="power"> <span class="description-percentage">W</span></h5>
          <span class="description-text">Power</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff" id="power_max"> <span class="description-percentage">W</span></h5>
          <span class="description-text">Power MAX</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="col-sm-6 col-xs-12">
        <div class="description-block border-right">
          <h5 class="description-header diff-h2" id="power_balance"></h5>
          <span class="description-text">Power Balance</span> </div>
        <!-- /.description-block --> 
      </div>
      <!-- /.col -->
      <div class="clear"></div>
      <div class="row">
        <div class="col-sm-6 col-xs-12">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="angle"></h5>
            <span class="description-text">Angle</span> </div>
          <!-- /.description-block --> 
        <!-- /.col -->
        <div class="col-sm-6 col-xs-12 height-fix">
          <div class="description-block border-right">
            <h5 class="description-header diff" id="calories"><span class="description-percentage">kCal</span></h5>
            <span class="description-text">Calories</span> </div>
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
  </div>
  <!-- /.row --> 
  
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper --> 

       
</div>
      <!-- /.row --> 
      
    </section>
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








