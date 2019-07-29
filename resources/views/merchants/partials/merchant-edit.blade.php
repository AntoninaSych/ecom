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

        <div class=" col-md-6">
            <div class="box box-primary">
                <div class="box-body box-profile">
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

            {!! Form::open(array('url' => route('merchant.update',['id'=>$merchant->id]),'method' => 'POST','id'=>'merchant_update', 'class'=>'form-horizontal')) !!}


            <div class="form-group">
{{--                {{ Form::label('merchant_identifier',"Идентификатор мерчанта",['class'=>'col-sm-2 control-label'] ) }}--}}
                <div class="col-sm-10">
                    {{ Form::hidden("merchant_identifier",  $merchant->merchant_id,['class'=>'form-control','id'=>'merchant_identifier']) }}
                </div>
            </div>

              <div class="form-group">

                {{ Form::label('merchant_name',"Имя" ,['class'=>'col-sm-2 control-label ']) }}
                <div class="col-sm-10">
                {{ Form::text("merchant_name",  $merchant->name,['class'=>'form-control','id'=>'merchant_name']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label("merchant_url", "URL" ,['class'=>'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                {{ Form::text("merchant_url",  $merchant->url,['class'=>'form-control','id'=>'merchant_url']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label("merchant_status","Статус" ,['class'=>'col-sm-2 control-label'] ) }}
                <div class="col-sm-10">
                {{ Form::select("merchant_status", $arrayMerchantStatuses->toArray(), $relations['merchant_status']->id ,
                ['class'=>'form-control','id'=>'merchant_status']) }}
                </div>
            </div>

{{--            <div class="form-group">--}}
{{--                {{ Form::label("merchant_user_name", "Имя мерчанта",['class'=>'col-sm-2 control-label'] ) }}--}}
{{--                <div class="col-sm-10">--}}
{{--                {{ Form::text("merchant_user_name",  $relations['user']->username,['class'=>'form-control']) }}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                {{ Form::label("merchant_user_email", "Email мерчанта" ,['class'=>'col-sm-2 control-label']) }}--}}
{{--                <div class="col-sm-10">--}}
{{--                {{ Form::text("merchant_user_email",  $relations['user']->email,['class'=>'form-control']) }}--}}
{{--                </div>--}}
{{--            </div>--}}
            <?php
            $new_arr = [0 => 'Пожалуйста сделайте выбор'];

            foreach ($codes as $key => $value) {
                $new_arr[$key] = $value;
            }

            ?>
            <div class="form-group">
                {{ Form::label("mcc_id", "Mcc code",['class'=>'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                {{ Form::select("mcc_id",   $new_arr, $merchant->mcc_id , ['class'=>'form-control']) }}
                </div>
            </div>

            <div>
                {{Form::submit('Обновить данные мерчанта',['class'=>'form-control btn btn-primary','id'=>'submit_btn'])}}
            </div>
            {!! Form::close() !!}

        </div>
        </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
</div>