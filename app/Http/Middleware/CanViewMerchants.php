<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionException;
use Closure;

class CanViewMerchants
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
        if (auth()->user()==null || !auth()->user()->can('merchant-view') ) {
            throw new PermissionException('У Вас недостаточно прав для просмотра этой страницы');
        }
        return $next($request);
    }
}
