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
                        <table class="table table-hover" id="payment-table">
                            <thead>
                            <tr role="row">
                                <th> ID</th>
                                <th> Дата операции</th>
                                <th> Сумма</th>
                                <th> Комиссия</th>
                                <th> Статус</th>
                                <th> Карта</th>
                                <th> ID заказа</th>
                                <th> Описание</th>
                                <th> Просмотр </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
<script src="{{ asset('js/libraries/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>

       $(function () {
            $('#payment-table').DataTable({
                processing: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
                },
                serverSide: true,
                ajax: '{!! route('get.search.payment') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created', name: 'created'},
                    {data: 'amount', name: 'amount',},
                    {data: 'customer_fee', name: 'customer_fee'},
                    {data: 'status', name: 'status'},
                    {data: 'card_num', name: 'card_num'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'description', name: 'description'},
                    {data: 'view_details', name: 'view_details',  searchable: false}
                ]
            });

           $('#payment-search-button').on('click', function (e) {
               $('#payment-table').dataTable().fnDestroy();
               var oTable = $('#payment-table').DataTable({
                   processing: true,
                   "language": {
                       "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
                   },
                   serverSide: true,
                   ajax: {
                       url: '{!! route('get.search.payment') !!}',
                       data: {
                           id:$('#search-form').find("input[name*='id']").val(),
                            created_date: $('#search-form').find("input[name*='created_date']").val(),
                            payment_type: $('#search-form').find("select[name*='payment_type']").val(),
                            payment_status:  $('#search-form').find("select[name*='payment_status']").val(),
                            number_order:  $('#search-form').find("input[name*='number_order']").val(),
                            amount:  $('#search-form').find("input[name*='amount']").val(),
                            merchant_id:  $('#search-form').find("select[name*='merchant_id']").val(),
                            card_number: $('#search-form').find("input[name*='card_number']").val(),
                            description:  $('#search-form').find("input[name*='description']").val(),
                            updated_from: $('#request_period_updated').val().split(delimiter)[0],//дата платежа
                            updated_to:  $('#request_period_updated').val().split(delimiter)[1],//дата платежа
                            created_from:  $('#request_period_created').val().split(delimiter)[0],//дата платежа
                            created_to:  $('#request_period_created').val().split(delimiter)[1]//дата платежа
                       }
                   },
                   columns: [
                       {data: 'id', name: 'id'},
                       {data: 'created', name: 'created'},
                       {data: 'amount', name: 'amount',},
                       {data: 'customer_fee', name: 'customer_fee'},
                       {data: 'status', name: 'status'},
                       {data: 'card_num', name: 'card_num'},
                       {data: 'order_id', name: 'order_id'},
                       {data: 'description', name: 'description'},
                       {data: 'view_details', name: 'view_details',  searchable: false}
                   ]
               });
               oTable.draw();
               alertify.success('Данные загружены');
               e.preventDefault();
           });

        });
</script>