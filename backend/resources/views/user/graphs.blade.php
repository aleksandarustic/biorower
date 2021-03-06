@extends('layouts.main')

@section('content')
<section class="content">
<div class="row"> 
	<div class="col-md-3 col-left">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                <div class="img-circle-width">
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->name) }}" alt="User profile picture">
                  </div>
                  <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name}}
                  @if($user->online == 1)
                      <i class="fa fa-circle text-success"></i>
                  @else
                      <i class="fa fa-circle text-danger"></i>
                  @endif
                  </h3>
                  <p class="text-muted text-center">&#64;{{ $user->display_name }} 
					 <i class="fa  fa-map-marker"></i> @if($user->country) {{ $user->country }}
                  @else unknown @endif  
                 </p>
                  <input type="hidden" name="user-email" id="user-email" value="{{ $user->email }}">
                 <!-- <a href="edit-profile.html" class="btn btn-primary btn-block"><b>Edit Profile</b></a>-->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        <a href="{{asset($user->display_name)}}" class="btn btn-primary btn-block"><b> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to {{ $user->first_name.' '.$user->last_name}} profile</b></a>
  </div><!-- /.col LEFT-->

        <div class="col-md-9 friends-pro no-shadow">
            <div class="nav-tabs-custom box no-border transp-bg no-shadow">
               <h1 class="pull-left friends-pro-h1"><i class="fa fa-line-chart text-aqua" aria-hidden="true"></i> User Graphs:</h1>
               
               	<div class="friends-btns-group">
               	<div class="btn-group">
                      <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-check margin-r-5" aria-hidden="true"></i> <span class="follow-txt">Friends </span>
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        @if($getstatus == 1)
                            <li id="id-getnotif"><a id="ungetnotification"><i class="fa fa-check" aria-hidden="true"></i> Get Notifications</a></li>
                        @else
                            <li id="id-getnotif"><a id="getnotification">Get Notifications</a></li>
                        @endif
                        <li><a href="#">  Block</a></li>                   
                        <li class="divider"></li>
                        <li><a href="#" id="unfriend-button"> Unfriend</a></li>
                      </ul>
                    </div>
                  <button type="button" class="btn btn-default margin-r-5 fsm-btn"  data-toggle="control-sidebar" id="chat-view"><i class="fa fa-comments" aria-hidden="true"></i> <span class="msm-txt">Sent Message</span></button>  
              	</div>
            </div> <!-- /.nav-tabs-custom box-->

<div class="row">
  <div class="col-md-12">

               <div class="col-md-12 white-bg box box-primary no-padding historyGraph graph-box">
                    <div class="graphic-header historyGraph-header">
                        <div class="historyGraph-header-body">
                                 <div>
                                         <div class="box-default pull-left" style="margin-top: -8px;margin-left: 10px;margin-right: 20px" id="strelice">

                                <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous" id="next2"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate.subtract(1,piktoBiorowerGraph.rangeType)) ;
                                                  
            var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
            groupType:'none',
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });

                                   "
                                        ><i class="fa fa-chevron-left"></i></a>
                                <a href="javascript:;" id="next1" class="btn btn-box-tool" dat a-toggle="tooltip" title="" data-original-title="Next"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate.add(1,piktoBiorowerGraph.rangeType));
                                      
            var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:'none',
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });

