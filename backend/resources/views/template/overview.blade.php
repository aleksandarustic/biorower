@extends('layouts.main')

@section('content')
    <section class="content">
        <script src="{{ URL::asset('js/jQuery-2.1.4.min.js') }}"></script>


        <div class="row">
            <div class="col-md-3 col-left">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="img-circle-width">
                            <a href="{{ url('/profile/edit') }}"><span class="label-edit edit-img"></span>
                                <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset(Auth::user()->profile->image->name) }}" alt="User profile picture"></a>
                        </div>
                        <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name }}</h3>
                        <p class="text-muted text-center">{{ $user->display_name }}</p>
                        <input type="hidden" name="user-email" id="user-email" value="{{ $user->email }}">

                        <!-- <a href="edit-profile.html" class="btn btn-primary btn-block"><b>Edit Profile</b></a>-->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <!-- About Me Box -->
                <div class="box no-bg no-border aboutMe-box">


                    <div class="aboutMe-body">
                        <div class="col-sm-6 about-border-r about-value-box">
                            <div class="about-desc">{{ date('Y-m-d', strtotime($user->created_at)) }}</div>
                            <div class="about-name">Member Since</div>
                        </div>
                        <!-- Item 1 -->
                        <div class="col-sm-6 about-value-box">
                            <div class="about-desc latest-session"></div>
                            <div class="about-name">Latest Session</div>
                        </div>
                        <!-- Item 2 -->
                        <div class="col-sm-12 about-border-t">
                            <div class="col-sm-6 about-rowerIcon">
                                <img src="dist/img/rower-icon.png">
                            </div>
                            <!-- Item 3.1 -->
                            <div class="col-sm-6 about-middle">
                                <div class="act-block about-value-box">
                                    <div class="about-value time2"></div>
                                    <div class="about-vname">Training time</div>
                                </div>
                                <!-- Item 3.2 -->

                                <div class="act-block about-value-box about-middle">
                                    <div class="about-value distance"></div>
                                    <div class="about-vname">Distance</div>
                                </div>
                                <!-- Item 3.3 -->
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="col-sm-12 about-border-t">
                            <div class="col-sm-6 about-value-box about-border-r">
                                <div class="about-value power-average"></div>
                                <div class="about-vname about-vname-last">Power average</div>
                            </div>
                            <!-- Item 4 -->
                            <div class="col-sm-6 about-value-box">
                                <div class="about-value heart-rate-avg"></div>
                                <div class="about-vname about-vname-last">Heart rate average</div>
                            </div>
                            <!-- Item 5 -->
                        </div>
                    </div>


                    <div class="clear"></div>
                    <!-- /.box-body -->
                </div><!-- /.box -->

                <!--I am Following -->


                <!-- Following me -->


            </div><!-- /.col -->

            <div class="col-md-9 margin-bottom ">
                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ $totalStatisticsParameters['sescnt'][0] }}</h5>
                            <span class="description-text">Total training sessions</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{  gmdate("H:i:s", $totalStatisticsParameters["time"][0]) }}</h5>
                            <span class="description-text">Total training time </span>
                            <span class="description-percentage-small-small text-blue btn-block">[hh:mm:ss]</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalStatisticsParameters["dist"][0], 1) }}</h5>
                            <span class="description-text">Total Distance</span>
                            <span class="description-percentage-small text-blue btn-block">[km]</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block">
                            <h5 class="description-header">{{ round($totalStatisticsParameters["pwr_avg"][0], 0) }}</h5>
                            <span class="description-text">Total Power average </span>
                            <span class="description-percentage-small text-blue btn-block">[W]</span>
                        </div><!-- /.description-block -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">

                            <h5 class="description-header">{{ $totalStatisticsParameters['scnt'][0] }}</h5>
                            <span class="description-text">Total number of strokes</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalStatisticsParameters["sdist_avg"][0], 2) }}</h5>
                            <span class="description-text">Total Stroke distance average </span>
                            <span class="description-percentage-small text-blue inline">[m]</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ round($totalStatisticsParameters["ang_avg"][0], 0) }}</h5>
                            <span class="description-text">Total Angle average</span>
                            <span class="description-percentage-small text-blue btn-block">[°]</span>
                        </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-12">
                        <div class="description-block">
                            <h5 class="description-header">{{ round($totalStatisticsParameters["hr_avg"][0], 2) }}</h5>
                            <span class="description-text ">Total HR average</span>
                            <span class="description-percentage-small text-blue btn-block">[bpm]</span>


                        </div><!-- /.description-block -->
                    </div>
                </div>
            </div>
            <!-- graph -->
            <div class="col-md-9" id="graphs">

                <!-- Graph Block-->
                <div class="col-md-12 white-bg box box-primary no-padding historyGraph graph-box">
                    <div class="graphic-header historyGraph-header">
                        <div class="historyGraph-header-body">
                            <div>
                                <h3 class="pull-left" id="tekst">History</h3>
                            </div>
                            <div class="pull-left left-options">
                                <!-- /.form group -->

                            </div>

                            <div class="box-tools pull-right" style="margin-top: -8px;" id="strelice">

                                <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous" id="next2"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate.subtract(1,piktoBiorowerGraph.rangeType)) ;"
                                        ><i class="fa fa-chevron-left"></i></a>
                                <a href="javascript:;" id="next1" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate.add(1,piktoBiorowerGraph.rangeType));
                     
