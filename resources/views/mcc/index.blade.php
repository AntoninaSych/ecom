@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>MCC коды</h1>
@stop
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Список MCC кодов</h3>
                <div class="box-body" id="mcc-codes">
                  <div class=" right"> <a href="{{route('mcc.create')}}" class="btn-primary btn"> <i class="fa fa-fw fa-plus"></i></a></div>
                @if(empty($codes->toArray()))
                        Пусто
                      @else
                    <table class="table table-hover" id="mcc-table">
                        <thead>
                        <tr role="row">
                            <th> ID</th>
                            <th> Название</th>
                            <th> Код</th>
                            <th> ApplePay</th>
                            <th> Дата изменения</th>
                            <th> Изменить</th>
                            <th> Удалить</th>
                        </tr>
                        </thead>
                    </table>
                    @endif
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
            $.fn.dataTable.ext.errMode = 'throw';
            $('#mcc-table').DataTable({
                processing: true,
                "language": {
                    "url": "/Russian.json"
                },
                serverSide: true,
                ajax: '{!! route('get.search.mcc.codes') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'merchant_id'},
                    {data: 'code', name: 'code',},
                    {data: 'applePay', name: 'applePay'},
                    {data: 'updated', name: 'updated'},
                    {data: 'view_details', name: 'view_details', searchable: false},
                    {data: 'remove', name: 'remove', searchable: false}
                ]
            });

        });
    })(jQuery);

</script>
