(function ($) {
    $(function () {

    });
})(jQuery);

function addReport() {

    var el = $('#modal-add-report');
    var name = el.find("input[name='name']").val();
    var query = el.find("textarea[name='query']").val();


    $.ajax({
        url: '/reports/manage/store',
        type: "post",
        data: {
            name: name,
            query: query
        },
        success: function () {
            location.reload();
        }, error: function (response) {
            var response = response.responseText;
            response = JSON.parse(response);

            $('#route-add-errors').html(response.data);
            $('#route-add-errors').show();
        }
    });
}

function prepareRemoveReport(id) {
    $('#remove_report_id').val(id);
}

function removeReport() {
    $.ajax({
        url: '/reports/manage/remove',
        type: "post",
        data: {
            id: $('#remove_report_id').val()
        },
        success: function () {
            location.reload();
        }, error: function (response) {
            var response = response.responseText;
            response = JSON.parse(response);

            $('#route-add-errors').html(response.data);
            $('#route-add-errors').show();
        }
    });
}

function prepareUpdateReport(e) {
    var el = $('#modal-update-report');
    el.find("input[name='name']").val($(e).data("name"));
    el.find("textarea[name='query']").val($(e).data("query"));
    el.find("input[name='id']").val($(e).data("id"));
}


function updateReport() {
    var el = $('#modal-update-report');
    var name = el.find("input[name='name']").val();
    var query = el.find("textarea[name='query']").val();
    var id = el.find("input[name='id']").val();


    $.ajax({
        url: '/reports/manage/update',
        type: "post",
        data: {
            name: name,
            query: query,
            id: id
        },
        success: function () {
            location.reload();
        }, error: function (response) {
            var response = response.responseText;
            response = JSON.parse(response);

            $('#route-add-errors').html(response.data);
            $('#route-add-errors').show();
        }
    });
}

function execute(e) {

    var id = $(e).data("id");
    var query = $(e).data("query");
    let pos = -1;
    var variables = Array();
    while ((pos = query.indexOf('@', pos + 1)) != -1) {
        var str = query.slice(pos, query.length);
        variables.push(str.split("@")[1].split(" ")[0]);
    }

    params= Array();
    for(var i=0;i<variables.length;i++)
    {
         var  item  = prompt('Введите '+variables[i], null);
        params.push(item);
    }console.log(params);
    $.ajax({
        url: '/reports/manage/execute',
        type: "get",
        data: {
            id: id,
            variables:params
        },
        success: function (data) {
            var el = $('#report-preview');
            el.text('');


            html = buildTable(data, el);
            el.html(html);

        }, error: function (response) {
            console.log(response);
            var response = response.responseText;
            response = JSON.parse(response);

            $('#route-add-errors').html(response.data);
            $('#route-add-errors').show();
        }
    });
}

function buildTable(data, el) {
    var html = '';
    html += '<table class="table table-responsive table-striped">';
    html += '<thead>';
    $.each(data, function (key, value) {
        $.each(value, function (key, value) {
            html += '<td>';
            html += key;
            html += '</td>';
        });
        return false;
    });
    html += '</thead>';
    html += '<tbody>';
    $.each(data, function (key, value) {
        html += '<tr>';
        $.each(value, function (key, value) {
            html += '<td>' + value + '</td>';
        });
        html += '</tr>';
    });
    html += '</tbody>';
    html += '<table>';
    return html;
}
