$(document).ready(function () {
    $("#document_num").mask('000000000000000000000000000');

    $('#phonenum, #phonenum_j, #tel_reserve, .format_phonenum,#sc_filter_clientPhon').mask('+00 (000) 000-00-00');
    $("#cardnum, #cardnum_j").mask('0000 0000 0000 0000 000');
    $("#ekb_id, #ekb_id_j, #sc_filter_clientId, #sc_filter_id").mask('0000000000');
    $("#inn, #inn_j, #sc_filter_clientInn").mask('000000000000');
    $("#acc_info_j").mask('00000000000000');
    $("#DB").mask('0000-00-00');


    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            var re = new RegExp(regexp);
            //console.log(value + " " + re.test(value));
            return this.optional(element) || re.test(value);
        },
        locale_text48
    );

    $.validator.messages.required = locale_text48;

    $("#findClientReserveForm").validate({
        rules: {
            clientReserveSurname: {
                required: true
            },
            clientReserveName: {
                required: true
            },
            clientReserveTel: {
                required: true,
                maxlength: 19,
                minlength: 19
            }
        },
        messages: {
            clientReserveSurname: {
                required: locale_text49
            },
            clientReserveName: {
                required: locale_text49
            },
            clientReserveTel: {
                required: locale_text49,
                maxlength: locale_text50,
                minlength: locale_text50
            }
        }
    });
    $("#LFMNameDB").validate({
        rules: {
            LName: {
                required: true,
                maxlength: 20
            },
            FName: {
                required: true,
                maxlength: 20
            }
        },
        errorPlacement: function () {
            return false;
        }
    });
    $("#DSerNum").validate({
        rules: {
            DSer: "required",
            DNum: "required"
        },
        errorPlacement: function () {
            return false;
        }
    });

    $("#OKPO").validate({
        rules: {
            OKPO: {
                required: true,
                maxlength: 12,
                digits: true
            }
        },
        errorPlacement: function () {
            return false;
        }
    });

    $("#OKPO_j").validate({
        rules: {
            OKPO: {
                required: true,
                maxlength: 12,
                digits: true
            }
        },
        errorPlacement: function () {
            return false;
        }
    });
    $("#CliEkbId").validate({
        rules: {
            ekb_id: {
                required: true,
                maxlength: 10,
                digits: true
            }
        },
        errorPlacement: function () {
            return false;
        }
    });
    $("#CliEkbId_j").validate({
        rules: {
            ekb_id: {
                required: true,
                maxlength: 10,
                digits: true
            }
        },
        errorPlacement: function () {
            return false;
        }
    });
    $("#AccInfo_j").validate({
        rules: {
            AccInfo: {
                required: true,
                maxlength: 14,
                digits: true
            }
        },
        errorPlacement: function () {
            return false;
        }
    });
    $("#AllPhone").validate({
        rules: {
            AllPhone: {
                required: true,
                maxlength: 19,
                minlength: 19
            }
        },
        errorPlacement: function () {
            return false;
        }
    });

    $("#AllPhone_j").validate({
        rules: {
            AllPhone: {
                required: true,
                maxlength: 19,
                minlength: 19
            }
        },
        errorPlacement: function () {
            return false;
        }
    });

    $("#Pan").validate({
        rules: {
            Pan: {
                required: true,
                regex: "(^\\d{4}\\s{1}\\d{4}\\s{1}\\d{4}\\s{1}\\d{4}$)|(^\\d{4}\\s{1}\\d{4}\\s{1}\\d{4}\\s{1}\\d{4}\\s{1}\\d{3}$)"
            }
        },
        errorPlacement: function () {
            return false;
        }
    });

    $("#Pan_j").validate({
        rules: {
            Pan: {
                required: true,
                minlength: 19 // 16 digits + 3 space delimiters
            }
        },
        errorPlacement: function () {
            return false;
        }
    });

    $('#Pan input, ' +
        '#AllPhone input,' +
        '#CliEkbId input, ' +
        '#OKPO input,' +
        '#DSerNum input,' +
        '#LFMNameDB input,' +
        '#Pan_j input,' +
        '#AllPhone_j input,' +
        '#CliEkbId_j input,' +
        '#OKPO_j input,' +
        '#AccInfo_j input,' +
        '#LFMNameDB_j input').on('keypress', function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode === 13) {
            e.preventDefault();
            $(this).closest('form').find('.findBtn').click()
            return false;
        }
    });
});



