<div class="modal fade in" id="modal-edit-merchant-user-alias">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменение типа доступа к мерчанту ConcordPay</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="route-edit-errors" style="display: none"></div>


                {!! Form::open(array('url' => route('merchant-user-alias.update',['id'=>$merchantId]),'method' => 'post',
                'id'=>'merchant-alias-update')) !!}

                <div>
                    {{ Form::label("merchant_alias_role_id", "Тип доступа к мерчанту ConcordPay" ) }}
                    <select class="form-control" name="merchant_alias_role_id" >
                        <option value="1">Просмотр</option>
                       <option value="2">Возможность возврата средств</option>
                    </select>
                </div>
                <div>
                    {{Form::hidden('id', null)}}
                </div>
                <div>
                    {{Form::hidden('merchant_id',  $merchantId)}}
                </div>
                <div>
                    {{Form::hidden('user_id', null)}}
                </div>

                <div style="margin-top: 15px">
                    <input type="button" value="Изменить связь пользователя и мерчанта" class="form-control btn btn-primary"
                           onclick="updateMerchantUserAlias()">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
