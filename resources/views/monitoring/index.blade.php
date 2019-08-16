@extends('adminlte::page')
@section('content_header')
    <h1>Мониторинг</h1>
@stop

@section('content')

    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            @if( Auth::user()->can(PermissionHelper::VIEW_MONITORING) )
                <li class="active"><a href="#online-monitoring" data-toggle="tab" aria-expanded="true">Online</a></li>
                <li class=""><a href="#archive-monitoring" data-toggle="tab" aria-expanded="false">Archive</a></li>
                <li class=""><a href="#technical-monitoring" data-toggle="tab" aria-expanded="false">Tech</a></li>
            @endif
        </ul>
        <div class="tab-content no-padding">

            @if( Auth::user()->can(PermissionHelper::VIEW_MONITORING) )
                @include('monitoring.partials.online-monitoring')
                @include('monitoring.partials.archive-monitoring')
                @include('monitoring.partials.technical-monitoring')
            @endif

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
<link rel="stylesheet" href="{{ asset('/css/libraries/morris/morris.css')}}">
<script src="{{ asset('/js/libraries/morris/raphael-min.js') }}"></script>
<script src="{{ asset('/js/libraries/morris/morris.min.js') }}"></script>



