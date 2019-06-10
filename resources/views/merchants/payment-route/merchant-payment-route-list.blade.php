@if(empty($merchantPaymentRoutes->isNotEmpty()))
    У мерчанта не настроены типы платежей

@else
    <table id="account_list" class="table table-bordered table-striped dataTable" role="grid"
           aria-describedby="example1_info">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> payment type</th>
            <th> Роут</th>
            <th> Сумма min</th>
            <th> Сумма max</th>
            <th> Card system</th>
            <th> Payment type (display ony)</th>
            <th> Создан</th>
            <th> Обновлен</th>
{{--            <th> Изменить</th>--}}
        </tr>
        </thead>


        <tbody id="merchant-accounts-table">
                        @foreach($merchantPaymentRoutes as $merchantPaymentRoute)
                            <tr>
                                <td>{{$merchantPaymentRoute->id}}</td>
                                <td>{{$merchantPaymentRoute->paymentRoute->paymentType->name}}</td>

                                <td>{{$merchantPaymentRoute->paymentRoute->name}}</td>
                                <td>{{$merchantPaymentRoute->sum_min}}</td>
                                <td>{{$merchantPaymentRoute->sum_max}}</td>
                                <td>{{$merchantPaymentRoute->cardSystem->name}}</td>
                                <td>{{$merchantPaymentRoute->created}}</td>
                                <td>{{$merchantPaymentRoute->created}}</td>
                                <td>{{$merchantPaymentRoute->updated}}</td>
{{--                                <td><div class="btn btn-default"  data-target="#modal-edit-payment-type" data-toggle="modal"--}}
{{--                                         data-id="{{$merchantPaymentRoute->id}}"--}}
{{--                                         data-merchant-id="{{$merchantPaymentRoute->merchant_id}}"--}}
{{--                                         onclick="editPaymentRoute(this)">--}}
{{--                                        <i class="fa fa-edit"></i> </div></td>--}}

                            </tr>
                        @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> payment type</th>
            <th> Роут</th>
            <th> Сумма min</th>
            <th> Сумма max</th>
            <th> Card system</th>
            <th> Payment type (display ony)</th>
            <th> Создан</th>
            <th> Обновлен</th>
{{--            <th> Изменить</th>--}}
        </tr>
        </tfoot>
    </table>


{{--    @include('merchants.remove-account-modal')--}}
{{--    @include('merchants.payment-type.edit-payment-type-modal')--}}

@endif
@include('merchants.payment-route.add-payment-route-modal')