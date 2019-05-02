@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о мерчантах</h1>
@stop


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Результаты поиска</h3>
                    <div class="box-body" id="merchants-search-results">
                        <table class="table table-hover" id="merchants-table">
                            <thead>
                            <tr role="row">
                                <th> ID</th>
                                <th> Идентификатор Мерчанта</th>
                                <th> Имя</th>
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
<script>
    (function ($) {
        $(function () {

            $('#merchants-table').DataTable({
                processing: true,
                "language": {
                    "url": "/Russian.json"
                },
                serverSide: true,
                ajax: '{!! route('get.search.merchants') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'merchant_id', name: 'merchant_id'},
                    {data: 'name', name: 'name'},
                    {data: 'url', name: 'url',},
                    {data: 'status', name: 'status'},
                    {data: 'view_details', name: 'view_details', searchable: false}
                ]
            });

        });
    })(jQuery);

</script>


