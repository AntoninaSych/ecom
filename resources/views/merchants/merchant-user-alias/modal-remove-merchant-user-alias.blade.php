<div class="modal fade in" id="modal-remove-merchant-user-alias">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменение типа доступа к мерчанту ConcordPay</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="route-edit-errors" style="display: none"></div>


                {!! Form::open(array('url' => route('merchant-user-alias.remove',['id'=>$merchantId]),'method' => 'post',
                'id'=>'merchant-alias-remove')) !!}

                <p id="alias-merchant-question"></p>
                <div>
                    {{Form::hidden('id', null)}}
                </div>



                <div style="margin-top: 15px">
                    <input type="button" value="Удалить связь пользователя и мерчанта" class="form-control btn btn-primary"
                           onclick="removeMerchantUserAlias()">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
