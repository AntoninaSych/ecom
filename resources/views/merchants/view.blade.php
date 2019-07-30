@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о мерчантах</h1>
@stop


@section('content')
    @if(!empty($errors->first()))
        <div class="row col-lg-12">
            <div class="alert alert-danger">
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Список всех мерчантов</h3>
                    <div class="box-tools " style="margin: 15px!important">

                        <div class="row">
                            <div class="pull-right btn btn-primary" data-toggle="modal"
                                 data-target="#modal-add-merchant"
                                 style="margin-bottom: 15px">
                                <i class="fa fa-fw fa-plus"></i> Добавить мерчанта
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box-body" id="merchants-search-results" style="margin-top: 15px!important">

                    <div class="row " style="margin-bottom: 15px!important; margin-left:15px!important;">
                        <div class=" ">
                            <h3>Фильтры</h3>
                            <form id="search-form">
                                <div class="row">
                                    <div class="col-md-4 col-xs-12">
                                        <label class="control-label" for="identifier">Идентификатор мерчанта</label>
                                        <select type="text" name="identifier" class="form-control" id="identifier"
                                                style="width: 100%"
                                        >
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label for="user">Пользователям ConcordPay </label>
                                        <select name="concordpay_user" class="form-control" id="concordpay_user"
                                                style="width: 100%">
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label" for="merchant_id">Мерчант
                                        </label>
                                        <select class="merchant_id form-control" id="merchant_id" name="merchant_id"
                                                style="width: 100%"
                                                multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-xs-12">
                                        <label for="user">По имени создателя </label>
                                        <select name="merchant_creator_user" class="form-control" style="width: 100%"
                                                id="merchant_creator_user">
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <label for="terminal">Terminal </label>
                                        <input type="text" name="terminal" class="form-control">
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        &nbsp;
                                        <input type="submit" value="Поиск" class="form-control btn btn-primary"
                                               id="merchant-search-button">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover " id="merchants-table">
                            <thead>
                            <tr role="row">
                                <th> ID</th>
                                <th> ID Терминала</th>
                                <th> Имя</th>
                                <th> Тип</th>
                                <th> URL</th>
                                <th> Статус</th>
                                <th> Детали</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('merchants.modal-add-merchant')

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
<script type="text/javascript" src="{{ asset('/js/config.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/merchant-search.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<script>
    (function ($) {
        $(function () {
           var table= $('#merchants-table').DataTable({
                dom: 'lBctp',
                processing: true,
                "pageLength": 10,
                responsive: true,
                "language": {
                    "url": "/Russian.json"
                },
                serverSide: true,
                ajax: '{!! route('get.search.merchants') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'merchant_id', name: 'merchant_id'},
                    {data: 'name', name: 'name'},
                    {data: 'type', name: 'type'},
                    {data: 'url', name: 'url',},
                    {data: 'status', name: 'status'},
                    {data: 'view_details', name: 'view_details', searchable: false}
                ]
            });
            table.order([[0,'desc']]).draw();

            $('#merchant-search-button').on('click', function (e) {
                e.preventDefault();
                let form = $("#search-form");

                $('#merchants-table').dataTable().fnDestroy();

               var oTable = $('#merchants-table').DataTable({
                    dom: 'lBrtip',

                    buttons: [
                        'copy', 'csv', 'excel', 'print'
                    ],
                    processing: true,

                    "language": {
                        "url": "/Russian.json"
                    },
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    serverSide: true,
                    ajax: {
                        url:  '{!! route('get.search.merchants') !!}',
                        data: {
                            terminal: $('#search-form').find("input[name*='terminal']").val(),
                            identifier: $('#search-form').find("select[name*='identifier']").val(),
                            merchant_creator_user: $('#search-form').find("select[name*='merchant_creator_user']").val(),
                            concordpay_user: $('#search-form').find("select[name*='concordpay_user']").val(),
                            merchant_id: $('#search-form').find("select[name*='merchant_id']").val(),
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
                        {data: 'merchant_id', name: 'merchant_id'},
                        {data: 'name', name: 'name'},
                        {data: 'type', name: 'type'},
                        {data: 'url', name: 'url',},
                        {data: 'status', name: 'status'},
                        {data: 'view_details', name: 'view_details', searchable: false}
                    ]
                });
               oTable.order([[0, 'desc']]).draw();
                // }

            });
        });
    })(jQuery);

</script>


