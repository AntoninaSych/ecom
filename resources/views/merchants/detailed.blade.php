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
                    <td>Идентификатор мерчанта</td>
                    <td>{{$merchant->merchant_id}}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{$merchant->name}}</td>
                </tr>
                <tr>
                    <td>URL</td>
                    <td><a href="{{$merchant->url}}">{{$merchant->url}}</a></td>
                </tr>

                <tr>
                    <td>Комиссия</td>
                    <td>{{$merchant->comission}}</td>
                </tr>
                <tr>
                    <td>Apple мерчанта</td>
                    <td>{{$merchant->apple_merchant_id}}</td>
                </tr>
                <tr>
                    <td>Статус</td>
                    <td>{{$relations['status']->name}}</td>
                </tr>
                <tr>
                    <td>Имя мерчанта</td>
                    <td>
                        {{$relations['user']->username}}<br>

                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        {{$relations['user']->email}}
                    </td>
                </tr>
                <tr>
                    <td>Тип компенсации</td>
                    <td>{{$relations['compensationType']->name}}
                        @if($relations['compensationType']->enabled ==1)
                            <span class="label label-success"> Включен</span>
                        @else
                            <span class="label label-danger">Выключен</span>
                        @endif


                    </td>
                </tr>
                <tr>
                    <td>Вид компенсации</td>
                    <td>{{$relations['compensationTerm']->name}}
                        @if($relations['compensationTerm']->enabled ==1)
                            <span class="label label-success"> Включен</span>
                        @else
                            <span class="label label-danger">Выключен</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>Тип мерчанта</td>


                    <td>{{$relations['merchantType']->name}}

                        @if($relations['merchantType']->enabled ==1)
                            <span class="label label-success"> Включен</span>
                        @else
                            <span class="label label-danger">Выключен</span>
                        @endif


                    </td>
                </tr>
                <tr>
                    <td>Дата обновления</td>
                    <td>{{$merchant->updated}}</td>
                </tr>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
@stop


