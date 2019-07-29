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
        startDate: moment().subtract(1, 'days'),
        timePicker24Hour: false,
        endDate: moment(),
        timePicker: false,
        timePickerSeconds: false
    });



    // $('#request_period_created').daterangepicker({
    //     locale: dateTimeRangeConfiguration,
    //     timePicker: false,
    //
    //     timePickerSeconds: false
    // });
    // $('#request_period_created').on('cancel.daterangepicker', function (ev, picker) {
    //     //do something, like clearing an input
    //     $('#request_period_created').val('');
    // });
    // $('#request_period_created').val('');

    $("#merchant_id").select2({
        language: "ru",
        placeholder: "Пожалуйста, введите название мерчанта.",
        allowClear: true,
        data: merchants,
        ajax: {
            delay: 250,
            url: config.services.getMerchants,
            data: function (params) {
                var queryParameters = {
                    name: params.term
                };

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

function setDateAfterReset() {

   $("#merchant_id").empty().trigger('change')
   $('#search-form').trigger("reset");
   $('#request_period_updated').val(moment().subtract(1, 'days').format('YYYY-MM-DD') + " - " + moment().format('YYYY-MM-DD'));
}