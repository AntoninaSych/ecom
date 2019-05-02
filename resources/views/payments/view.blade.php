@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>История операций</h1>
@stop


@section('content')
    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class=""><a href="#main-information" data-toggle="tab" aria-expanded="false">Details</a></li>
            <li class=""><a href="#call-back-log" data-toggle="tab" aria-expanded="false">CallBackLog</a></li>

            <li class=""><a href="#payment-log" data-toggle="tab" aria-expanded="true">PaymentLog</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i> Детали платежа</li>
        </ul>
        <div class="tab-content no-padding">

            {{--  Details tab begin--}}
            <div id="main-information" class="tab-pane active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Платеж</h3>
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <td>ID</td>
                                            <td>{{$payment->id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Дата</td>
                                            <td>{{$payment->created}}</td>
                                        </tr>
                                        <tr>
                                            <td>Описание</td>
                                            <td>{{$payment->description}}</td>
                                        </tr>
                                        <tr>
                                            <td>Сумма</td>
                                            <td>{{$payment->amount}}</td>
                                        </tr>
                                        <tr>
                                            <td>Комиссия</td>
                                            <td>{{$payment->customer_fee}}</td>
                                        </tr>
                                        <tr>
                                            <td>Merchant</td>
                                            <td>{{$payment->merchant->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Статус</td>
                                            <td>{{$payment->paymentStatus->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Тип</td>
                                            <td>{{$payment->paymentType->name}}</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Плательщик</h3>


                                <div class="box-body">

                                    <table class="table">
                                        <tr>
                                            <td>Карта</td>
                                            <td>{{  $payment->card_num }}</td>
                                        </tr>
                                        <tr>
                                            <td>Имя</td>
                                            <td>{{$payment->client_first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Фамилия</td>
                                            <td>{{$payment->client_last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Телефон</td>
                                            <td>{{$payment->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$payment->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>User-Agent</td>
                                            <td>{{$payment->user_agent}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Магазин</h3>


                                <div class="box-body">

                                    <table class="table">
                                        <tr>
                                            <td>Номер заказа</td>
                                            <td>{{$payment->order_id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Approve Url</td>
                                            <td>{{$payment->approve_url}}</td>
                                        </tr>
                                        <tr>
                                            <td>Cancel Url</td>
                                            <td>{{$payment->cancel_url}}</td>
                                        </tr>
                                        <tr>
                                            <td>Decline Url</td>
                                            <td>{{$payment->decline_url}}</td>
                                        </tr>
                                        <tr>
                                            <td>Callback Url</td>
                                            <td>{{$payment->callback_url}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  Details tab end--}}

            {{-- Callback tab begin--}}
            <div id="call-back-log" class="tab-pane">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">CallBackLog</h3>


                                <div class="box-body">

                                    @if($callBackLog)
                                        <table class="table">
                                            <tr>
                                                <th>time</th>
                                                <th>response</th>
                                            </tr>

                                            @foreach ($callBackLog as $log)

                                                <tr>
                                                    <td>{{$log->ts}}</td>
                                                    <td>{{$log->response_body}}</td>
                                                </tr>
                                            @endforeach


                                        </table>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Callback tab end--}}

            {{-- ProcessLog tab begin--}}
            <div id="payment-log" class="tab-pane">

                <div class="row">
                    <div class="col-md-12" style="margin: 15px 0 0 15px">
                        <ul class="timeline">


                            @foreach($processLog as $log)
                                <li class="time-label">
                                    <span class="bg-green">{{$log['ts']}}</span></li>
                                <li>
                                    <!-- timeline icon -->
                                    <i class="fa  fa-clock-o bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i>Request: {{$log['request_time']}} </span>

                                        <h3 class="timeline-header"><a href="#"> ID:  {{$log['id']}}  </a></h3>

                                        <div class="timeline-body">
                                            Request Time: {{$log['request_time']}}<br>
                                            Request body: {{$log['request_body']}}
                                        </div>

                                        <div class="timeline-footer">
                                            Response Time {{$log['response_time']}}<br>
                                            Response body: {{$log['response_body']}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        {{-- ProcessLog tab end--}}

    </div>
    </div>
@stop

