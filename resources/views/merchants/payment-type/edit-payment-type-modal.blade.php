<div class="modal fade in" id="modal-edit-payment-type">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменение типа платежа</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                {!! Form::open(array('url' => route('payment-type.update',['id'=>$merchantId]),'method' => 'post','id'=>'payment-type-update')) !!}
                <div>
                    {{ Form::label("payment_type", "Тип платежа" ) }}
                    {{ Form::select("payment_type", $refPaymentTypes, null, ['class'=>'form-control']) }}
                </div>
                <div>
                    {{ Form::label('fee_proc', "Процентная комиссия за платеж" ) }}
                    {{ Form::text("fee_proc",  null,['class'=>'form-control','id'=>'payment_account']) }}
                </div>
                <div>
                    {{ Form::label('fee_fix', "Фиксированная комиссия за платеж" ) }}
                    {{ Form::text("fee_fix",  null,['class'=>'form-control','id'=>'payment_account']) }}
                </div>
                <div>
                    {{ Form::label("fee_type", "Тип комиссии" ) }}
                    {{ Form::select("fee_type", $refFeeTypes, 1, ['class'=>'form-control']) }}
                </div>

                <div>
                    {{Form::hidden('merchant_id',  $merchantId)}}
                    {{Form::hidden('id', null)}}
                </div>
                <div>
                    <div class="wrap">
                        <input type="checkbox" id="merchant_payment_type_status" name="enabled"  />
                        <label class="slider-v2" for="merchant_payment_type_status" id="label-checkbox"></label>
                    </div>
                </div>
                <div style="margin-top: 15px">
                 {{Form::submit('Изменить тип платежа',['class'=>'form-control btn btn-primary','id'=>'payment_type_update_submit'])}}

                 </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>