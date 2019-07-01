var config = {
    services: {
        getSearchResponse: '/payments/getSearchResponse',     //получение данных платежей.
        getMerchants: '/merchants/getlistByName',     //поиск мерчантов для таблицы платежей (выдает лимитированное кол-во).
        applyRole: '/settings/applyRole', // Применение новой роли к польоователю
        statusUpdate: '/settings/statusUpdate', //изменение статуса пользователя
        processLog: '/payments/getProcessLog', //загрузка логов по платежу
        merchantAccounts: '/account/table', //загрузка аккаунтов по мерчанту
        merchantInfoQueries: '/queries', //загрузка информации по мерчанту

    },

};