@extends('layouts.myframe')

@section('title', 'Archive races')
@endsection

@section('content')
        <section>
            <div id="rightColumn" class="container-fluid">
              <div class="row" id="rightColumnRow">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <h2 style="float:left">Archive: </h2>
                            <div style="float:right; position:relative">
                                <span id="racesArchiveWrapper" style="position:absolute; top:20px; right:0px;">
                                    <a href="{{ Request::root() }}/race/index" class="btn btn-default"> Back</a>
                                </span>     
                            </div>

                            <div style="clear:both"></div>

                            <div id="ptContainer">
                                {!! $partialTableArchive !!}
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </section>
@endsection

