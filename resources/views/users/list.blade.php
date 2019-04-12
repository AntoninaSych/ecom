

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
        <table>
            @foreach($users as $user)
                <tr><td>{{$user->name}}</td><td> </td></tr>

            @endforeach
        </table>
        </div>
    </div>


@stop


