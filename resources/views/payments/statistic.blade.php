@extends('adminlte::page')
@section('content_header')
    <h1>Статистика</h1>
@stop

@section('content')


    <div>
        <div class="box">
            <div class="box-header"><h2>Общая статистика</h2></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3 style="font-size: 24px">{{number_format($all, 2, ',', ' ')}} UAH</h3>
                                <p>За все время</p>
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
                                <h3 style="font-size: 24px">  {{number_format($todayPayments, 2, ',', ' ')}} UAH</h3>
                                <p>Сегодня</p>
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
                                <h3 style="font-size: 24px">{{number_format($currentMonth, 2, ',', ' ')}} UAH</h3>
                                <p> Текущий месяц</p>
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
                                <h3 style="font-size: 24px">{{number_format($previousMonth, 2, ',', ' ')}} UAH</h3>
                                <p> Предыдущий месяц</p>
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


    <div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="box-header"><h2>TOP 10 мерчантов</h2></div>

                    <div class="col-lg-3 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <p>За все время</p>

                                <table class="table small-box bg-aqua ">

                                    @foreach($top10 as $merchant)
                                        <tr>
                                            <td>{{$merchant->name}}</td>
                                            <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <p>Сегодня</p>
                                <table class="table ">
                                    @foreach($top10Today as $merchant)
                                        <tr>
                                            <td>{{$merchant->name}}</td>
                                            <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-xs-12">
                        <div class=" small-box bg-green">
                            <div class="inner">
                                <p>Текущий месяц</p>
                                <table class="table">
                                    @foreach($top10currentMonth as $merchant)
                                        <tr>
                                            <td>{{$merchant->name}}</td>
                                            <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <p>Предыдущий месяц</p>
                        <table class="table small-box bg-red">

                            @foreach($top10previousMonth as $merchant)
                                <tr>
                                    <td>{{$merchant->name}}</td>
                                    <td>{{number_format($merchant->summa, 2, ',', ' ')}}</td>
                                </tr>
                            @endforeach
                        </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{--    Статистика по роутам--}}
        <div>
            <div class="box">
                <div class="box-header"><h2>По роутам платежей</h2></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <p>За все время</p>
                                    <table class="table">
                                        @foreach($allPaymentsByRoutes as $data)
                                            <tr>
                                                <td>{{$data->name}}</td>
                                                <td>{{number_format($data->amount, 2, ',', ' ')}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
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

                                    <p>Сегодня</p>
                                    <table class="table">
                                        @foreach($todayPaymentsByRoutes as $data)
                                            <tr>
                                                <td>{{$data->name}}</td>
                                                <td>{{number_format($data->amount, 2, ',', ' ')}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
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

                                    <p> Текущий месяц</p>
                                    <table class="table">
                                        @foreach($currentMonthByRoutes as $data)
                                            <tr>
                                                <td>{{$data->name}}</td>
                                                <td>{{number_format($data->amount, 2, ',', ' ')}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
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
                                    <p> Предыдущий месяц</p>
                                    <table class="table">
                                        @foreach($previousMonthByRoutes as $data)
                                            <tr>
                                                <td>{{$data->name}}</td>
                                                <td>{{number_format($data->amount, 2, ',', ' ')}}</td>
                                            </tr>
                                        @endforeach
                                    </table>
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
@stop