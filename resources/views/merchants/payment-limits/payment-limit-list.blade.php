
@if(empty($limits->isNotEmpty()))
    У мерчанта не настроены лимиты

@else
    <table id="account_list" class="table table-bordered table-striped dataTable" role="grid"
           aria-describedby="example1_info">
        <thead>
        <tr role="row">
            <th> ID</th>
            <th> Card System</th>
            <th> Limit Type</th>
            <th> Amount</th>
            <th> Создан</th>
            <th> Обновлен</th>
            <th> Изменить</th>
        </tr>
        </thead>


        <tbody id="merchant-accounts-table">
        @foreach($limits as $limit)
            <tr>
                <td>{{$limit->id}}</td>
                <td>{{$limit->cardSystem->name}}</td>
                <td>{{$limit->limitTypes->name}}</td>
                <td>{{$limit->amount}}</td>
                <td>{{$limit->created_at}}</td>
                <td>{{$limit->updated_at}}</td>
                <td>
                    <div class="btn btn-default" data-target="#modal-edit-payment-limit" data-toggle="modal"
                         data-id="{{$limit->id}}"
                         data-merchant-id="{{$limit->merchant_id}}"
                         data-payment-amount="{{$limit->amount}}"
                         data-limit-type="{{$limit->limitTypes->id}}"
                         data-card-system="{{$limit->cardSystem->id}}"
                         onclick="editPaymentLimit(this)">
                        <i class="fa fa-edit"></i></div>
                </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr role="row">
            <th> ID</th>
            <th> Card System</th>
            <th> Limit Type</th>
            <th> Amount</th>
            <th> Создан</th>
            <th> Обновлен</th>
            <th> Изменить</th>
        </tr>
        </tfoot>
    </table>

    @include('merchants.payment-limits.edit-payment-limit-modal')
@endif
@include('merchants.payment-limits.add-payment-limit-modal')
