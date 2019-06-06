<div id="payment-type"  class="tab-pane">
    <table id="account_list" class="table table-bordered table-striped dataTable" role="grid"
           aria-describedby="example1_info">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> МФО</th>
            <th> ЕДРПА</th>
            <th> Расчетный счет</th>
            <th> Мерчант</th>
            <th> Изменен</th>
            <th> Редактировать</th>
            <th> Удалить</th>
        </tr>
        </thead>


        <tbody id="merchant-accounts-table">
{{--        @foreach($merchantPaymentTypes as $paymentType)--}}
{{--            <tr>--}}
{{--                <td>{{$account->id}}</td>--}}
{{--                <td>{{$account->mfo}}</td>--}}
{{--                <td>{{$account->ed_rpo}}</td>--}}
{{--                <td>{{$account->checking_account}}</td>--}}
{{--                <td>{{$account->merchant->name}}</td>--}}
{{--                <td>{{$account->updated_at}}</td>--}}
{{--                <td><div class="btn btn-default"  data-target="#modal-edit-account" data-toggle="modal"--}}
{{--                         data-id="{{$account->id}}"--}}
{{--                         data-mfo="{{$account->mfo}}"--}}
{{--                         data-ed-rpo="{{$account->ed_rpo}}"--}}
{{--                         data-merchant-id="{{$account->merchant->id}}"--}}
{{--                         data-checking-account="{{$account->checking_account}}"--}}
{{--                         onclick="editAccount(this)"--}}
{{--                    >--}}
{{--                        <i class="fa fa-edit"></i> </div></td>--}}
{{--                <td><div class="btn btn-danger remove-account" data-id="{{$account->id}}"--}}
{{--                         onclick="removeAccount({{$account->id}})" data-toggle="modal"--}}
{{--                         data-target="#modal-remove-account" ><i class="fa fa-remove"></i> </div></td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> МФО</th>
            <th> ЕДРПА</th>
            <th> Расчетный счет</th>
            <th> Мерчант</th>
            <th> Изменен</th>
            <th> Редактировать</th>
            <th> Удалить</th>
        </tr>
        </tfoot>
    </table>
</div>

