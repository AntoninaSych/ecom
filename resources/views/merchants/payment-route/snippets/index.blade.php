@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1> </h1>
@stop


@section('content')
    <div class="content">
        <div class="row">
            <button data-target="#modal-add-payment-route-snippet" data-toggle="modal" class="btn btn-primary">Добавить шаблон</button>
            <div class="col-lg-3 col-xs-6">
              list of snippets
            </div>
        </div>
    </div>
    @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE))
        @include('merchants.payment-route.snippets.modal-add-payment-route-snippet')
    @endif
@stop