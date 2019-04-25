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
                                <div class=" col-md-4">
                                    <div>
                                        <label class="control-label" for="request_period_updated">Дата платежа</label>
                                        <div class="input-group input-daterange" style="width: 100%">
                                            <input required="" id="request_period_updated" class="form-control valid"
                                                   name="request_period_updated" type="text"
                                                   aria-invalid="false" style="width: 100%;">
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="col-md-4">--}}
{{--                                    <div>--}}
{{--                                        <label class="control-label" for="request_period_created">Дата создания--}}
{{--                                            платежа</label>--}}
{{--                                        <div class="input-group input-daterange" style="width: 100%">--}}
{{--                                            <input id="request_period_created" class="form-control valid"--}}
{{--                                                   name="request_period_created" type="text"--}}
{{--                                                   aria-invalid="false" style="width: 100%;">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-4">
                                    <label class="control-label" for="merchant_id">Мерчант
                                    </label>
                                    <select class="merchant_id form-control" id="merchant_id" name="merchant_id"
                                            multiple="multiple">
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <label class="control-label" for="id">ID платежа</label>
                                        <input class="form-control" type="text" name="id" id="id">
                                    </div>
                                    <div style="display: block">
                                        <div>
                                            <label class="control-label" for="payment_type">Тип платежа</label>
                                            <select class="form-control" type="text" name="payment_type"
                                                    id="payment_type">
                                                <option value="" disabled selected hidden>Пожалуйста, сделайте выбор...
                                                </option>
                                                @foreach($paymentTypes as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div style="margin-top: 25px">
                                        <input type="button" class="btn btn-default" style="width: 100%" value="Очистить"
                                               onclick="setDateAfterReset()"
                                               id="empty-btn">
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div>
                                        <label class="control-label" for="payment_status">Статус платежа
                                        </label>
                                        <select class="form-control" type="text" name="payment_status"
                                                id="payment_status">
                                            <option value="" disabled selected hidden>Пожалуйста, сделайте выбор...
                                            </option>
                                            @foreach($paymentStatuses as $status)
                                                <option value="{{$status->id}}">{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="control-label" for="number_order">Номер заказа в системе
                                            мерчанта</label>
                                        <input class="form-control" type="text" name="number_order" id="number_order">
                                    </div>
                                    <div>
                                        <label class="control-label" for="amount">Сумма</label>
                                        <input class="form-control" type="text" name="amount" id="amount">
                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div>
                                        <label class="control-label" for="card_number">Маскированый номер карты</label>
                                        <input class="form-control" type="text" name="card_number" id="card_number">
                                    </div>
                                    <div>
                                        <label class="control-label" for="description">Описание</label>
                                        <input class="form-control" type="text" name="description" id="description">
                                    </div>

                                    <div style="width: 100%">&nbsp;
                                        <input type="submit" value="Поиск" class="btn btn-primary form-control"
                                               id="payment-search-button">

                                    </div>
                                </div>
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
{{--                                <th> Дата создания</th>--}}
                                <th> Дата платежа</th>
                                <th> Сумма</th>
                                <th> Комиссия</th>
                                <th> Статус</th>
                                <th> Мерчант</th>
                                <th> Карта</th>
                                <th> ID заказа</th>
                                <th> Описание</th>
                                <th> Просмотр</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/default.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<script src="{{ asset('js/payment.js') }}"></script>
<script>
    (function ($) {
        $(function () {
            $("#card_number").mask("000000******0000");
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Введите первые 6 и последние 4 цифры карты"
            );
            $('#payment-table').DataTable({
                processing: true,
                "language": {
                    "url": "/Russian.json"
                },
                serverSide: true,
                ajax: '{!! route('get.search.payment') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    // {data: 'created', name: 'created'},
                    {data: 'updated', name: 'updated'},
                    {data: 'amount', name: 'amount',},
                    {data: 'customer_fee', name: 'customer_fee'},
                    {data: 'status', name: 'status'},
                    {data: 'merchant', name: 'merchant'},
                    {data: 'card_num', name: 'card_num'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'description', name: 'description'},
                    {data: 'view_details', name: 'view_details', searchable: false}
                ]
            });


            $('#payment-search-button').on('click', function (e) {

                let form = $("#search-form");
                form.validate({
                    rules: {
                        id: {
                            number: true,
                        },
                        number_order: {
                            number: true,
                        },
                        amount: {
                            number: true,
                        },
                        description:
                        {
                                minlength: 3
                        },
                        card_number:{
                            regex: "(\\d{6}([*]{6}|)\\d{4})"
                        }

                    },
                    errorClass: "has-error",
                    validClass: "has-success",
                    errorElement: "em",
                    highlight: function (element, errorClass, validClass) {
                        $(element).parent().addClass(errorClass);
                        $(element.form).find("label[for=" + element.id + "]")
                            .addClass(errorClass);
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).parent().removeClass(errorClass);
                        $(element.form).find("label[for=" + element.id + "]")
                            .removeClass(errorClass);
                    }
                });
                if (form.valid() === true) {

                    $('#payment-table').dataTable().fnDestroy();
                    var oTable = $('#payment-table').DataTable({
                        processing: true,
                        "language": {
                            "url": "/Russian.json"
                        },
                        serverSide: true,
                        ajax: {
                            url: '{!! route('get.search.payment') !!}',
                            data: {
                                id: $('#search-form').find("input[name*='id']").val(),
                                // created_date: $('#search-form').find("input[name*='created_date']").val(),
                                payment_type: $('#search-form').find("select[name*='payment_type']").val(),
                                payment_status: $('#search-form').find("select[name*='payment_status']").val(),
                                number_order: $('#search-form').find("input[name*='number_order']").val(),
                                amount: $('#search-form').find("input[name*='amount']").val(),
                                merchant_id: $('#search-form').find("select[name*='merchant_id']").val(),
                                card_number: $('#search-form').find("input[name*='card_number']").val(),
                                description: $('#search-form').find("input[name*='description']").val(),
                                updated_from: $('#request_period_updated').val().split(delimiter)[0],//дата платежа
                                updated_to: $('#request_period_updated').val().split(delimiter)[1],//дата платежа
                                created_from: $('#request_period_created').val().split(delimiter)[0],//дата создания платежа
                                created_to: $('#request_period_created').val().split(delimiter)[1]//дата создание платежа
                            },
                        },
                        success: function(result, status) {
                            self.editing = false;
                            callback.apply(self, [result, settings]);
                            console.log('123');
                            if (!$.trim($(self).html())) {
                                $(self).html(settings.placeholder);
                            }
                        },
                        error:function(data){console.log('success'+data)},
                        columns: [
                            {data: 'id', name: 'id'},
                            // {data: 'created', name: 'created'},
                            {data: 'updated', name: 'updated'},
                            {data: 'amount', name: 'amount',},
                            {data: 'customer_fee', name: 'customer_fee'},
                            {data: 'status', name: 'status'},
                            {data: 'merchant', name: 'merchant'},
                            {data: 'card_num', name: 'card_num'},
                            {data: 'order_id', name: 'order_id'},
                            {data: 'description', name: 'description'},
                            {data: 'view_details', name: 'view_details', searchable: false}
                        ]
                    });
                    e.preventDefault();
                }
            });

        });
    })(jQuery);

</script>


