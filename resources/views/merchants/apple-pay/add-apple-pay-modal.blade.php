<div class="modal fade in" id="modal-add-apple-pay" @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавить тип платежа к выбранному мерчанту</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">

                <div class="alert alert-danger" id="type-add-errors" style="display: none">

                </div>


                {!! Form::open(array('url' => route('apple-pay.store',['id'=>$merchantId]),'method' => 'post','id'=>'payment-type-add')) !!}


                <div>
                    {{ Form::label('merchant_identifier', "Merchant Identifier in Apple Pay System" ) }}
                    {{ Form::text("merchant_identifier",  null,['class'=>'form-control','id'=>'merchant_identifier']) }}
                </div>
                <div>
                    {{ Form::label('domain_name', "Домен" ) }}
                    {{ Form::text("domain_name",  null,['class'=>'form-control','id'=>'domain_name']) }}
                </div>

                <div>
                    {{Form::hidden('merchant_id',  $merchantId)}}

                </div>

                <div style="margin-top: 15px">
                    <input type="button" value="Добавить apple pay" class="form-control btn btn-primary"
                           onclick="addApplePay()">
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    </div>

</div>
