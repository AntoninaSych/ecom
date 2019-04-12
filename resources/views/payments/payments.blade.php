@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>История операций</h1>
@stop


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Фильтры</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                    </div>


                    <div class="box-body">

                        <form role="form" id="search-form">
                            <div class="row">
                                <div class=" col-md-4" >
                                    <label class="control-label">Дата платежа</label>

                                    <div class="input-group input-daterange" style="width: 100%">
                                        <input required="" id="request_period_updated" class="form-control valid"
                                               name="request_period_updated" type="text"
                                               aria-invalid="false" style="width: 100%;">
                                    </div>
                                </div>




                                <div class="col-md-4">
                                    <label class="control-label">Дата создания платежа</label>


                                        <div class="input-group input-daterange" style="width: 100%">
                                            <input required="" id="request_period_created" class="form-control valid"
                                                   name="request_period_created" type="text"
                                                   aria-invalid="false" style="width: 100%;">
                                        </div>

                                </div>
                                <div class="col-md-4">&nbsp;</div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="control-label">ID платежа</label>
                                    <input class="form-control" type="text" name="id">



                                    <label class="control-label">Тип платежа</label>

                                    <select class="form-control" type="text" name="payment_type">
                                        <option value="" disabled selected hidden>Пожалуйста, сделайте выбор...</option>
                                        @foreach($paymentTypes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-4">

                                    <label class="control-label">Статус платежа
                                    </label>
                                    <select class="form-control" type="text" name="payment_status">
                                        <option value="" disabled selected hidden>Пожалуйста, сделайте выбор...</option>
                                        @foreach($paymentStatuses as $status)
                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>

                                    <label class="control-label">Номер заказа в системе мерчанта</label>
                                    <input class="form-control" type="text" name="number_order">

                                    <label class="control-label">Сумма</label>
                                    <input class="form-control" type="text" name="amount">

                                </div>

                                <div class="col-md-4">
                                    <label class="control-label">Мерчант
                                    </label>
                                    <select class="merchant_id form-control"  id="merchant_id" name="merchant_id" multiple="multiple">
                                    </select>

                                    <label class="control-label">Маскированый номер карты</label>
                                    <input class="form-control" type="text" name="card_number">

                                    <label class="control-label">Описание</label>
                                    <input class="form-control" type="text" name="description">

                                </div>
                            </div>

                                <div  style="margin-top: 25px">
                                    <input type="submit" value="Поиск" class="btn btn-default form-control" id="payment-search-button">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Результаты поиска</h3>
                    <div class="box-body" id="payment-search-results">
                        @include('payments.search-results')
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

