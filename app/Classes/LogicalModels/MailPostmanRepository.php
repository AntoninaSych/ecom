<?php


namespace App\Classes\LogicalModels;

use App\Models\MailerPostman;


use App\Models\Merchants;
use App\Models\Orders;
use Illuminate\Support\Str;



class MailPostmanRepository
{
    public function apply(Orders $order, Merchants $merchant)
    {
        $mail = new MailerPostman();
        $mail->subject = "Ваш магазин активирован.";
        $mail->body = view('email.approved')->with(
            ['user' => $order->user,
                'url' => $merchant->url]);
        $mail->date_create = date('y-m-d h:m:i');
        $mail->code = "BO_" . Str::random(40);
        $mail->recipients = json_encode([
            'from' => [
                'pay@concord.ua',
                'Concord Pay'],
            'to' => [$order->user->email]]);

        $mail->save();


    }

    public function decline(Orders $order, Merchants $merchant)
    {

        $mail = new MailerPostman();
        $mail->subject = "Нам нужна дополнительная информация по Вашему магазину.";
        $mail->body = view('email.decline')->with(
            [   'user' => $order->user,
                'url' => $merchant->url]);
        $mail->date_create = date('y-m-d h:m:i');
        $mail->code = "BO_" . Str::random(40);
        $mail->recipients = json_encode([
            'from' => [
                'pay@concord.ua',
                'Concord Pay'],
            'to' => [$order->user->email]]);

        $mail->save();


    }

public static function newLetter($merchantName,$path, $merchantEmail)
{
    $mail = new MailerPostman();
    $mail->subject = "Данные из реестра.";
    $mail->body = view('email.mailing')->with(
        ['merchantName' => $merchantName
           ]);
    $mail->date_create = date('y-m-d h:m:i');
    $mail->code = "Mailing_reestr_" . Str::random(40);
    $mail->attachments = $path;
    $mail->recipients = json_encode([
        'from' => [
            'concord@concord.ua',
            'Concord Bank'],
        'to' => [$merchantEmail]]);

    $mail->save();
}
}
