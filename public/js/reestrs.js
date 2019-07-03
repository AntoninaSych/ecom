$(document).ready(function () {
    var dateTimeRangeConfiguration = {

        "format": 'D-M-YYYY',
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
    $('#date_reestr').daterangepicker({
        locale: dateTimeRangeConfiguration,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: false,

        timePickerSeconds: false
    });

    // $('#reestrs').on('submit', function (e) {
    //     e.preventDefault();
    //     // var moment_day = moment($('#daterange').val(), "D-M-YYYY");
    //     // console.log(moment_day.getDay());
    //     // console.log(moment_day.getMonth());
    //     // console.log(moment_day.year);
    //     $.ajax({
    //         url: '/reestrs/getReestr',
    //         type: "GET",
    //         data: {
    //             'type_reestr': $('#type_reestr').val(),
    //             'day': '1',
    //             'month':'7',
    //             'year':'2019'
    //         },
    //         success: function (data) {
    //             // $('#reestr_search').html(data);
    //
    //         }, error: function (data) {
    //             var response = data.responseText;
    //             response = JSON.parse(response);
    //             console.log(response.data);
    //         }
    //     });
    // });
});
