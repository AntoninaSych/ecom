@if(empty($merchantPaymentTypes->isNotEmpty()))
    У мерчанта не настроены типы платежей

@else
    <table id="account_list" class="table table-bordered table-striped dataTable" role="grid"
           aria-describedby="example1_info">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> Тип платежа</th>
            <th> Процентная комиссия за платеж</th>
            <th> Фиксированная комиссия за платеж</th>
            <th> Статус</th>
            <th> Тип комиссии</th>
            <th> Создан</th>
            <th> Обновлен</th>
            <th> Изменить</th>
        </tr>
        </thead>


        <tbody id="merchant-accounts-table">
                        @foreach($merchantPaymentTypes as $merchantPaymentType)
                            <tr>
                                <td>{{$merchantPaymentType->id}}</td>
                                <td>{{$merchantPaymentType->payment->name}} ({{$merchantPaymentType->payment->code}})</td>
                                <td>{{$merchantPaymentType->fee_proc}}</td>
                                <td>{{$merchantPaymentType->fee_fix}}</td>
                                <td>@if($merchantPaymentType->enabled==1)
                                        <span class="label label-success">Активен</span>
                                    @else <span class="label label-danger">Не активен</span> @endif</td>
                                <td>{{$merchantPaymentType->feeType->name}}</td>
                                <td>{{$merchantPaymentType->created}}</td>
                                <td>{{$merchantPaymentType->updated}}</td>
                                <td><div class="btn btn-default"  data-target="#modal-edit-payment-type" data-toggle="modal"
                                         data-id="{{$merchantPaymentType->id}}"
                                         data-merchant-id="{{$merchantPaymentType->merchant_id}}"
                                         data-payment-type-id="{{$merchantPaymentType->payment->id}}"
                                         data-payment-type-name="{{$merchantPaymentType->payment->name}}"
                                         data-fee_proc="{{$merchantPaymentType->fee_proc}}"
                                         data-fee_fix="{{$merchantPaymentType->fee_fix}}"
                                         data-fee_type="{{$merchantPaymentType->feeType->id}}"
                                         data-enabled="{{$merchantPaymentType->enabled}}"
                                         onclick="editPaymentType(this)">
                                        <i class="fa fa-edit"></i> </div></td>

                            </tr>
                        @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> Тип платежа</th>
            <th> Процентная комиссия за платеж</th>
            <th> Фиксированная комиссия за платеж</th>
            <th> Статус</th>
            <th> Тип комиссии</th>
            <th> Создан</th>
            <th> Обновлен</th>
            <th> Изменить</th>
        </tr>
        </tfoot>
    </table>


{{--    @include('merchants.remove-account-modal')--}}
    @include('merchants.payment-type.edit-payment-type-modal')

@endif
@include('merchants.payment-type.add-payment-type-modal')