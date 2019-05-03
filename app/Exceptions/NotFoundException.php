<?php


namespace App\Exceptions;


class NotFoundException extends BaseException
{
    public $message = "Данные не найдены!";
    public $code = 404;
    public $statusCode = 404;
}