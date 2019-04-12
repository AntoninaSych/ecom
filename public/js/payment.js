let merchants;

$(document).ready(function () {


    //добавляем datetimepicker - ы
    delimiter = ' - ';
    var dateTimeRangeConfiguration = {
        "format": 'YYYY-MM-DD',
        "separator": " - ",
        "applyLabel": "Применить",
        "cancelLabel": "Отмена",
        "fromLabel": "От",
        "toLabel": "До",
        "customRangeLabel": "Свой",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Май",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1
    };

    $('#request_period_updated').daterangepicker({
        locale: dateTimeRangeConfiguration,
        startDate: moment().subtract(10, 'days'),
        timePicker24Hour: false,
        endDate: moment(),
        timePicker: false,
        timePickerSeconds: false
    });


    $('#request_period_created').daterangepicker({
        locale: dateTimeRangeConfiguration,
        timePicker: false,

        timePickerSeconds: false
    });
    $('#request_period_created').on('cancel.daterangepicker', function(ev, picker) {
        //do something, like clearing an input
        $('#request_period_created').val('');
    });
    $('#request_period_created').val('');

    $('#payment-search-button').on('click', function (event) {
        event.preventDefault();
        var request_object = getFormParams();
        getSearchResponse(request_object);

    });

    $("#merchant_id").select2({
        language: "ru",
        placeholder: "Пожалуйста, введите название мерчанта.",
        allowClear: true,
        data: merchants,
        ajax: {
            url: config.services.getMerchants,
            data: function (params) {
                var queryParameters = {
                    name: params.term
                }

                return queryParameters;
            },
            processResults: function (json) {
                merchants = [];
                $.each(json, function (key, value) {
                    merchants.push({'id': parseInt(value.id), 'text': value.name});
                });
                return {
                    results: merchants
                };
                ;
            },
        }
    });

});


function loadMerchants(params) {

    $.ajax({
        url: config.services.getMerchants,
        type: "GET",
        data: {
            "name": params
        },
        success: function (json) {
            merchants = [];
            $.each(json, function (key, value) {
                merchants.push({'id': parseInt(value.id), 'text': value.name});
            });
            return merchants;

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

function getFormParams() {
    var time = $('#request_period_updated').val();
    var start_date = time.split(delimiter)[0];
    var end_date = time.split(delimiter)[1];

    var time_created = $('#request_period_created').val();
    var start_date_created = time_created.split(delimiter)[0];
    var end_date_created = time_created.split(delimiter)[1];

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
        updated_from: start_date,//дата платежа
        updated_to: end_date,//дата платежа
        created_from: start_date_created,//дата платежа
        created_to: end_date_created,//дата платежа
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
        template += '<td  role="row" class="' + row + '">' + card_num + '</td>';
        template += '<td  role="row" class="' + row + '">' + data[i]['order_id'] + '</td>';
        template += '<td  role="row" class="' + row + '">' + data[i]['description'] + '</td>';
        template += '<td role="row" class="' + row + '"> <a class="btn btn-black" href="/cabinet/payments/view?id=87" title="Просмотр"><i class="fa fa-fw fa-eye"></i></a></td>';

        template += '</tr>';
    }

    $('#search-data-body').html(template);
}

