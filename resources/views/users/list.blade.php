@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Таблица пользователей и их ролей</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
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
                    <th>Заблокировать пользователя</th>
                </tr>
                </thead>
                <tbody id = 'list-of-users-with-roles'>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td> {{$user->email}}</td>
                        <td>{{$user->roles_relation[0]->display_name}}</td>

                        <td>
                            <button class="btn btn-primary change-role-btn"
                                    onclick="changeRole('{{$user->id}}','{{$user->roles_relation[0]->id}}','{{$user->name}}')"
{{--                                    data-id="{{$user->id}}"--}}
{{--                                    data-role-id={{$user->roles_relation[0]->id}}--}}
{{--                                    data-name="{{$user->name}}"--}}
                                    data-toggle="modal" data-target="#modal-attach-role">Изменить роль
                            </button>
                        </td>
                        <td>
                            <button class="btn @if(intval($user->status) == 0) btn-success @else btn-warning @endif form-control block-user"
                                    data-id={{$user->id}}
                                     data-status={{intval($user->status)}}>
                               <?php echo ($user->status == 0) ? "Разблокироать пользователся" : "Заблокировать пользователя";?>

                            </button>
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
                    <th>Заблокировать пользователя</th>
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
                        <div class="col-md-4" id = "user_name_apply_new_role" data-user-id-applay=""></div>
                        <div class="col-md-8">
                            <select id="change-role-select">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="apply-new-role" data-dismiss="modal">Сохранить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        var roles_all = {!! json_encode($roles->toArray()) !!};
    </script>
@stop


