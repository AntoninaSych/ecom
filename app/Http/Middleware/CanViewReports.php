<?php


namespace App\Http\Middleware;


use App\Classes\Helpers\PermissionHelper;
use App\Exceptions\PermissionException;
use Closure;

class CanViewReports {
    protected $redirectPath = '/login';

    public function handle($request, Closure $next)
    {
        if (auth()->user()==null || !auth()->user()->can(PermissionHelper::CAN_VIEW_REPORTS) ) {
            throw new PermissionException('У Вас недостаточно прав для просмотра этой страницы');

        }
        return $next($request);
    }
}
