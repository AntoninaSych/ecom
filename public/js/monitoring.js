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

    $.ajax({
        url: '/monitoring/getArchiveData',
        type: "GET",
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


function archiveMonitoring() {

}
