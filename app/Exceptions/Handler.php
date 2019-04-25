<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Mockery\Matcher\Not;

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
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundException) {
            return response()->view('errors.default',
                ['message' => "Страница не найдена", 'code' => $exception->getStatusCode()]);
        }

        if ($exception instanceof PermissionException) {
            return response()->view('errors.custom',
                ['message' => $exception->getMessage(), 'code' =>$exception->getStatusCode()]);
        }
//
//        return response()->view('errors.default',
//            ['message' => "Произошла ошибка", 'code' => '500']);
//

      return parent::render($request, $exception);
    }
}
