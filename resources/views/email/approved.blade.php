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
        <td><h3>Приветствуем! </h3><br>
            Банк Конкорд благодарит вас за выбор нашего сервиса ConcordPay.<br>
            <br>
            Сообщаем что ваш магазин  <b>{{ $url}}</b> успешно активирован на портале ConcordPay.<br>
            Банк Конкорд снял все ограничения и теперь вы можете осуществлять полноценную деятельность с вашим новым интернет-магазином.
            <br>      <br>
            Если вам потребуется консультация, то вы можете воспользоваться следующими контактами:<br>
            Email: ecom@concord.ua,
            <br>      <br>
            Телефоны:
            +380 66 182 92 59,
            +380 67 630 19 03 (в рабочее время)<br>
        </td>
    </tr>

        <td class="td-bottom"><span style="vertical-align: 17px;">Благодарим, что выбрали сервис</span>
            <img src="{{ env('URL_CONCORDPAY') . '/images/email/concordpay.png'  }}" style=" width: 166px;height:  44px; margin: 0px; padding: 0px "/>
            <span style="vertical-align: 17px;">   от</span>
            <img src="{{   env('URL_CONCORDPAY') . '/images/email/concordbank.png' }}" style=" width: 189px;height:  44px; margin: 0px; padding: 0px  "/>
        </td>
    </tr>
    <tr>
        <td><img src="{{  env('URL_CONCORDPAY') . '/images/email/email-phone.jpg'  }}" style=" width:780px;height: 412px;"/></td>
    </tr>
    <tr>
        <td class="concordPhone-text"><a href="https://pay.concord.ua/" class="bottom-link">pay.concord.ua</a></td>
    </tr>
</table>
</body>
</html>

{{--Уважаемый {{$user->username}},<br>--}}
{{--Банк Конкорд благодарит вас за выбор нашего сервиса ConcordPay.<br>--}}
{{--<br>--}}
{{--Сообщаем что ваш магазин {{ $url}} успешно активирован на портале ConcordPay.<br>--}}
{{--Банк Конкорд снял все ограничения и теперь вы можете осуществлять полноценную деятельность с вашим новым интернет-магазином.--}}
{{--<br>--}}
{{--Если вам потребуется консультация, то вы можете воспользоваться следующими контактами:<br>--}}
{{--Email: ecom@concord.ua,--}}
{{--<br>--}}
{{--Телефоны:--}}
{{--+380 66 182 92 59,--}}
{{--+380 67 630 19 03 (в рабочее время)<br>--}}
{{--<br>--}}
{{--<br>--}}
{{--Спасибо, что воспользовались сервисом ConcordPay от Банка Конкорд.<br>--}}
{{--</body>--}}
{{--</html>--}}



