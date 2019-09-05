@extends('adminlte::page')
@section('content_header')
    <h1>Список отчетов</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body" style="overflow-x: scroll">
            <div class="row">
                <div><h3 style="margin: 15px">Список отчетов</h3></div>
            </div>
            <div class="pull-right">
                <button class="btn btn-default"
                        data-target="#modal-add-report" data-toggle="modal" style="margin: 15px">Добавить отчет
                </button>
            </div>

            <div>
                <table class="table">
                @foreach($queriesReport as $query)
                    <tr>
                        <td>{{$query->id}}</td>
                        <td>{{$query->name}}</td>
                        <td>{{$query->query}}</td>
                        <td><button class="btn button btn-warning"
                                    data-id="{{$query->id}}"
                                    data-name="{{$query->name}}"
                                    data-query="{{$query->query}}"
                                    data-target="#modal-update-report"
                                    data-toggle="modal"
                                    onclick="prepareUpdateReport(this)">Изменить</button>
                        </td>
                        <td><button class="btn button btn-danger"  onclick="prepareRemoveReport({{$query->id}})"
                                    data-target="#modal-remove-report"
                                    data-toggle="modal">Удалить</button></td>
                        <td><button class="btn button btn-dropbox"
                                    data-query="{{$query->query}}"
                                    data-id="{{$query->id}}"
                                    onclick="execute(this)">Execute</button></td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
        <hr>
        <div id="report-preview" class="table-responsive responsive">

        </div>
    </div>
        @include('reports.manage.partials.add-report-modal')
        @include('reports.manage.partials.remove-report-modal')
        @include('reports.manage.partials.update-report-modal')
        @stop

        <script src="{{ asset('/js/libraries/jquery.js') }}"></script>
        <script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/libraries/alertify/alertify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/libraries/alertify/default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">
        <script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/config.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/reports.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
