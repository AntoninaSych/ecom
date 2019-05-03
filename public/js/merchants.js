(function ($) {
    $(function () {
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
    });
})(jQuery);
