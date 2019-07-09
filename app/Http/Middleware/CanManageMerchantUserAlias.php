<?php

namespace App\Http\Middleware;

use App\Classes\Helpers\PermissionHelper;
use App\Exceptions\NotFoundException;
use App\Exceptions\PermissionException;
use Closure;

class CanManageMerchantUserAlias
{
    protected $redirectPath = '/login';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()==null || !auth()->user()->can(PermissionHelper::MERCHANT_USER_ALIAS) ) {
            throw new PermissionException('У Вас недостаточно прав для просмотра этой страницы');

        }
        return $next($request);
    }
}
