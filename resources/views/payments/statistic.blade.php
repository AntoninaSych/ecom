@extends('adminlte::page')
@section('content_header')
    <h1>Статистика</h1>
@stop

@section('content')
    <div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{$all}} UAH</h3>

                                <p>All</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 style="font-size: 24px">   {{$todayPayments}} UAH</h3>
                                <p>Toady</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{$currentMonth}} UAH</h3>
                                <p> Month current</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{$previousMonth}} UAH</h3>
                                <p> Month previous</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats"></i>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">

            <table class="table small-box bg-aqua ">
                <caption> Merchants</caption>
                @foreach($top10 as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-lg-3 col-xs-6">

            <table class="table small-box bg-yellow">
                <caption class="caption"> Today merchants</caption>
                @foreach($top10Today as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-lg-3 col-xs-6">

            <table class="table small-box bg-green">
                <caption> Current Month</caption>
                @foreach($top10currentMonth as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
        <div class="col-lg-3 col-xs-6" >

            <table class="table small-box bg-red">
                <caption> Previous Month</caption>
                @foreach($top10previousMonth as $merchant)
                    <tr>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->summa}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@stop