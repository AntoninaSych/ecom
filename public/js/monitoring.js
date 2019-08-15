(function ($) {
    $(function () {
        $.ajax({
            url: '/monitoring/getPaymentLogOnline',
            type: "GET",
            success: function (data) {


                $('#online-monitoring').html(data);

            }
        });
    });
})(jQuery);
