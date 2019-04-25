$(document).ready(function () {




    $('#user_list_table').DataTable({
        "order": [[1, "desc"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
        }
    });

    $('.change-role-btn').on('click', function (e) {
            var user_id = $(this).data("id");
            var current_role_id = $(this).data("role-id");
            var user_name = $(this).data("name");
console.log('111');
            var options = "";
            for (var i = 0; i < roles_all.length; i++) {
                if (current_role_id === roles_all[i].id) {
                    options += "<option value = " + roles_all[i].id + " selected > " + roles_all[i].display_name + "</option>";
                } else {
                    options += "<option value = " + roles_all[i].id + " > " + roles_all[i].display_name + "</option>";
                }
            }
            $('#change-role-select').html(options);
            $('#user_name_apply_new_role').html("<span><b>" + user_name + "</b><span>");
            $('#user_name_apply_new_role').data("data-user-id-applay", user_id);

        }
    );

    $('#apply-new-role').on('click', function () {

        var user_id = $('#user_name_apply_new_role').data("data-user-id-applay");
        var role_id = $('#change-role-select').val();//norm

        $.ajax({
            url: config.services.applyRole,
            type: "GET",
            data: {
                "user_id": user_id,
                "role_id": role_id
            },
            success: function (data) {
                rebuildUsers(data.data.users);
                document.location.reload(true);//костылек временно
                alertify.success('Пользователю назначена новая роль');
            }, error: function (data) {
                var response = data.responseText;
                response = JSON.parse(response);
                alertify.error(response.data);
            }
        });
    })

    function rebuildUsers(users) {

        $('#user_list_table').dataTable().fnDestroy();
        var template = '';
        for (var i = 0; i < users.length; i++) {

            template += '<tr>';
            template += '<td>' + users[i].id + '</td>';
            template += '<td>' + users[i].name + '</td>';
            template += '<td>' + users[i].email + '</td>';
            template += '<td>' + users[i].roles_relation[0].display_name + '</td>';
            template += '<td>';
            template += '<button class="btn btn-primary change-role-btn"';
            template += 'data-id="' + users[i].id + '"';
            template += 'data-role-id="' + users[i].roles_relation[0].id + '"';
            template += 'data-name="' + users[i].name + '"';
            template += 'data-toggle="modal" data-target="#modal-attach-role">Изменить роль';
            template += '</button></td>';
            template += '<td>';
            template += '<button class="btn ' ;
            template += (parseInt(users[i].status) == 0) ? 'btn-success' : 'btn-warning';
            template += ' form-control block-user"';
            template += 'data-id="' + users[i].id + '"';
            template += 'data-status= "' + users[i].status + '">';
            template += (parseInt(users[i].status) == 0) ? "Разблокироать пользователся" : "Заблокировать пользователя";

            template += '</button>';
            template += '</td>';
            template += '</tr>';
        }
        $('#list-of-users-with-roles').html(template);

        $('#user_list_table').dataTable({
            "order": [[1, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
            },
            dom: 'lBftip'
        });


    }
    $('.block-user').on('click', function () {
        var id = $(this).data("id");
        var status =  $(this).data("status");
        status  = ( status === 1) ? 0 : 1;
        $.ajax({
            url: config.services.statusUpdate,
            type: "GET",
            data: {
                "id": id,
                "status": status
            },
            success: function (data) {
                rebuildUsers(data.data.users);
                document.location.reload(true);//костылек временно
                alertify.success('Пользователю назначен новый статус');
            }, error: function (data) {
                var response = data.responseText;
                response = JSON.parse(response);
                alertify.error(response.data);
            }
        });
    });
});