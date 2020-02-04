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
        <td><h3>Приветствуем!</h3><br>
Поступила новая заявка от мерчанта, просьба взять в работу:<br>
<?php $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';?>
{{$protocol.'://'.$_SERVER['HTTP_HOST'].'/queries/'.$order->id}}
<br>
Спасибо, за своевременное взаимодействие с пользователями Банка Конкорд.
</table>
</body>
</html>
