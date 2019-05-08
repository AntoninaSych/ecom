(function ($) {
    $(function () {

        // loadAccounts();



        $.validator.addMethod(
            "url",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Пожалуйста, укажите корректный url"
        );


        $('#submit_btn').on('click', function (e) {
            let form = $("#merchant_update");
            form.validate({
                rules: {
                    merchant_identifier: {
                        minlength: 3,
                        required: true,
                    },
                    merchant_name: {
                        minlength: 3,
                        required: true,
                    },
                    merchant_url: {
                        url: "^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?"
                    },
                    merchant_status: {
                        number: true
                    },
                    merchant_user_name: {
                        required: true,
                        minlength: 3
                    },
                    merchant_user_email: {
                        required: true,
                        email: true
                    }

                },
                errorClass: "has-error",
                validClass: "has-success",
                errorElement: "em",
                highlight: function (element, errorClass, validClass) {
                    $(element).parent().addClass(errorClass);
                    $(element.form).find("label[for=" + element.id + "]")
                        .addClass(errorClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parent().removeClass(errorClass);
                    $(element.form).find("label[for=" + element.id + "]")
                        .removeClass(errorClass);
                }
            });

            if (form.valid() === false) {
                e.preventDefault();
            }
        });

        var deferred = $.Deferred();



        deferred.done(function(value) {
            alert(value);
        });


    });
})(jQuery);

function removeAccount(id) {
    $("#hiddenValueIdAccount").val(id);
}

function editAccount(e) {
    var el = $('#modal-edit-account');
    el.find("input[name='mfo_code']").val($(e).data("mfo"));
    el.find("input[name='edrpo_code']").val($(e).data("ed-rpo"));
    el.find("input[name='payment_account']").val($(e).data("checking-account"));
    el.find("input[name='id_account']").val($(e).data("id"));
    el.find("input[name='merchant_id']").val($(e).data("merchant-id"));
}

function loadAccounts() {
    $.ajax({
        url: '' + merchant_id + '/account/table',
        type: "GET",

        success: function (data) {
            $('#accounts').html(data);


                //edit account begin
                $('#payment_account_update').submit( function (e) {
                    e.preventDefault();
                     var el = $('#modal-edit-account');
                    mfo_code = el.find("input[name='mfo_code']").val();
                    edrpo_code = el.find("input[name='edrpo_code']").val();
                    payment_account = el.find("input[name='payment_account']").val();
                    id_account = el.find("input[name='id_account']").val();
                    merchant = el.find("input[name='merchant_id']").val();
                    $.ajax({
                        url: '/merchants/account/update',
                        type: "get",
                        data: {
                            payment_account: payment_account,
                            edrpo_code: edrpo_code,
                            mfo_code: mfo_code,
                            id_account: id_account,
                            merchant_id: merchant
                        },
                        success: function () {
                            $('#modal-edit-account').hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            loadAccounts();
                        }, error: function (data) {
                            var response = data.responseText;
                            response = JSON.parse(response);
                            console.log(response.data);
                        }
                    });
                });
                //edit account end


                //remove account begin
                $('#modal-remove-account-form').submit( function (e) {
                    e.preventDefault();
                    var el = $('#modal-remove-account');
                    var id_account = el.find("input[name='accountId']").val();

                    $.ajax({
                        url: '/merchants/account/destroy',
                        type: "post",
                        data: {
                            id_account: id_account
                        },
                        success: function () {
                            $('#modal-edit-account').hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            loadAccounts();
                        }, error: function (data) {
                            var response = data.responseText;
                            response = JSON.parse(response);
                            console.log(response.data);
                        }
                    });
                });
                //remove account end


        }, error: function (data) {
            var response = data.responseText;
            response = JSON.parse(response);
            console.log(response.data);
        }
    });
}

//add account begin
function addAccount(){

    var el = $('#modal-add-account');
    mfo_code = el.find("input[name='mfo_code']").val();
    edrpo_code = el.find("input[name='edrpo_code']").val();
    payment_account = el.find("input[name='payment_account']").val();
    id_account = el.find("input[name='id_account']").val();
    merchant = el.find("input[name='merchant_id']").val();
    $.ajax({
        url: '/merchants/account/add',///{merchantId}/account
        type: "post",
        data: {
            payment_account: payment_account,
            edrpo_code: edrpo_code,
            mfo_code: mfo_code,
            id_account: id_account,
            merchant_id: merchant
        },
        success: function () {
            $('#modal-add-account').hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            loadAccounts();

            el.find("input[name='mfo_code']").val('');
            el.find("input[name='edrpo_code']").val('')
            el.find("input[name='payment_account']").val('');
            el.find("input[name='id_account']").val('');

        }, error: function (data) {
            var response = data.responseText;
            response = JSON.parse(response);
            console.log(response.data);
        }
    });
};
//addd account end