;"
                                        ><i class="fa fa-chevron-right"></i></a>
                            </div>
                                <h3 class="pull-left" id="tekst">History</h3>
                              
                            </div>
                            <div class="pull-left left-options">
                                <!-- /.form group -->

                            </div>


                            <div>

                                <!--Btn links -->

                                <div class="pull-right change-btn" style="margin-top: -11px; margin-right: 10px;">


                                    <a href="javascript:;" class="btn btn-link" id="week_history"
                                       onclick="
                                            if(piktoBiorowerGraph.startDate==''){
                                         piktoBiorowerGraph.startDate=moment().subtract(1,'week'); 
                                     }     
                                            if(moment(piktoBiorowerGraph.startDate).add(1,piktoBiorowerGraph.rangeType).add(1,'day')>moment()){
                   piktoBiorowerGraph.startDate=moment().subtract(1,'week');
                  
                   
                               
                                   
                                   
                           }
                           
                           
                                  if(moment(piktoBiorowerGraph.startDate).add(1,'week').add(1,'day')>moment()){
                   piktoBiorowerGraph.startDate=moment().subtract(1,'week');
                  
                   
                               
                                   
                                   
                           }    
                           
                                if(moment(piktoBiorowerGraph.startDate)< piktoBiorowerGraph.start){
                   piktoBiorowerGraph.startDate=moment(piktoBiorowerGraph.start).subtract(2,'day');
                  
                   
                               
                                   
                                   
                           }           
                                           
                                           
                                           
            

    piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'week',piktoBiorowerGraph.startDate);

  var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:'none',
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });

                                       "
                                            >Week</a>
                                    <a href="javascript:;" class="btn btn-link" id="month_history"
                                       onclick="
                         if(piktoBiorowerGraph.startDate==''){
                                         piktoBiorowerGraph.startDate=moment().subtract(1,'month'); 
                                     }                     
                                         
                     if(moment(piktoBiorowerGraph.startDate).add(1,piktoBiorowerGraph.rangeType).add(1,'day')>moment()){
                   piktoBiorowerGraph.startDate=moment().subtract(1,'month');
                  
                 
                               
                                   
                                   
                           }
                           
                           
                                  if(moment(piktoBiorowerGraph.startDate).add(1,piktoBiorowerGraph.rangeType).add(1,'day')>moment()){
                   piktoBiorowerGraph.startDate=moment().subtract(1,'month');
                  
                   
                               
                                   
                                   
                           }
                             if(moment(piktoBiorowerGraph.startDate)< piktoBiorowerGraph.start){
                   piktoBiorowerGraph.startDate=moment(piktoBiorowerGraph.start).subtract(15,'day');
                  
                   
                               
                                   
                                   
                           }
                    
                    
                                
                                           




                piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'month',piktoBiorowerGraph.startDate);
                var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:'none',
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });




                                       "
                                            >Month</a>
                                    <a href="javascript:;" class="btn btn-link" id="year_history"
                                       onclick="
                                             if(moment(piktoBiorowerGraph.startDate)< piktoBiorowerGraph.start){
                   piktoBiorowerGraph.startDate=moment(piktoBiorowerGraph.start).subtract(1,'month');
                  
                   
                               
                                   
                                   
                           }   
                                     if(piktoBiorowerGraph.startDate==''){
                                         piktoBiorowerGraph.startDate=moment().subtract(1,'year'); 
                                     }           
                           
                           
                         
                               if(moment(piktoBiorowerGraph.startDate).add(1,piktoBiorowerGraph.rangeType).add(1,'day')>moment()){
                   piktoBiorowerGraph.startDate=moment().subtract(1,'year');
                  
                   
                               
                                   
                                   
                           }   
                           
                                            if(moment(piktoBiorowerGraph.startDate).add(1,'year').add(10,'day')>moment()){
                                            
                   piktoBiorowerGraph.startDate=moment().subtract(1,'year');
                  
                   
                               
                                   
                                   
                           }  
                         
                           
    piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'year',piktoBiorowerGraph.startDate);
                                    var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
            groupType:'none',
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });

                                       "
                                            >Year</a>
                                    <a href="javascript:;" class="btn btn-sm btn-primary" id="all_history"
                                       onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'all','');
                                            var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            cilj:2,
              groupType:'none',
        };
            var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:'none',
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });


                                       "
                                            >All</a>

                                </div>



                            </div>
                        </div>
                        <div class="graphic-body">

                            <div>
                                <div id="history" style="height: 300px;"></div>

                                <div class="graphic-footer" >
                                        <a href="javascript:;" class="pull-right btn-param" id="skaliranje" style=" margin-right: 10px;"
                                            >X1</a>
                                    <a class="pull-left btn-param" id="link" href="#" data-toggle="modal" data-target="#myParam"><i class="fa fa-cog"></i></a>


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
                                                     <div class="row">

                                                    <!-- List of Parametars -->
                                                    <div id="history-graph-params" class="param-box">
                                                          <ul class="checkbox icheck modalParm-list" id="lista1">
                                                                 <div class="col-md-6">  

                                                            <li>
                                                                <label for="strokeCount">
                                                                    <input type="checkbox" class="parameters" id="strokeCount" value="scnt" >
                                                                    <span class="scnt">Stroke Count</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeDistance">
                                                                    <input type="checkbox" class="parameters" id="strokeDistance" value="sdist_avg">
                                                                    <span class="sdist_avg">Stroke Distance</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="speedMax">
                                                                    <input type="checkbox" class="parameters" id="speedMax" value="spd_max">
                                                                    <span class="spd_max">Speed Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace2km">
                                                                    <input type="checkbox" class="parameters" id="pace2km" value="pace2k_avg">
                                                                    <span class="pace2k_avg">Pace 2km</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="hrMax">
                                                                    <input type="checkbox" class="parameters" id="hrMax" value="hr_max">
                                                                    <span class="hr_max">HR Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="calories23">
                                                                    <input type="checkbox" class="parameters" id="calories23" value="cal">
                                                                    <span class="cal">Calories</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="time23">
                                                                    <input type="checkbox" class="parameters" id="time23" value="time">
                                                                    <span class="time">Time</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeDistMax">
                                                                    <input type="checkbox" class="parameters" id="strokeDistMax" value="sdist_max">
                                                                    <span class="sdist_max">Stroke Dist. Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace500m">
                                                                    <input type="checkbox" class="parameters" id="pace500m" value="pace500_avg">
                                                                    <span class="pace500_avg">Pace 500m</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace2kmMax">
                                                                    <input type="checkbox" class="parameters" id="pace2kmMax" value="pace2k_max">
                                                                    <span class="pace2k_max">Pace 2km Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeRate">
                                                                    <input type="checkbox" class="parameters" id="strokeRate" value="srate_avg">
                                                                    <span class="srate_avg">Stroke Rate</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="powerL">
                                                                    <input type="checkbox" class="parameters" id="powerL" value="pwr_l_avg">
                                                                    <span class="pwr_l_avg">Power L</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="distance2">
                                                                    <input type="checkbox" class="parameters" id="distance2" value="dist">
                                                                    <span class="dist">Distance</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="speed">
                                                                    <input type="checkbox" class="parameters" id="speed" value="spd_avg">
                                                                    <span class="spd_avg">Speed</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace500mMax">
                                                                    <input type="checkbox" class="parameters" id="pace500mMax" value="pace500_max">
                                                                    <span class="pace500_max">Pace 500m Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="hr">
                                                                    <input type="checkbox" class="parameters" id="hr" value="hr_avg">
                                                                    <span class="hr_avg">HR</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                         
                                                            <li>
                                                                <label for="strokeRateMax">
                                                                    <input type="checkbox" class="parameters" id="strokeRateMax" value="srate_max">
                                                                    <span class="srate_max">Stroke Rate Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->

                                                            <li>
                                                                <label for="power">
                                                                    <input type="checkbox" class="parameters" id="power" value="pwr_avg">
                                                                    <span class="pwr_avg">Power average</span>
                                                                </label>
                                                            </li>
                                                            
                                                            <li>
                                                                <label for="powerMax">
                                                                    <input type="checkbox" class="parameters" id="powerMax" value="pwr_max">
                                                                    <span class="pwr_max">Power max</span>
                                                                </label>
                                                            </li>


                                                            <li>
                                                                <label for="powerLMax">
                                                                    <input type="checkbox" class="parameters" id="powerLMax" value="pwr_l_max">
                                                                    <span class="pwr_l_max">Power L Max</span>
                                                                </label>
                                                            </li>
                                                               </div>
                                                        <div class="col-md-6">
                                                            <li>
                                                                <label for="powerR">
                                                                    <input type="checkbox" class="parameters" id="powerR" value="pwr_r_avg">
                                                                    <span class="pwr_r_avg">Power right average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerRmax">
                                                                    <input type="checkbox" class="parameters" id="powerRmax" value="pwr_r_max">
                                                                    <span class="pwr_r_max">Power right max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerBalance">
                                                                    <input type="checkbox" class="parameters" id="powerBalance" value="pwr_bal_avg">
                                                                    <span class="pwr_bal_avg">Power balance</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerBalanceMax">
                                                                    <input type="checkbox" class="parameters" id="powerBalanceMax" value="pwr_bal_max">
                                                                    <span class="pwr_bal_max">Power balance max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleLeftAvg">
                                                                    <input type="checkbox" class="parameters" id="angleLeftAvg" value="ang_l_avg">
                                                                    <span class="ang_l_avg">Angle left average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleLeftMax">
                                                                    <input type="checkbox" class="parameters" id="angleLeftMax" value="ang_l_max">
                                                                    <span class="ang_l_max">Angle left Max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleRightAvg">
                                                                    <input type="checkbox" class="parameters" id="angleRightAvg" value="ang_r_avg">
                                                                    <span class="ang_r_avg">Angle right average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleRightMax">
                                                                    <input type="checkbox" class="parameters" id="angleRightMax" value="ang_r_max">
                                                                    <span class="ang_r_max">Angle right max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angle">
                                                                    <input type="checkbox" class="parameters" id="angle" value="ang_avg">
                                                                    <span class="ang_avg">Angle average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleMax">
                                                                    <input type="checkbox" class="parameters" id="angleMax" value="ang_max">
                                                                    <span class="ang_max">Angle max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="mml2">
                                                                    <input type="checkbox" class="parameters" id="mml2" value="mml2">
                                                                    <span class="mml2">MML 2 Level</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="mml4">
                                                                    <input type="checkbox" class="parameters" id="mml4" value="mml4">
                                                                    <span class="mml4">MML 4 Level</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_avg">
                                                                    <input type="checkbox" class="parameters" id="frc_avg" value="frc_avg">
                                                                    <span class="frc_avg">Force average</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_bal_avg">
                                                                    <input type="checkbox" class="parameters" id="frc_bal_avg" value="frc_bal_avg">
                                                                    <span class="frc_bal_avg">Force balance average</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_bal_max">
                                                                    <input type="checkbox" class="parameters" id="frc_bal_max" value="frc_bal_max">
                                                                    <span class="frc_bal_max">Force balance max</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_l_avg">
                                                                    <input type="checkbox" class="parameters" id="frc_l_avg" value="frc_l_avg">
                                                                    <span class="frc_l_avg">Force left average</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_l_max">
                                                                    <input type="checkbox" class="parameters" id="frc_l_max" value="frc_l_max">
                                                                    <span class="frc_l_max">Force left max</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_max">
                                                                    <input type="checkbox" class="parameters" id="frc_max" value="frc_max">
                                                                    <span class="frc_max">Force max</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_r_avg">
                                                                    <input type="checkbox" class="parameters" id="frc_r_avg" value="frc_r_avg">
                                                                    <span class="frc_r_avg">Force right average</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_r_max">
                                                                    <input type="checkbox" class="parameters" id="frc_r_max" value="frc_r_max">
                                                                    <span class="frc_r_max">Force right max</span>
                                                                </label>
                                                            </li>


                                                        </div>

                                                            <!-- End Parametar Item -->
                                                        </ul><!-- /.contatcts-list -->

                                                        </div>


                                                    </div><!-- /.List of Parametars -->
                                                     <div id="progress-graph-params" class="param-box">
                                                              <div class="row">

                                                          <ul class="checkbox icheck modalParm-list" >
                                                               <div class="col-md-6"> 
                                                            <li>
                                                                <label for="strokeCount2">
                                                                    <input type="checkbox" class="parameters2" id="strokeCount2" value="scnt" >
                                                                    <span class="scnt2">Stroke Count</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeDistance2">
                                                                    <input type="checkbox" class="parameters2" id="strokeDistance2" value="sdist_avg">
                                                                    <span class="sdist_avg2">Stroke Distance</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="speedMax2">
                                                                    <input type="checkbox" class="parameters2" id="speedMax2" value="spd_max">
                                                                    <span class="spd_max2">Speed Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace2km2">
                                                                    <input type="checkbox" class="parameters2" id="pace2km2" value="pace2k_avg">
                                                                    <span class="pace2k_avg2">Pace 2km</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="hrMax2">
                                                                    <input type="checkbox" class="parameters2" id="hrMax2" value="hr_max">
                                                                    <span class="hr_max2">HR Max</span>
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
                                                                <label for="strokeDistMax2">
                                                                    <input type="checkbox" class="parameters2" id="strokeDistMax2" value="sdist_max">
                                                                    <span class="sdist_max2">Stroke Dist. Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace500m2">
                                                                    <input type="checkbox" class="parameters2" id="pace500m2" value="pace500_avg">
                                                                    <span class="pace500_avg2">Pace 500m</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace2kmMax2">
                                                                    <input type="checkbox" class="parameters2" id="pace2kmMax2" value="pace2k_max">
                                                                    <span class="pace2k_max2">Pace 2km Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeRate2">
                                                                    <input type="checkbox" class="parameters2" id="strokeRate2" value="srate_avg">
                                                                    <span class="srate_avg2">Stroke Rate</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="powerL2">
                                                                    <input type="checkbox" class="parameters2" id="powerL2" value="pwr_l_avg">
                                                                    <span class="pwr_l_avg2">Power L</span>
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
                                                                    <input type="checkbox" class="parameters2" id="speed2" value="spd_avg">
                                                                    <span class="spd_avg2">Speed</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace500mMax2">
                                                                    <input type="checkbox" class="parameters2" id="pace500mMax2" value="pace500_max">
                                                                    <span class="pace500_max2">Pace 500m Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="hr2">
                                                                    <input type="checkbox" class="parameters2" id="hr2" value="hr_avg">
                                                                    <span class="hr_avg2">HR</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                          
                                                            <li>
                                                                <label for="strokeRateMax2">
                                                                    <input type="checkbox" class="parameters2" id="strokeRateMax2" value="srate_max">
                                                                    <span class="srate_max2">Stroke Rate Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->

                                                            <li>
                                                                <label for="power2">
                                                                    <input type="checkbox" class="parameters2" id="power2" value="pwr_avg">
                                                                    <span class="pwr_avg2">Power average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerMax2">
                                                                    <input type="checkbox" class="parameters2" id="powerMax2" value="pwr_max">
                                                                    <span class="pwr_max2">Power max</span>
                                                                </label>
                                                            </li>

   
                                                            <li>
                                                                <label for="powerLMax2">
                                                                    <input type="checkbox" class="parameters2" id="powerLMax2" value="pwr_l_max">
                                                                    <span class="pwr_l_max2">Power L Max</span>
                                                                </label>
                                                            </li>
                                                            </div>	
                                                        <div class="col-md-6">
                                                            <li>
                                                                <label for="powerR2">
                                                                    <input type="checkbox" class="parameters2" id="powerR2" value="pwr_r_avg">
                                                                    <span class="pwr_r_avg2">Power right average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerRmax2">
                                                                    <input type="checkbox" class="parameters2" id="powerRmax2" value="pwr_r_max">
                                                                    <span class="pwr_r_max2">Power right max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerBalance2">
                                                                    <input type="checkbox" class="parameters2" id="powerBalance2" value="pwr_bal_avg">
                                                                    <span class="pwr_bal_avg2">Power balance</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerBalanceMax2">
                                                                    <input type="checkbox" class="parameters2" id="powerBalanceMax2" value="pwr_bal_max">
                                                                    <span class="pwr_bal_max2">Power balance max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleLeftAvg2">
                                                                    <input type="checkbox" class="parameters2" id="angleLeftAvg2" value="ang_l_avg">
                                                                    <span class="ang_l_avg2">Angle left average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleLeftMax2">
                                                                    <input type="checkbox" class="parameters2" id="angleLeftMax2" value="ang_l_max">
                                                                    <span class="ang_l_max2">Angle left Max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleRightAvg2">
                                                                    <input type="checkbox" class="parameters2" id="angleRightAvg2" value="ang_r_avg">
                                                                    <span class="ang_r_avg2">Angle right average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleRightMax2">
                                                                    <input type="checkbox" class="parameters2" id="angleRightMax2" value="ang_r_max">
                                                                    <span class="ang_r_max2">Angle right max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angle2">
                                                                    <input type="checkbox" class="parameters2" id="angle2" value="ang_avg">
                                                                    <span class="ang_avg2">Angle average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleMax2">
                                                                    <input type="checkbox" class="parameters2" id="angleMax2" value="ang_max">
                                                                    <span class="ang_max2">Angle max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="mml22">
                                                                    <input type="checkbox" class="parameters2" id="mml22" value="mml2">
                                                                    <span class="mml22">MML 2 Level</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="mml42">
                                                                    <input type="checkbox" class="parameters2" id="mml42" value="mml4">
                                                                    <span class="mml42">MML 4 Level</span>
                                                                </label>
                                                            </li>
                                                                <li>
                                                                <label for="frc_avg2">
                                                                    <input type="checkbox" class="parameters2" id="frc_avg2" value="frc_avg">
                                                                    <span class="frc_avg2">Force average</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_bal_avg2">
                                                                    <input type="checkbox" class="parameters2" id="frc_bal_avg2" value="frc_bal_avg">
                                                                    <span class="frc_bal_avg2">Force balance average</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_bal_max2">
                                                                    <input type="checkbox" class="parameters2" id="frc_bal_max2" value="frc_bal_max">
                                                                    <span class="frc_bal_max2">Force balance max</span>
                                                                </label>
                                                            </li>
                                                              <li>
                                                                <label for="frc_l_avg2">
                                                                    <input type="checkbox" class="parameters2" id="frc_l_avg2" value="frc_l_avg">
                                                                    <span class="frc_l_avg2">Force left average</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_l_max2">
                                                                    <input type="checkbox" class="parameters2" id="frc_l_max2" value="frc_l_max">
                                                                    <span class="frc_l_max2">Force left max</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_max2">
                                                                    <input type="checkbox" class="parameters2" id="frc_max2" value="frc_max">
                                                                    <span class="frc_max2">Force max</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_r_avg2">
                                                                    <input type="checkbox" class="parameters2" id="frc_r_avg2" value="frc_r_avg">
                                                                    <span class="frc_r_avg2">Force right average</span>
                                                                </label>
                                                            </li>
                                                             <li>
                                                                <label for="frc_r_max2">
                                                                    <input type="checkbox" class="parameters2" id="frc_r_max2" value="frc_r_max">
                                                                    <span class="frc_r_max2">Force right max</span>
                                                                </label>
                                                            </li>


