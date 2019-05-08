<div class="modal fade in" id="modal-edit-account">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменение аккаунта</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <p>Изменение аккаунта</p>


                    {!! Form::open(array('url' => route('account.update'),'method' => 'post','id'=>'payment_account_update')) !!}
                    <div>
                        {{ Form::label('payment_account', "Расчетный счет" ) }}
                        {{ Form::text("payment_account",  null,['class'=>'form-control','id'=>'payment_account']) }}
                    </div>

                    <div>
                        {{ Form::label('edrpo_code',"Код ЕДРПО" ) }}
                        {{ Form::text("edrpo_code",  null,['class'=>'form-control']) }}
                    </div>

                    <div>
                        {{ Form::label('mfo_code',"Код МФО" ) }}
                        {{ Form::text("mfo_code",  null,['class'=>'form-control']) }}
                    </div>
                     {{Form::hidden('id_account' )}}
                     {{Form::hidden('merchant_id' )}}
                    <div style="margin-top: 15px">
                        {{Form::submit('Изменить аккаунт',['class'=>'form-control btn btn-primary','id'=>'payment_account_update_submit'])}}
                    </div>
                    {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Зыкрыть</button>
                    <input type="hidden" value=""  name="accountId" id="editHiddenValueIdAccount">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>