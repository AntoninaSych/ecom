<?php

namespace App\Http\Middleware;

use App\Classes\Helpers\PermissionHelper;
use App\Classes\Helpers\RoleHelper;
use App\Exceptions\PermissionException;
use Closure;

class CanApplyMerchantsRequest
{
    protected $redirectPath = '/login';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() == null
            ||  !auth()->user()->hasRole([RoleHelper::SECURITY,RoleHelper::BUSINESS,RoleHelper::FRAUD_MONITORING]) )

         {
             dd('12');
            throw new PermissionException('У Вас недостаточно прав для просмотра этой страницы');
        }
        return $next($request);
    }
}
