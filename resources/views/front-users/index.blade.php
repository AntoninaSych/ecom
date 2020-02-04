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
                                <div class="col-md-4">
                                        <label class="control-label" for="request_period_updated">Дата создания
                                            пользователя</label>
                                        <div class="input-group input-daterange" style="width: 100%">
                                            <input required="" id="request_period_updated" class="form-control valid"
                                                   name="request_period_updated" type="text"
                                                   aria-invalid="false" style="width: 100%;">
                                        </div>

                                </div>
                                <div class=" col-md-4">&nbsp;<label>&nbsp;</label>
                                    <input type="submit" value="Поиск" class="btn btn-primary form-control"
                                           id="front-users-search-button">

                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Результаты поиска</h3>
                    <div class="box-body table-responsive">
                        <table class="table table-hover" id="front-users-table">
                            <thead>
                            <tr role="row">
                                <th> #ID </th>
                                <th> Имя пользователя</th>
                                <th> Email пользователя</th>
                                <th> Дата создания пользователя</th>
                                <th> utm_term</th>
                                <th> utm_content</th>
                                <th> utm_campaign</th>
                                <th> utm_medium</th>
                                <th> utm_source</th>
                                <th> Активных мерчантов</th>
                                <th> Всего мерчантов</th>
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
<script src="{{ asset('js/libraries/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/default.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<script src="{{ asset('js/front-users.js') }}"></script>
<script>
    (function ($) {
        $(function () {

            var oTable = $('#payment-table').DataTable({
                dom: 'rBltp',
                buttons: [
                    'copy', 'csv', 'print',

                ],
                processing: true,
                "language": {
                    "url": "/Russian.json"
                },
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                serverSide: true,
                ajax: '{!! route('get.front.users') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'utm_term', name: 'utm_term'},
                    {data: 'utm_content', name: 'utm_content'},
                    {data: 'utm_campaign', name: 'utm_campaign'},
                    {data: 'utm_medium', name: 'utm_medium'},
                    {data: 'utm_source', name: 'utm_source'},
                    {data: 'active_merchants', name: 'active_merchants'},
                    {data: 'total_merchants', name: 'total_merchants'},

                ]
            });
            oTable.order([[1, 'desc']]).draw();

            $('#front-users-search-button').on('click', function (e) {
                e.preventDefault();
                let form = $("#search-form");
                form.validate({
                    rules: {
                        created_at: {
                            minlength: 1,
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
                    $('#front-users-table').dataTable().fnDestroy();
                    oTable = $('#front-users-table').DataTable({
                        dom: 'lBrtip',

                        buttons: [  {
                                               text: 'Экспорт в CSV',
                                               class:'csv-btn',
                                               action: function (dt) {
                                                   csv();
                                               }
                     }],
                        processing: true,

                        "language": {
                            "url": "/Russian.json"
                        },
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        serverSide: true,
                        ajax: {
                            url: '{!! route('get.front.users') !!}',
                            data: {
                                created_from: $('#request_period_updated').val().split(delimiter)[0],//дата платежа
                                created_to: $('#request_period_updated').val().split(delimiter)[1],//дата платежа
                            },
                        },
                        success: function (result, status) {
                            self.editing = false;
                            callback.apply(self, [result, settings]);
                            if (!$.trim($(self).html())) {
                                $(self).html(settings.placeholder);
                            }
                        },
                        error: function (data) {
                            console.log('success' + data)
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'username', name: 'username'},
                            {data: 'email', name: 'email'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'utm_term', name: 'utm_term'},
                            {data: 'utm_content', name: 'utm_content'},
                            {data: 'utm_campaign', name: 'utm_campaign'},
                            {data: 'utm_medium', name: 'utm_medium'},
                            {data: 'utm_source', name: 'utm_source'},
                            {data: 'active_merchants', name: 'active_merchants'},
                            {data: 'total_merchants', name: 'total_merchants'},

                        ]
                    });
                    oTable.order([[1, 'desc']]).draw();
                    e.preventDefault();
                }
            });
        });
    })(jQuery);

            function csv() {
                   var el = $('#search-form');
                   var href = '/front/exportToCSV?';
                   href+=  ($('#request_period_updated').val().split(delimiter)[0]!=null) ? '&created_from='+$('#request_period_updated').val().split(delimiter)[0]: '';
                   href+=  ($('#request_period_updated').val().split(delimiter)[1]!=null) ? '&created_to='+$('#request_period_updated').val().split(delimiter)[1]: '';
                window.location = href;
            }
</script>




