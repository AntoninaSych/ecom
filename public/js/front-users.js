let merchants;

$(document).ready(function () {

    //добавляем datetimepicker - ы
    delimiter = ' - ';
    var dateTimeRangeConfiguration = {
        "format": 'DD-MM-YYYY',
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



});
