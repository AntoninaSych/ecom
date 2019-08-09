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

        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>    {{$user->id}}</td>
                <td>    {{$user->username}}</td>
                <td>    {{$user->email}}</td>
                <td>    {{$user->status}}</td>
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


{{--<script>--}}

{{--    (function ($) {--}}
{{--        $(function () {--}}
{{--            console.log('123');--}}

{{--        });--}}
{{--    })(jQuery);--}}


{{--    function loadMerchantAlias(e,id) {--}}
{{--        $.ajax({--}}
{{--            url: '/front/user/' + id,--}}
{{--            type: "GET",--}}

{{--            success: function (data) {--}}
{{--                var counter = $('#front-users tbody tr').length + 1;--}}
{{--                var newRow = $("<tr>");--}}
{{--                var cols = "";--}}
{{--                cols += '<td colspan=4>'+data+' </td>';--}}
{{--                newRow.append(cols);--}}

{{-- --}}



{{--                newRow.insertAfter( $('#'+id).closest("tr") );--}}


{{--                // var table = document.getElementById("front-users");--}}
{{--                // var row = table.insertRow($('#myTable tbody tr').length);--}}
{{--                // var cell = row.insertCell(0);--}}
{{--                // cell.colSpan = 4;--}}
{{--                // // table.insertRow(0);--}}
{{--                // cell.innerHTML = data;--}}
{{--                // appendTo('#'+id+' tr ').html( ' <tr><td colspan=4>'+data+'</td></tr>');--}}
{{--                // $('#details-' + id).html(data);--}}

{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}