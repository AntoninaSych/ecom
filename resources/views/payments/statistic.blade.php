@extends('adminlte::page')
@section('content_header')
    <h1>Статистика</h1>
@stop

@section('content')
    <div>
        <div class="box">
            <div class="box-header"><h2>Общая статистика</h2>
                <div class="box-tools">
                    <div class="col-xs-12">
                    <div class="pull-right">
                        <button class="btn btn-danger" style="margin-top: 25px;"
                                onclick="loadStatistic('over-all-statistic-btn','loader1','main-stat','/statistic/overAll')"
                                id="over-all-statistic-btn"><i class="icon ion-arrow-down-a"></i>
                        </button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="row " id="main-statistic">
                    <div class="container" id='loader1' style="display: none">
                        <div class="item-1"></div>
                        <div class="item-2"></div>
                        <div class="item-3"></div>
                        <div class="item-4"></div>
                        <div class="item-5"></div>
                    </div>
                    <div id="main-stat" style="display: none">

                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="box-header"><h2>TOP 10 мерчантов</h2>
                        <div class="box-tools">
                            <div class="col-xs-12">
                                <div class="pull-right">
                                    <button class="btn btn-warning" style="margin-top: 25px;"
                                            onclick="loadStatistic('top-ten-statistic-btn','loader2','top-10-stat','/statistic/topTen')"
                                            id="top-ten-statistic-btn"><i class="icon ion-arrow-down-a"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container" id='loader2' style="display: none">
                        <div class="item-1"></div>
                        <div class="item-2"></div>
                        <div class="item-3"></div>
                        <div class="item-4"></div>
                        <div class="item-5"></div>
                    </div>

                    <div id="top-10-stat" style="display: none">

                    </div>
                </div>
            </div>
        </div>

        {{--    Статистика по роутам--}}
        <div>
            <div class="box">
                <div class="box-header"><h2>По роутам платежей</h2>
                    <div class="box-tools">
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <button class="btn btn-success" style="margin-top: 25px;"
                                        onclick="loadStatistic('by-routes','loader3','by-routes','/statistic/byRoutes')"
                                        id="by-routes-statistic-btn"><i class="icon ion-arrow-down-a"></i>
                                </button>
                            </div>
                        </div>
                    </div></div>


                    <div class="row">
                    <div class="container" id='loader3' style="display: none">
                        <div class="item-1"></div>
                        <div class="item-2"></div>
                        <div class="item-3"></div>
                        <div class="item-4"></div>
                        <div class="item-5"></div>
                    </div>
                    <div id="by-routes">
                    </div>

            </div>
        </div>
    </div>
@stop

<script src="{{ asset('/js/libraries/jquery.js') }}"></script>

<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>

<script src="{{ asset('js/statistics.js') }}"></script>