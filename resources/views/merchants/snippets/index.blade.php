@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1></h1>
@stop
<style>

    .wrap {
        position: relative;
        /*width: 33.33%;*/
        /*margin: -72px 0;*/
        /*top: 50%;*/
        /*float: left;*/
    }

    input[type="checkbox"] + label {
        margin: 1.5em auto;
    }

    input[type="checkbox"] {
        display: none;
        /*position: absolute;*/
        /*left: -9999px;*/
    }

    .slider-v2::after {
        position: absolute;
        content: '';
        width: 2em;
        height: 2em;
        top: 0.5em;
        left: 0.5em;
        border-radius: 50%;
        transition: 250ms ease-in-out;
        background: linear-gradient(#f5f5f5 10%, #eeeeee);
        box-shadow: 0 0.1em 0.15em -0.05em rgba(255, 255, 255, 0.9) inset, 0 0.2em 0.2em -0.12em rgba(0, 0, 0, 0.5);
    }

    .slider-v2::before {
        position: absolute;
        content: '';
        width: 4em;
        height: 1.5em;
        top: 0.75em;
        left: 0.75em;
        border-radius: 0.75em;
        transition: 250ms ease-in-out;
        background: linear-gradient(rgba(0, 0, 0, 0.07), rgba(255, 255, 255, 0.1)), #d0d0d0;
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 0 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::before {
        box-shadow: 0 0.08em 0.15em -0.1em rgba(0, 0, 0, 0.5) inset, 0 0.05em 0.08em -0.01em rgba(255, 255, 255, 0.7), 3em 0 0 0 rgba(68, 204, 102, 0.7) inset;
    }

    input:checked + .slider-v2::after {
        left: 3em;
    }


</style>
@section('content')
    <div class="content">
        <button data-target="#modal-add-snippet-name" data-toggle="modal" class="btn btn-primary"><i
                    class="fa fa-fw fa-plus"></i>Добавить
            название шаблона
        </button>
        <div class="row">

            <div class="col-xs-12" id="snippet-list">
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Название шаблона</th>

                    <th>Редактировать содержимое</th>
                    <th>Удалить</th>
                    </thead>
                    <tbody>

                    @foreach($merchantSnippetNames as $snippetName)
                        <tr>
                            <td>{{$snippetName->id}}</td>
                            <td>{{$snippetName->name}}
                                <button class="btn btn-default"
                                        data-target="#modal-edit-snippet-name"
                                        data-toggle="modal"
                                        onclick="editSnippetName(this)"
                                        data-snippet-id="{{$snippetName->id}}"
                                        data-name="{{$snippetName->name}}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </button>
                            </td>

                            <td>
                                <a href="/snippets/{{$snippetName->id}}/routes/" class="btn btn-success"> <i
                                            class="fa fa-edit"></i> </a>
                            </td>

                            <td>
                                <div class="btn btn-danger" data-target="#modal-remove-snippet" data-toggle="modal"
                                     data-id="{{$snippetName->id}}"
                                     onclick="askToRemoveSnippetName(this)">
                                    <i class="fa fa-remove"></i></div>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                    <tfoot>
                    <th>ID</th>
                    <th>Название шаблона</th>

                    <th>Редактировать содержимое</th>
                    <th>Удалить</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @if(Auth::user()->can(PermissionHelper::MANAGE_MERCHANT_ROUTE))
        @include('merchants.snippets.modal-edit-snippet-name')
        @include('merchants.snippets.modal-add-snippet-name')
        @include('merchants.snippets.modal-remove-snippet')
    @endif
@stop

<script src="{{ asset('/js/libraries/jquery.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">

<script src="{{ asset('js/snippets.js') }}"></script>
