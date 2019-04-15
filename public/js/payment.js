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
    $('#request_period_created').on('cancel.daterangepicker', function (ev, picker) {
        //do something, like clearing an input
        $('#request_period_created').val('');
    });
    $('#request_period_created').val('');

    $('#payment-search-button').on('click', function (event) {
        event.preventDefault();
        $('#payment-table').dataTable().fnDestroy();
        buildTable();
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


// function loadMerchants(params) {
//
//     $.ajax({
//         url: config.services.getMerchants,
//         type: "GET",
//         data: {
//             "name": params
//         },
//         success: function (json) {
//             merchants = [];
//             $.each(json, function (key, value) {
//                 merchants.push({'id': parseInt(value.id), 'text': value.name});
//             });
//             return merchants;
//
//         }, error: function (data) {
//
//
//             var status = data.statusCode;
//             var response = data.responseText;
//             if (status !== 401) {
//                 try {
//                     response = JSON.parse(response);
//                     alertify.error(response.data);
//                 } catch (e) {
//                     alertify.error("Не удалось загрузить");
//                 }
//             }
//         }
//     });
// }

// function getFormParams() {
//     var time = $('#request_period_updated').val();
//     var start_date = time.split(delimiter)[0];
//     var end_date = time.split(delimiter)[1];
//
//     var time_created = $('#request_period_created').val();
//     var start_date_created = time_created.split(delimiter)[0];
//     var end_date_created = time_created.split(delimiter)[1];
//
//     var main_el = $('#search-form');
//     var request_object = {
//         id: main_el.find("input[name*='id']").val(),
//         created_date: main_el.find("input[name*='created_date']").val(),
//         payment_type: main_el.find("select[name*='payment_type']").val(),
//         payment_status: main_el.find("select[name*='payment_status']").val(),
//         number_order: main_el.find("input[name*='number_order']").val(),
//         amount: main_el.find("input[name*='amount']").val(),
//         merchant_id: main_el.find("select[name*='merchant_id']").val(),
//         card_number: main_el.find("input[name*='card_number']").val(),
//         description: main_el.find("input[name*='description']").val(),
//         updated_from: start_date,//дата платежа
//         updated_to: end_date,//дата платежа
//         created_from: start_date_created,//дата платежа
//         created_to: end_date_created,//дата платежа
//     };
//
//     return request_object;
// }

function getSearchResponse() {
    var time = $('#request_period_updated').val();
    var start_date = time.split(delimiter)[0];
    var end_date = time.split(delimiter)[1];

    var time_created = $('#request_period_created').val();
    var start_date_created = time_created.split(delimiter)[0];
    var end_date_created = time_created.split(delimiter)[1];

    var main_el = $('#search-form');

    var id = main_el.find("input[name*='id']").val();
    var created_date = main_el.find("input[name*='created_date']").val();
    var payment_type = main_el.find("select[name*='payment_type']").val();
    var payment_status = main_el.find("select[name*='payment_status']").val();
    var number_order = main_el.find("input[name*='number_order']").val();
    var amount = main_el.find("input[name*='amount']").val();
    var merchant_id = main_el.find("select[name*='merchant_id']").val();
    var card_number = main_el.find("input[name*='card_number']").val();
    var description = main_el.find("input[name*='description']").val();
    var updated_from = start_date;//дата платежа
    var updated_to = end_date;//дата платежа
    var created_from = start_date_created;//дата платежа
    var created_to = end_date_created;//дата платежа
    $.ajax({
        url: config.services.getSearchResponse,
        type: "GET",
        data: {
            "id": id,
            "created_date": created_date,
            "payment_type": payment_type,
            "payment_status": payment_status,
            "number_order": number_order,
            "amount": amount,
            "merchant_id": merchant_id,
            "card_number": card_number,
            "description": description,
            "updated_from": updated_from,
            "updated_to": updated_to,
            "created_from": created_from,
            "created_to": created_to
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
            var response = data.responseText;
            response = JSON.parse(response);
            alertify.error(response.data);
        }
    });
}

function buildTable() {

    $('#payment-table').DataTable({
        processing: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
        },
        serverSide: true,
        ajax: '{!! route('get.search.payment') !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'created', name: 'created'},
            {data: 'amount', name: 'amount',},
            {data: 'customer_fee', name: 'customer_fee'},
            {data: 'status', name: 'status'},
            {data: 'card_num', name: 'card_num'},
            {data: 'order_id', name: 'order_id'},
            {data: 'description', name: 'description'},
            {data: 'view_details', name: 'view_details',  searchable: false}
        ]
    });
}



