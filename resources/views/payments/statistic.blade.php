@extends('adminlte::page')
@section('content_header')
    <h1>Таблица ролей и их прав</h1>
@stop

@section('content')
    <div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    All {{$all}} <br>
                    Toady {{$todayPayments}} <br>
                    Month current:{{$currentMonth}}<br>
                    Month previous:{{$previousMonth}}

                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="box ">
                <div class="box-body">
                    <div class="row">
                        <table class="table">
                            <caption>< top 10 merchants/caption>
                                @foreach($top10 as $merchant)
                                    <tr>
                                        <td>{{$merchant->name}}</td>
                                        <td>{{$merchant->summa}}</td>
                                    </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <table class="table">
                            <caption>top 10 today merchants</caption>
                            @foreach($top10Today as $merchant)
                                <tr>
                                    <td>{{$merchant->name}}</td>
                                    <td>{{$merchant->summa}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <table class="table">
                            <caption>top 10 current Month</caption>
                            @foreach($top10currentMonth as $merchant)
                                <tr>
                                    <td>{{$merchant->name}}</td>
                                    <td>{{$merchant->summa}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <table class="table">
                            <caption> top 10 previous Month</caption>
                            @foreach($top10previousMonth as $merchant)
                                <tr>
                                    <td>{{$merchant->name}}</td>
                                    <td>{{$merchant->summa}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop