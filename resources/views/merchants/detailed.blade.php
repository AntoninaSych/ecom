@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о мерчантe</h1>
@stop


@section('content')
    <?php

    $relations = $merchant->getRelations();
    ?>

    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class="active"><a href="#main-information" data-toggle="tab" aria-expanded="true">Детали</a></li>

            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Настройки</a></li>


            <li class=""><a href="#refound" id="ref_a" data-toggle="tab" aria-expanded="false" onclick="loadAccounts()">Возмещение</a>
            </li>
            @endif

            <li class="pull-left header"><i class="fa fa-inbox"></i> Информация о мерчантe</li>
        </ul>
        <div class="tab-content no-padding">

            {{--               Merchant's details begin--}}
         @include('merchants.partials.merchant-detail')
            {{--               Merchant's detailsvend--}}



            {{--               Settings detailsvend--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                @include('merchants.partials.merchant-edit')
            @endif
            {{--Settings detailsvend--}}


            {{--Account details begin--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                @include('merchants.partials.merchant-account')
            @endif
            {{--Account details end--}}

        </div>
    </div>
@stop
<script src="{{ asset('/js/libraries/jquery-3.3.1.min.js') }}"></script>

<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<script src="{{ asset('js/merchants.js') }}"></script>
<script>
    var merchant_id ={!! $merchant->id !!};
</script>