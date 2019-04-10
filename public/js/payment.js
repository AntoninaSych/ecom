$(document).ready(function () {
    //добавляем datetimepicker
    // dateTimeRangeConfiguration.format = 'YYYY-MM-DD';
    // $('#request_period').daterangepicker({
    //     locale: dateTimeRangeConfiguration,
    //     startDate: moment().subtract(10, 'days'),
    //     timePicker24Hour: false,
    //     endDate: moment(),
    //     timePicker: false,
    //     timePickerSeconds: false
    // });
    $('#request_period').daterangepicker();
    // $('input[name="dates"]').daterangepicker();

    $('#payment-search-button').on('click', function (event) {
        event.preventDefault();
        var request_object = getFormParams();
        getSearchResponse(request_object);

    });

});

function getFormParams() {
    var time = $('#request_period').val();
    // var start_date = time.split(delimiter)[0];
    // var end_date = time.split(delimiter)[1];

    var main_el = $('#search-form');
    var request_object = {
        id: main_el.find("input[name*='id']").val(),
        created_date: main_el.find("input[name*='created_date']").val(),
        payment_type: main_el.find("select[name*='payment_type']").val(),
        payment_status: main_el.find("select[name*='payment_status']").val(),
        number_order: main_el.find("input[name*='number_order']").val(),
        amount: main_el.find("input[name*='amount']").val(),
        merchant_id: main_el.find("select[name*='merchant_id']").val(),
        card_number: main_el.find("input[name*='card_number']").val(),
        description: main_el.find("input[name*='description']").val(),
        created_from: main_el.find("input[name*='created_from']").val(),
        created_to: main_el.find("input[name*='created_to']").val()
    };

    return request_object;
}

function getSearchResponse(request_object) {
    $.ajax({
        url: config.services.getSearchResponse,
        type: "GET",
        data: {
            "request_object": request_object
            // "beginDate": moment(start_date).format('YYYY-MM-DD'),
            // "endDate": moment(end_date).format('YYYY-MM-DD'),

        },
        success: function (data) {

            $('#app_list').show();

            $('#app_list').dataTable().fnDestroy();

            buildTable(data);

            $('#app_list').dataTable({
                "order": [[1, "desc"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
                },
                dom: 'lBftip',
                buttons: [
                    {extend: 'copyHtml5', text: 'Скопировать'},
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
             alertify.success('Данные по вашему запросу загружены!');
        }, error: function (data) {

            var status = data.statusCode;
            var response = data.responseText;
            if (status !== 401) {
                try {
                    response = JSON.parse(response);
                    alertify.error(response.data);
                } catch (e) {
                    alertify.error("Не удалось загрузить");
                }
            }
        }
    });
}

function buildTable(data) {

    console.log(data);
    var template = '';
    $('#search-data-body').empty();

    for (var i = 0; i < data.length; i++) {
        var card_num = data[i]['card_num'] !== null ? data[i]['card_num'] : ''; //data[i]['card_num'];
        var row = (i % 2 == 0) ? "odd" : "even";
        template += '<tr role="row" class="' + row + '" data-id="' + data[i]['id'] + '">';
            template += '<td>' + data[i]['id'] + '</td>';
            template += '<td  role="row" class="' + row + '">' + data[i]['created'] + '</td>';
            template += '<td  role="row" class="' + row + '">' + data[i]['amount'] + '</td>';
            template += '<td  role="row" class="' + row + '">' + data[i]['customer_fee'] + '</td>';
            template += '<td  role="row" class="' + row + '">' + data[i]['status'] + '</td>';
            template += '<td  role="row" class="' + row + '">' + card_num   + '</td>';
            template += '<td  role="row" class="' + row + '">' + data[i]['order_id'] + '</td>';
            template += '<td  role="row" class="' + row + '">' + data[i]['description'] + '</td>';
        template += '<td role="row" class="' + row + '"> <a class="btn btn-black" href="/cabinet/payments/view?id=87" title="Просмотр"><i class="fa fa-fw fa-eye"></i></a></td>';

        template += '</tr>';
    }

    $('#search-data-body').html(template);
}