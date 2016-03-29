

(function($) {
  
  var Radar = (function() {
    
    function Radar(ele, settings) {
      this.ele = ele;
      this.settings = $.extend({
        showAxisLabels: false,
        title: "Untitled",
        step: 1,
        size: [150, 150],
        values: {},
        color: [0,128,255],
        avrGFAngle: 0,
        avrGSAngle: 0,
        strNum:0,
      },settings);
      this.width = settings.size[0];
      this.height = settings.size[1];
      $(ele).css({
        'position': 'relative',
        'width': this.width,
        'height': this.height
      });
      this.canvases = {};
      this.draw();
    }
    
    Radar.prototype.newCanvas = function(name, delay) {
      var delay = delay || 0;
      var canvas = document.createElement('canvas');
      canvas.width = this.width;
      canvas.height = this.height;
      $(canvas).css({
        'position': 'absolute'
      });
      this.canvases[name] = canvas;
      this.ele.appendChild(canvas);
      this.cxt = canvas.getContext('2d');
      
      if (delay != 0) {
        $(canvas).css('opacity',0).delay(delay).animate({opacity: 1}, 500);
      }
      
    }

    Radar.prototype.draw = function() {
      this.newCanvas('axis', 200);
      var min = 0;
      var max = 0;

      
      $.each(this.settings.values, function(i,val){
        $.each(val.SampleValues, function(iin,valin){
          if (valin < min){
            min = val;
          }
          if (valin > max){
            max = valin;
          }
        });
      });
      
      min = Math.floor(min);
      max = Math.ceil(max);

      var spacing = 125/max;

      $nulti = false;
      //iscrtava krugove      
      for(var i = 0; i <= max + 10; i += this.settings.step) {
        if (i % 30 == 0)
        {        
          this.cxt.beginPath();
          this.cxt.arc(this.width/2,
                       this.height/2,
                       this.settings.step * spacing * i,
                       0, 2 * Math.PI, false);
          this.cxt.strokeStyle = "#000";
          this.cxt.fillStyle = "#000";
          this.cxt.stroke();
          if (this.settings.showAxisLabels){
            this.cxt.fillText(i, this.width/2+2, this.height/2 + this.settings.step * spacing * i+20);
            if ($nulti != false)
              this.cxt.fillText(i, this.width/2+2, this.height/2 + this.settings.step * spacing * (-i)-20);
            $nulti = true;
          }
        }
      }
      
        //br. vrednosti
        var size = 0;


        size = max;


      this.cxt.beginPath();
      this.cxt.moveTo(this.width / 2, this.height /2);
      var x = this.width /2 + Math.cos(Math.PI * 2) * spacing * (max + 12); 
      var y = this.height /2 + 0; //this.height /2 + Math.sin(Math.PI * 2) * spacing * max;
      this.cxt.lineTo(x, y);
      this.cxt.stroke();      

      this.cxt.beginPath();
      this.cxt.moveTo(this.width / 2, this.height /2);
      var x = this.width /2 - Math.cos(Math.PI * 2) * spacing * (max + 12);
      var y = this.height /2 - 0;
      this.cxt.lineTo(x, y);
      this.cxt.stroke();

      this.cxt.beginPath();
      this.cxt.moveTo(this.width / 2, this.height /2);
      var x = this.width /2 + 0;
      var y = this.height /2 + Math.cos(Math.PI * 2) * spacing * (max + 12);
      this.cxt.lineTo(x, y);
      this.cxt.stroke();

      this.cxt.beginPath();
      this.cxt.moveTo(this.width / 2, this.height /2);
      var x = this.width /2 - 0;
      var y = this.height /2 - Math.cos(Math.PI * 2) * spacing * (max + 12);
      this.cxt.lineTo(x, y);
      this.cxt.stroke();

      $goreDesnoX = 120;
      $goreDesnoY = 70;


      /*
      this.cxt.beginPath();
      this.cxt.moveTo($goreDesnoX, $goreDesnoY);
      this.cxt.lineTo(50, 150);
      this.cxt.lineTo(70, 136);

      this.cxt.moveTo(50, 150);
      this.cxt.lineTo(62, 126);
      this.cxt.lineWidth = 2;
      this.cxt.closePath();
      this.cxt.stroke();   
      */

      var pomerajX = 470;
      var pomerajY = 340;

      /*
      this.cxt.beginPath();
      this.cxt.moveTo(50+pomerajX, 150+pomerajY);
      //this.cxt.lineTo(50+pomerajX, 150+pomerajY);
      this.cxt.lineTo($goreDesnoX + pomerajX, $goreDesnoY + pomerajY);      
      this.cxt.lineTo($goreDesnoX + pomerajX - 12, $goreDesnoY + pomerajY +22);

      this.cxt.moveTo($goreDesnoX + pomerajX, $goreDesnoY + pomerajY);
      this.cxt.lineTo($goreDesnoX + pomerajX - 20, $goreDesnoY + pomerajY +14);
      this.cxt.lineWidth = 2;
      this.cxt.closePath();
      this.cxt.stroke();   
      */
      
      //vracena sirina linije jer se iscrtavaju okretaji
      this.cxt.lineWidth = 1;


      //iscrtava linije grafa
      var first = true;
      var that = this;

      that.cxt.beginPath();
      var end = {x: null, y: null};


      var MaxIndexFHalf = 0;
      var MaxIndexFHalfValue = 0;
      var SizeFHalf = 0;


      var MaxIndexSHalf = 0;
      var MaxIndexSHalfValue = 0;
      var SizeSHalf = 0;

      var indexForName = 0;
      

      $.each(that.settings.values, function(i,val){

        //da li je samo okretaj ili ceo polar
        if ((that.settings.strNum == 0) || ((that.settings.strNum != 0 && that.settings.strNum == indexForName+1 )))
        {

             that.cxt.beginPath();

             var arrayValuesFirstHalf = [];
             var arrayValuesSecondHalf = [];

             var m = 0;

             var SHCount = val.TotCount - val.FHCount;

             //alert(val.FHCount);

             $.each(val.SampleValues, function(indexValues, valValues){
                      m++;

                      if (m <= parseInt(val.FHCount))
                      {
                          arrayValuesFirstHalf.push(valValues);
                      }
                      else
                          arrayValuesSecondHalf.push(valValues);
             });



                size = arrayValuesFirstHalf.length;

                var i = 0;
                var first = false;



                $.each(arrayValuesFirstHalf, function(key,valin){
                  
                   if (MaxIndexFHalfValue < valin) {
                      MaxIndexFHalfValue = valin;
                      MaxIndexFHalf = i;
                      SizeFHalf = size;
                   }

                  
                   var x = that.width / 2 + Math.sin(i * (Math.PI/size)) * valin * spacing;
                   var y = that.height / 2 + Math.cos(i * (Math.PI/size)) * valin * spacing; 

                   that.cxt.lineTo(x, y);
                   i += 1;

                });

                size = arrayValuesSecondHalf.length;
                i=0;

                $.each(arrayValuesSecondHalf, function(key,valin){

                  if (MaxIndexSHalfValue < valin) {
                     MaxIndexSHalfValue = valin;
                     MaxIndexSHalf = i;
                     SizeSHalf = size;
                  }

                 var x = that.width / 2 - Math.sin(i * (Math.PI/size)) * valin * spacing;
                 var y = that.height / 2 - Math.cos(i * (Math.PI/size)) * valin * spacing;

                  that.cxt.lineTo(x, y);
                  i += 1;
                  //alert('a');
                });

                /*
                   if ($.cookie('language')=="en")
                  {
                  Calendar.dayNames = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
                  }
                  else if ($.cookie('language')=="sr")
                  {
                  Calendar.dayNames = new Array("Ned","Pon","Uto","Sre","ÄŚet","Pet","Sub");
                  }
                */

                that.cxt.closePath();
                that.cxt.strokeStyle = '#ff0000';
                that.cxt.stroke();

            }

            indexForName++;

      });
      
      if (that.settings.strNum != 0)
      {


        //$("#myCanvasLeft").hide();
        //$("#myCanvasRight").hide();

        $ugao = this.settings.values[that.settings.strNum-1].FHMaxAngle;

        var rFHMaxAngle = parseFloat($ugao)*180/Math.PI; 

        var x = that.width / 2 - Math.sin(MaxIndexFHalf * (Math.PI/SizeFHalf))  * spacing * (max+12);
        var y = that.height / 2 - Math.cos(MaxIndexFHalf * (Math.PI/SizeFHalf)) * spacing * (max+12); 



        this.cxt.beginPath();
        this.cxt.moveTo(this.width / 2, this.height /2);
        this.cxt.lineTo(x, y);


        //this.cxt.font = 'italic 12pt Calibri';
        //this.cxt.fillText("Max angle: ", x - 70, y - 10);
        //this.cxt.fillText(Math.round(rFHMaxAngle)+"°", x - 45, y+5);

        //na drugi nacin
        /*
        $("#myCanvasLeft").css('top', y - 10);

        var c=document.getElementById("myCanvasLeft");
        var ctx=c.getContext("2d");  

        ctx.clearRect(0,0,150,200);
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.font = 'italic 8pt Calibri';          
        ctx.fillText("Max angle: "+ Math.round(rFHMaxAngle)+"°", 10, 20); // to force peak in whole session Right leg:", 0 + 5, 10); 
        ctx.lineWidth = 3;
        ctx.strokeStyle = '#000';
        ctx.stroke();
  
        this.cxt.lineWidth = 3;

        this.cxt.strokeStyle = '#000';
        this.cxt.stroke();
        */

        this.cxt.beginPath();
        this.cxt.arc(this.width/2,
                      this.height/2,
                      spacing * max + 12,
                      parseFloat(1.57 - parseFloat($ugao)),
                      1.57, false);
        this.cxt.lineWidth = 3;
        this.cxt.strokeStyle = '#000';
        this.cxt.stroke();       

        var rSHMaxAngle = parseFloat($ugao)*180/Math.PI;


        var x = that.width / 2 + Math.sin(MaxIndexSHalf * (Math.PI/SizeSHalf)) * spacing * (max+12);
        var y = that.height / 2 + Math.cos(MaxIndexSHalf * (Math.PI/SizeSHalf)) * spacing * (max+12); 

        this.cxt.beginPath();
        this.cxt.moveTo(this.width / 2, this.height /2);
        this.cxt.lineTo(x, y);

        //this.cxt.font = 'italic 12pt Calibri';
        //this.cxt.fillText("Max angle: ", x + 2, y);
        //this.cxt.fillText(Math.round(rSHMaxAngle)+"°", x + 20, y + 15);

        //na drugi nacin

        /*
        $("#myCanvasRight").css('top', y - 10);

        var c=document.getElementById("myCanvasRight");
        var ctx=c.getContext("2d");  

        ctx.clearRect(0,0,150,200);
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.font = 'italic 8pt Calibri';          
        ctx.fillText("Max angle: "+ Math.round(rSHMaxAngle)+"°", 10, 20); // to force peak in whole session Right leg:", 0 + 5, 10); 
        ctx.lineWidth = 3;
        ctx.strokeStyle = '#000';
        ctx.stroke();
        */

        this.cxt.lineWidth = 3;
        this.cxt.strokeStyle = '#000';
        this.cxt.stroke();

          this.cxt.beginPath();
          this.cxt.arc(this.width/2,
                      this.height/2,
                      spacing * max + 12,
                      4.71,
                      parseFloat(4.71 - parseFloat($ugao)),
                      true);
          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();          

      }
      else{

           var rAverageHMaxAngle = parseFloat(this.settings.avrGFAngle)*180/Math.PI;

          //alert(rAverageHMaxAngle);

          var x = that.width / 2 + Math.sin(rAverageHMaxAngle * (2 * Math.PI/360)) * spacing * (max+12);
          var y = that.height / 2 + Math.cos(rAverageHMaxAngle * (2 * Math.PI/360)) * spacing * (max+12); 


          this.cxt.beginPath();
          this.cxt.moveTo(this.width / 2, this.height /2);
          this.cxt.lineTo(x, y);
          this.cxt.font = 'italic 8pt Calibri';          
          //this.cxt.fillText("Avg angle: ", x + 5, y); "Average angle to force peak in whole session Right leg:"
          //this.cxt.fillText("Avg angle: ", x + 5, y);
          //this.cxt.fillText(Math.round(rAverageHMaxAngle)+"°", x + 20, y + 15);
          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();

          this.cxt.beginPath();
          //this.cxt.moveTo(x, y);
          //this.cxt.lineTo(650, y);
          this.cxt.font = 'italic 8pt Calibri';          
          //this.cxt.fillText("Avg angle: ", x + 5, y); "Average angle to force peak in whole session Right leg:"
          /*this.cxt.fillText("Alaihu: ", 20 + 5, y);*/
          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();

          /*          
          $("#myCanvasRight").css('top',y - 50);

          var c=document.getElementById("myCanvasRight");
          var ctx=c.getContext("2d");  

          ctx.clearRect(0,0,150,200);
          ctx.beginPath();
          ctx.moveTo(0, 0);
          ctx.font = 'italic 8pt Calibri';          
          ctx.fillText("Average angle ", 10, 20); // to force peak in whole session Right leg:", 0 + 5, 10); 
          ctx.fillText("to force peak in ", 10, 40);
          ctx.fillText("whole session ", 10, 60);
          ctx.fillText("Right leg: "+ Math.round(rAverageHMaxAngle) +"°", 10, 80);
          ctx.lineWidth = 3;
          ctx.strokeStyle = '#000';
          ctx.stroke();
          */

          this.cxt.beginPath();
          this.cxt.arc(this.width/2,
                      this.height/2,
                      spacing * max + 12,
                      parseFloat(1.57 - parseFloat(this.settings.avrGFAngle)),
                      1.57, false);
          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();

          var rAverageHMaxAngle = parseFloat(this.settings.avrGSAngle)*180/Math.PI;

          var x = that.width / 2 - Math.sin(rAverageHMaxAngle * (2 * Math.PI/360)) * spacing * (max+12);
          var y = that.height / 2 - Math.cos(rAverageHMaxAngle * (2 * Math.PI/360)) * spacing * (max+12); 

          this.cxt.beginPath();
          this.cxt.moveTo(this.width / 2, this.height /2);
          this.cxt.lineTo(x, y);

        /*
          this.cxt.fillText("Avg angle: " + parseInt(rAverageHMaxAngle), x + 5, y);
          this.cxt.fillText(parseInt(rAverageHMaxAngle)+"°", x + 20, y + 15);
        */

        /*
          this.cxt.font = 'italic 12pt Calibri';
          this.cxt.fillText("Avg angle: ", x - 70, y - 10);
          this.cxt.fillText(Math.round(rAverageHMaxAngle)+"°", x - 45, y+5);
          */

          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();

          this.cxt.beginPath();
         //this.cxt.moveTo(x, y);
         // this.cxt.lineTo(0, y);
          this.cxt.font = 'italic 8pt Calibri';          
          //this.cxt.fillText("Avg angle: ", x + 5, y); "Average angle to force peak in whole session Right leg:"
          /*this.cxt.fillText("Alaihu: ", 20 + 5, y);*/
          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();

          /*
          $("#myCanvasLeft").css('top',y - 50);

          var c=document.getElementById("myCanvasLeft");
          var ctx=c.getContext("2d");

          ctx.clearRect(0,0,150,200);

          ctx.beginPath();
          ctx.moveTo(0, 0);
          ctx.font = 'italic 8pt Calibri';          
          ctx.fillText("Average angle ", 10, 20); // to force peak in whole session Right leg:", 0 + 5, 10); 
          ctx.fillText("to force peak in ", 10, 40);
          ctx.fillText("whole session ", 10, 60);
          ctx.fillText("Left leg: "+Math.round(rAverageHMaxAngle)+"°", 10, 80);
          ctx.lineWidth = 3;
          ctx.strokeStyle = '#000';
          ctx.stroke();
          */


          this.cxt.beginPath();
          this.cxt.arc(this.width/2,
                      this.height/2,
                      spacing * max + 12,
                      4.71,
                      parseFloat(4.71 - parseFloat(this.settings.avrGSAngle)),
                      true);
          this.cxt.lineWidth = 3;
          this.cxt.strokeStyle = '#000';
          this.cxt.stroke();      

       }

      /*
      $.ajax({
          url: '/Home/GetConversation',
          dataType: 'json',
          data: { arrayIDsUsers: JSON.stringify(arrayIDsUsers) },
          success: function(data) {
              if(data){
                  var obj4 = jQuery.parseJSON(data);
                  var conversationID = obj4.m_unConversationID;

                  window.currentConversationID = conversationID;

                  $clicktxtArea.addClass('conversationID-' + obj4.m_unConversationID);
                  $clicktxtArea.addClass('openConversation');                                                    

                  window.DajPorukeIObeleziIHKaoProcitane(partsID[2], conversationID, 'contacts', '');
              }
              else{
              }
          }
      }); 
      */

      //this.cxt.lineTo(end.x, end.y);
      //var grad = this.cxt.createLinearGradient(0, 0, 0, this.height);
      //grad.addColorStop(0,"rgba("+this.settings.color[0]+","+this.settings.color[1]+","+this.settings.color[2]+",0)");
      //grad.addColorStop(1,"rgba("+this.settings.color[0]+","+this.settings.color[1]+","+this.settings.color[2]+",1)");
      //this.cxt.fillStyle = grad;
      //this.cxt.shadowBlur = 2;
      //this.cxt.shadowColor = "rgba(0, 0, 0, .2)";
      //this.cxt.stroke();
      //this.cxt.fill();
      
      /*
      this.newCanvas('labels',1000);
      
      i = 0;
      $.each(this.settings.values, function(key,val){
        that.newCanvas('label-'+i, i * 250);
        that.cxt.fillStyle = "rgba(0,0,0,.8)";
        that.cxt.strokeStyle = "rgba(0,0,0,.5)";
        that.cxt.font = "bold 12px Verdana";
        var dist = Math.min(spacing * val, size * spacing);
        var x = that.width / 2 + Math.cos((Math.PI * 2) * (i / size)) * spacing * val;
        var y = that.height / 2 + Math.sin((Math.PI * 2) * (i / size)) * spacing * val;

        var textX = that.width / 2 + Math.cos((Math.PI * 2) * (i / size)) * spacing * val;
        var textY = that.height / 2 + Math.sin((Math.PI * 2) * (i / size)) * spacing * val * 1.5;
        
        if (textX < that.width/2) {
          textX -= 75
          that.cxt.textAlign="end";
          that.cxt.beginPath();
          var width = that.cxt.measureText(key).width;
          that.cxt.moveTo(textX - width - 5, textY + 4);
          that.cxt.lineTo(textX + 15, textY + 4);
          that.cxt.lineTo(x - 2, y);
          that.cxt.lineWidth = 2;
          that.cxt.stroke();
        } else {
          textX += 75
          that.cxt.textAlign="start";
          that.cxt.beginPath();
          var width = that.cxt.measureText(key).width;
          that.cxt.moveTo(x + 2,y);
          that.cxt.lineTo(textX - 15, textY + 4);
          that.cxt.lineTo(textX + width + 5, textY + 4);
          that.cxt.lineWidth = 2;
          that.cxt.stroke();
        }
        that.cxt.fillText(key, textX, textY);
        //For arrows that aren't done.
        i += 1;
      });
      
      
      this.newCanvas('title',1000);
      this.cxt.font = "bold 24px Verdana";
      this.cxt.fillText(this.settings.title, 10, 30); 
      */

    }
    
    return Radar;
    
  })();
  
  $.fn.radarChart = function(settings){
    this.each(function(i,ele){
      var radar = new Radar(ele, settings);
    });
  }
  
})(jQuery);
