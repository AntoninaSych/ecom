@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Информация о пользователе</h1>
@stop

@section('content')

    <h5>Пользователи Concord Pay</h5>

    <table class="table table-striped" id="front-users">
        <thead>
        <th>ID</th>
        <th>Пользователь</th>
        <th>Email</th>
        <th>Статус</th>
        <th>Мерчанты</th>
        <th>Utm Info</th>
        </thead>
        <tbody>

        @foreach($users as $user)

            <tr onclick="loadMerchantAlias(this,{{$user->id}})" id="id-{{$user->id}}">
                <td>    {{$user->id}}</td>
                <td>    {{$user->username}}</td>
                <td>    {{$user->email}}</td>
                <td>    {{$user->status}}</td>

                <td>
                    @foreach($user->merchants as $merchant)
                        <a href="/merchants/{{$merchant->id}}">    {{$merchant->name}}</a><br>
                    @endforeach
                </td>
                <td>
                    @if(!is_null($user->utm['utm_source']) ||
                            !is_null($user->utm['utm_medium'])||
                            !is_null($user->utm['utm_campaign'])||
                            !is_null($user->utm['utm_content'])||
                            !is_null($user->utm['utm_term'])
                            )
                        <table class="table">
                            <tr>
                                <th>utm_source</th>
                                <td>{{$user->utm['utm_source']}}</td>
                            </tr>
                            <tr>
                                <th>utm_medium</th>
                                <td>{{$user->utm['utm_medium']}}</td>
                            </tr>
                            <tr>
                                <th>utm_campaign</th>
                                <td>{{$user->utm['utm_campaign']}}</td>
                            </tr>
                            <tr>
                                <th>utm_content</th>
                                <td>{{$user->utm['utm_content']}}</td>
                            </tr>
                            <tr>
                                <th>utm_term</th>
                                <td>{{$user->utm['utm_term']}}</td>
                            </tr>
                        </table>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@stop

<script src="{{ asset('/js/libraries/jquery.js') }}"></script>

<script src="{{ asset('js/libraries/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/libraries/datatables/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/alertify/default.min.css') }}">
<link rel="stylesheet" href="{{ asset('/css/libraries/datatables/dataTables.bootstrap.min.css') }}">
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/js/libraries/jquery-validation/validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/libraries/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/config.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('/js/libraries/jquery-validation/localization/messages_ru.min.js') }}"></script>
