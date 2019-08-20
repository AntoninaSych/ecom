@if(empty($applePayList->isNotEmpty()))
    У мерчанта нет Apple Pay

@else
    <table id="apple_pay_list" class="table table-bordered table-striped dataTable" role="grid"
           aria-describedby="example1_info">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> Identifier in ApplePay system</th>
            <th> Domain Name</th>
            <th> Merchant Id</th>
            <th> Изменить</th>
            <th> Удалить</th>
        </tr>
        </thead>


        <tbody id="merchant-apple-pay-table">
        @foreach($applePayList as $applePaySetting)
             <tr>
                <td>{{$applePaySetting->id}}</td>
                <td>{{$applePaySetting->merchant_identifier}} </td>
                <td>{{$applePaySetting->domain_name}}</td>
                <td>{{$applePaySetting->merchant_id}}</td>

                <td><div class="btn btn-default"  data-target="#modal-edit-apple-pay" data-toggle="modal"
                         data-id="{{$applePaySetting->id}}"
                         data-domain-name="{{$applePaySetting->merchant_id}}"
                         data-merchant-identifier="{{$applePaySetting->merchant_identifier}}"
                         data-merchant-id="{{$applePaySetting->merchant_id}}"
                         onclick="editMerchantApplePay(this)">
                        <i class="fa fa-edit"></i> </div></td>
                 <td><div class="btn btn-danger"  data-target="#modal-remove-apple-pay" data-toggle="modal"
                          data-id="{{$applePaySetting->id}}"
                          onclick="askToRemoveApplePay({{$applePaySetting->id}})">
                         <i class="fa fa-remove"></i> </div></td>

            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> Identifier in ApplePay system</th>
            <th> Domain Name</th>
            <th> Merchant Id</th>
            <th> Изменить</th>
        </tr>
        </tfoot>
    </table>


        @include('merchants.apple-pay.remove-apple-pay-modal')
    @include('merchants.apple-pay.edit-apple-pay-modal')

@endif
@include('merchants.apple-pay.add-apple-pay-modal')