</div>
                                                            <!-- End Parametar Item -->
                                                        </ul><!-- /.contatcts-list -->


</div>

                                                    </div>









                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary margin-r-5" id="dugme1"
                                                            onclick="var newHistoryParams = $('#history-graph-params input:checked').map(function(){
                                                                    var value = $(this).val();
                                                                    var parameter = {
                                                                        slug: value,
                                                                        label: $('.'+value).text()
                                                                    }
                                                                    return parameter;
                                                                 }).get();
                                                                 var linije=['spd'];


                                                                 var newHistoryData = piktoBiorowerGraph.getHistoryData(newHistoryParams);


                                                                 piktoBiorowerGraph.historyPlot.setData(newHistoryData);

                                                                   var opts = piktoBiorowerGraph.historyPlot.getOptions();
                  var r= piktoBiorowerGraph.parameters;
                  var duzina=r.length;
              
              
              
             
            
            
             
                


                    


                    
                       

 
                   piktoBiorowerGraph.historyPlot.setupGrid();
                    piktoBiorowerGraph.historyPlot.draw();
                                  piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate);

                    
                    
                     
            var s=[];
                 for(var i=0;i< piktoBiorowerGraph.parameters.length; i++){
                    s[i]=piktoBiorowerGraph.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph.parameters[0]){
                    s[0]=piktoBiorowerGraph.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph.parameters[1]){
                      s[1]=piktoBiorowerGraph.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph.parameters[2]){
                      s[2]=piktoBiorowerGraph.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'history',
            date_start: piktoBiorowerGraph.startDate?piktoBiorowerGraph.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });




                                                                 $('#myParam').modal('hide');">
                                                        Save changes
                                                    </button>

                                                    <button type="button" class="btn btn-primary margin-r-5" id="dugme2"
                                                            onclick="var newHistoryParams = $('#progress-graph-params input:checked').map(function(){
                                                                    var value = $(this).val();
                                                                    var parameter = {
                                                                        slug: value,
                                                                        label: $('.'+value+'2').text(),
                                                                    }
                                                                    return parameter;
                                                                 }).get();
                                                                 var newHistoryData = piktoBiorowerGraph2.getHistoryData(newHistoryParams);
                                                                 piktoBiorowerGraph2.progressPlot.setData(newHistoryData);
                                                                 piktoBiorowerGraph2.progressPlot.setupGrid();
                                                                 piktoBiorowerGraph2.progressPlot.draw();
                                                                             piktoBiorowerGraph2.progressPlot.setData(newHistoryData);

                                                                   var opts = piktoBiorowerGraph2.progressPlot.getOptions();
                  var r= piktoBiorowerGraph2.parameters;
                  var duzina=r.length;




                       if(duzina==1){

                            opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].position='left';
                              opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].color='green';


                       }
                        if(duzina==2){
                              opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].position='left';


                            opts.yaxes[piktoBiorowerGraph2.parameters[1].yaxis-1].position='right';
                       }
                        if(duzina==3){


                            opts.yaxes[piktoBiorowerGraph2.parameters[0].yaxis-1].position='left';
                            opts.yaxes[piktoBiorowerGraph2.parameters[1].yaxis-1].position='left';
                            opts.yaxes[piktoBiorowerGraph2.parameters[2].yaxis-1].position='right';
                       }


                   piktoBiorowerGraph2.progressPlot.setupGrid();
                    piktoBiorowerGraph2.progressPlot.draw();
                    
                                                      piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate,piktoBiorowerGraph2.groupType);

                    
                       var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });   
                    

                                                                 $('#myParam').modal('hide');">
                                                        Save changes
                                                    </button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                </div><!-- /.example-modal -->


                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                    <div class="clear relative"></div>
                </div>
                <!-- /.Graph Block-->

                <!-- Graph Block-->
                <div class="col-md-12 white-bg box box-primary no-padding historyGraph graph-box">
                    <div class="graphic-header historyGraph-header">
                        <div class="historyGraph-header-body">
                            
                                 <div>
                                        <div class="box-default pull-left" style="margin-top: -8px;margin-left: 10px;margin-right: 20px"id="strelice2">

                                <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip" id="next3" title="" data-original-title="Previous"
                                   onclick="
                               piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate.subtract(1,piktoBiorowerGraph2.rangeType), piktoBiorowerGraph2.groupType) ;
                         var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });         
    
    ;"
                                        ><i class="fa fa-chevron-left"></i></a>
                                <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip"  id="next4" title="" data-original-title="Next"
                                   onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate.add(1,piktoBiorowerGraph2.rangeType), piktoBiorowerGraph2.groupType);
                                            
                                           
                                           
                                   var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });         
