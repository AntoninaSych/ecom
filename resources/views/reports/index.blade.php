@extends('adminlte::page')
@section('content_header')
    <h1>Возможные отчеты</h1>
@stop

@section('content')
    <?php $bgArray = ['bg-green', 'bg-aqua', 'bg-yellow', 'bg-red'];
    $iconArray = ['ion ion-stats-bars','ion ion-pie-graph' ]
    ?>
    <div class="box">
        <div class="box-body" style="overflow-x: scroll">
            <div class="row">
                @if( Auth::user()->can(PermissionHelper::CAN_MANAGE_REPORTS) )
                <div class="cols-xl-6"><a class="btn-default btn" href="/reports/manage/" style="    margin: 15px;">Админ</a></div>
                @endif
                @if( Auth::user()->can(PermissionHelper::CAN_VIEW_REPORTS) ||  Auth::user()->can(PermissionHelper::CAN_MANAGE_REPORTS))
                    @foreach($queriesReport as $report)
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>     {{$report->name}}</h3>
                                        <p> </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer" onclick="execute(this)"
                                       data-query="{{$report->query}}"
                                       data-id="{{$report->id}}"
                                    >Load report <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div id="report-preview" class="table-responsive responsive">

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
        <script type="text/javascript"
                src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/config.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/reports.js') }}"></script>
        <script type="text/javascript"
                src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>


