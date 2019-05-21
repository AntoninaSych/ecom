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
            <th> Пользователь</th>
            <th> Мерчант</th>
            <th> Создан</th>
            <th> Статус</th>
            <th> Просмотр деталей</th>
        </tr>
        </thead>

        <tbody id="order-info-table">
        @foreach($orders as $order)

        <tr>
            <td>{{$order['id']}}</td>
            <td>{{$order['user']['username']}}</td>
            <td>{{$order['merchant']['name']}}</td>
            <td>{{$order['created_at']}}</td>
            <td>{{$order['order_status']}}</td>
            <td><a href=""><i class="fa fa-fw fa-eye"></i> </a> </td>
        </tr>
            @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> Пользователь</th>
            <th> Мерчант</th>
            <th> Создан</th>
            <th> Статус</th>
            <th> Просмотр деталей</th>
        </tr>
        </tfoot>
    </table>
@stop
<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">

