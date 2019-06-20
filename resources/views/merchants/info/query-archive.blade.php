@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Заявки от мерчантов</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Архив заявок от мерчантов</h3>
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
                ajax: '{!! route('get.search.merchant.queries.archive') !!}',
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



        });
    })(jQuery);

</script>