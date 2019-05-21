@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>История операций</h1>
@stop


@section('content')
    <table class="table table-hover" id="orders-table">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> Создан</th>
            <th> Статус</th>
            <th> Пользователь</th>
            <th> Мерчант</th>
             <th> Fraud</th>
            <th> Security </th>
             <th> Business</th>
            <th> Просмотр деталей</th>
        </tr>
        </thead>

        <tbody id="order-info-table">
        @foreach($orders as $order)

        <tr>
            <td>{{$order['id']}}</td>
            <td>{{$order['created_at']}}</td>
            <td>{{$order['status']['name']}}</td>
            <td>{{$order['users']['username']}}</td>
            <td>{{$order['merchant']['name']}}</td>
             @if(OrderStatusHelper::checkDisplay($order['order_status'], $order['fraud_check'], $order['security_check'] ,$order['business_check']))
            <td>{{$order['fraudStageCheck']}}</td>
            <td>{{$order['securityStageCheck']}}</td>
                @else
                <td>Проверка не требуется</td>
                <td>Проверка не требуется</td>
            @endif
            <td>{{$order['businessStageCheck']}}</td>

            <td><a href="/queries/{{$order['id']}}"><i class="fa fa-fw fa-eye"></i> </a> </td>
        </tr>
            @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> Создан</th>
            <th> Статус</th>
            <th> Пользователь</th>
            <th> Мерчант</th>
            <th> Fraud</th>
            <th> Security </th>
            <th> Business</th>
            <th> Просмотр деталей</th>
        </tr>
        </tfoot>
    </table>
@stop
<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">

