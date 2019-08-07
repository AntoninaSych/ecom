@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>История операций</h1>
@stop


@section('content')
    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class="active"><a href="#main-information" data-toggle="tab" aria-expanded="false">Details</a></li>
            <li class=""><a href="#call-back-log" data-toggle="tab" aria-expanded="false">CallBackLog</a></li>

            @if( Auth::user()->can(PermissionHelper::PROCESS_LOG_VIEW) )
                <li class=""><a href="#payment-log" data-toggle="tab" aria-expanded="true">PaymentLog</a></li>
            @endif


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
                                        <tr>
                                            <td>Роут</td>
                                            <td>@if(!is_null($payment->paymentRoute))
                                                    {{$payment->paymentRoute->name}}
                                                @endif</td>
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
                <div class="row" id="statusLog">

                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">


                                <div class="box-body">
                                    @if( Auth::user()->can(PermissionHelper::MAKE_REQUEST_STATUS) )
                                        <h3 class="box-title">Запрос на изменение статуса платежа</h3>
                                        <div>
                                            <label for="statusId">Выберите статус платежа:</label>
                                            <select class="form-control" name="status" id="statusId">
                                                @foreach($paymentStatusList as $status)
                                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="commentStatus">Комментарий:</label>
                                            <textarea id="commentStatus" class="form-control"></textarea>
                                            <button id="request-status-change" onclick="changeStatus({{$payment->id}})"
                                                    class="btn btn-primary">Создать запрос на
                                                изменение статуса
                                            </button>
                                        </div>
                                    @endif
                                    <div id="listOfRequests">
                                        @if(isset($statusRequest))
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <th>id</th>
                                                    <th>payment Id</th>
                                                    <th>Со статуса платежа</th>
                                                    <th>На статус платежа</th>
                                                    <th>Создал/Комментарий</th>
                                                    <th>Подтвердил/Комментарий</th>
                                                    <th>Дата</th>
                                                    <th>Статус заявки</th>
                                                    <tbody>
                                                    @foreach($statusRequest as $item)
                                                        <tr>
                                                            <td> {{$item->id}}</td>
                                                            <td> {{$item->payment_id}}</td>
                                                            <td> {{$item->statusPrev->name}}</td>
                                                            <td> {{$item->statusNext->name}}</td>
                                                            <td> {{$item->comment_request}} by
                                                                <b> {{$item->userRequest->name}}</b></td>
                                                            <td>
                                                                @if( Auth::user()->can(PermissionHelper::MAKE_RESPONSE_STATUS) && $item->is_applied == 0 )
                                                                    <label for="commentStatusApprove">Оставить
                                                                        комментарий:</label>
                                                                    <textarea id="commentStatusApprove"
                                                                              class="form-control"></textarea>
                                                                    <div class="row">
                                                                        <div class="col-xs-6">
                                                                            <button id="approveStatusRequest"
                                                                                    class="btn btn-success"
                                                                                    style="margin: 15px 15px 0 0"
                                                                                    onclick="approveStatusRequest({{$item->id}},'apply')">
                                                                                Подтвердить
                                                                            </button>
                                                                        </div>
                                                                        <div class="col-xs-6">
                                                                            <button id="declineStatusRequest"
                                                                                    style="margin: 15px 0 0 15px"
                                                                                    class="btn btn-danger"
                                                                                    onclick="approveStatusRequest({{$item->id}},'decline')">
                                                                                Отклонить
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(isset($item->userResponse->name))
                                                                    {{$item->comment_response}}
                                                                @endif
                                                                @if(isset($item->userResponse->name))
                                                                    by     <b>  {{$item->userResponse->name}} </b>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{$item->created_at}}
                                                            </td>
                                                            <td>

                                                                @switch($item->is_applied)
                                                                    @case(1)

                                                                    <span class="label label-success">Подтвержден</span>
                                                                    @break
                                                                    @case(2)

                                                                    <span class="label label-danger">  Отклонен</span>

                                                                    @break
                                                                    @case(3)
                                                                    <span class="label label-warning">   Отменен при создании новой заявки</span>

                                                                    @break
                                                                    @case(0)
                                                                    <span class="label label-info">Новая заявка ожидает обработки<</span>

                                                                    @break
                                                                @endswitch


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        @endif

                                    </div>
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
                        @if( Auth::user()->can(PermissionHelper::PROCESS_LOG_VIEW) )
                            <ul class="timeline" id="timeline"
                                style="word-wrap: break-word; overflow-wrap: break-word;">
                            </ul>
                        @endif

                    </div>
                </div>

            </div>
            {{-- ProcessLog tab end--}}

            <div id="request-status-change" class="tab-pane"></div>

        </div>


    </div>
    </div>
    <script>
        var id = {!! json_encode($payment->id) !!};
    </script>
@stop

<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/tree-view/jquery.json-view.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/libraries/tree-view/jquery.json-view.css') }}">


