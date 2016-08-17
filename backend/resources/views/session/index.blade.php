@extends('layouts.main')
@section('page-scripts')
    <!-- DataTables -->
  <!-- <link rel="canonical" href="{{ Request::url() }}" /> -->
     <link rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/skin-blue.min.css') }}">
     
    <!-- Font Awesome -->
  
    <!-- Theme style -->
    
    <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">    
<script src="{{ URL::asset('js/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 --> 
<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
<!-- AdminLTE App --> 

<!-- FLOT CHeartS --> 
<script src="{{ URL::asset('plugins/flot/jquery.flot.min.js') }}"></script>

 


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
            data: {account: email2 ,sessionIds:niz,pc:"1",
          

        }, 
            success: function (data) {
                
        
              var dat=data.sessions;
              var sesija2;
              var split;
          
             

                for(var i=0;i< dat.length; i++){
                  
                 
                   sesija2=dat[i].summary;
                   split=dat[i].splits;


                  
            }




            var time=[];

            var nizPower=[];
          
            var angle_r=[];
            var angle_l=[];
            var force_r=[];
            var force_l=[];
            var power_l=[];
            var power_r=[];
            var angle_Ltime=[];
            var angle_Rtime=[];
            
            var speed2=[];
            var pace2500=[];
            var pace2km2=[];
            var strokerate2=[];
            var distance2=[];
            var calories2=[];
            var powerbalance2=[];
            var powerL2=[];
            var powerR2=[];
            var angle5=[];
            var angle5L=[];
            var angle5R=[];
            var hr2=[];


              for(var i2=0;i2< split[0].length; i2++){
                  
  

                angle_r.push(split[0][i2].signal.ang_r);
                pace2500.push(i2);
                pace2500.push(split[0][i2].pace500);
                hr2.push(i2);
                hr2.push(split[0][i2].hr);
                powerbalance2.push(i2);
                powerbalance2.push(split[0][i2].pwr_bal);
                pace2km2.push(i2);
                pace2km2.push(split[0][i2].pace2k);
                powerL2.push(i2);
                powerL2.push(split[0][i2].pwr_l);
                powerR2.push(i2);
                powerR2.push(split[0][i2].pwr_r);
                angle5.push(i2);
                angle5.push(split[0][i2].ang);
                angle5L.push(i2);
                angle5L.push(split[0][i2].ang_l);
                angle5R.push(i2);
                angle5R.push(split[0][i2].ang_r);
                strokerate2.push(i2);
                strokerate2.push(split[0][i2].srate);
                calories2.push(i2);
                calories2.push(split[0][i2].cal);
                speed2.push(i2);
                speed2.push(split[0][i2].spd);
                distance2.push(i2);
                distance2.push(split[0][i2].dist);
                angle_l.push(split[0][i2].signal.ang_l);
                force_r.push(split[0][i2].signal.frc_r);
                force_l.push(split[0][i2].signal.frc_l);


                 nizPower.push(i2);
                 nizPower.push(split[0][i2].pwr);
                 time.push(i2);
                 time.push(split[0][i2].time);
             



    
                
                
                  
            }
            
           
           



            var nizForceL2=[];
            var nizForceR2=[];
            
           

             for(var i3=0;i3< angle_r.length; i3++){
                 
                   var tt=0;
                  
                


               for(var i4=0;i4< angle_r[i3].length; i4++){
                    tt=tt+0.01;
                 
                  
                     
                  
                   
                power_l.push(tt);
                power_l.push(force_l[i3][i4]);
                power_r.push(tt);
                power_r.push(force_r[i3][i4]);
                
                 angle_Ltime.push(tt);
                  angle_Ltime.push(angle_l[i3][i4]);
                  angle_Rtime.push(tt);
                  angle_Rtime.push(angle_r[i3][i4]);
               

                
                  nizForceL2.push(angle_l[i3][i4]);
                  nizForceL2.push(force_l[i3][i4]);
                  nizForceR2.push(angle_r[i3][i4]);
                  nizForceR2.push(force_r[i3][i4]);
                   }
             }
          
            var nizTime=[];
            var power_l2=[];
            var power_r2=[];
            var power1=[];
            var forceL1=[];
            var forceR1=[];
            var angle_Ltime2=[];
            var angle_Rtime2=[];
            
            var speed3=[];
            var pace3500=[];
            var pace2km3=[];
            var strokerate3=[];
            var distance3=[];
            var calories3=[];
            var powerbalance3=[];
            var powerL3=[];
            var powerR3=[];
            var angle3=[];
            var angle3L=[];
            var angle3R=[];
            var hr3=[];
            
          while(speed2.length) speed3.push(speed2.splice(0,2));
          while(pace2500.length) pace3500.push(pace2500.splice(0,2));
          while(pace2km2.length) pace2km3.push(pace2km2.splice(0,2));
          while(strokerate2.length) strokerate3.push(strokerate2.splice(0,2));
          while(distance2.length) distance3.push(distance2.splice(0,2));
          while(calories2.length) calories3.push(calories2.splice(0,2));
          while(powerbalance2.length) powerbalance3.push(powerbalance2.splice(0,2));
          while(powerL2.length) powerL3.push(powerL2.splice(0,2)); 
          while(powerR2.length) powerR3.push(powerR2.splice(0,2));
          while(angle5.length) angle3.push(angle5.splice(0,2));
          while(angle5L.length) angle3L.push(angle5L.splice(0,2));
          while(angle5R.length) angle3R.push(angle5R.splice(0,2)); 
            
          while(hr2.length) hr3.push(hr2.splice(0,2));
          while(angle_Rtime.length) angle_Rtime2.push(angle_Rtime.splice(0,2));
          while(angle_Ltime.length) angle_Ltime2.push(angle_Ltime.splice(0,2));
          while(power_l.length) power_l2.push(power_l.splice(0,2));
          while(power_r.length) power_r2.push(power_r.splice(0,2));
          while(nizPower.length) power1.push(nizPower.splice(0,2));
          while(time.length) nizTime.push(time.splice(0,2));
          while(nizForceL2.length) forceL1.push(nizForceL2.splice(0,2));
          while(nizForceR2.length) forceR1.push(nizForceR2.splice(0,2));
          
            var d19={
              data:hr3,
        label:'heart rate(bmp)',
   
         yaxis:9,
        lines: { show: true, },
        points: { show: false}
            }  ; 
          
          var d18={
              data:calories3,
        label:'calories(kCal)',
   
         yaxis:8,
        lines: { show: true, },
        points: { show: false}
            }  ; 
          
        var d17={
              data:angle3R,
        label:'angle3 right(+)',
   
         yaxis:7,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
        var d16={
              data:angle3L,
        label:'angle3 left(+)',
   
         yaxis:7,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
        var d15={
              data:angle3,
        label:'angle(+)',
   
         yaxis:7,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
         var d14={
              data:strokerate3,
        label:'stroke rate(spm)',
   
         yaxis:6,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
         var d13={
              data:pace2km3,
        label:'pace 2km(mm:ss)',
   
         yaxis:1,
        lines: { show: true, },
        points: { show: false}
            }  ;
            
         var d12={
              data:pace3500,
        label:'pace 500m(mm:ss)',
   
         yaxis:1,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
         var d11={
              data:speed3,
        label:'speed(m/s)',
   
         yaxis:5,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
         var d10={
              data:distance3,
        label:'distance(m)',
   
         yaxis:3,
        lines: { show: true, },
        points: { show: false}
            }  ;
        
      var d9={
              data:powerbalance3,
        label:'Power balance(W)',
   
         yaxis:1,
        lines: { show: true, },
        points: { show: false}
            }  ;
              
        var d8={
              data: powerL3,
        label:'Power left(W)',
   
         yaxis:1,
        lines: { show: true, },
        points: { show: false}
            }  ;
            var d7={
              data: powerR3,
        label:'Power right(W)',
   
         yaxis:1,
        lines: { show: true, },
        points: { show: false}
            }  ;
            


  var d6={
              data: nizTime,
        label:'Time(s)',
   
         yaxis:4,
        lines: { show: true, },
        points: { show: false}
            }  ;
            

  var d5={
              data: power1,
        label:'Power(W)',
    
        yaxis:1,
        lines: { show: true,},
        points: { show: false}
            };
 var data2 = [ d5,];


 var plot2 =$.plot($("#Strokes"),
       data2,{            
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
      yaxes: [  {position:"left",max:1500},{position:"right",max:60,min:-90,  },{position:"right",max:20,  } ,{position:"right",max:5,  },{max:10,  },{max:50,position:"right",  },{max:150,  },{max:2,position:"right",  },{max:250,position:"right",  },],
            xaxis:{
        show: true,
            }     
        }
    );





            $("#promenaParametra").click(function(){

      var niz=[];
  



      niz=document.getElementsByName("parameters");

       for(var i=0;i< niz.length; i++){
        if(niz[i].checked==true){
            
              if( niz[i].getAttribute("id")=="hr2"){
            data2.push(d19);
           



          } 
            
               if( niz[i].getAttribute("id")=="calories2"){
            data2.push(d18);
           



          } 
            
              if( niz[i].getAttribute("id")=="strokeRate"){
            data2.push(d14);
           



          } 
            
             if( niz[i].getAttribute("id")=="pace2km"){
            data2.push(d13);
           



          } 
            
             if( niz[i].getAttribute("id")=="pace500m"){
            data2.push(d12);
           



          } 
            
            
             if( niz[i].getAttribute("id")=="speed2"){
            data2.push(d11);
           



          } 
            
             if( niz[i].getAttribute("id")=="angle5R"){
            data2.push(d17);
           



          } 
            
            
               if( niz[i].getAttribute("id")=="angle5l"){
            data2.push(d16);
           





          } 
            
            
            
             if( niz[i].getAttribute("id")=="angle5"){
            data2.push(d15);
           





          } 
            
            if( niz[i].getAttribute("id")=="distance2"){
            data2.push(d10);
           





          } 
            
          if( niz[i].getAttribute("id")=="time2"){
            data2.push(d6);
           





          }
          if( niz[i].getAttribute("id")=="powerBalance"){
            data2.push(d9);
            




          }
          if( niz[i].getAttribute("id")=="powerL"){
            data2.push(d8);
           





          }
          if( niz[i].getAttribute("id")=="powerR"){
            data2.push(d7);
          




          }
           




        }
        if(niz[i].checked==false){





        }

      }
  
       plot2.setData(data2);
            plot2.setupGrid();
            plot2.draw();


     });



            

              
        
            document.getElementById("time").innerHTML = sesija2.time+"<span class='description-percentage'>s</span>";;
            document.getElementById("stroke_count").innerHTML = sesija2.scnt;
            document.getElementById("distance").innerHTML = sesija2.dist+"<span class='description-percentage'>km</span>";
            document.getElementById("stroke_rate").innerHTML = sesija2.srate_avg+"<span class='description-percentage'>spm</span>";
            document.getElementById("stroke_rate_max").innerHTML = sesija2.srate_max+"<span class='description-percentage'>spm</span>";
            document.getElementById("hr").innerHTML = sesija2.hr_avg+"<span class='description-percentage'>bpm</span>";
            document.getElementById("hr_max").innerHTML = sesija2.hr_max+"<span class='description-percentage'>bpm</span>";
            document.getElementById("pace").innerHTML = sesija2.pace500_avg;
            document.getElementById("speed").innerHTML = sesija2.spd_avg+"<span class='description-percentage'>km/h</span>";
            document.getElementById("power").innerHTML = sesija2.pwr_avg+"<span class='description-percentage'>W</span>";
            document.getElementById("power_max").innerHTML = sesija2.pwr_max+"<span class='description-percentage'>W</span>";
            document.getElementById("power_balance").innerHTML = sesija2.pwr_bal_avg+"<span class='description-percentage'>W</span>";
            document.getElementById("angle").innerHTML = sesija2.ang_avg;

            document.getElementById("calories").innerHTML =sesija2.cal+"<span class='description-percentage'>kCal</span>";
            document.getElementById("uvod").innerHTML="BY <a href='profile.html'><?php echo $id; ?></a>"+" "+dat[0].date;
          


 
    $.plot($("#left-hand"),
        [{
              data: forceL1,
        color: "#536A7F",
        lines: { show: true, color: "#536A7F", fillColor: "#536A7F" },
        points: { show: false, fill:true }
            },
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
            max:1000,
          },
            xaxis:{
            show:true,
            max:60,
            min:-90,
            }     
        }
    );
   var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Angle(°)").appendTo($('#left-hand'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Forse(N)").appendTo($('#left-hand'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);





     $.plot($("#right-hand"),
        [{
              data: forceR1,
        color: "#536A7F",
        lines: { show: true, color: "#536A7F", fillColor: "#536A7F" },
        points: { show: false, fill:true }
            },
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
             max:1000,
          },
            xaxis:{
            show:true,
            max:60,
            min:-90,
            }     
        }
    );
   var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Angle(°)").appendTo($('#right-hand'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Forse(N)").appendTo($('#right-hand'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);




        var d1 = {
          data: power_l2,
          color: "#3c8dbc",
      label: 'Left Force',
      yaxis:1,
    
        };

      var d2 = {
      label:'Right Force',
      data: power_r2,
      yaxis:1,};
      var d3 = {

      label:'Angle Left',
      data: angle_Ltime2,
        yaxis:2,};
       var d4 = {

      label:'Angle Right',
      data: angle_Rtime2,yaxis:2,};


    var data =
     [ d1, d2 ,d3, d4]
      placeholder = $("#signals-graph");

    var plot = $.plot(placeholder, data,
    
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
      yaxes: [  {zoomRange: [0.1, 10],
        panRange: [-10, 10],position:"left",max:1000  },{zoomRange: [0.1, 10],
        panRange: [-10, 10],position:"right",max:60,min:-90,  } ],
      
      xaxis: {
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
      
     
   }
          });

    // and add panning buttons

    // little helper for taking the repetitive work out of placing
    // panning arrows
 var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>").text("Time(s)").appendTo($('#signals-graph'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>").text("Power(W)").appendTo($('#signals-graph'));
yaxisLabel.css("margin-top", yaxisLabel.width() / 2 - 20);
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
                    <div class="btn btn-primary btn-sm pull-right">Reset Zoom</div>
          <form class="pull-right">
          <input type="text" placeholder="Go to" name="go-to-zoom" class="go-to-zoom margin-r-5 btn-sm">
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
        <div class="traninig-graph-header">
              <h3 class="training-h3">Strokes</h3>

    
     </div>   
        <div id="Strokes" class="clear" style="height: 300px;"></div>
        <div class="graphic-footer row">
                
                            <div class="graphic-footer row">
                                <a class="pull-right btn-param" href="#" data-toggle="modal" data-target="#myParam"><i class="fa fa-cog"></i></a>
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
                                                <!-- List of Parametars -->
                                                <div id="history-graph-params" class="param-box">
                                                    <ul class="checkbox icheck modalParm-list">
                                                     
                                         
                                                      
                                                        <li>
                                                            <label for="pace2km">
                                                                <input type="checkbox" name="parameters" id="pace2km" >
                                                                Pace 2km
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                     
                                                        <li>
                                                            <label for="calories2">
                                                                <input type="checkbox" name="parameters" id="calories2" >
                                                                Calories
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="time2">
                                                                <input type="checkbox" name="parameters" id="time2" value="time2">
                                                                Time
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                     
                                                        <li>
                                                            <label for="pace500m">
                                                                <input type="checkbox" name="parameters" id="pace500m" >
                                                                Pace 500m
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                      
                                                        <li>
                                                            <label for="strokeRate">
                                                                <input type="checkbox" name="parameters" id="strokeRate" value="stroke_rate_average">
                                                                Stroke Rate
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                         <li>
                                                            <label for="power5">
                                                                <input type="checkbox" name="parameters" id="power5" value="power" checked>
                                                                Power
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                         <li>
                                                            <label for="powerBalance">
                                                                <input type="checkbox" name="parameters" id="powerBalance" value="power_left_average">
                                                                Power Balance
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="powerL">
                                                                <input type="checkbox" name="parameters" id="powerL" value="power_left_average">
                                                                Power L
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                         <li>
                                                            <label for="powerR">
                                                                <input type="checkbox" name="parameters" id="powerR" value="power_right_average">
                                                                Power R
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="distance2">
                                                                <input type="checkbox" name="parameters" id="distance2" value="distance2">
                                                                Distance
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="speed2">
                                                                <input type="checkbox" name="parameters" id="speed2" value="speed_average">
                                                                Speed
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                      
                                                        <li>
                                                            <label for="hr2">
                                                                <input type="checkbox" name="parameters" id="hr2" >
                                                                HR
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                         
                                                        <li>
                                                            <label for="angle5">
                                                                <input type="checkbox" name="parameters" id="angle5" >
                                                                angle
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                         
                                                        <li>
                                                            <label for="angle5l">
                                                                <input type="checkbox" name="parameters" id="angle5l" >
                                                                angle l
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                         
                                                        <li>
                                                            <label for="angle5R">
                                                                <input type="checkbox" name="parameters" id="angle5R" >
                                                                angle r
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                   
                                                      
                                                    </ul><!-- /.contatcts-list -->


                                                </div><!-- /.List of Parametars -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                <button type="button" id="promenaParametra" class="btn btn-primary margin-r-5" data-dismiss="modal" >
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