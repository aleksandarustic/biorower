
<?php 
    use Hashids\Hashids;
    use App\Library\GlobalFunctions;
?>

@extends('layouts.myframe')

@section('page-script')
    <link rel="stylesheet" href="../js/jquery-validation-1.13.1/css/screen.css" type="text/css" />
    <script src="../js/jquery-validation-1.13.1/jquery.validate.js"></script>
@endsection

@section('content')
    <!--
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    -->

    <?php
        $hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
        $encodedCurrentUser = $hashidsUser->encode(Auth::user()->id);
    ?>

    {!! HTML::script('js/highcharts.js') !!}
    {!! HTML::script('js/highcharts-more.js') !!}
    {!! HTML::script('js/highcharts-3d.js') !!}

    <!--
    {!! HTML::script('js/game.js') !!}
    -->

    <script src="{{ Request::root() }}/../node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
    <!-- <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script> -->
    <script type="text/javascript">
            
        $(function(){

            var urlBase = "<?php echo Request::root() ?>";

            var socket = io.connect('http://localhost:8890');

            /*
                function refreshData() {
                    var series = chart1.series[0],
                        shift = series.data.length > 20; // shift if the series is
                                                         // longer than 20
                    // add the point
                    chart1.series[0].addPoint(eval(data), true, shift);
                }
            */
            /*
                socket1.on('messageSoc', function (data) {
                    var jsonData = JSON.parse(data);
                    jsonData[0]["user"];
                    for (var key in jsonData[0]) {
                      if (jsonData[0].hasOwnProperty(key)) {
                        $("#container1").append("<p>"+ key + " -> " + jsonData[0][key] +"</p>");
                      }
                    }
                });
            */

            var arrayColors = [ 
            "#0000FF",
            "#FF0000",
            "#FFFF00",
            "#00CED1",
            "#2E8B57",
            "#4B0082",
            "#B8860B",
            "#D2691E",
            "#000000",
            "#2F4F4F",
            "#DC143C",
            "#9370DB",
            "#ADFF2F"];

            var i = 0;
            $(".avatarOverviewFollow").each(function(){
                $("#canvasWrapper").append("<div style='height:70px;'><img src='../js/rower.gif' id='' class='playerGif-"+(i+1)+" plyCls' class='imgRower' /></div>");
                $("#canvasWrapper").append("<div id='' class='playerGifStat-"+(i+1)+" plyCls'></div><hr></hr>");
                i++;
            });

            var i = 0;
            $(".racerColor").each(function(){
                $(".playerGif-"+(i+1)).css("border","1px solid "+arrayColors[i]);
                $(this).css("background-color", arrayColors[i]);
                i++;
            });

            $(".avatarOverviewFollow").css("border-color", "#9370DB");

            socket.on('connect', function(){
                // call the server-side function 'adduser' and send one parameter (value of prompt)
                socket.emit('addroomtosocket', $("#hidRaceId").val(), "{{ Auth::user()->display_name }}", "{{ $encodedCurrentUser }}");
            });

            socket.on('updateroom', function(from, message, clients){
                if (message.indexOf("disconnected") >= 0){
                    $("#serverMessages").append("<div style='color:red'>"+message+"</div>");
                }
                else{
                    $("#serverMessages").append("<div style='color:green'>"+message+"</div>");
                }

                $('#serverMessages').scrollTop($('#serverMessages')[0].scrollHeight);
                
                /*alert(clients.toString());*/

                var allOnline = [];
                for(var i =0; i < clients.length; i++){
                    var cilentFounded = $(".clsRacePlayer-" + clients[i]);

                    if (cilentFounded.length){
                        cilentFounded.parent(".racePlayerWrapper").find(".onoffRacerSpan").removeClass("label-danger");
                        cilentFounded.parent(".racePlayerWrapper").find(".onoffRacerSpan").addClass("label-success");
                    }
                    else if (!cilentFounded.length){
                        $("#addedUsersContainer").append("<div class='racePlayerWrapper'>"
                                                   + "<div style='background-color: rgb(255, 255, 0); display: none;' class='racerColor racerColorIndex-3'>"
                                                   + "<span class='label'>&nbsp;&nbsp;&nbsp;</span>"
                                                   + "</div>"
                                                   + "<input id='racePlayer-3' class='clsRacePlayer-Oa clsRacePlayerScClass' type='hidden'>"
                                                   + "<a href='http://localhost:8080/!powerhub%20template/blog/public/bojanproba81' class='' data-toggle='tooltip' data-placement='top' title='bojanproba81'>"
                                                   + "<img style='border-color: rgb(147, 112, 219); />' src='http://localhost:8080/!powerhub%20template/blog/public/images/avatar_empty.png' class='avatarOverviewFollow' alt='a picture' height='50' width='50'>"
                                                   + "</a>"
                                                   + "<div class='onoffRacer'>"
                                                   + "<span class='label label-danger onoffRacerSpan'>&nbsp;</span>"
                                                   + "</div>"
                                                   + "</div>");
                    }

                    allOnline.push(clients[i]);

                    $(".clsRacePlayer-" + clients[i]).parent(".racePlayerWrapper").find(".racerColor").show();
                }

                $(".clsRacePlayerScClass").each(function(){
                    encid = $(this).attr("class").split(" ")[0].split("-")[1];
                    if ($.inArray(encid, allOnline) == -1){
                        $(this).parent(".racePlayerWrapper").find(".onoffRacerSpan").removeClass("label-success");
                        $(this).parent(".racePlayerWrapper").find(".onoffRacerSpan").addClass("label-danger");

                        $(this).parent(".racePlayerWrapper").find(".racerColor").hide();
                    }
                });

            });

            socket.on('updatechat', function(from, message, displayname, encodeid){
                var rdNumber = $(".clsRacePlayer-" + encodeid).parent(".racePlayerWrapper").find(".clsRacePlayerScClass").attr("id").split("-")[1];
                var bgColor = arrayColors[parseInt(rdNumber) - 1];

                $("#raceChat").append("<div style='color:"+bgColor+"'>"+displayname+": "+message+"</div>");
                $('#raceChat').scrollTop($('#raceChat')[0].scrollHeight);
            });

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    if ($("#chatMessageInput").val() != ""){
                        socket.emit('addchatmessage', $("#hidRaceId").val(), $("#chatMessageInput").val(), "{{ Auth::user()->display_name }}", "{{ $encodedCurrentUser }}");
                        $("#chatMessageInput").val("");
                    }
                }
            });

            var timeOutId = 0;

            function requestData1() {
              $.ajax({
                url: urlBase + '/race/ajax-data1?id_race='+$("#hidRaceId").val(),
                success: function(point) {
                    if ($("#startRace").hasClass("stopRace")){
                        timeOutId = setTimeout(requestData1, 100);    
                    }
                    else{
                        clearTimeout(timeOutId);
                    }
                },
                cache: false
              });
            }

            $(document).on("click", "#startRace", function(){
                requestData1();
                $(this).text("Stop race");
                $(this).removeClass("btn-primary");
                $(this).addClass("btn-warning");
                $(this).addClass("stopRace");
            });

            $(document).on("click", ".stopRace", function(){
                $(this).text("Start race");
                $(this).addClass("btn-primary");
                $(this).removeClass("btn-warning");
                $(this).removeClass("stopRace");                
            });

            socket.on('messageSoc', function (data) {

                var jsonData = $.parseJSON(data);

                var dataJson = jsonData[0]["\"data\""];
                var userJson = jsonData[0]["\"user\""];

                var playerOrderNmbr = $(".clsRacePlayer-"+userJson).attr("id").split("-")[1];
                
                var playerGif = ".playerGif-"+playerOrderNmbr;
                var playerGifStat = ".playerGifStat-"+playerOrderNmbr;

                var current = $(playerGif).position();
                var sum = parseInt(current.left) + parseInt(dataJson[1]);
                
                if (sum<1220){
                    $(playerGif).css('left', sum);
                    $(playerGifStat).text(sum);
                }
                else{
                    $(playerGif).css('left', 1220);
                    //$("#firstRowerStat").text('1220');
                    if (window.winner == 0){
                        $(playerGifStat).text('WINNER');
                        $(playerGifStat).addClass('clsWinner');
                        window.winner = 1;
                    }
                    else{
                        if ($(playerGifStat).text() != 'WINNER' && $(playerGifStat).text() != '1220')
                        {
                            $(playerGifStat).text('1220');
                        }
                    }                                        
                }
            });


            $('[data-toggle="tooltip"]').tooltip({placement: 'top'});

            $(document).on("change", ".watchUsers", function(){
                $("#loadingGif").show();

                if ($(this).val() != 0){

                    $.ajax({
                            url : urlBase + '/race/add-user-to-race?id_race='+$("#hidRaceId").val()+'&id_user='+$(this).val(),
                        }).done(function (data) {
                            $("#loadingGif").hide();
                            window.location.reload();
                      }).fail(function () {
                    });
                }
            });

            $(document).on("click", ".removeUserFromListRace", function(){
                $("#loadingGif").show();

                var idUser = $(this).attr("id").split("-")[1];

                $.ajax({
                        url : urlBase + '/race/delete-user-from-race?id_race='+$("#hidRaceId").val()+'&id_user='+idUser,
                    }).done(function (data) {
                        $("#loadingGif").hide();
                        window.location.reload();
                  }).fail(function () {
                });
            });  

            $("#mainFormRaceSearch").validate();
            
            $("#id_find_user").rules( "add", {
                 //required: true,
                 minlength: 3,
            });

            $(document).on("click", "#searchButtonFindUserRace", function(){
                var isOK = $("#mainFormRaceSearch").valid();
                if (isOK){
                    $("#loadingGif").show();
                    $("#containerUserSearchRace").empty();
                    $.ajax({
                            url : urlBase + '/race/search-users-race-ajax?search_name='+$("#id_find_user").val(),
                            type: "POST",
                            dataType: 'json',
                        }).done(function (data) {
                            $("#iduserfieldSearch").val($("#id_find_user").val());
                            $("#containerUserSearchRace").html(data);
                            $("#loadingGif").hide();

                            var arrayAllUsers = [];

                            $(".sendRequestForRace").each(function(){
                                var idUser = $(this).attr("id").split("-")[1];

                                if ($(".clsRacePlayer-"+idUser).length){
                                    $(this).removeClass("btn");
                                    $(this).removeClass("btn-default");
                                    $(this).removeClass("sendRequestForRace");
                                    $(this).text("Already in the race");
                                }
                            });

                      }).fail(function () {
                    });
                }
            });

            $(document).on('click', '.pagination a', function (e) {
                var page = $(this).attr('href').split('page=')[1];

                $('#containerUserSearchRace').empty();
                $('#loadingGif').show();

                var url = urlBase + "/race/search-users-race-ajax?search_name=" + $("#iduserfieldSearch").val() + "&page=" + page;
 
                $.ajax({
                    url : url,
                    dataType: 'json',
                    type: "POST",
                }).done(function (data) 
                {
                    $('#containerUserSearchRace').html(data);
                    $('#loadingGif').hide();

                    var arrayAllUsers = [];

                    $(".sendRequestForRace").each(function(){
                        var idUser = $(this).attr("id").split("-")[1];

                        if ($(".clsRacePlayer-"+idUser).length){
                            $(this).removeClass("btn");
                            $(this).removeClass("btn-default");
                            $(this).removeClass("sendRequestForRace");
                            $(this).text("Already in the race");
                        }
                    });

                    location.hash = page;

                }).fail(function () {
                    alert('Users could not be loaded.');
                });

                e.preventDefault();
            });

            $(document).on("click", ".sendRequestForRace", function(){

                $this = $(this);
                $this.closest(".trListOfUsersForRace").find(".loadingGifSendRequest").show();
                $this.hide();
                $this.removeClass("btn");
                $this.removeClass("btn-default");
                $this.removeClass("sendRequestForRace");

                var encodedID = $(this).attr("id").split("-")[1];

                $.ajax({
                        url : urlBase + '/race/send-request-for-race?id_race='+$("#hidRaceId").val()+'&id_user='+encodedID
                    }).done(function (data) {

                        $this.text("Request has been sent");
                        $this.show();
                        $this.closest(".trListOfUsersForRace").find(".loadingGifSendRequest").hide();

                        socket.emit('emit_message', encodedID);

                  }).fail(function () {
                });
            });

            /*
            chart1 = new Highcharts.Chart({
                chart: {
                    renderTo: 'container1',
                    defaultSeriesType: 'spline',
                    events: {
                        load: function(){
                            socket1.on('messageSoc', function (data) {
                                var jsonData = $.parseJSON(data);

                                var dataJson = jsonData[0]["\"data\""];
                                var userJson = jsonData[0]["\"user\""];
                                
                                if (userJson == "user1"){
                                    var series = chart1.series[0], shift = series.data.length > 20; // shift if the series is longer than 20                                

                                    chart1.series[0].addPoint(dataJson, true, shift);

                                }
                            });  
                        }
                    }
                },
                title: {
                    text: 'Live random data'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Random data',
                    data: []
                }]
            });  
            
            chart2 = new Highcharts.Chart({
                chart: {
                    renderTo: 'container2',
                    defaultSeriesType: 'spline',
                    events: {
                        load: function(){
                            socket1.on('messageSoc', function (data) {
                                var jsonData = $.parseJSON(data);
                                //var dataForChart = jsonData[0]["data"].toString();

                                //console.log(jsonData[0]["\"user\""]);
                                var dataJson = jsonData[0]["\"data\""];
                                var userJson = jsonData[0]["\"user\""];
                                
                                if (userJson == "user2"){
                                    var series = chart2.series[0], shift = series.data.length > 20; // shift if the series is  longer than 20                                

                                    chart2.series[0].addPoint(dataJson, true, shift);

                                    var current = $("#secondRower").position();
                                    var sum = parseInt(current.left) + parseInt(dataJson[1]);
                                    
                                    if (sum<1220){
                                        $("#secondRower").css('left', sum);
                                        $("#secondRowerStat").text(sum);
                                    }
                                    else{
                                        $("#secondRower").css('left', 1220);
                                        if (window.winner == 0){
                                            $("#secondRowerStat").text('WINNER');
                                            $("#secondRowerStat").addClass('clsWinner');
                                            window.winner = 1;
                                        }
                                        else{
                                            if ($("#secondRowerStat").text() != 'WINNER' && $("#secondRowerStat").text() != '1220')
                                            {
                                                $("#secondRowerStat").text('1220');
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    }
                },
                title: {
                    text: 'Live random data'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Random data',
                    data: []
                }]
            });  
            */

        })
    </script>
 
    <div class="container-fluid" id="rightColumn">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" >

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <br />
                        <input type="hidden" id="iduserfieldSearch" value="" />

                        {!! Form::open(array('id'=>'mainFormRaceSearch')) !!}
                            <div><span class="addPlayerSpan addPlayerSpanText" >Add player: </span><span class="addPlayerSpan">{!! Form::select('watchUsers', array('0' => '- Please select -') + $listsWatchedList, '', array('class' => 'watchUsers')) !!}</span><span class="addPlayerSpan addPlayerSpanText" >Find user: </span><span class="addPlayerSpan">{!! Form::text('find_user_race', '', array('id' => 'id_find_user')) !!}</span><a href="#" class="btn btn-default" id="searchButtonFindUserRace"><span class="glyphicon glyphicon-search"></span></a></div>
                            <input type="hidden" value="{{ Input::get('id') }}" id="hidRaceId">
                            <div style="clear:both"></div>
                        {!! Form::close() !!}

                        <div id="loadingGif" style="margin:0 auto; display:none;">
                            Loading...
                            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div id="containerUserSearchRace">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" >
                          <div class="raceTitles">Players: </div>
                          <div id="addedUsers">

                                <div class="wrapperBoxesAddedUsers">
                                    <div class="ovrData">
                                        
                                        <div id="addedUsersContainer">
                                            <?php $counter = 1; ?>
                                            @foreach ($addedUsersInRace as $el)
                                                <div class="racePlayerWrapper">
                                                    
                                                    <div class="racerColor racerColorIndex-{{ $counter }}">
                                                        <span class="label">&nbsp;&nbsp;&nbsp;</span>
                                                    </div>                                                    

                                                    <?php
                                                        $hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
                                                        $encodedIDUser = $hashidsUser->encode($el->user->id);
                                                    ?>

                                                    @if ($isInitiator)
                                                        @if($el->user->id != Auth::user()->id)
                                                            <a href="#"><span class="glyphicon glyphicon-remove removeUserFromListRace" id="idUser-{{ $encodedIDUser }}"></span></a>
                                                        @endif
                                                    @endif

                                                    <input type="hidden" id="racePlayer-{{ $counter++ }}" class="clsRacePlayer-{{ $encodedIDUser }} clsRacePlayerScClass">

                                                    <a href="{{ url('/'.$el->user->linkname) }}"  class="" data-toggle="tooltip" data-placement="top" title="{{ $el->user->display_name }} ">
                                                        @if (isset($el->user->profile->image_id))
                                                                <img class="avatarOverviewFollow" src="{{ '../storage/profile_images'.$el->user->profile->image->name }}"  height="50" width="50">
                                                        @else
                                                                {!! HTML::image('images/avatar_empty.png', 'a picture', array('class' => 'avatarOverviewFollow', 'width' => '50', 'height' => '50')) !!}
                                                        @endif
                                                    </a>
                                                    <div class="onoffRacer">
                                                        <span class="label label-danger onoffRacerSpan">&nbsp;</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </div>              
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" >
                            <div class="raceTitles">Chat: </div>
                            <div class="wrapperBoxesChat">
                                <div id="raceChat">
                                </div>
                                <div id="chatInputWrapper">
                                    <span class="glyphicon glyphicon-bullhorn" id="chatIcon"></span><input type="text" name="rcInput" id="chatMessageInput" />
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" >
                            <div class="raceTitles">Log: </div>
                            <div class="wrapperBoxesMessagesFromServer">
                                <div id="serverMessages">
                                </div>
                            </div>
                        </div>
                 </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div class="text-center">
                            <a href="#" class="btn btn-lg btn-primary" id="startRace">Start race</a>
                        </div>
                        <br />
                    </div>
                </div>    

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        <div id="canvasWrapper">
                            <img src="../images/flag.png" id="flagPolo" />
                            <!--
                            <canvas id="canvas">
                            </canvas>
                            -->
                        </div>

                        <audio preload="true" id="collide">
                            <source src="../js/Metal%20Cling%20-%20Hit.mp3" />
                            <source src="../js/Metal%20Cling%20-%20Hit.wav" />
                        </audio>

                    </div>
                </div>                                

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                      <br />
                      <div id="container1">
                      </div>

                      <div id="container2">
                      </div>              
                    </div>
                </div>

                    <!--
                        <label><input type='checkbox' id='showPath'>Show SVG Path</label>
                        <br><br>
                        <button id='addWalker'>Add Another</button>
                        <div class='walkerController'>
                            <button class='delete' title='Remove This Walker Instance'>&times;</button>
                            <label>
                                <input type='checkbox'>
                                <button class='stopPlay'></button>
                            </label>
                            <label>
                                <input type='checkbox'>
                                <button class='reverse'></button>
                            </label>
                            <select>
                                <option value=''>No Easing</option>
                                <option value='Math.pow(t,3)'>easeInCubic</option>
                                <option value='1-Math.pow(1-t,3)'>easeOutCubic</option>
                                <option value='Math.pow(2,-10*t) * Math.sin((t-2/4)*(2*Math.PI)/2) + 1'>easeOutElastic</option>
                                <option value='t*t'>easeInQuad</option>
                                <option value='t*(2-t)'>easeOutQuad</option>
                                <option value='t<.5 ? 2*t*t : -1+(4-2*t)*t'>easeInOutQuad</option>
                                <option value='t<.5 ? 8*t*t*t*t : 1-8*(--t)*t*t*t'>easeInOutQuart</option>
                            </select>
                            <br>
                            <input class='speed' type="range" min="1" max="100" step="1" value="30">
                            <span>Time (s)</span>
                        </div>
                    -->

                    <!--
                    <div class='walker'>&#9654;</div>
                    <object id='svgPath' data="path.svg" width="596" height="660" type="image/svg+xml"></object>
                    -->
            </div>
        </div>

    </div>

@endsection

