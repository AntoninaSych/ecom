@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3 center-block"style="margin-top: 30%">
                <div class="error-page">
                    <h2 class="headline text-red pull-left">Code:{{$code}}</h2>

                    <div class="error-content pull-right">
                        <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
                        <p>
                            Message: {{$message}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop




