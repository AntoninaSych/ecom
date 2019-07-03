@extends('adminlte::page')
@section('content_header')
    <h1>Реестры</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="col-md-3">
                    <form id="reestrs" action="/reestrs/getReestr" method="get">
                        <label for="date_reestr">Дата</label>
                        <input id="date_reestr" class="form-control" name="date_reestr">
                        <label for="type_reestr">Тип реестра</label>
                        <select id="type_reestr" name="type_reestr" class="form-control">
                            {{--<option  selected disabled>Выберите тип реестра</option>--}}
                            <option value="mono" selected> Монобанк</option>
                        </select>
                        <input type="submit" value="Зазгрузить" class="form-control btn-primary"
                               style="margin-top: 15px!important">
                    </form>
                </div>
                <div class="col-md-6" id="reestr_search" style="border-bottom-color: #1d643b">

                </div>
            </div>


        </div>
    </div>
@stop
<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/default.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>


<script src="{{ asset('/js/reestrs.js') }}"></script>



