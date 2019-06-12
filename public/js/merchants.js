var currentRouteForEditModal = null;
var currentTypeForEditModal = null;
(function ($) {
    $(function () {

        // loadAccounts();

        // $('#mcc_id').select2();

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


        deferred.done(function (value) {
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
            $('#payment_account_update').submit(function (e) {
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
            $('#modal-remove-account-form').submit(function (e) {
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

function loadMerchantPaymentType() {
    $.ajax({
        url: '/merchants/payment-type/' + merchant_id + '/table',
        type: "GET",

        success: function (data) {
            $('#merchant-payment-types').html(data);

            // //edit account begin
            $('#payment-type-update').submit(function (e) {
                e.preventDefault();
                var el = $('#modal-edit-payment-type');
                var enabled = el.find("input[name='enabled']").val();
                var payment_type = el.find("select[name='payment_type']").val();
                var merchant_id = el.find("input[name='merchant_id']").val();
                var fee_proc = el.find("input[name='fee_proc']").val();
                var fee_fix = el.find("input[name='fee_fix']").val();
                var fee_type = el.find("select[name='fee_type']").val();
                var id = el.find("input[name='id']").val();

                $.ajax({
                    url: '/merchants/payment-type/update',
                    type: "get",
                    data: {
                        id: id,
                        enabled: enabled,
                        payment_type: payment_type,
                        merchant_id: merchant_id,
                        fee_proc: fee_proc,
                        fee_fix: fee_fix,
                        fee_type: fee_type
                    },
                    success: function () {
                        $('#type-edit-errors').html();
                        $('#type-edit-errors').hide();
                        $('#modal-edit-payment-type').hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        loadMerchantPaymentType();

                    }, error: function (data) {
                        var response = data.responseText;
                        response = JSON.parse(response);
                        $('#type-edit-errors').html(response.data);
                        $('#type-edit-errors').show();
                    }
                });
            });
            // //edit account end


        }, error: function (data) {
            var response = data.responseText;
            response = JSON.parse(response);
            console.log(response.data);
        }
    });
}

//add account begin
function addAccount() {

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


//add payment begin
function addPaymentType() {
    var el = $('#modal-add-payment-type');
    var payment_type = el.find("select[name='payment_type']").val();
    var fee_proc = el.find("input[name='fee_proc']").val();
    var fee_fix = el.find("input[name='fee_fix']").val();
    var fee_type = el.find("select[name='fee_type']").val();
    var merchant_id = el.find("input[name='merchant_id']").val();
    $.ajax({
        url: '/merchants/payment-type/store',///{merchantId}/account
        type: "post",
        data: {
            payment_type: payment_type,
            fee_proc: fee_proc,
            fee_fix: fee_fix,
            fee_type: fee_type,
            merchant_id: merchant_id
        },
        success: function () {
            $('#type-add-errors').html();
            $('#type-add-errors').hide();
            $('#modal-add-account').hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            loadMerchantPaymentType();

            el.find("input[name='payment_type']").val('');
            el.find("input[name='fee_proc']").val('')
            el.find("input[name='fee_fix']").val('');
            el.find("input[name='fee_type']").val('');
            el.find("input[name='merchant_id']").val('');

        }, error: function (data) {
            var response = data.responseText;
            response = JSON.parse(response);
            $('#type-add-errors').html(response.data);
            $('#type-add-errors').show();
        }
    });
}

//add payment end

//edit Payment Type
function editPaymentType(e) {
    var el = $('#modal-edit-payment-type');
    var merchant_id = $(e).data("merchant-id");
    var id = $(e).data("id");
    var payment_type_id = $(e).data("payment-type-id");
    var fee_proc = $(e).data("fee_proc");
    var fee_fix = $(e).data("fee_fix");
    var fee_type = $(e).data("fee_type");
    var enabled = $(e).data("enabled");
    var name = $(e).data("payment-type-name");
    var temp = Object.assign({}, refPaymentTypes);
    var refPaymentTypesAllowed = Object.assign(temp, {[payment_type_id]: name});
    el.find("select[name='payment_type']").text('');
    $.each(refPaymentTypesAllowed, function (key, value) {
        el.find("select[name='payment_type']").append($("<option />").val(key).text(value));
    });
    el.find("select[name='payment_type']").val(payment_type_id);
    el.find("input[name='merchant_id']").val(merchant_id);
    el.find("input[name='fee_proc']").val(fee_proc);
    el.find("input[name='fee_fix']").val(fee_fix);
    el.find("input[name='id']").val(id);
    el.find("select[name='fee_type']").val(fee_type);
    if (enabled === 1) {
        $('#merchant_payment_type_status').prop({
            "checked": true
        }).val(1);
    }
    if (enabled === 0) {
        $('#merchant_payment_type_status').prop({
            "checked": false
        }).val(0);

    }
    $('#type-edit-errors').html();
    $('#type-edit-errors').hide();


    $('#label-checkbox').on('click', function () {
        var status = $('#merchant_payment_type_status').val();
        status = (parseInt(status) === 1) ? 0 : 1;
        $('#merchant_payment_type_status').val(status);
    })
}

//edit Payment Type

//begin load Merchant Routes Table
function loadMerchantRoutes() {
    $.ajax({
        url: '/merchants/route/table?merchantId=' + merchant_id,
        type: "GET",

        success: function (data) {
            $('#merchant-payment-route').html(data);
        }
    });
}

//end load Merchant Routes Table


//begin create Merchant Routes

function getAllowedRotesByType(idElement) {
    console.log('loadin routes');
    var el = $(idElement);

    var payment_type = el.find("select[name='payment_type']").val();

    if (idElement === '#modal-edit-payment-route') {
        payment_type = currentTypeForEditModal;
    }
    $.ajax({
        url: '/merchants/route/getAllowedRoutes/' + payment_type,
        type: "GET",
        success: function (response) {
            select = el.find("select[name='payment_route']");
            select.text('');
            select.append('<option    disabled>Выберите роут</option>');
            $.each(response.data, function (key, value) {
                el.find("select[name='payment_route']").append($("<option />").val(key).text(value));
            });
            if (idElement === '#modal-edit-payment-route') {
                $('#modal-edit-payment-route').find("select[name='payment_route']").val(currentRouteForEditModal);
            }
        }
    });
}

function addMerchantPaymentRoute() {
    var el = $('#modal-add-payment-route');
    var payment_type = el.find("select[name='payment_type']").val();
    var payment_route = el.find("select[name='payment_route']").val();
    var card_system = el.find("select[name='card_system']").val();
    var sum_max = el.find("input[name='sum_max']").val();
    var sum_min = el.find("input[name='sum_min']").val();
    var merchant_id = el.find("input[name='merchant_id']").val();
    $.ajax({
        url: '/merchants/route/store',
        type: "post",
        data: {
            payment_type: payment_type,
            payment_route_id: payment_route,
            card_system: card_system,
            sum_max: sum_max,
            sum_min: sum_min,
            merchant_id: merchant_id
        },
        success: function () {
            $('#type-errors').html();
            $('#type-errors').hide();
            $('#modal-add-payment-route').hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            loadMerchantRoutes();
            el.find("select[name='payment_type']").val('');
            el.find("select[name='payment_route']").val('');
            el.find("select[name='card_system']").val('');
            el.find("input[name='sum_max']").val('');
            el.find("input[name='sum_min']").val('');
            el.find("input[name='merchant_id']").val('');
            $('#route-add-errors').html();
            $('#route-add-errors').hide();
        }, error: function (response) {
            var response = response.responseText;
            response = JSON.parse(response);

            $('#route-add-errors').html(response.data[0] );
            $('#route-add-errors').show();
        }
    });
}


//begin edit Merchant Routes
function editPaymentRoute(e) {
    var el = $('#modal-edit-payment-route');
    var merchant_id = $(e).data("merchant-id");
    var id = $(e).data("id");
    var payment_type_id = $(e).data("payment-type-id");
    var payment_route_id = $(e).data("payment-route-id");

    currentTypeForEditModal = payment_type_id;
    currentRouteForEditModal = payment_route_id;

    var sum_min = $(e).data("sum_min");
    var sum_max = $(e).data("sum_max");
    var card_system = $(e).data("card-system");
    getAllowedRotesByType('#modal-edit-payment-route');
    $('#route-edit-errors').html();
    $('#route-edit-errors').hide();
    el.find("select[name='payment_type']").val(payment_type_id);
    el.find("input[name='merchant_id']").val(merchant_id);
    el.find("select[name='payment_route']").val(payment_route_id);
    el.find("input[name='sum_min']").val(sum_min);
    el.find("input[name='id']").val(id);
    el.find("input[name='sum_max']").val(sum_max);
    el.find("select[name='card_system']").val(card_system);
}

//begin edit Merchant Routes
function changeMerchantPaymentRoute() {
    var el = $('#modal-edit-payment-route');
    var id = el.find("input[name='id']").val()
    var payment_type = el.find("select[name='payment_type']").val();
    var sum_min = el.find("input[name='sum_min']").val();
    var sum_max = el.find("input[name='sum_max']").val();
    var card_system = el.find("select[name='card_system']").val();
    var merchant_id = el.find("input[name='merchant_id']").val();
    var payment_route = el.find("select[name='payment_route']").val();
    $.ajax({
        url: '/merchants/route/update',
        type: "post",
        data: {
            id:id,
            payment_type: payment_type,
            payment_route_id: payment_route,
            card_system: card_system,
            sum_max: sum_max,
            sum_min: sum_min,
            merchant_id: merchant_id
        },
        success: function () {
            $('#type-errors').html();
            $('#type-errors').hide();
            $('#modal-add-payment-route').hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            loadMerchantRoutes();
            el.find("select[name='id']").val('');
            el.find("select[name='payment_type']").val('');
            el.find("select[name='payment_route']").val('');
            el.find("select[name='card_system']").val('');
            el.find("input[name='sum_max']").val('');
            el.find("input[name='sum_min']").val('');
            el.find("input[name='merchant_id']").val('');
            $('#route-edit-errors').html();
            $('#route-edit-errors').hide();
        }, error: function (response) {
          var response = response.responseText;
            response = JSON.parse(response);

            $('#route-edit-errors').html(response.data[0] );
            $('#route-edit-errors').show();
        }
    });
}

function clearErrors(id) {
    $(id).html();
    $(id).hide();
}