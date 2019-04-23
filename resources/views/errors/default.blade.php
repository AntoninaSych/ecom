{{--@extends('adminlte::page')--}}

{{--@section('title', 'AdminLTE')--}}

{{--@section('content_header')--}}
{{--    <h1>This is Error Page</h1>--}}
{{--@stop--}}

@section('content')


    <div class="error-page">
        <h2 class="headline text-red pull-left">Code:{{$code}}</h2>

        <div class="error-content pull-right">
            <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
            <p>
                Message: {{$message}}
            </p>
        </div>
    </div>
@stop