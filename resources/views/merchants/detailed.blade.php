@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о мерчантe</h1>
@stop


@section('content')
    <?php

    $relations = $merchant->getRelations();

    ?>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$merchant->name}}</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary">{{$merchant->name}}</span>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table">
                <tr>
                    <td>Merchant Id</td>
                    <td>{{$merchant->merchant_id}}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{$merchant->name}}</td>
                </tr>
                <tr>
                    <td>URL</td>
                    <td>{{$merchant->url}}</td>
                </tr>

                <tr>
                    <td>Comission</td>
                    <td>{{$merchant->comission}}</td>
                </tr>
                <tr>
                    <td>Apple Merchant</td>
                    <td>{{$merchant->apple_merchant_id}}</td>
                </tr>
                <tr>
                    <td>Статус</td>
                    <td>{{$relations['status']->name}}</td>
                </tr>
                <tr>
                    <td>Имя мерчанта</td>
                    <td>
                        Name: {{$relations['user']->username}}<br>
                        Email: {{$relations['user']->email}}
                    </td>
                </tr>

                <tr>
                    <td>Compensation Type</td>
                    <td>{{$relations['compensationType']->name}}<br>
                        {{$relations['compensationType']->enabled}}
                    </td>
                </tr>
                <tr>
                    <td>Compensation Term</td>
                    <td>{{$relations['compensationTerm']->name}}<br>
                        {{$relations['compensationTerm']->enabled}}
                    </td>
                </tr>

                <tr>
                    <td>Merchant Type</td>
                    <td>{{$relations['merchantType']->name}}<br>
                        {{$relations['merchantType']->enabled}}
                    </td>
                </tr>
                <tr>
                    <td>Updated</td>
                    <td>{{$merchant->updated}}</td>
                </tr>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            The footer of the box
        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
    <?php //dd($merchant);?>

@stop


