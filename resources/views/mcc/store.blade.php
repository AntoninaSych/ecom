@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Добавление MCC кода</h1>
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавление MCC кода</h3>
                    <div class="box-body" id="mcc-codes">
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
                        {!! Form::open(array('url' => route('mcc.store'),'method' => 'post','id'=>'mcc_create')) !!}

                        <div>
                            {{ Form::label('mcc_code',"Код" ) }}
                            {{ Form::text("mcc_code",  null,['class'=>'form-control']) }}
                        </div>
                        <div>
                            {{ Form::label('mcc_name',"Навание рус." ) }}
                            {{ Form::text("mcc_name",  null,['class'=>'form-control','id'=>'mcc_name']) }}
                        </div>
                        <div>
                            {{ Form::label('mcc_name_uk',"Навание укр." ) }}
                            {{ Form::text("mcc_name_uk",  null,['class'=>'form-control','id'=>'mcc_name_uk']) }}
                        </div>
                        <div>
                            {{ Form::label('mcc_name_en',"Навание анг." ) }}
                            {{ Form::text("mcc_name_en", null,['class'=>'form-control','id'=>'mcc_name_en']) }}
                        </div>
                        <div>
                            {{ Form::label('mcc_description',"Описание" ) }}
                            {{ Form::text("mcc_description", null,['class'=>'form-control','id'=>'mcc_description']) }}
                        </div>

                        <div>
                            {{ Form::label('mcc_hight_risk',"Hight Risk" ) }}
                            {{ Form::select("mcc_hight_risk",  ['1' => 'Да', '0' => 'Нет'], null ,['class'=>'form-control']) }}
                        </div>

                        <div>
                            {{ Form::label('mcc_apple_pay',"Apple Pay status" ) }}
                            {{ Form::select("mcc_apple_pay",  ['1' => 'Активен', '0' => 'Не активен'],null ,['class'=>'form-control']) }}
                        </div>


                        <div style="margin-top: 15px">
                            {{Form::submit('Добавить код',['class'=>'form-control btn btn-primary','id'=>'submit_btn'])}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop