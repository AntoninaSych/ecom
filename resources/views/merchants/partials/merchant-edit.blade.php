<div id="settings"  class="tab-pane ">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$merchant->name}}</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->

            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body col-md-6">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif

            {!! Form::open(array('url' => route('merchant.update',['id'=>$merchant->id]),'method' => 'POST','id'=>'merchant_update')) !!}
            <div>
                {{ Form::label('merchant_identifier',"Идентификатор мерчанта" ) }}
                {{ Form::text("merchant_identifier",  $merchant->merchant_id,['class'=>'form-control','id'=>'merchant_identifier']) }}
            </div>

            <div>
                {{ Form::label('merchant_name',"Имя" ) }}
                {{ Form::text("merchant_name",  $merchant->name,['class'=>'form-control']) }}
            </div>

            <div>
                {{ Form::label("merchant_url", "URL" ) }}
                {{ Form::text("merchant_url",  $merchant->url,['class'=>'form-control']) }}
            </div>

            <div>
                {{ Form::label("merchant_status","Статус"  ) }}

                {{ Form::select("merchant_status", $arrayMerchantStatuses->toArray(), $relations['status']->id ,
                ['class'=>'form-control']) }}
            </div>

            <div>
                {{ Form::label("merchant_user_name", "Имя мерчанта" ) }}
                {{ Form::text("merchant_user_name",  $relations['user']->username,['class'=>'form-control']) }}
            </div>

            <div>
                {{ Form::label("merchant_user_email", "Email мерчанта" ) }}
                {{ Form::text("merchant_user_email",  $relations['user']->email,['class'=>'form-control']) }}
            </div>
            <?php
            $new_arr = [0 => 'Пожалуйста сделайте выбор'];

            foreach ($codes as $key => $value) {
                $new_arr[$key] = $value;
            }

            ?>
            <div>
                {{ Form::label("mcc_id", "Mcc code" ) }}
                {{ Form::select("mcc_id",   $new_arr, $merchant->mcc_id , ['class'=>'form-control']) }}
            </div>

            <div>
                {{Form::submit('Обновить данные мерчанта',['class'=>'form-control btn btn-primary','id'=>'submit_btn'])}}
            </div>
            {!! Form::close() !!}

        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
</div>