;"
                                        ><i class="fa fa-chevron-right"></i></a>
                            </div>
                             <h3 class="pull-left" id="tekst2">Progress</h3>
                           
                            </div>
                            <div class="pull-left left-options">
                                <!-- /.form group -->

                            </div>


                            <div>

                                <!--Btn links -->

                                <div class="pull-right change-btn" style="margin-top: -11px; margin-right: 10px;">

                    <a href="javascript:;" class="btn btn-link" id="year_progress"
                                           onclick="
                                   
                                   
                           
                         
                               if(moment(piktoBiorowerGraph.startDate).add(1,piktoBiorowerGraph.rangeType).add(1,'day')>moment()){
                   piktoBiorowerGraph.startDate=moment().subtract(1,'year');
                  
                   
                               
                                   
                                   
                           }   
                           
                                            if(moment(piktoBiorowerGraph.startDate).add(1,'year').add(10,'day')>moment()){
                                            
                   piktoBiorowerGraph.startDate=moment().subtract(1,'year');
                  
                   
                               
                                   
                                   
                           }  
                                       
                                       
                                       
                                       
                                         if(moment(piktoBiorowerGraph2.startDate)< piktoBiorowerGraph2.start){
                   piktoBiorowerGraph2.startDate=moment(piktoBiorowerGraph2.start).subtract(1,'month');
                  
                   
                               
                                   
                                   
                           }   
                                     if(piktoBiorowerGraph2.startDate==''){
                                         piktoBiorowerGraph2.startDate=moment().subtract(1,'year'); 
                                     }           
                           
                           
                         
                               if(moment(piktoBiorowerGraph2.startDate).add(1,piktoBiorowerGraph2.rangeType).add(1,'day')>moment()){
                   piktoBiorowerGraph2.startDate=moment().subtract(1,'year');
                  
                   
                               
                                   
                                   
                           }   
                           
                                            if(moment(piktoBiorowerGraph2.startDate).add(1,'year').add(10,'day')>moment()){
                                            
                   piktoBiorowerGraph2.startDate=moment().subtract(1,'year');
                  
                   
                               
                                   
                                   
                           }  
                                       
                                       
               

    piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'year',piktoBiorowerGraph2.startDate,piktoBiorowerGraph2.groupType);
                                               var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });         "
                                                >Year</a>
                                        <a href="javascript:;" class="btn btn-sm btn-primary" id="all_progress"
                                           onclick="

    piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'all','',piktoBiorowerGraph2.groupType);
                                               var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:' + $('#user-email').val(),
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('api/v1/graph_setting', data3, function (response3) {


             });         "
                                                >All</a>

                                </div>



                            </div>
                        </div>
                        <div class="graphic-body">

                            <div>
                                <div id="progress" style="height: 300px;"></div>

                                <div class="graphic-footer" >
                                        <a href="javascript:;" class="pull-right btn-param" style=" margin-right: 10px;" id="skaliranje2"
                                                >X1</a>
                                    <a href="javascript:;" style="margin-right: 10px" class="pull-right btn-param" id="izbor1"  
                                        >Group by Month</a>
                          

                                 <a class="pull-left btn-param" href="#" data-toggle="modal" data-target="#myParam" id="link2"><i class="fa fa-cog"></i></a>


                                </div>









                            </div>
                            <div class="clear"></div>
                        </div>

                    </div>
                    <div class="clear relative"></div>
                </div>






      
  </div><!-- /.col -->
