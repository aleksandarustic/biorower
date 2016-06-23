@extends('layouts.main')

@section('content')
    <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="padding-all white-bg">
                            <span class="pull-left act-h2"><i class="fa fa-users margin-right"></i> Friends</span>
                            <div class="act-like-tabs pull-right col-md-7 search-friends">
                                <form class="search-form">
                                    <div class="input-group col-md-12">
                                        <i class="fa fa-search icon-search"></i>
                                        <input type="text" name="search" class="form-control search-forFriends" placeholder="Search">
                                    </div><!-- /.input-group -->
                                </form>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="white-bg col-left">
                            <div class="friends-tabs-custom row">
                                <ul class="friends-tab margin-bottom">
                                    <li class="active"><a href="#following" data-toggle="tab">Following me</a></li>
                                    <li><a href="#follow" data-toggle="tab">Following</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="following" >
                                        <div class="no-padding">
                                            <ul class="products-list product-list-in-box">

                                                <li class="item pull-left full-width-item">
                                                    <div class="pull-left col-md-8">
                                                        <div class="product-img">
                                                            <img class="img-square" src="dist/img/default-50x50.gif" alt="User Picture">
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">Alexander Pierce</a>
                                                            <span class="product-description product-username">
                                                              alex
                                                            </span>
                                                            <span class="product-description">
                                                             <ul>
                                                                 <li class="product-descriptions-first"><span class="bold">Followers:</span> 13</li>

                                                                 <li> <span class="bold">Session:</span> 2</li>
                                                             </ul>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="buttons-followUn">
                                                        <a class="btn btn-primary btn-sm">Follow</a>
                                                        <a class="btn btn-default btn-sm">Unfollow</a>
                                                    </div>
                                                </li><!-- /.item -->
                                                <li class="item pull-left full-width-item">
                                                    <div class="pull-left col-md-8">
                                                        <div class="product-img">
                                                            <img class="img-square" src="dist/img/default-50x50.gif" alt="User Picture">
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">Alexander Pierce</a>
                                                                <span class="product-description product-username">
                                                                  alex
                                                                </span>
                                                                <span class="product-description">
                                                                 <ul>
                                                                     <li class="product-descriptions-first"><span class="bold">Followers:</span> 13</li>

                                                                     <li> <span class="bold">Session:</span> 2</li>
                                                                 </ul>
                                                                </span>
                                                                                                </div>
                                                    </div>
                                                    <div class="buttons-followUn">
                                                        <a class="btn btn-primary btn-sm">Follow</a>
                                                        <a class="btn btn-default btn-sm">Unfollow</a>
                                                    </div>
                                                </li><!-- /.item -->
                                                <li class="item pull-left full-width-item">
                                                    <div class="pull-left col-md-8">
                                                        <div class="product-img">
                                                            <img class="img-square" src="dist/img/default-50x50.gif" alt="User Picture">
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript::;" class="product-title">Alexander Pierce</a>
                        <span class="product-description product-username">
                          alex
                        </span>
                        <span class="product-description">
                         <ul>
                             <li class="product-descriptions-first"><span class="bold">Followers:</span> 13</li>

                             <li> <span class="bold">Session:</span> 2</li>
                         </ul>
                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="buttons-followUn">
                                                        <a class="btn btn-primary btn-sm">Follow</a>
                                                        <a class="btn btn-default btn-sm">Unfollow</a>
                                                    </div>
                                                </li><!-- /.item -->

                                            </ul>



                                            <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>

                                    </div>

                                    <div class="white-bg no-padding tab-pane" id="follow" >
                                        <div class="no-padding">
                                            <h1 class="text-center no-friends-h1">You are not following anyone. Find followers in the search box above.</h1>
                                            <ul class="products-list product-list-in-box">
                                            </ul>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>

                                </div>

                                <div class="white-bg no-padding tab-pane" id="search" >

                                    <div class="clear"></div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="col-md-3 col-right row">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-users"></i>  Request to Follow</h3>
                        </div>
                        <div class="box-body">
                            <div class='user-block no-border-first'>
                                <img class='img-circle img-bordered-sm' src='dist/img/user7-128x128.jpg' alt='user image'>
                        <span class='username yes-no-height'>
                          <a href="#">Sarah Ross</a>
                        </span>
                                <span class='description'>Memeber: 2016-02-16</span>
                                <div class="yes-no-btn">
                                    <a class="btn btn-default btn-sm inline"><i class="fa fa-user margin-r-5"></i>Accept</a>
                                    <a class="btn btn-default btn-sm inline">Decline</a>
                                </div>
                            </div><!-- /.user-block -->
                            <div class='user-block border-top'>
                                <img class='img-circle img-bordered-sm' src='dist/img/user7-128x128.jpg' alt='user image'>
                        <span class='username yes-no-height'>
                          <a href="#">Alexander Pierce</a>
                        </span>
                                <span class='description'>Memeber: 2016-02-16</span>
                                <div class="yes-no-btn">
                                    <a class="btn btn-default btn-sm inline"><i class="fa fa-user margin-r-5"></i>Accept</a>
                                    <a class="btn btn-default btn-sm inline">Decline</a>
                                </div>
                            </div><!-- /.user-block -->
                            <div class='user-block border-top'>
                                <img class='img-circle img-bordered-sm' src='dist/img/user7-128x128.jpg' alt='user image'>
                        <span class='username yes-no-height'>
                          <a href="#">Sarah Ross</a>
                        </span>
                                <span class='description'>Memeber: 2016-02-16</span>
                                <div class="yes-no-btn">
                                    <a class="btn btn-default btn-sm inline"><i class="fa fa-user margin-r-5"></i>Accept</a>
                                    <a class="btn btn-default btn-sm inline">Decline</a>
                                </div>
                            </div><!-- /.user-block -->
                            <div class='user-block border-top'>
                                <img class='img-circle img-bordered-sm' src='dist/img/user7-128x128.jpg' alt='user image'>
                        <span class='username yes-no-height'>
                          <a href="#">Sarah Ross</a>
                        </span>
                                <span class='description'>Memeber: 2016-02-16</span>
                                <div class="yes-no-btn">
                                    <a class="btn btn-default btn-sm inline"><i class="fa fa-user margin-r-5"></i>Accept</a>
                                    <a class="btn btn-default btn-sm inline">Decline</a>
                                </div>
                            </div><!-- /.user-block -->

                            <!-- /.box-body -->
                        </div><!--/.box -->
                    </div>
                </div>

                <!-- /.row -->
    </section>
@endsection