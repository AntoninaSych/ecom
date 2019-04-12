
$(document)
    .ajaxStart(function () {
        spinner.showSimple();
    })
    .ajaxStop(function () {
        spinner.hideSimple();
    })
    .ajaxError(function (data) {
        var status = data.statusCode;
        if (status == 401) {
            alertify.log('Текущая сессия истекла! Обновите страницу для продолжения работы!');
        }
    }).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_csrf"]').attr('content')
        }
    });

    alertify
        .okBtn("ОК")
        .cancelBtn('Отменить')
        .logPosition("bottom right")
        .maxLogItems(100)
        .parent(document.body);

    /** add active class and stay opened when selected */
    var url = window.location;

    // для отображения активной li в меню бэкенда
    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');
    $('ul.treeview-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');


});
