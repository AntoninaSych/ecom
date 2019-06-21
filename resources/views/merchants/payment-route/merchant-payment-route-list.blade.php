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
            <th> Изменить</th>
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
                <td>
                    <div class="btn btn-default" data-target="#modal-edit-payment-route" data-toggle="modal"
                         data-id="{{$merchantPaymentRoute->id}}"
                         data-merchant-id="{{$merchantPaymentRoute->merchant_id}}"
                         data-payment-type-id="{{$merchantPaymentRoute->paymentRoute->paymentType->id}}"
                         data-payment-route-id="{{$merchantPaymentRoute->paymentRoute->id}}"
                         data-sum_min="{{$merchantPaymentRoute->sum_min}}"
                         data-sum_max="{{$merchantPaymentRoute->sum_max}}"
                         data-card-system="{{$merchantPaymentRoute->cardSystem->id}}"
                         onclick="editPaymentRoute(this)">
                        <i class="fa fa-edit"></i></div>
                </td>
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
            <th> Изменить</th>
        </tr>
        </tfoot>
    </table>

    @include('merchants.payment-route.edit-payment-route-modal')
@endif
@include('merchants.payment-route.add-payment-route-modal')