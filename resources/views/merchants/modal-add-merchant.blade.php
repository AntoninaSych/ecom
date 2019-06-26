<div class="modal fade in" id="modal-add-merchant">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Добавление мерчанта</h4>
            </div>
            <div class="modal-body" id="edit-content" style="text-align: center">
                <div class="alert alert-danger" id="limits-add-errors" style="display: none"></div>
                {!! Form::open(array('url' => route('merchant.create'  ),'method' => 'POST','id'=>'merchant_update', 'class'=>'form-horizontal')) !!}



                <div class="form-group">

                    {{ Form::label('merchant_name',"Имя" ,['class'=>'col-sm-2 control-label ']) }}
                    <div class="col-sm-10">
                        {{ Form::text("merchant_name", null,['class'=>'form-control','id'=>'merchant_name']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("merchant_url", "URL" ,['class'=>'col-sm-2 control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::text("merchant_url", null,['class'=>'form-control','id'=>'merchant_url']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("merchant_status","Статус" ,['class'=>'col-sm-2 control-label'] ) }}
                    <div class="col-sm-10">
                        {{ Form::select("merchant_status", $arrayMerchantStatuses->toArray(), null,
                        ['class'=>'col-sm-2  form-control','id'=>'merchant_status']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label("user_id","Пользователь" ,['class'=>'col-sm-2 control-label'] ) }}
                    <div class="col-sm-10">
                        {{ Form::select("user_id", $usersFront->toArray(),  null, ['class'=>' col-sm-2 form-control' ]) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label("terminal_id", "ID терминала" ,['class'=>'col-sm-2 control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::text("terminal_id", null,['class'=>'form-control']) }}
                    </div>
                </div>
                <?php
                $new_arr = [0 => 'Пожалуйста сделайте выбор'];

                foreach ($codes as $key => $value) {
                    $new_arr[$key] = $value;
                }

                ?>
                <div class="form-group">
                    {{ Form::label("mcc_id", "Mcc code",['class'=>'col-sm-2 control-label']) }}
                    <div class="col-sm-10">
                        {{ Form::select("mcc_id",   $new_arr, null, ['class'=>'form-control']) }}
                    </div>
                </div>

                <div>
                    {{Form::submit('Добавить мерчанта',['class'=>'form-control btn btn-primary','id'=>'submit_btn'])}}
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