<script>
    (function ($) {
        $(function () {
            var format = "DD-MM-YYYY HH:mm:ss";


            $.ajax({
                url: config.services.processLog,
                type: "GET",
                data: {
                    "id": id
                },
                success: function (data) {
                    if (data.data.processLog.length == 0) {
                        $('#timeline').html("Нет данных для отображения");
                    } else {
                        var process_log = data.data.processLog;
                        var template = '';
                        $('#timeline').html(template);
                        for (var i = 0; i < process_log.length; i++) {
                            template = '<li  class="time-label"><span  class="bg-green" >' + process_log[i]['ts'] + '</span></li>';
                            template += '<li>';
                            template += '<i class="fa  fa-clock-o bg-blue"></i>';
                            template += '<div class="timeline-item">';
                            var request_time = process_log[i]['request_time'];
                            if (request_time != null) {
                                request_time = moment.unix(process_log[i]['request_time']).format(format);
                            } else {
                                request_time = "Время не зафиксировано";
                            }
                            template += '<span class="time"><i class="fa fa-clock-o"></i> Request: ' + request_time + '</span>';
                            template += '<h3 class="timeline-header"><a href="#"> ID: ' + process_log[i]['id'] + '</a></h3>';

                            template += '<div class="timeline-body">';
                            template += 'Request Time:' + request_time + '<br>';
                            template += 'Request body: <div id="request' + i + '"><div class="json-view"> </div></div>';
                            var response_time = process_log[i]['response_time'];
                            if (response_time != null) {
                                response_time = process_log[i]['response_time'] = moment.unix(process_log[i]['response_time']).format(format);
                            } else {
                                response_time = "Время не зафиксировано";
                            }
                            template += 'Response Time: ' + response_time + '<br>';
                            var xml = '';
                            var json = '';
                            try {
                                xml = $.parseXML(process_log[i]['response_body']);
                                json = xml2json(xml);

                            } catch (err) {
                                json = process_log[i]['response_body'];
                            }

                            template += 'Response body:<div id="xml' + i + '"></div>';
                            template += '</div>-';

                            template += '<div class="timeline-footer">';

                            template += '</div>';
                            template += '</div>';
                            template += '</li>';

                            $('#timeline').append(template);
                            var link = null;
                            var request_body = process_log[i]['request_body'];
                            if (!IsJsonString(request_body)) {
                                var str = request_body;
                                console.log('строка а потом json');
                                delimiter = str.indexOf("{");
                                request_body = str.slice(delimiter);
                                link = str.substring(delimiter, -1);
                            }

                            $('#request' + i).jsonView(request_body);
                            if(link!==null){
                            $('#request' + i).append("<a href='"+link+"'>"+link+"</a>");}

                            $('#xml' + i).jsonView(json);

                        }
                    }

                }, error: function (data) {
                    $('#timeline').html("У Вас нет доступа для просмотра данного раздела");
                }
            });


            function xml2json(xml) {
                try {
                    var obj = {};
                    if (xml.children.length > 0) {
                        for (var i = 0; i < xml.children.length; i++) {
                            var item = xml.children.item(i);
                            var nodeName = item.nodeName;

                            if (typeof (obj[nodeName]) == "undefined") {
                                obj[nodeName] = xml2json(item);
                            } else {
                                if (typeof (obj[nodeName].push) == "undefined") {
                                    var old = obj[nodeName];

                                    obj[nodeName] = [];
                                    obj[nodeName].push(old);
                                }
                                obj[nodeName].push(xml2json(item));
                            }
                        }
                    } else {
                        obj = xml.textContent;
                    }
                    return obj;
                } catch (e) {
                    console.log('json');
                    console.log(e.message);
                }
            }
        });
    })(jQuery);

    function changeStatus(paymentId) {
        $.ajax({
            url: '/payments/changeStatusRequest',
            type: "POST",
            data: {
                "id": paymentId,
                'status': $('#statusId').val(),
                'comment': $('#commentStatus').val()
            },
            success: function (data) {

                location.reload();

            }, error: function (data) {
                $('#timeline').html("У Вас нет доступа для просмотра данного раздела");
            }
        });
    }

    function approveStatusRequest(requestId, action) {
        $.ajax({
            url: '/payments/changeStatusResponse',
            type: "POST",
            data: {
                "id": requestId,
                'comment': $('#commentStatusApprove').val(),
                'action': action
            },
            success: function (data) {

                location.reload();

            }, error: function (data) {
                $('#timeline').html("У Вас нет доступа для просмотра данного раздела");
            }
        });
        console.log($('#commentStatusApprove').val());
    }

    function xmlValidator(xml) {
        // var xml = "<note><to>Tove</to><from>Jani</from><heading>Reminder</heading><body>Don't forget me this weekend!</body></note>";
        while (xml.indexOf('<') != -1) {
            var sub = xml.substring(xml.indexOf('<'), xml.indexOf('>') + 1);
            var value = xml.substring(xml.indexOf('<') + 1, xml.indexOf('>'));
            var endTag = '</' + value + '>';
            if (xml.indexOf(endTag) != -1) {
                // console.log('xml is valid');
                // break;
            } else {
                console.log('xml is in invalid');
                break;
            }
            xml = xml.replace(sub, '');
            xml = xml.replace(endTag, '');
            console.log(xml);
            console.log(sub + ' ' + value + ' ' + endTag);
        }
    }

    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
</script>

