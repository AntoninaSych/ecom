<div class="modal fade in" id="modal-add-payment-limit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавление лимитов платежей</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="limits-add-errors" style="display: none"></div>
                {!! Form::open(array('url' => route('payment-route.store',['id'=>$merchantId]),'method' => 'post','id'=>'payment-limit-store')) !!}


                <div>
                    {{ Form::label('amount', "Лимит" ) }}
                    {{ Form::text("amount",  0,['class'=>'form-control']) }}
                </div>
                <div>
                    {{ Form::label("card_system", "Card System" ) }}
                    {{ Form::select("card_system", $cardSystem, 1, ['class'=>'form-control']) }}
                </div>
                <div>
                    {{ Form::label("limit_type", "Тип лимита" ) }}
                    {{ Form::select("limit_type", $allowedLimitType, 1, ['class'=>'form-control']) }}
                </div>
                <div>
                    {{Form::hidden('id', null)}}
                </div>
                <div>
                    {{Form::hidden('merchant_id',  $merchantId)}}
                </div>
                <div>
                    {{Form::hidden('merchant_route_id',  null)}}
                </div>
                <div style="margin-top: 15px">
                    <input type="button" value="Добавить лимит" class="form-control btn btn-primary"
                           onclick="addMerchantPaymentLimit()">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
