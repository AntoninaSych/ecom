var options = {
    "language": {
        "url": "/js/libraries/datatables/Russian.json"
    }
};
$(document).ready(function () {

    $('#user_list_table').DataTable({
        "order": [0, 'desc'],
        "language": {
            "url": "/js/libraries/datatables/Russian.json"
        }
    });

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
            }, error: function (data) {
                var response = data.responseText;
                response = JSON.parse(response);

            }
        });
    })
});

function changeUserStatus(id, status) {
    status = (parseInt(status) === 1) ? 0 : 1;
    return $.ajax({
        url: config.services.statusUpdate,
        type: "GET",
        data: {
            "id": id,
            "status": status
        },
        success: function (data) {
            // rebuildUsers(data.data.users);
        }, error: function (data) {
            var response = data.responseText;
            response = JSON.parse(response);
        }
    });
}

function changeRole(user_id, current_role_id, user_name) {
    var options = "";
    for (var i = 0; i < roles_all.length; i++) {
        if (parseInt(current_role_id) === parseInt(roles_all[i].id)) {
            options += "<option value = " + roles_all[i].id + " selected > " + roles_all[i].display_name + "</option>";
        } else {
            options += "<option value = " + roles_all[i].id + " > " + roles_all[i].display_name + "</option>";
        }
    }
    $('#change-role-select').html(options);
    $('#user_name_apply_new_role').html("<span><b>" + user_name + "</b><span>");
    $('#user_name_apply_new_role').data("data-user-id-applay", user_id);
}

function rebuildUsers(users) {
    var template = '';
    for (var i = 0; i < users.length; i++) {
        template += '<tr>';
        template += '<td>' + users[i].id + '</td>';
        template += '<td>' + users[i].name + '</td>';
        template += '<td>' + users[i].email + '</td>';
        template += '<td>' + users[i].roles_relation[0].display_name + '</td>';
        template += '<td>';
        template += '<button class="btn btn-primary change-role-btn"';
        template += ' onclick="changeRole(' + users[i].id + ',' + users[i].roles_relation[0].id + ',\'' + users[i].name + '\')"';
        template += 'data-id="' + users[i].id + '"';
        template += 'data-role-id="' + users[i].roles_relation[0].id + '"';
        template += 'data-name="' + users[i].name + '"';
        template += 'data-toggle="modal" data-target="#modal-attach-role">Изменить роль';
        template += '</button></td>';
        template += '<td>';
        template += '<div class="wrap"><input type="checkbox" id="s' + users[i].id + '"';
        template += (parseInt(users[i].status) === 1) ? checked = "checked" : '';
        template += ' />';
        template += '<label class="slider-v2" for="s' + users[i].id + '"';
        template += 'onclick="changeUserStatus(\'' + users[i].id + '\', \'' + parseInt(users[i].status) + '\')"></label></div>';
        template += '</td>';
        template += '</tr>';
    }
    $('#user_list_table').dataTable().fnDestroy();
    $('#list-of-users-with-roles').html(template);
    $('#user_list_table').dataTable(options);
}