<div class="modal fade in" id="modal-edit-payment-route">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Изменение роута платежа</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="route-edit-errors" style="display: none"></div>


                {!! Form::open(array('url' => route('payment-route.update',['id'=>$merchantId]),'method' => 'post','id'=>'payment-type-update')) !!}
                <div>
                    {{ Form::label("payment_type", "Тип платежа" ) }}
                    <select class="form-control" name="payment_type" onchange="getAllowedRotesByType( '#modal-edit-payment-route')">
                        <option disabled selected>Выберите тип платежа</option>
                        @foreach ($merchantPaymentTypes as $paymentType)
                            <option value="{{$paymentType['key']}}">{{$paymentType['value']}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    {{ Form::label("payment_route", "Роут по типу платежа" ) }}
                    <select class="form-control" name="payment_route">
                        <option disabled selected>Определите после выбора типа платежа</option>
                    </select>
                </div>

                <div>
                    {{ Form::label('sum_min', "Сумма минимального платежа" ) }}
                    {{ Form::text("sum_min",  0,['class'=>'form-control']) }}
                </div>
                <div>
                    {{ Form::label('sum_max', "Сумма максимального платежа" ) }}
                    {{ Form::text("sum_max",  0,['class'=>'form-control']) }}
                </div>
                <div>
                    {{ Form::label("card_system", "Card System" ) }}
                    {{ Form::select("card_system", $cardSystem, 1, ['class'=>'form-control']) }}
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
                <div>
                    {{ Form::label('bins', "Bin" ) }}
                    {{ Form::text("bins",  null,['class'=>'form-control']) }}
                </div>

                <div>
                    {{ Form::label('priority', "Приоритет" ) }}
                    {{ Form::text("priority",  null,['class'=>'form-control']) }}
                </div>

                <div>
                    <div class="col-xs-6" style=" text-align: right; margin-top: 10px;  font-weight: 700;">
                        Final
                    </div>
                    <div class="col-xs-6">
                        <div class="wrap ">
                            <input type="checkbox" id="final" name="final"/>
                            <label class="slider-v2" for="final" id="label-checkbox"></label>
                        </div>
                    </div>

                </div>

                <div style="margin-top: 15px">
                    <input type="button" value="Изменить роут платежа" class="form-control btn btn-primary"
                           onclick="changeMerchantPaymentRoute()">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
