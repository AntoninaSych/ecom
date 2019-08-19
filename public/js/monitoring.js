var interval = 0;
(function ($) {
    $(function () {
        techMonitoring();
    });
})(jQuery);


function onlineMonitoring()
{
    interval =  setTimeout(onlineMonitoring,2000);
    $.ajax({
        url: '/monitoring/getPaymentLogOnline',
        type: "GET",
        success: function (data) {
            $('#online-chart').html('');

            new Morris.Line({
                element: 'online-chart',
                data:  data,
                xkey: 'ts',
                ykeys: ['value'],
                labels: ['ms']
            });
        }
    });
}

function techMonitoring()
{
    clearTimeout(interval);


    initialTechTab();

    makeTechChart();
}

function makeTechChart()
{
    $.ajax({
        url: '/monitoring/getTechData',
        type: "GET",
        data:{
            payment_type: $('#payment-type').val(),
            date_from: $('#period').val().split(delimiter)[0],//дата платежа
            date_to: $('#period').val().split(delimiter)[1],//дата платежа
        },
        success: function (data) {
            $('#technical-chart').html('');
            new Morris.Line({
                element: 'technical-chart',
                data:  data,
                xkey: 'created',
                ykeys: ['count'],
                labels: ['количество']
            });
        }
    });
}

function initialTechTab() {

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
    $('#period').daterangepicker({
        locale: dateTimeRangeConfiguration,
        startDate: moment().subtract(1, 'days'),
        timePicker24Hour: false,
        endDate: moment(),
        timePicker: false,
        timePickerSeconds: false
    });

    $("#payment-type").select2({
        language: "ru",
        class:"form-control",
        placeholder: "Выбирите тип платежа",

    });
    $('#payment-type').select2({dropdownAutoWidth: 'true'});
}


function archiveMonitoring() {

}
