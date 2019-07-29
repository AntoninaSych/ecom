$(document).ready(function () {

    $("#merchant_id").select2(
        {
        language: "ru",
        placeholder: "Пожалуйста, введите название мерчанта.",
        allowClear: true,
        ajax: {
            delay: 250,
            url: config.services.getMerchants,
            data: function (params) {console.log(params);
                var queryParameters = {
                    name: params.term
                };

                return queryParameters;
            },
            processResults: function (json) {
                merchants = [];
                $.each(json, function (key, value) {
                    merchants.push({'id': parseInt(value.id), 'text': value.name});
                });
                return {
                    results: merchants
                };
                ;
            },
        }
    }
    );

    $("#identifier").select2({
        language: "ru",
        placeholder: "Пожалуйста, введите идентификатор.",
        allowClear: true,
        ajax: {
            delay: 250,
            url: config.services.getMerchantsIdentifier,
            data: function (params) {
                console.log(params);
                var queryParameters = {
                    name: params.term
                };

                return queryParameters;
            },
            processResults: function (json) {
               identifigers = [];
                $.each(json, function (key, value) {
                    identifigers.push({'id': parseInt(value.id), 'text': value.merchant_id});
                });
                return {
                    results: identifigers
                };
            },
        }
    });


    $("#concordpay_user").select2({
        language: "ru",
        placeholder: "Пожалуйста, введите имя пользователя.",
        allowClear: true,
        ajax: {
            delay: 250,
            url: config.services.getConcordPayUserName,
            data: function (params) {
                console.log(params);
                var queryParameters = {
                    name: params.term
                };

                return queryParameters;
            },
            processResults: function (json) {
                concordpay_user = [];
                $.each(json, function (key, value) {
                    concordpay_user.push({'id': parseInt(key), 'text': value});
                });
                return {
                    results: concordpay_user
                };
            },
        }
    });


    $("#merchant_creator_user").select2({
        language: "ru",
        placeholder: "Пожалуйста, введите имя пользователя.",
        allowClear: true,
        ajax: {
            delay: 250,
            url: config.services.getConcordPayUserName,
            data: function (params) {
                console.log(params);
                var queryParameters = {
                    name: params.term
                };

                return queryParameters;
            },
            processResults: function (json) {
                merchant_creator_user = [];
                $.each(json, function (key, value) {
                    merchant_creator_user.push({'id': parseInt(key), 'text': value});
                });
                return {
                    results: merchant_creator_user
                };
            },
        }
    });


});