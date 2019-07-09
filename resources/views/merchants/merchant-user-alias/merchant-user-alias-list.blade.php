
@include('merchants.merchant-user-alias.modal-add-merchant-user-alias')

@if(empty($merchantUserAlias->isNotEmpty()))
    У мерчанта не настроены типы платежей

@else
    <table id="account_list" class="table table-bordered table-striped dataTable" role="grid"
           aria-describedby="example1_info">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> Пользователь</th>
            <th> Роль</th>
            <th> Изменить</th>
            <th> Удалить</th>
        </tr>
        </thead>
        <tbody id="merchant-accounts-table">
        @foreach($merchantUserAlias as $alias)
            <tr>
                <td>{{$alias->id}}</td>
                <td>{{$alias->userAlias[0]->username }}</td>
                <td>{{($alias->role_id==2)?"Возможность возврата средств":"Просмотр"}}</td>
                <td>
                    <div class="btn btn-primary" data-target="#modal-edit-merchant-user-alias" data-toggle="modal"
                         data-id="{{$alias->id}}"
                         data-merchant-id="{{$alias->merchant_id}}"
                         data-user_id="{{$alias->user_id}}"
                         data-role_id="{{$alias->role_id}}"
                         onclick="editMerchantUserAlias(this)">
                        <i class="fa fa-edit"></i></div>
                </td>
                <td>
                    <div class="btn btn-danger" data-target="#modal-remove-merchant-user-alias" data-toggle="modal"
                         data-id="{{$alias->id}}"
                         data-username="{{$alias->userAlias[0]->username}}"
                         onclick="prepareDelete(this)">
                        <i class="fa fa-remove"></i></div>
                </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> Пользователь</th>
            <th> Роль</th>
            <th> Изменить</th>
            <th> Удалить</th>
        </tr>
        </tfoot>
    </table>


        @include('merchants.merchant-user-alias.modal-edit-merchant-user-alias')
        @include('merchants.merchant-user-alias.modal-remove-merchant-user-alias')

@endif
{{--@if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE))--}}
{{--    @include('merchants.payment-route.add-payment-route-modal')--}}
{{--@endif--}}
