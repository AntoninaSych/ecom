<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/css/front-email.css">
</head>
<body class="wrapper-body">
<table class=" table-wrapper">
    <tr>
        <td><h3> Вітаємо!</h3>
            <br>
            Банк Конкорд дякує вам за вибір нашого сервісу <b>ConcordPay</b>.<br>
            <br>
            На вимогу Законодавства України в даний час банк проводить перевірку реєстраційної інформації про ваше підприємство. Для її завершення банку необхідна додаткова інформація.<br>
            <br>
            Найближчим часом з вами зв'яжеться менеджер банку, який повідомить яку інформацію про ваше підприємство необхідно надати додатково, або ви можете самостійно скористатися наступними контактами:<br>
            <b> Email</b>: ecom@concord.ua,<br>
            <b> Телефони</b> (в робочий час):<br>
            +380 66 182 92 59,<br>
            +380 67 630 19 03<br>
            <br>
         </td>
    </tr>
    <tr>
        <td class="td-bottom"><span style="vertical-align: 17px;"> Дякуємо, що обрали сервіс </span>
            <img src="{{ env('URL_CONCORDPAY') . '/images/email/concordpay.png'  }}"
                 style=" width: 166px;height:  44px; margin: 0px; padding: 0px "/>
            <span style="vertical-align: 17px;">   від</span>
            <img src="{{   env('URL_CONCORDPAY') . '/images/email/concordbank.png' }}"
                 style=" width: 189px;height:  44px; margin: 0px; padding: 0px  "/>
        </td>
    </tr>
    <tr>
        <td><img src="{{  env('URL_CONCORDPAY') . '/images/email/email-phone.jpg'  }}"
                 style=" width:780px;height: 412px;"/></td>
    </tr>
    <tr>
        <td class="concordPhone-text"><a href="https://pay.concord.ua/" class="bottom-link">pay.concord.ua</a></td>
    </tr>
</table>
</body>
</html>




