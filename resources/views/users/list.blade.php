@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Таблица пользователей и их ролей</h1>
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
    {{--    @if (\Session::has('success'))--}}
    <div class="alert alert-success" id='success-mess-user' style="display: none">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    {{--    @endif--}}

    @if (\Session::has('error'))
        <div class="alert alert-error">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif
    <div class="box">
        <div class="box-header">

            <div class="row">
                <div class="pull-right btn btn-primary" data-toggle="modal" data-target="#modal-add-user"
                     style="margin: 15px" onclick="clearErrors('#limits-add-errors')">
                    <i class="fa fa-fw fa-plus"></i> Добавить пользователя
                </div>
            </div>
        </div>
        <div id="load_user">
            @include('vendor.adminlte.register')
        </div>

        <div class="box-body">
            <table id="user_list_table" class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Текущая роль</th>
                    <th>Выбрать другую роль</th>
                    <th>Активный</th>
                </tr>
                </thead>
                <tbody id='list-of-users-with-roles'>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles_relation[0]->display_name}}</td>

                        <td>
                            <button class="btn btn-primary change-role-btn"
                                    onclick="changeRole('{{$user->id}}','{{$user->roles_relation[0]->id}}','{{$user->name}}')"
                                    data-toggle="modal" data-target="#modal-attach-role">Изменить роль
                            </button>
                        </td>
                        <td>

                            <div class="wrap">
                                <input type="checkbox" id="s{{$user->id}}"
                                       @if(intval($user->status) == 1) checked="checked" @endif />
                                <label class="slider-v2" for="s{{$user->id}}"
                                       onclick="changeUserStatus('{{$user->id}}', '<?php echo $val = (intval($user->status) == 1) ? '1' : '0' ?>')"

                                ></label>
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Текущая роль</th>
                    <th>Выбрать другую роль</th>
                    <th>Активный</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-attach-role" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Изменение роли</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4" id="user_name_apply_new_role" data-user-id-applay=""></div>
                        <div class="col-md-8">
                            <select id="change-role-select">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="apply-new-role" data-dismiss="modal">Сохранить
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        function clearErrors() {

        }

        var roles_all = {!! json_encode($roles->toArray()) !!};
        $('#register_new_user').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/register',
                type: "POST",
                data: {
                    name: $('#register-user').find("input[name='name']").val(),
                    email: $('#register-user').find("input[name='email']").val(),
                    role: $('#register-user').find("select[name='role']").val(),
                    password: 'generate',
                    password_confirmation: 'generate'
                },
                success: function (data) {
                    $('#modal-add-user').fadeOut();
                    location.reload();
                    $('#success-mess-user').fadeIn();
                    $('#success-mess-user').text(data.data.success);

                },
                error: function (data) {
                    var response = data.responseText;
                    response = JSON.parse(response);
                    jQuery.each(response.errors, function (key, value) {
                        $('#error-user-add').fadeIn();
                        $('#error-user-add').text(value);
                    });

                }
            });
        });

    </script>
@stop


