<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        /*if ($exception->getStatusCode()== '405')
        {
            return response()->view('errors.default',
                ['message'=>"Воспользуйтесь стандартным интерфейсом для продолжения операции",'code'=>$exception->getStatusCode()] );
        }


        if ($exception->getStatusCode()== '404')
        {
            return response()->view('errors.default',
                ['message'=>"Страница не найдена",'code'=>$exception->getStatusCode()] );
        }

        if ($exception->getStatusCode()== '500')
        {
            return response()->view('errors.default',
                ['message'=>"Произола ошибка",'code'=>$exception->getStatusCode()] );
        }

            return response()->view('errors.default',
            ['message'=>$exception->getMessage(),'code'=>$exception->getCode()] );
        */

           return parent::render($request, $exception);
    }
}
