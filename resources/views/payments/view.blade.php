@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>История операций</h1>
@stop


@section('content')

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

    <div class="row">
        <div class="col-md-4">
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
{{--        //todo with nice styles time line maybe--}}
        @if(isset($processLog) && !is_null($processLog))
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Processing Log (only for Administrator (make check // toDO)</h3>
                    <div class="box-body">
                        <table class="table">

                            @foreach($processLog as $log)
                                <tr><td>ID</td><td>{{$log['id']}}</td></tr>
                             <tr> <td>ts</td><td>{{$log['ts']}}</td> </tr>
                             <tr><td>request_time</td><td>{{$log['request_time']}}</td> </tr>
                             <tr><td>response_time</td><td>{{$log['response_time']}}</td> </tr>
                             <tr><td>request_body</td><td>{{$log['request_body']}}</td> </tr>
                            <tr> <td>response_body</td> <td >{{$log['response_body']}}</td></tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
            @endif
    </div>

@stop

