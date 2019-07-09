<div class="modal fade in" id="modal-add-merchant-user-alias">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавление типа доступа к мерчанту ConcordPay</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="limits-add-errors" style="display: none"></div>
                {!! Form::open(array('url' => route('merchant-user-alias.store',
                ['id'=>$merchantId]),'method' => 'post',   'id'=>'merchant-alias-store')) !!}

                <div>
                    {{ Form::label("user_id", "Пользователь из ConcordPay" ) }}
                    <select class="user_id form-control" id="merchant_user_id_alias" name="user_id"
                            style="width: 100%"
                            multiple="multiple">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>


                <div>
                    {{ Form::label("role_id", "Тип доступа к мерчанту ConcordPay" ) }}
                    <select class="form-control" name="role_id">
                        <option value="1">Просмотр</option>
                        <option value="2">Редактирование</option>
                    </select>
                </div>

                <div>
                    {{Form::hidden('merchant_id',  $merchantId)}}
                </div>
                <div style="margin-top: 15px">
                    <input type="button" value="Добавить связь пользователя и мерчанта" class="form-control btn btn-primary"
                           onclick="storeMerchantUserAlias()">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    var merchant_id = {!! $merchantId  !!};
</script>
