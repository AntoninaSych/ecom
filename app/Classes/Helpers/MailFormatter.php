<?php
//
//
//namespace App\Classes\Helpers;
//
//
//
//use App\Models\MailerPostman;
//
//use App\Models\Orders;
//use Illuminate\Support\Str;
//
//class MailFormatter
//{
//
//
//    public function apply(Orders $order, $fieldValues)
//    {
//
//        $url = $this->getBykey($fieldValues, 'merchant_website');
//        $mail = new MailerPostman();
//        $mail->subject = "Ваши данные сохранены у нас";
//        $mail->body = view('email.approved')->with(
//            ['username' => $order->user->username,
//                'url' => $url]);
//        $mail->date_create = date('y-m-d h:m:i');
//        $mail->code = "BO_" . Str::random(40);
//        $mail->recipients = json_encode([
//            'from' => [
//                'pay@concord.ua',
//                'Concord Pay',
//                'mailer@somehost.com',
//                'Mailer'],
//            'to' => ['antoninasych@gmail.com']]);
//
//        $mail->save();
//
//
//    }
//
//    public function getBykey($fieldValues, string $serach_key)
//    {
//        foreach ($fieldValues as $key => $value) {
//            if ($value->field->field_key == $serach_key) {
//                return $value->field_value;
//            }
//        }
//    }
//
//}