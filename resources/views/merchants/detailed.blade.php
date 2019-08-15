@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о мерчантe</h1>
@stop
<style>

    .wrap {
        position: relative;
        /*width: 33.33%;*/
        /*margin: -72px 0;*/
        /*top: 50%;*/
        /*float: left;*/
    }

    input[type="checkbox"] + label {
        margin: 1.5em auto;
    }

    input[type="checkbox"] {
        display: none;
        /*position: absolute;*/
        /*left: -9999px;*/
    }

    .slider-v2::after {
        position: absolute;
        content: '';
        width: 2em;
        height: 2em;
        top: 0.5em;
        left: 0.5em;
        border-radius: 50%;
        transition: 250ms ease-in-out;
        background: linear-gradient(#f5f5f5 10%, #eeeeee);
        box-shadow: 0 0.1em 0.15em -0.05em rgba(255, 255, 255, 0.9) inset, 0 0.2em 0.2em -0.12em rgba(0, 0, 0, 0.5);
    }

    .slider-v2::before {
        position: absolute;
        content: '';
        width: 4em;
        height: 1.5em;
        top: 0.75em;
        left: 0.75em;
        border-radius: 0.75em;
        transition: 250ms ease-in-out;
        background: linear-gradient(rgba(0, 0, 0, 0.07), rgba(255, 255, 255, 0.1)), #d0d0d0;
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 0 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::before {
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 3em 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::after {
        left: 3em;
    }


</style>
@section('content')
    <?php
    $relations = $merchant->getRelations();
    ?>
    <div class="nav-tabs-custom" style="cursor: move;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li class="active"><a href="#main-information" data-toggle="tab" aria-expanded="false">Детали</a></li>

            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Настройки</a></li>


                <li class=""><a href="#refound" id="ref_a" data-toggle="tab" aria-expanded="false"
                                onclick="loadAccounts()">Возмещение</a>

                @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_PAYMENT_TYPE) )
                    <li class=""><a href="#payment-type" id="ref_a" data-toggle="tab" aria-expanded="false"
                                    onclick="loadMerchantPaymentType()">Типы платежей</a>
                    </li>
                @endif
                <li class=""><a href="#limits" data-toggle="tab" aria-expanded="false"
                                onclick="loadMerchantLimits()">Лимиты платежей</a>
                </li>

                <li class=""><a href="#attachments" data-toggle="tab" aria-expanded="false">Файлы</a>
                </li>

             @endif

                @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE) || Auth::user()->can(PermissionHelper::VIEW_ROUTES))
                    <li class=""><a href="#payment-route" data-toggle="tab" aria-expanded="false"
                                     id="test_id_rem">Роут платежей</a>
                    </li>
                @endif
            @if( Auth::user()->can(Auth::user()->can(PermissionHelper::MERCHANT_USER_ALIAS)))
                <li class=""><a href="#merchant-user-alias" data-toggle="tab" aria-expanded="false"
                                onclick="loadMerchantUserAlias()">Alias Merchant User</a>
                </li>
            @endif

            @if( Auth::user()->can(Auth::user()->can(PermissionHelper::MERCHANT_VIEW)))
                <li class=""><a href="#merchant-charts" data-toggle="tab" aria-expanded="true"
                               >Merchant Charts</a>
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

            {{--Attachments details begin--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                @include('merchants.partials.attachments')
            @endif
            {{--Attachments details end--}}


            {{--Account details begin--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                @include('merchants.partials.merchant-account')
            @endif
            {{--Account details end--}}

            {{--Account details begin--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) )
                @include('merchants.partials.merchant-limits')
            @endif
            {{--Account details end--}}

            {{--PaymentType details begin--}}
            @if( Auth::user()->can(PermissionHelper::MANAGE_MERCHANT) && Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_PAYMENT_TYPE))
                @include('merchants.partials.merchant-payment-type')
            @endif
            {{--PaymentType details end--}}

            {{--PaymentType details begin--}}
            @if(   Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE) || Auth::user()->can(PermissionHelper::VIEW_ROUTES))
                @include('merchants.partials.merchant-route')
            @endif
            {{--PaymentType details end--}}


{{--        start    merchant-user-alias--}}
            @if(Auth::user()->can(PermissionHelper::MERCHANT_USER_ALIAS))
                @include('merchants.partials.merchant-user-alias')
            @endif
{{--        end    merchant-user-alias--}}

            {{--  start   merchant-charts--}}
            @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT))
                @include('merchants.partials.merchant-charts')
            @endif
            {{--  end   merchant-charts--}}
        </div>
    </div>
@stop


{{--<script src="{{ asset('/js/libraries/jquery-3.3.1.min.js') }}"></script>--}}
<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('/js/libraries/moment/moment.js') }}"></script>
<script src="{{ asset('/js/libraries/datarangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>
{{--<script src="{{ asset('/js/libraries/select2/select2.full.min.js') }}"></script>--}}
 <script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>

<link href="{{ asset('/css/libraries/jquery-ui/1.11.4.jquery-ui.css')}}" rel="stylesheet">


<link rel="stylesheet" href="{{ asset('/css/libraries/morris/morris.css')}}">
  <script src="{{ asset('/js/libraries/morris/raphael-min.js') }}"></script>
  <script src="{{ asset('/js/libraries/morris/morris.min.js') }}"></script>

<script src="{{ asset('js/merchants.js') }}"></script>
<script>
    var merchant_id ={!! $merchant->id !!};


</script>


<script>
    (function ($) {
        $(function () {  //добавляем datetimepicker - ы
            delimiter = ' - ';
            var dateTimeRangeConfiguration = {
                "format": 'YYYY-MM-DD',
                "separator": " - ",
                "applyLabel": "Применить",
                "cancelLabel": "Отмена",
                "fromLabel": "От",
                "toLabel": "До",
                "customRangeLabel": "Свой",
                "daysOfWeek": [
                    "Вс",
                    "Пн",
                    "Вт",
                    "Ср",
                    "Чт",
                    "Пт",
                    "Сб"
                ],
                "monthNames": [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
                "firstDay": 1
            };

            $('#request_period_updated').daterangepicker({
                locale: dateTimeRangeConfiguration,
                startDate: moment().subtract(1, 'days'),
                timePicker24Hour: false,
                endDate: moment(),
                timePicker: false,
                timePickerSeconds: false
            });


        });

    })(jQuery);
</script>

