(function ($) {
    $(function () {
        console.log('loaded')
    })
})(jQuery);

function loadStatistic(button, loader, wrapper, url) {
    button = $('#' + button);
    loader = $('#' + loader);
    wrapper = $('#' + wrapper);

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function () {
            wrapper.fadeOut(616);
            loader.fadeIn(613);
            button.attr('disabled', 'disabled');
        },
        success: function (data) {
            wrapper.html(data)
            loader.fadeOut(613);
            wrapper.fadeIn(613);
            button.removeAttr('disabled');


        }
    });
}

