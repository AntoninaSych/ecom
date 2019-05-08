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
                    <div class="pull-right"><a href="{{route('mcc.create')}}" class="btn-primary btn" style="margin-bottom: 15px"title="Добавить новый код"> <i
                                    class="fa fa-fw fa-plus"></i>Добавить новый код</a></div>
                    <div class="box-body" id="mcc-codes">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
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

    <div class="modal fade in" id="modal-remove-mcc">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Удалить выбранный код</h4>
                </div>
                <div class="modal-body" id="remove-content" style="text-align: center">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Зыкрыть</button>
{{--                    <button type="button" class="btn btn-primary">Удалить</button>--}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<script>

    function loadInfo(id, name, code) {

        var template = "<form method='get' action='{{route('remove.mcc')}}'> ";
        template += "Вы действительно желаете удалить код: " + code + " <br>" +
            "c названием: " + name + " <br>" +
            "и ID: " + id;

        template += "<input type='hidden' name='id' value='" + id + "'><br>";
        template += "<input type='submit' class='btn-primary btn pull-right' value='Удалить' style='margin-top:45px'>";
        template += "</form>";
        $('#remove-content').html(template);

    }


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