;"
                                        ><i class="fa fa-chevron-right"></i></a>
                            </div>
                            <div>

                                <!--Btn links -->

                                <div class="pull-right change-btn" style="margin-top: -11px; margin-right: 10px;">


                                    <a href="javascript:;" class="btn btn-link" id="week_history"
                                       onclick=" piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'week',moment().startOf('week')); "
                                            >Week</a>
                                    <a href="javascript:;" class="btn btn-link" id="month_history"
                                       onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'month',moment().startOf('month'));
                                            
                                            
                                       
                                       "
                                            >Month</a>
                                    <a href="javascript:;" class="btn btn-link" id="year_history"
                                       onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'year',moment().startOf('year'));"
                                            >Year</a>
                                    <a href="javascript:;" class="btn btn-sm btn-primary" id="all_history"
                                       onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'all','');"
                                            >All</a>
                                    <a href="javascript:;" class="btn btn-sm btn-primary" id="skaliranje"
                                            >X1</a>
                                </div>



                            </div>
                        </div>
                        <div class="graphic-body">

                            <div>
                                <div id="history" style="height: 300px;"></div>

                                <div class="graphic-footer row">
                                    <a class="pull-right btn-param" id="link" href="#" data-toggle="modal" data-target="#myParam"><i class="fa fa-cog"></i></a>

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
                                                                <label for="strokeCount">
                                                                    <input type="checkbox" name="parameters" id="strokeCount" value="scnt">
                                                                    <span class="scnt">Stroke Count</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeDistance">
                                                                    <input type="checkbox" name="parameters" id="strokeDistance" value="sdist_avg">
                                                                    <span class="sdist_avg">Stroke Distance</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="speedMax">
                                                                    <input type="checkbox" name="parameters" id="speedMax" value="spd_max">
                                                                    <span class="spd_max">Speed Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace2km">
                                                                    <input type="checkbox" name="parameters" id="pace2km" value="pace2k_avg">
                                                                    <span class="pace2k_avg">Pace 2km</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="hrMax">
                                                                    <input type="checkbox" name="parameters" id="hrMax" value="hr_max">
                                                                    <span class="hr_max">HR Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="calories">
                                                                    <input type="checkbox" name="parameters" id="calories" value="cal">
                                                                    <span class="cal">Calories</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="time2">
                                                                    <input type="checkbox" name="parameters" id="time2" value="time">
                                                                    <span class="time">Time</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeDistMax">
                                                                    <input type="checkbox" name="parameters" id="strokeDistMax" value="sdist_max">
                                                                    <span class="sdist_max">Stroke Dist. Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace500m">
                                                                    <input type="checkbox" name="parameters" id="pace500m" value="pace500_avg">
                                                                    <span class="pace500_avg">Pace 500m</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace2kmMax">
                                                                    <input type="checkbox" name="parameters" id="pace2kmMax" value="pace2k_max">
                                                                    <span class="pace2k_max">Pace 2km Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeRate">
                                                                    <input type="checkbox" name="parameters" id="strokeRate" value="srate_avg">
                                                                    <span class="srate_avg">Stroke Rate</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="powerL">
                                                                    <input type="checkbox" name="parameters" id="powerL" value="pwr_l_avg">
                                                                    <span class="pwr_l_avg">Power L</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="distance2">
                                                                    <input type="checkbox" name="parameters" id="distance2" value="dist">
                                                                    <span class="dist">Distance</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="speed">
                                                                    <input type="checkbox" name="parameters" id="speed" value="spd_avg">
                                                                    <span class="spd_avg">Speed</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="pace500mMax">
                                                                    <input type="checkbox" name="parameters" id="pace500mMax" value="pace500_max">
                                                                    <span class="pace500_max">Pace 500m Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="hr">
                                                                    <input type="checkbox" name="parameters" id="hr" value="hr_avg">
                                                                    <span class="hr_avg">HR</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->
                                                            <li>
                                                                <label for="strokeRateMax">
                                                                    <input type="checkbox" name="parameters" id="strokeRateMax" value="srate_max">
                                                                    <span class="srate_max">Stroke Rate Max</span>
                                                                </label>
                                                            </li><!-- End Parametar Item -->

                                                            <li>
                                                                <label for="power">
                                                                    <input type="checkbox" name="parameters" id="power" value="pwr_avg">
                                                                    <span class="pwr_avg">Power average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerMax">
                                                                    <input type="checkbox" name="parameters" id="powerMax" value="pwr_max">
                                                                    <span class="pwr_max">Power max</span>
                                                                </label>
                                                            </li>


                                                            <li>
                                                                <label for="powerLMax">
                                                                    <input type="checkbox" name="parameters" id="powerLMax" value="pwr_l_max">
                                                                    <span class="pwr_l_max">Power L Max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerR">
                                                                    <input type="checkbox" name="parameters" id="powerR" value="pwr_r_avg">
                                                                    <span class="pwr_r_avg">Power right average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerRmax">
                                                                    <input type="checkbox" name="parameters" id="powerRmax" value="pwr_r_max">
                                                                    <span class="pwr_r_max">Power right max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerBalance">
                                                                    <input type="checkbox" name="parameters" id="powerBalance" value="pwr_bal_avg">
                                                                    <span class="pwr_bal_avg">Power balance</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="powerBalanceMax">
                                                                    <input type="checkbox" name="parameters" id="powerBalanceMax" value="pwr_bal_max">
                                                                    <span class="pwr_bal_max">Power balance max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleLeftAvg">
                                                                    <input type="checkbox" name="parameters" id="angleLeftAvg" value="ang_l_avg">
                                                                    <span class="ang_l_avg">Angle left average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleLeftMax">
                                                                    <input type="checkbox" name="parameters" id="powerBalanceMax" value="ang_l_max">
                                                                    <span class="ang_l_max">Angle left Max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleRightAvg">
                                                                    <input type="checkbox" name="parameters" id="powerBalanceMax" value="ang_r_avg">
                                                                    <span class="ang_r_avg">Angle right average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleRightMax">
                                                                    <input type="checkbox" name="parameters" id="powerBalanceMax" value="ang_r_max">
                                                                    <span class="ang_r_max">Angle right max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angle">
                                                                    <input type="checkbox" name="parameters" id="angle" value="ang_avg">
                                                                    <span class="ang_avg">Angle average</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="angleMax">
                                                                    <input type="checkbox" name="parameters" id="powerBalanceMax" value="ang_max">
                                                                    <span class="ang_max">Angle max</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="mml2">
                                                                    <input type="checkbox" name="parameters" id="mml2" value="mml2">
                                                                    <span class="mml2">MML 2 Level</span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label for="mml4">
                                                                    <input type="checkbox" name="parameters" id="mml4" value="mml4">
                                                                    <span class="mml4">MML 4 Level</span>
                                                                </label>
                                                            </li>



                                                            <!-- End Parametar Item -->
                                                        </ul><!-- /.contatcts-list -->


                                                    </div><!-- /.List of Parametars -->
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
                       
                       
                   
                   piktoBiorowerGraph.historyPlot.setupGrid();
                    piktoBiorowerGraph.historyPlot.draw();
                                                                 
                                                                 
                                                                 
                                                                 $('#myParam').modal('hide');">
                                                        Save changes
                                                    </button>

                                                    <button type="button" class="btn btn-primary margin-r-5" id="dugme2"
                                                            onclick="var newHistoryParams = $('#history-graph-params input:checked').map(function(){
                                                                    var value = $(this).val();
                                                                    var parameter = {
                                                                        slug: value,
                                                                        label: $('.'+value).text(),
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
                       
                   
                   piktoBiorowerGraph2.progressPlot.setupGrid();
                    piktoBiorowerGraph2.progressPlot.draw();
                                                                 
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
                <div class="col-md-12 white-bg box box-primary">
                    <div class="graphic-box">
                        <div class="pull-left">
                            <h3 class="progress-h3" id="tekst2">Progress</h3>
                        </div>
                        <div class="graphic-header">

                            <div class="box-tools pull-right"  id="strelice2">

                                <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip" id="next3" title="" data-original-title="Previous"
                                   onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate.subtract(1,piktoBiorowerGraph2.rangeType)) ;"
                                        ><i class="fa fa-chevron-left"></i></a>
                                <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip"  id="next4" title="" data-original-title="Next"
                                   onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate.add(1,piktoBiorowerGraph2.rangeType));
