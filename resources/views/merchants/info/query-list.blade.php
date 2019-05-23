@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Заявки от мерчантов</h1>
@stop
<style>

    .wrap {
        position: relative;
        /*width: 33.33%;*/
        /*margin: -72px 0;*/
        /*top: 50%;*/
        /*float: left;*/
    }

    input[type="checkbox"] + label {
        margin: 1.5em auto;
    }

    input[type="checkbox"] {
        display: none;
        /*position: absolute;*/
        /*left: -9999px;*/
    }

    .slider-v2::after {
        position: absolute;
        content: '';
        width: 2em;
        height: 2em;
        top: 0.5em;
        left: 0.5em;
        border-radius: 50%;
        transition: 250ms ease-in-out;
        background: linear-gradient(#f5f5f5 10%, #eeeeee);
        box-shadow: 0 0.1em 0.15em -0.05em rgba(255, 255, 255, 0.9) inset, 0 0.2em 0.2em -0.12em rgba(0, 0, 0, 0.5);
    }

    .slider-v2::before {
        position: absolute;
        content: '';
        width: 4em;
        height: 1.5em;
        top: 0.75em;
        left: 0.75em;
        border-radius: 0.75em;
        transition: 250ms ease-in-out;
        background: linear-gradient(rgba(0, 0, 0, 0.07), rgba(255, 255, 255, 0.1)), #d0d0d0;
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 0 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::before {
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 3em 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::after {
        left: 3em;
    }


</style>
@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Поиск заявок</h3>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="search-form">
                <div class="col-md-12">

                    <div class="col-md-4">

                        <div>
                            <label class="control-label" for="department"> Фильтр по департаменту:
                            </label>
                            <select class="form-control" type="text" name="department" id="department">
                                <option value="" disabled selected hidden>Пожалуйста, сделайте выбор...
                                </option>
                                @foreach(OrderStatusHelper::getAllowedDeparts() as $key=>$value)
                                    @if( Auth::user()->hasRole($key));
                                    <option value="{{$key}}" selected>{{$value}}</option>
                                    @else
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        {{--                    <div class="wrap">--}}
                        {{--                        <input type="checkbox" id="allowed"--}}
                        {{--                               checked="checked"  />--}}
                        {{--                        <label class="slider-v2" for="allowed"></label>--}}
                        {{--                    </div>--}}
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class=" btn btn-primary pull-right" id="apply-filters" value="Поиск">
                    </div>
                </div>
            </form>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Отображение заявок от мерчантов</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary">Label</span>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table id="orders-table" class="table table-bordered table-striped dataTable" role="grid"
                   aria-describedby="example1_info">
                <thead>
                <tr role="row">
                    <th> ID</th>
                    <th> Создан</th>
                    <th> Статус мерчанта</th>
                    <th> Статус заявки</th>
                    <th> Пользователь</th>
                    <th> Мерчант</th>
                    <th> Fraud</th>
                    <th> Security</th>
                    <th> Business</th>
                    <th> Просмотр деталей</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->


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
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
{{--<script src="{{ asset('js/payment.js') }}"></script>--}}
<script>
    (function ($) {
        $(function () {

            $('#orders-table').DataTable({
                processing: true,
                "language": {
                    "url": "/Russian.json"
                },
                serverSide: true,
                ajax: '{!! route('get.search.merchant.queries') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'marchant_state', name: 'marchant_state'},
                    {data: 'order_state', name: 'order_state', searchable: false},
                    {data: 'user_created', name: 'user_created'},
                    {data: 'merchant', name: 'merchant'},
                    {data: 'fraud', name: 'fraud'},
                    {data: 'security', name: 'security'},
                    {data: 'business', name: 'business'},
                    {data: 'view_details', name: 'view_details', searchable: false}
                ]
            });


            $('#apply-filters').on('click', function (e) {

                let form = $("#search-form");
                form.validate({
                    rules: {
                        id: {
                            number: true,
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

                    $('#orders-table').dataTable().fnDestroy();
                    var oTable = $('#orders-table').DataTable({
                        processing: true,
                        "language": {
                            "url": "/Russian.json"
                        },
                        serverSide: true,
                        ajax: {
                            url: '{!! route('get.search.merchant.queries')  !!}',
                            data: {
                                // id: $('#search-form').find("input[name*='id']").val(),
                                // created_date: $('#search-form').find("input[name*='created_date']").val(),
                                department: $('#search-form').find("select[name*='department']").val(),
                                // payment_status: $('#search-form').find("select[name*='payment_status']").val(),
                                // number_order: $('#search-form').find("input[name*='number_order']").val(),
                                // amount: $('#search-form').find("input[name*='amount']").val(),
                                // merchant_id: $('#search-form').find("select[name*='merchant_id']").val(),
                                // card_number: $('#search-form').find("input[name*='card_number']").val(),
                                // description: $('#search-form').find("input[name*='description']").val(),
                                // updated_from: $('#request_period_updated').val().split(delimiter)[0],//дата платежа
                                // updated_to: $('#request_period_updated').val().split(delimiter)[1],//дата платежа
                                // // created_from: $('#request_period_created').val().split(delimiter)[0],//дата создания платежа
                                // // created_to: $('#request_period_created').val().split(delimiter)[1]//дата создание платежа
                            },
                        },
                        success: function (result, status) {
                            self.editing = false;
                            callback.apply(self, [result, settings]);
                            console.log('123');
                            if (!$.trim($(self).html())) {
                                $(self).html(settings.placeholder);
                            }
                        },
                        error: function (data) {
                            console.log('success' + data)
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'marchant_state', name: 'marchant_state'},
                            {data: 'order_state', name: 'order_state', searchable: false},
                            {data: 'user_created', name: 'user_created'},
                            {data: 'merchant', name: 'merchant'},
                            {data: 'fraud', name: 'fraud'},
                            {data: 'security', name: 'security'},
                            {data: 'business', name: 'business'},
                            {data: 'view_details', name: 'view_details', searchable: false}
                        ]
                    });
                    e.preventDefault();
                }
            });
        });
    })(jQuery);

</script>