</div><!-- /.row -->       



</div><!-- /.col-md-9 friends-pro --> 



              
</div> <!-- /.row -->
</section> 
@endsection

@section('page-scripts')
  <script src="{{ URL::asset('js/moment-range.js') }}"></script>
    <script src="{{ URL::asset('dist/js/pages/profile.js') }}"></script>
  


    <script>
        $(document).ready(function () {
            
       

           var end= moment();
        var s=new Date("October 10, 2016 11:13:00");
        var s2=new Date("October 10, 2017 11:13:00");
        var dr2=moment.range(s, s2);
        
            var data4 = {
            account: 'biorower:{{Auth::user()->email}}',
            cilj:1,
        };
             $.post('{{asset('api/v1/graph_setting')}}', data4, function (response4) {



        var dateStart=response4.history[0].dateStart;
        var rangeType=response4.history[0].rangeType;
        var parametar1=response4.history[0].parametar1;
        var parametar2=response4.history[0].parametar2;
        var parametar3=response4.history[0].parametar3;
        
        
        
        
        
        
        
        var groupType=response4.progress[0].groupType;
         var dateStart2=response4.progress[0].dateStart;
        var rangeType2=response4.progress[0].rangeType;
        var parametar12=response4.progress[0].parametar1;
        var parametar22=response4.progress[0].parametar2;
        var parametar32=response4.progress[0].parametar3;
      
        


        for(var i=0;i<document.getElementsByClassName("parameters").length; i++){



                  if(document.getElementsByClassName("parameters")[i].value==parametar1){
            
                 var id2=document.getElementsByClassName("parameters")[i].id;
     
                $('#'+id2).iCheck('check');
                 
                  


             }
               if(document.getElementsByClassName("parameters")[i].value==parametar2){
                  var id2=document.getElementsByClassName("parameters")[i].id;
     
                $('#'+id2).iCheck('check');
                 
                


             }
               if(document.getElementsByClassName("parameters")[i].value==parametar3){
                  var id2=document.getElementsByClassName("parameters")[i].id;
     
                $('#'+id2).iCheck('check');
                 
                


             }




    }
 
         for(var i=0;i<document.getElementsByClassName("parameters2").length; i++){



                  if(document.getElementsByClassName("parameters2")[i].value==parametar12){
            
                 var id2=document.getElementsByClassName("parameters2")[i].id;
     
                $('#'+id2).iCheck('check');
                 
                  


             }
               if(document.getElementsByClassName("parameters2")[i].value==parametar22){
                  var id2=document.getElementsByClassName("parameters2")[i].id;
     
                $('#'+id2).iCheck('check');
                 
                


             }
               if(document.getElementsByClassName("parameters2")[i].value==parametar32){
                  var id2=document.getElementsByClassName("parameters2")[i].id;
     
                $('#'+id2).iCheck('check');
                 
                


             }




    }
 

   

        if(rangeType=="all"){





              piktoBiorowerGraph.loadHistoryData('{{Auth::user()->email}}',rangeType,'');







        }
        else{
           
              piktoBiorowerGraph.loadHistoryData('{{Auth::user()->email}}',rangeType,moment(dateStart));

                  
        }
      
                       
                       
                       
                   
          if(rangeType2=="all"){
        





              piktoBiorowerGraph2.loadHistoryData('{{Auth::user()->email}}',rangeType2,'',groupType);







        }
        else{
          
           
              piktoBiorowerGraph2.loadHistoryData('{{Auth::user()->email}}',rangeType2,moment(dateStart2),groupType);

                  
        }
        
        
        
        
        
        
          var niz=[];
        
          var parameter1 = { slug: parametar1,label: $('.'+parametar1).text()}
          niz.push(parameter1);
          if(parametar2!="nista"){
              var parameter2= { slug: parametar2,label: $('.'+parametar2).text()}
              niz.push(parameter2);
          }
          if(parametar3!="nista"){
              var parameter3= { slug: parametar3,label: $('.'+parametar3).text()}
               niz.push(parameter3);
          }
          piktoBiorowerGraph.parameters=niz;
          
           var niz2=[];
        
          var parameter12 = { slug: parametar12,label: $('.'+parametar12).text()}
          niz2.push(parameter12);
          if(parametar22!="nista"){
              var parameter22= { slug: parametar22,label: $('.'+parametar22).text()}
              niz2.push(parameter22);
          }
          if(parametar32!="nista"){
              var parameter32= { slug: parametar32,label: $('.'+parametar32).text()}
               niz2.push(parameter32);
          }
          piktoBiorowerGraph2.parameters=niz2;
       
          
          
          
        $("#dugme1").click();
        $("#dugme2").click();

         });

     $('.parameters').on('ifClicked', function(event){
             if(this.checked==true){



             }
             else{

             if ($('.parameters').filter(':checked').length == 3) {
              var s=$('.parameters').filter(':checked')[2].id;


              $('#'+s).iCheck('uncheck');
             }


    }



        });


          $('.parameters2').on('ifClicked', function(event){

                if(this.checked==true){



             }
             else{


             if ($('.parameters2').filter(':checked').length == 3) {
              var s=$('.parameters2').filter(':checked')[2].id;

      $('#'+s).iCheck('uncheck');

    }
    }



        });





            var skaliranje=500;
            var skaliranje2=500;
         


            $('#strelice').hide();
            $('#strelice2').hide();

            $('#link').click(function(){
                $('#dugme1').show();
                $('#dugme2').hide();
                $("#history-graph-params").show();
                $("#progress-graph-params").hide();
            });

            $('#link2').click(function(){
                $('#dugme2').show();
                $('#dugme1').hide();
                 $("#history-graph-params").hide();
                 $("#progress-graph-params").show();
            });
            
            $('#izbor1').click(function(){
               
                if(piktoBiorowerGraph2.groupType=="month"){
                     piktoBiorowerGraph2.loadHistoryData('{{Auth::user()->email}}',piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate,'week');
                      var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:{{Auth::user()->email}}',
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('{{asset('api/v1/graph_setting')}}', data3, function (response3) {


             });      
                    
                }
                else{
                     piktoBiorowerGraph2.loadHistoryData('{{Auth::user()->email}}',piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate,'month');
                      var s=[];
                 for(var i=0;i< piktoBiorowerGraph2.parameters.length; i++){
                    s[i]=piktoBiorowerGraph2.parameters[i].slug;

                 }
                  if(piktoBiorowerGraph2.parameters[0]){
                    s[0]=piktoBiorowerGraph2.parameters[0].slug;
                 }

                 if(piktoBiorowerGraph2.parameters[1]){
                      s[1]=piktoBiorowerGraph2.parameters[1].slug;
                 }
                 else{
                     s[1]='nista';
                 }
                   if(piktoBiorowerGraph2.parameters[2]){
                      s[2]=piktoBiorowerGraph2.parameters[2].slug;
                 }
                  else{
                     s[2]='nista';
                 }



                     var data3 = {
            account: 'biorower:{{Auth::user()->email}}',
            name: 'progress',
            date_start: piktoBiorowerGraph2.startDate?piktoBiorowerGraph2.startDate.format('YYYY-MM-DD'):'',
            range_type:piktoBiorowerGraph2.rangeType,
            parametar1:s[0],
            parametar2:s[1],
            parametar3:s[2],
              groupType:piktoBiorowerGraph2.groupType,
            cilj:2,

        };
             $.post('{{asset('api/v1/graph_setting')}}', data3, function (response3) {


             });      
                      
                }
               
             
            });




            $('#skaliranje').click(function(){

                skaliranje=skaliranje+500;
                if(skaliranje==500){
                     var opts = piktoBiorowerGraph.historyPlot.getOptions();
                    for(var i=0;i<opts.yaxes.length; i++){

                          opts.yaxes[i].max =  opts.yaxes[i].max/2;
                          opts.yaxes[i].tickSize=opts.yaxes[i].tickSize/2;


                    }

                      piktoBiorowerGraph.historyPlot.setupGrid();
                    piktoBiorowerGraph.historyPlot.draw();





                    $('#skaliranje').text("X1");







                }
                if(skaliranje==1000){
                    $('#skaliranje').text("X2");
                                        var opts = piktoBiorowerGraph.historyPlot.getOptions();
                      for(var i=0;i<opts.yaxes.length; i++){

                                              opts.yaxes[i].max =  opts.yaxes[i].max/2;
                                                opts.yaxes[i].tickSize=opts.yaxes[i].tickSize/2;


                    }




                    piktoBiorowerGraph.historyPlot.setupGrid();
                    piktoBiorowerGraph.historyPlot.draw();
                }
                if(skaliranje==1500){
                    $('#skaliranje').text("1/2X");
                    var opts = piktoBiorowerGraph.historyPlot.getOptions();
                        for(var i=0;i<opts.yaxes.length; i++){

                          opts.yaxes[i].max =   opts.yaxes[i].max*4;
                           opts.yaxes[i].tickSize=opts.yaxes[i].tickSize*4;

                    }





                    piktoBiorowerGraph.historyPlot.setupGrid();
                    piktoBiorowerGraph.historyPlot.draw();
                    skaliranje=0;
                }


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






        })
    </script>
@endsection
