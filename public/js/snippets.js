(function ($) {
    $(function () {

        $("#remove-btn").click(function (e) {
            var my_id_value = e.data('id');
            console.log(my_id_value);
            $('#routeSnippetId').val(my_id_value);
        });

        // loadSnippetRoutes();
        $('#final1').on('click', function () {
            var final1 = $('#final1').val();
            final1 = (parseInt(final1) === 1) ? 0 : 1;
            $('#final1').val(final1);
            console.log($('#final1').val());
        });
    });
})(jQuery);


function addSnippetMerchantPaymentRoute() {

    var el = $('#modal-add-payment-route-snippet');
    // var snippet_id = el.find("select[name='snippet_id']").val();
    var payment_route = el.find("select[name='payment_route']").val();
    var card_system = el.find("select[name='card_system']").val();
    var sum_max = el.find("input[name='sum_max']").val();
    var sum_min = el.find("input[name='sum_min']").val();
    var bins = el.find("input[name='bins']").val();
    var priority = el.find("input[name='priority']").val();
    var final = Number($('#final1').val());

    $.ajax({
        url: '/snippets/' + snippet_id + '/routes/store',
        type: "post",
        data: {
            payment_route_id: payment_route,
            card_system: card_system,
            sum_max: sum_max,
            sum_min: sum_min,
            bins: bins,
            priority: priority,
            final: final,
            snippet_id: snippet_id
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

function loadSnippetRoutes() {
    $.ajax({
        url: '/merchants/route/snippets/table',
        type: "GET"
        ,
        success: function (data) {
            $('#snippet-list').html(data);


            $('#final').on('click', function () {
                var final = $('#final').val();
                final = (parseInt(final) === 1) ? 0 : 1;
                $('#final').val(final);
                console.log($('#final').val());
            });

        }
    });
}

function removeSnippetRoute() {
    $.ajax({
        url: '/snippets/routes/remove',
        type: "POST",
        data: {
            id: $('#routeSnippetId').val()

        },
        success: function (data) {
            location.reload();
        }
    });
}

function askRemove(id) {
    $('#routeSnippetId').val(id);
}

function editSnippetRoute(e) {
    var id = $(e).data("id");
    var route_id = $(e).data("route-id");
    var sum_min = $(e).data("sum-min");
    var sum_max = $(e).data("sum-max");
    var card_system = $(e).data("card-system");
    var priority = $(e).data("priority");
    var final = $(e).data("final");
    var bins = $(e).data("bins");
    var snippet_id = $(e).data("snippet-id");

    var el = $('#modal-edit-payment-route-snippet');
    el.find("select[name='payment_route']").val(route_id);
    el.find("select[name='card_system']").val(card_system);
    el.find("input[name='sum_max']").val(sum_max);
    el.find("input[name='snippet_id']").val(snippet_id);
    el.find("input[name='sum_min']").val(sum_min);
    el.find("input[name='priority']").val(priority);
    el.find("input[name='final']").val(final);
    el.find("input[name='bins']").val(bins);
    el.find("input[name='id']").val(id);

    $('#final').on('click', function () {
        var final = $('#final').val();
        final = (parseInt(final) === 1) ? 0 : 1;
        $('#final').val(final);
        console.log($('#final').val());
    });

    if (final === 1) {
        $('#final').prop({
            "checked": true
        }).val(1);
    }
    if (final === 0) {
        $('#final').prop({
            "checked": false
        }).val(0);
    }
}

function updateSnippetRoute() {
    var el = $('#modal-edit-payment-route-snippet');
    var payment_route = el.find("select[name='payment_route']").val();
    var card_system = el.find("select[name='card_system']").val();
    var sum_max = el.find("input[name='sum_max']").val();
    var sum_min = el.find("input[name='sum_min']").val();
    var priority = el.find("input[name='priority']").val();
    var final = el.find("input[name='final']").val();
    var bins = el.find("input[name='bins']").val();
    var id = el.find("input[name='id']").val();
    var snippet_id = el.find("input[name='snippet_id']").val();

    $.ajax({
        url: '/snippets/' + snippet_id + '/routes/update',
        type: "POST",
        data: {
            id: id,
            payment_route_id: payment_route,
            card_system: card_system,
            sum_max: sum_max,
            sum_min: sum_min,
            bins: bins,
            priority: priority,
            final: final,
            snippet_id: snippet_id
        },
        success: function (data) {
            location.reload();
        }
    });
}

function editSnippetName(e) {
    var el = $('#modal-edit-snippet-name');
    var snippet_id = $(e).data("snippet-id");
    var name = $(e).data("name");
    el.find("input[name='snippet_id']").val(snippet_id);
    el.find("input[name='name']").val(name);
}

function updateSnippetName() {
    var el = $('#modal-edit-snippet-name');
    var snippet_id = el.find("input[name='snippet_id']").val();
    var name = el.find("input[name='name']").val();
    $.ajax({
        url: '/snippets/update',
        type: "POST",
        data: {
            snippet_id: snippet_id,
            name: name
        },
        success: function (data) {
            location.reload();
        }
    });
}

function addSnippetName() {
    var el = $('#modal-add-snippet-name');
    var name = el.find("input[name='name']").val();
    $.ajax({
        url: '/snippets/store',
        type: "POST",
        data: {
            name: name
        },
        success: function (data) {
            location.reload();
        }
    });
}

function askToRemoveSnippetName(e) {
    var id = $(e).data("id");
    var el = $('#modal-remove-snippet');
    el.find("input[name='snippet_id']").val(id);
}

function removeSnippetName() {
    var el = $('#modal-remove-snippet');
    var id = el.find("input[name='snippet_id']").val();
    $.ajax({
        url: '/snippets/remove',
        type: "POST",
        data: {
            id: id
        },
        success: function (data) {
            location.reload();
        }
    });
}