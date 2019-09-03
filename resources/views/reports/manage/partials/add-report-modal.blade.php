<div class="modal fade in" id="modal-add-report" @if ($errors->any())style="display: block" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавить новый отчет</h4>
            </div>
            <div class="modal-body" id="remove-content" style="text-align: center">

                <div class="alert alert-danger" id="route-errors" style="display: none">
                </div>
                <div class="alert alert-danger" id="route-add-errors" style="display: none"></div>

                {!! Form::open(array('url' => route('report.store' ,['method' => 'get']))) !!}
                 <div>
                 {{ Form::label('name ', "Название отчета" ) }}
            {{ Form::text("name",  null,['class'=>'form-control']) }}
               </div>
                <div>
                    {!! Form::label("query", "Введите SQL запрос" )   !!}
                    {!! Form::textarea('query', null, ['class'=>'form-control']) !!}
                </div>

{{--                <div>--}}
{{--                    {{ Form::label("route_type", "Роут по типу платежа" ) }}--}}
{{--                    <select class="form-control" name="payment_route">--}}
{{--                        <option disabled selected>Определите после выбора типа платежа</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    {{ Form::label('sum_min', "Сумма минимального платежа" ) }}--}}
{{--                    {{ Form::text("sum_min",  0,['class'=>'form-control']) }}--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    {{ Form::label('sum_max', "Сумма максимального платежа" ) }}--}}
{{--                    {{ Form::text("sum_max",  0,['class'=>'form-control']) }}--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    {{ Form::label("card_system", "Card System" ) }}--}}
{{--                    {{ Form::select("card_system", $cardSystem, 1, ['class'=>'form-control']) }}--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    {{Form::hidden('merchant_id',  $merchantId)}}--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    {{ Form::label('bins', "Bin" ) }}--}}
{{--                    {{ Form::text("bins",  null,['class'=>'form-control']) }}--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    {{ Form::label('priority', "Приоритет" ) }}--}}
{{--                    {{ Form::text("priority",  null,['class'=>'form-control']) }}--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <div class="col-xs-6" style=" text-align: right; margin-top: 10px;  font-weight: 700;">--}}
{{--                        Final--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-6">--}}
{{--                        <div class="wrap ">--}}
{{--                            <input type="checkbox" id="final1" name="final" value="0"/>--}}
{{--                            <label class="slider-v2" for="final1" id="label-checkbox"></label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}


                <div style="margin-top: 15px">
                    <input type="button" value="Добавить отчет" class="form-control btn btn-primary"
                           onclick="addReport()">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--<script>--}}
{{--    var refPaymentTypes = {!! json_encode($refPaymentTypes) !!};--}}
{{--</script>--}}
