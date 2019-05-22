@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
{{--    <h1>Проверка данных мерчанта</h1>--}}
@stop


@section('content')

    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Проверка данных мерчанта  ( Статус заказа: {{$order->status->name}} )
                    <small class="pull-right">{{$order->created_at}}</small>
                </h2>
                <button class="btn btn-warning pull-right" id="take-in-process">Взять в работу</button>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                FRAUD TEAM
                <address>
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                SECURITY TEAM
                <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                BUSINESS TEAM
                <address>
                    <strong>John Doe</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название поля</th>
                        <th>Значение</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fieldValues as $fieldValue)
                <tr>
                    <td>{{OrderFieldHelper::getLabel($fieldValue->field->field_key)}}</td>
                    <td> {{$fieldValue->field_value}}</td>
                </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Добавить комментарий:</p>
                <textarea placeholder="Оставить комментарий к заявке..." class="form-control"
                          rows="4" cols="50" id="leave_comment_textarea"></textarea>

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Данный комментарий будет добавлен к заявке автоматически.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Информация о заявке</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Подал заявку:</th>
                            <td>{{$order->users->username}}</td>
                        </tr>
                        <tr>
                            <th>Мерчант</th>
                            <td>{{$order->merchant->name}}</td>
                        </tr>
                        <tr>
                            <th>Идентификатор мерчанта:</th>
                            <td>{{$order->merchant->merchant_id}}</td>
                        </tr>
                        <tr>
                            <th>Статус мерчанта:</th>
                            <td>  {{$order->merchant->merchant_status->name}}   </td>
                        </tr>
                        </tbody></table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">

                <button type="button" class="btn btn-warning pull-right" id="decline_btn" data-content="decline">
                    <i class="fa fa-remove" ></i> Отклонить
                </button>

                <button type="button" class="btn btn-success pull-right"  style="margin-right: 5px;" id="apply_btn" data-content="apply">
                    <i class="fa fa-check"></i> Согласовано
                </button>
            </div>
        </div>
    </section>

@stop


<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/merchant-request.js') }}"></script>

<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">


<?php

$assigned =  (!is_null($order->assigned))?$order->assigned: 0;
?>
<script>
    var order_id = {!!  $order->id !!};
    var assigned = {!!  $assigned !!};
    var current_user = {!! auth()->user()->id  !!};
</script>