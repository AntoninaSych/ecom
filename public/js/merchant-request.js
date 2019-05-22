$(document).ready(function () {
    var take_in_process_button = $('#take-in-process');
    var leave_comment_textarea = $('#leave_comment_textarea');
    var decline_btn = $('#decline_btn');
    var apply_btn = $('#apply_btn');

    if (assigned == 0) {
        lock();
    } else {
        if (assigned === current_user) {
            unlock();
        }
    }

    take_in_process_button.on('click', function () {
        $.ajax({
            url: '/queries/assign',
            type: "post",
            data: {
                order_id: order_id
            },
            success: function () {
                unlock();

            }, error: function (data) {
                lock();
                var response = data.responseText;
                response = JSON.parse(response);
                console.log(response.data);
            }
        });
    });

    $('#decline_btn , #apply_btn').on('click', function (e) {
        var send = false;
        if (e.currentTarget.dataset.content === 'decline') {
            if (!leave_comment_textarea.val() || leave_comment_textarea.val() === '') {
                leave_comment_textarea.css('border-color', 'red');
                send = false;
            } else {
                leave_comment_textarea.css('border-color', '#d2d6de');
                send = true;
            }
        }
        if (e.currentTarget.dataset.content === 'apply') {
            send = true;
        }
        if(send){
        $.ajax({
            url: '/queries/apply',
            type: "post",
            data: {
                comment: leave_comment_textarea.val(),
                order_id: order_id,
                type: e.currentTarget.dataset.content
            },
            success: function () {
                location.reload();

            }, error: function () {
                location.reload();
            }
        });
        }
    });


    function lock() {
        take_in_process_button.removeAttr('disabled');
        leave_comment_textarea.attr('disabled', 'disabled');
        decline_btn.attr('disabled', 'disabled');
        apply_btn.attr('disabled', 'disabled');
    }

    function unlock() {
        take_in_process_button.attr('disabled', 'disabled');
        leave_comment_textarea.removeAttr('disabled');
        decline_btn.removeAttr('disabled');
        apply_btn.removeAttr('disabled');
    }

});

