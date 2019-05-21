<div class="modal fade in" id="modal-add-account"   @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавить аккаунт к выбранному мерчанту</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::open(array('url' => route('account.store',['id'=>$merchant->id]),'method' => 'post','id'=>'payment-account-add')) !!}
                <div>
                    {{ Form::label('payment_account', "Расчетный счет" ) }}
                    {{ Form::text("payment_account",  null,['class'=>'form-control','id'=>'payment_account']) }}
                </div>

                <div>
                    {{ Form::label('edrpo_code',"Код ЕДРПО" ) }}
                    {{ Form::text("edrpo_code",  null,['class'=>'form-control']) }}
                </div>

                <div>
                    {{Form::hidden('merchant_id', $merchant->id)}}
                    {{ Form::label('mfo_code',"Код МФО" ) }}
                    {{ Form::text("mfo_code",  null,['class'=>'form-control']) }}
                </div>

                <div style="margin-top: 15px">
                    <input type="button" value="Добавить аккаунт" class="form-control btn btn-primary" onclick="addAccount()">
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