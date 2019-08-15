@extends('adminlte::page')
@section('content_header')
    <h1>Мониторинг</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="col-md-3">
                    <div id="online-monitoring">

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
<script src="{{ asset('/js/monitoring.js') }}"></script>