;"
                                        ><i class="fa fa-chevron-right"></i></a>
                            </div>



                                    <!--Btn links -->

                                    <div class="pull-right change-btn">
                                        <a href="javascript:;" class="btn btn-link" id="year_progress"
                                           onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'year',moment().startOf('year'));"
                                                >Year</a>
                                        <a href="javascript:;" class="btn btn-sm btn-primary" id="all_progress"
                                           onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'all','');"
                                                >All</a>
                                        <a href="javascript:;" class="btn btn-sm btn-primary" id="skaliranje2"
                                                >X1</a>
                                    </div>



                                </div>

                                <!-- Date and time range -->



                        <div class="graphic-body relative">
                            <div id="progress" style="height: 300px;"></div>

                            <div class="graphic-footer row">
                                <a class="pull-right btn-param" href="#" data-toggle="modal" data-target="#myParam" id="link2"><i class="fa fa-cog"></i></a>
                                <a href="javascript:;" class="pull left btn btn-sm btn-primary" id="izbor1"  onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate,'month')"
                                        >Month</a>
                                <a href="javascript:;" class="pull left btn btn-sm btn-primary" id="izbor2"  onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),piktoBiorowerGraph2.rangeType,piktoBiorowerGraph2.startDate,'week')"
                                        >Week</a>
                            </div>





                        </div>
                    </div>
                    <div class="clear dum-space"></div>
                </div>
                <!-- /.Graph Block-->

                <!-- Graph Block-->
                <div class="col-md-12 white-bg box box-primary">
                    <div class="graphic-box graphic-padding-b">
                        <div class="box-title">
                            <h3 class="pull-left graphic-padding-t ">Sessions</h3>
                            <div class="pull-right">
                                <a href="{{ url('/profile/sessions') }}" class="btn btn-primary pull-right">List</a>
                                <a href="{{ url('/sessions/calendar') }}" class="btn btn-primary pull-right margin-r-5">Calendar</a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <!-- /.Graph Block-->

            </div>
            <!-- /.graph -->

        </div><!-- /.row -->

    </section><!-- /.content -->

@section('page-scripts')

    <script src="{{ URL::asset('js/moment-range.js') }}"></script>
    <script src="{{ URL::asset('dist/js/graphs.js') }}"></script>
 

    <script>
        $(document).ready(function () {
             piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'all','');
             piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'all',piktoBiorowerGraph2.startDate,'week');
       
            var skaliranje=500;
            var skaliranje2=500;
          

            $('#strelice').hide();
            $('#strelice2').hide();

            $('#link').click(function(){
                $('#dugme1').show();
                $('#dugme2').hide();
            });

            $('#link2').click(function(){
                $('#dugme2').show();
                $('#dugme1').hide();
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

@endsection