(function ($) {
    $(function () {

        $("#remove-btn").click(function (e) {
            var my_id_value = e.data('id');
            console.log(my_id_value);
            $('#routeSnippetId').val(my_id_value);
        });

        loadSnippetRoutes();
    });
})(jQuery);


function addSnippetMerchantPaymentRoute() {
    console.log('12');
    var el = $('#modal-add-payment-route-snippet');
    var payment_route = el.find("select[name='payment_route']").val();
    var card_system = el.find("select[name='card_system']").val();
    var sum_max = el.find("input[name='sum_max']").val();
    var sum_min = el.find("input[name='sum_min']").val();
    var merchant_id = el.find("input[name='merchant_id']").val();
    var bins = el.find("input[name='bins']").val();
    var priority = el.find("input[name='priority']").val();
    var final = Number($('#final1').val());

    $.ajax({
        url: '/merchants/route/snippets/store',
        type: "post",
        data: {
            payment_route_id: payment_route,
            card_system: card_system,
            sum_max: sum_max,
            sum_min: sum_min,
            bins: bins,
            priority: priority,
            final: final
        },
        success: function () {
            $('#type-errors').html();
            $('#type-errors').hide();
            el.hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            loadSnippetRoutes();
            el.find("select[name='route_type']").val('');
            el.find("select[name='card_system']").val('');
            el.find("input[name='sum_max']").val('');
            el.find("input[name='sum_min']").val('');
            el.find("input[name='priority']").val('');
            $('#route-add-errors').html();
            $('#route-add-errors').hide();
        }, error: function (response) {
            var response = response.responseText;
            response = JSON.parse(response);

            $('#route-add-errors').html(response.data);
            $('#route-add-errors').show();
        }
    });
}

function loadSnippetRoutes() {
//snippet-list
    $.ajax({
        url: '/merchants/route/snippets/table',
        type: "GET"
        ,
        success: function (data) {
            $('#snippet-list').html(data);
            $('#final1').on('click', function () {
                var final1 = $('#final1').val();
                final1 = (parseInt(final1) === 1) ? 0 : 1;
                $('#final1').val(final1);
                console.log($('#final1').val());
            });

        }
    });
}

function removeSnippetRoute() {
    $.ajax({
        url: '/merchants/route/snippets/remove',
        type: "POST",
        data: {
            id: $('#routeSnippetId').val()
        },
        success: function (data) {
            loadSnippetRoutes();
            $('#modal-remove-payment-route-snippet').hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
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

    console.log(route_id);
    var el = $('#modal-edit-payment-route-snippet');
    el.find("select[name='payment_route']").val(route_id);
    el.find("select[name='card_system']").val(card_system);
    el.find("input[name='sum_max']").val(sum_max);
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
   var payment_route =  el.find("select[name='payment_route']").val();
   var card_system = el.find("select[name='card_system']").val();
   var sum_max =  el.find("input[name='sum_max']").val();
   var sum_min =  el.find("input[name='sum_min']").val();
   var priority =  el.find("input[name='priority']").val();
   var final =   el.find("input[name='final']").val();
   var bins =  el.find("input[name='bins']").val();
   var id = el.find("input[name='id']").val();

    $.ajax({
        url: '/merchants/route/snippets/update',
        type: "POST",
        data: {
            id: id,
            payment_route_id: payment_route,
            card_system: card_system,
            sum_max: sum_max,
            sum_min: sum_min,
            bins: bins,
            priority: priority,
            final: final
        },
        success: function (data) {
            loadSnippetRoutes();
            el.hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        }
    });
}