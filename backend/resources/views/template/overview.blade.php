@extends('layouts.main')

@section('content')
<section class="content">

    <div class="row">
        <div class="col-md-3 col-left">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="img-circle-width">
                        <a href="{{ url('/profile/edit') }}"><span class="label-edit edit-img"><i class="fa fa-pencil"></i></span></a>
                        <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset(Auth::user()->profile->image->name) }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name }}</h3>
                    <p class="text-muted text-center">{{ $user->display_name }}</p>
                    <input type="hidden" name="user-email" id="user-email" value="{{ $user->email }}">

                    <!-- <a href="edit-profile.html" class="btn btn-primary btn-block"><b>Edit Profile</b></a>-->
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box no-bg no-border aboutMe-box">
                <div class="about-me">
                    <h3>About me</h3>
                </div>

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
                                <div class="about-value power-max"></div>
                                <div class="about-vname">Power Max</div>
                            </div>
                            <!-- Item 3.2 -->

                            <div class="act-block about-value-box about-middle">
                                <div class="about-value power-average"></div>
                                <div class="about-vname">Power Average</div>
                            </div>
                            <!-- Item 3.3 -->
                        </div>
                    </div>
                    <!-- Item 3 -->
                    <div class="col-sm-12 about-border-t">
                        <div class="col-sm-6 about-value-box about-border-r">
                            <div class="about-value stroke-rate-max"></div>
                            <div class="about-vname about-vname-last">Stroke Rate Max</div>
                        </div>
                        <!-- Item 4 -->
                        <div class="col-sm-6 about-value-box">
                            <div class="about-value stroke-distance-max"></div>
                            <div class="about-vname about-vname-last">Stroke Distance Max</div>
                        </div>
                        <!-- Item 5 -->
                    </div>
                </div>


                <div class="clear"></div>
                <!-- /.box-body -->
            </div><!-- /.box -->

            <!--I am Following -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-users margin-right text-blue"></i> I'm following</h3>
                </div>
                <div class="box-body">
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            @foreach($allWatching as $following)
                            <li>
                                {{ $following }}
                            </li>
                            @endforeach
                            <li>
                                <img src="dist/img/user3-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="diff-profile.html">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                        </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center padding-bottom-zero">
                        <a href="javascript::" class="uppercase">View All Users</a>
                    </div><!-- /.box-footer -->
                </div><!--/.box -->
            </div>


            <!-- Following me -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-users margin-right text-blue"></i>  Following me</h3>
                </div>
                <div class="box-body">
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            @foreach($allWatched as $followers)
                            <li>{{ $followers }}</li>
                            @endforeach
                            <li>
                                <img src="dist/img/user1-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="diff-profile.html">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                        </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center padding-bottom-zero">
                        <a href="javascript::" class="uppercase">View All Users</a>
                    </div><!-- /.box-footer -->
                </div><!--/.box -->
            </div>


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
                        <h5 class="description-header">{{ round($totalStatisticsParameters["dist"][0], 2) }}</h5>
                        <span class="description-text">Total Distance</span>
                        <span class="description-percentage-small text-blue btn-block">[km]</span>
                    </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-3 col-xs-12">
                    <div class="description-block">
                        <h5 class="description-header">{{ round($totalStatisticsParameters["pwr_avg"][0], 2) }}</h5>
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
                        <span class="description-percentage-small text-blue inline">[spm]</span>
                    </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-3 col-xs-12">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ round($totalStatisticsParameters["ang_avg"][0], 2) }}</h5>
                        <span class="description-text">Total Angle average</span>
                        <span class="description-percentage-small text-blue btn-block">[°]</span>
                    </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-3 col-xs-12">
                    <div class="description-block">
                        <h5 class="description-header">{{ round($totalStatisticsParameters["hr_avg"][0], 2) }}</h5>
                        <span class="description-text ">Total HR average</span>
                        <span class="description-percentage-small text-blue btn-block">[bmp]</span>


                    </div><!-- /.description-block -->
                </div>
            </div>
        </div>
        <!-- graph -->
        <div class="col-md-9" id="graphs">
            <div class="heading-above col-md-12 no-padding">
                <h1 class="pull-left">Tranings</h1>
                <div class="pull-right heading-above-right">
                    <a class="pull-right" style="background: #fff; cursor: pointer; padding: 7px 12px; color: #555; border: 1px solid #ccc; font-size:13px; margin-top: -2px;" href="edit-profile.html#parentVerticalTab9"><i class="fa fa-filter"></i> </a>
                    <!-- Date and time range -->
                    <div class="inline margin-r-5">
                        <div id="reportrange" class="inline choose-date" style="background: transperant; cursor: pointer; padding: 7px 12px; padding-left:2px; color: #555; border: 1px solid #ccc;">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar btn-icon"></i>
                            <span>Choose the date</span> <b class="caret"></b>
                        </div>
                    </div>
                    <!-- ./ Date and time range -->

                </div>
                <div class="clear"></div>
            </div>
            <!-- Graph Block-->
            <div class="col-md-12 white-bg box box-primary no-padding historyGraph graph-box">
                <div class="graphic-header historyGraph-header">
                    <div class="historyGraph-header-body">
                        <div>
                            <h3 class="pull-left">History</h3>
                        </div>
                        <div class="pull-left left-options">
                            <!-- /.form group -->

                        </div>

                        <div class="box-tools pull-right" style="margin-top: -8px;">
                            <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"
                               onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate.subtract(1,piktoBiorowerGraph.rangeType));"
                               ><i class="fa fa-chevron-left"></i></a> 
                            <a href="javascript:;" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"
                               onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),piktoBiorowerGraph.rangeType,piktoBiorowerGraph.startDate.add(1,piktoBiorowerGraph.rangeType));"
                               ><i class="fa fa-chevron-right"></i></a>
                        </div>
                        <div>

                            <!--Btn links -->

                            <div class="pull-right change-btn" style="margin-top: -11px; margin-right: 10px;">
                                <a href="javascript:;" class="btn btn-link" id="week_history"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'week',moment().startOf('week'));"
                                   >Week</a>
                                <a href="javascript:;" class="btn btn-link" id="month_history"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'month',moment().startOf('month'));"
                                   >Month</a>
                                <a href="javascript:;" class="btn btn-link" id="year_history"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'year',moment().startOf('year'));"
                                   >Year</a>
                                <a href="javascript:;" class="btn btn-sm btn-primary" id="all_history"
                                   onclick="piktoBiorowerGraph.loadHistoryData($('#user-email').val(),'all','');"
                                   >All</a>
                            </div>



                        </div>
                    </div>
                    <div class="graphic-body">

                        <div>
                            <div id="history" style="height: 300px;"></div>

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
                                                            <label for="strokeCount">
                                                                <input type="checkbox" name="parameters" id="strokeCount" value="scnt">
                                                                <span class="stroke_count">Stroke Count</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeDistance">
                                                                <input type="checkbox" name="parameters" id="strokeDistance" disabled>
                                                                <span class="">Stroke Distance</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="speedMax">
                                                                <input type="checkbox" name="parameters" id="speedMax" value="spd_max">
                                                                <span class="speed_max">Speed Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace2km">
                                                                <input type="checkbox" name="parameters" id="pace2km" disabled>
                                                                <span class="">Pace 2km</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="hrMax">
                                                                <input type="checkbox" name="parameters" id="hrMax" disabled>
                                                                <span class="">HR Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="calories">
                                                                <input type="checkbox" name="parameters" id="calories" disabled>
                                                                <span class="">Calories</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="time">
                                                                <input type="checkbox" name="parameters" id="time" value="time">
                                                                <span class="time">Time</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeDistMax">
                                                                <input type="checkbox" name="parameters" id="strokeDistMax" value="sdist_max">
                                                                <span class="stroke_distance_max">Stroke Dist. Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace500m">
                                                                <input type="checkbox" name="parameters" id="pace500m" disabled>
                                                                <span class="">Pace 500m</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace2kmMax">
                                                                <input type="checkbox" name="parameters" id="pace2kmMax" disabled>
                                                                <span class="">Pace 2km Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeRate">
                                                                <input type="checkbox" name="parameters" id="strokeRate" value="srate_avg">
                                                                <span class="stroke_rate_average">Stroke Rate</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="powerL">
                                                                <input type="checkbox" name="parameters" id="powerL" value="pwr_l_avg">
                                                                <span class="power_left_average">Power L</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="distance">
                                                                <input type="checkbox" name="parameters" id="distance" value="dist">
                                                                <span class="distance">Distance</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="speed">
                                                                <input type="checkbox" name="parameters" id="speed" value="spd_avg">
                                                                <span class="speed_average">Speed</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace500mMax">
                                                                <input type="checkbox" name="parameters" id="pace500mMax" disabled>
                                                                <span class="">Pace 500m Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="hr">
                                                                <input type="checkbox" name="parameters" id="hr" disabled>
                                                                <span class="hr">HR</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeRateMax">
                                                                <input type="checkbox" name="parameters" id="strokeRateMax" value="srate_max">
                                                                <span class="stroke_rate_max">Stroke Rate Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="powerLMax">
                                                                <input type="checkbox" name="parameters" id="powerLMax" value="pwr_l_max">
                                                                <span class="power_left_max">Power L Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                    </ul><!-- /.contatcts-list -->


                                                </div><!-- /.List of Parametars -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary margin-r-5" 
                                                        onclick="var newHistoryParams = $('#history-graph-params input:checked').map(function(){
                                                                    var value = $(this).val();
                                                                    var parameter = {
                                                                        slug: value,
                                                                        label: $('.'+value).text()
                                                                    }
                                                                    return parameter; 
                                                                 }).get();
                                                                 var newHistoryData = piktoBiorowerGraph.getHistoryData(newHistoryParams);
                                                                 piktoBiorowerGraph.historyPlot.setData(newHistoryData);
                                                                 piktoBiorowerGraph.historyPlot.setupGrid();
                                                                 piktoBiorowerGraph.historyPlot.draw();
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
                        <h3 class="progress-h3">Progress</h3>
                    </div>
                    <div class="graphic-header">

                        <div class="progress-left">
                            <div class="progress-groupOne">
                              
                                <div>
                                </div>
                                <!--Btn links -->

                                <div class="pull-right changeP-btn">
                                     <a href="javascript:;" class="btn btn-link" id="year_progress"
                                   onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'year',moment().startOf('year'));"
                                   >Year</a>
                                <a href="javascript:;" class="btn btn-sm btn-primary" id="all_progress"
                                   onclick="piktoBiorowerGraph2.loadHistoryData($('#user-email').val(),'all','');"
                                   >All</a>
                                </div>


                            </div>

                            <!-- Date and time range -->
                      
                        </div><!-- /.form group -->
                    </div>

                    <div class="graphic-body relative">
                        <div id="progress" style="height: 300px;"></div>

                        <div class="graphic-footer row">
                            <a class="pull-right btn-param" href="#" data-toggle="modal" data-target="#myParam2"><i class="fa fa-cog"></i></a>
                        </div>
                          <div class="example-modal">
                                <div class="modal" id="myParam2">
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
                                                <div id="progress-graph-params" class="param-box">
                                                    <ul class="checkbox icheck modalParm-list">
                                                        <li>
                                                            <label for="strokeCount2">
                                                                <input type="checkbox" name="parameters2" id="strokeCount2" value="scnt">
                                                                <span class="stroke_count2">Stroke Count</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeDistance2">
                                                                <input type="checkbox" name="parameters2" id="strokeDistance2" disabled>
                                                                <span class="">Stroke Distance</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="speedMax2">
                                                                <input type="checkbox" name="parameters2" id="speedMax2" value="spd_max">
                                                                <span class="speed_max2">Speed Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace2km2">
                                                                <input type="checkbox" name="parameters2" id="pace2km2" disabled>
                                                                <span class="">Pace 2km</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="hrMax2">
                                                                <input type="checkbox" name="parameters2" id="hrMax2" disabled>
                                                                <span class="">HR Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="calories2">
                                                                <input type="checkbox" name="parameters2" id="calories2" disabled>
                                                                <span class="">Calories</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="time2">
                                                                <input type="checkbox" name="parameters2" id="time2" value="time">
                                                                <span class="time2">Time</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeDistMax2">
                                                                <input type="checkbox" name="parameters2" id="strokeDistMax2" value="sdist_max">
                                                                <span class="stroke_distance_max2">Stroke Dist. Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace500m2">
                                                                <input type="checkbox" name="parameters2" id="pace500m2" disabled>
                                                                <span class="">Pace 500m</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace2kmMax2">
                                                                <input type="checkbox" name="parameters2" id="pace2kmMax2" disabled>
                                                                <span class="">Pace 2km Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeRate2">
                                                                <input type="checkbox" name="parameters2" id="strokeRate2" value="srate_avg">
                                                                <span class="stroke_rate_average2">Stroke Rate</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="powerL2">
                                                                <input type="checkbox" name="parameters2" id="powerL2" value="pwr_l_avg">
                                                                <span class="power_left_average2">Power L</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="distance2">
                                                                <input type="checkbox" name="parameters2" id="distance2" value="dist">
                                                                <span class="distance2">Distance</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="speed2">
                                                                <input type="checkbox" name="parameters2" id="speed2" value="spd_avg">
                                                                <span class="speed_average2">Speed</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="pace500mMax2">
                                                                <input type="checkbox" name="parameters2" id="pace500mMax2" disabled>
                                                                <span class="">Pace 500m Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="hr2">
                                                                <input type="checkbox" name="parameters2" id="hr2" disabled>
                                                                <span class="hr2">HR</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="strokeRateMax2">
                                                                <input type="checkbox" name="parameters2" id="strokeRateMax2" value="srate_max">
                                                                <span class="stroke_rate_max2">Stroke Rate Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                        <li>
                                                            <label for="powerLMax2">
                                                                <input type="checkbox" name="parameters2" id="powerLMax2" value="pwr_l_max">
                                                                <span class="power_left_max2">Power L Max</span>
                                                            </label>
                                                        </li><!-- End Parametar Item -->
                                                    </ul><!-- /.contatcts-list -->


                                                </div><!-- /.List of Parametars -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary margin-r-5" 
                                                        onclick="var newHistoryParams = $('#progress-graph-params input:checked').map(function(){
                                                                    var value = $(this).val();
                                                                    var parameter = {
                                                                        slug: value,
                                                                        label: $('.'+value).text()
                                                                    }
                                                                    return parameter; 
                                                                 }).get();
                                                                 var newHistoryData = piktoBiorowerGraph2.getHistoryData(newHistoryParams);
                                                                 piktoBiorowerGraph2.progressPlot.setData(newHistoryData);
                                                                 piktoBiorowerGraph2.progressPlot.setupGrid();
                                                                 piktoBiorowerGraph2.progressPlot.draw();
                                                                 $('#myParam2').modal('hide');">
                                                    Save changes
                                                </button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div><!-- /.example-modal -->
                        
                        
                        
                        
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
                            <a href="{{ url('/profile/calendar') }}" class="btn btn-primary pull-right margin-r-5">Calendar</a>
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
<script src="{{ URL::asset('dist/js/graphs.js') }}"></script>
@endsection

@endsection

