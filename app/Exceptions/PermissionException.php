<?php


namespace App\Exceptions;


class PermissionException extends BaseException
{
    public $message = "У Вас недостаточно прав для просмотра этой страницы!";
    public $code = 403;

}