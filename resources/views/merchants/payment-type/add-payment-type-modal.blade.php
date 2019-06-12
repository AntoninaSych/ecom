<div class="modal fade in" id="modal-add-payment-type" @if ($errors->any())style="display: block" @endif>
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


                {!! Form::open(array('url' => route('payment-type.store',['id'=>$merchantId]),'method' => 'post','id'=>'payment-type-add')) !!}

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

                </div>

                <div style="margin-top: 15px">
                    <input type="button" value="Добавить тип платежа" class="form-control btn btn-primary"
                           onclick="addPaymentType()">
                    {{--                    {{Form::button('Добавить аккаунт',['class'=>'form-control btn btn-primary','id'=>])}}--}}
                </div>
                {!! Form::close() !!}
            </div>
            {{--            <div class="modal-footer">--}}
            {{--                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Зыкрыть</button>--}}
            {{--            </div>--}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var refPaymentTypes = {!! json_encode($refPaymentTypes) !!};
</script>