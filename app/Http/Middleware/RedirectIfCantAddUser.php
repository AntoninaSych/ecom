<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfCantAddUser
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



        if (auth()->user()==null || !auth()->user()->can('add-user') ) {
            Session()->flash('flash_message_warning', 'Only Allowed for admins');
//      return redirect()->back();

            return  redirect('/login');
        }
        return $next($request);
    }
}
