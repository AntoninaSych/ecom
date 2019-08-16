(function ($) {
    $(function () {
      setInterval(onlineMonitoring,2000);
    });
})(jQuery);


function onlineMonitoring()
{
    $.ajax({
        url: '/monitoring/getPaymentLogOnline',
        type: "GET",
        success: function (data) {
            $('#online-monitoring').html('');

            new Morris.Line({
                element: 'online-monitoring',
                data:  data,
                xkey: 'ts',
                ykeys: ['value'],
                labels: ['ms']
            });
        }
    });
}
