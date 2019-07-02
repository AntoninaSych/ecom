@extends('adminlte::page')

{{--@section('adminlte_css')--}}
{{--    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">--}}
{{--    @yield('css')--}}
{{--@stop--}}

{{--@section('body_class', 'login-page')--}}

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Изменение пароля</p>

                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

            @if (\Session::has('error'))
                <div class="alert alert-error">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif


            <form action="{{ url(config('adminlte.password_reset_url', '/user/password/change')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password_current" class="form-control"
                           placeholder="Текущий пароль">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password_current'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_current') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >Изменение пароля</button>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

{{--@section('adminlte_js')--}}
{{--    @yield('js')--}}
{{--@stop--}}
