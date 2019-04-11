<?php

namespace App\Exceptions;


use Exception;

class BaseException extends Exception
{
    protected $statusCode;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


}