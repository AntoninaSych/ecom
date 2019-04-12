@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Condensed Full Width Table</h3>
        </div>

        <div class="box-body">
            <table class="table">
                <th>Имя</th>
                <th>Email</th>
                <th>Текущая роль</th>
                <th>Выбрать другую роль</th>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td> {{$user->email}}</td>
                        <td><?php  echo json_decode($user->roles[0],true)['display_name']; ?>  </td>
                        <td>
                            <button class="btn-default">Изменить роль</button>
                        </td>
                    </tr>

                @endforeach
            </table>
        </div>
    </div>


@stop


