<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;


class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //log request
        Log::info(REQUEST_ID . " -------------------------------------------------------------------------------");
        Log::info(REQUEST_ID . ' url: ' . URL::full());
        Log::info(' User ID/name: ' . auth()->user()->getAuthIdentifier() . '/' . auth()->user()->name);
        Log::info(REQUEST_ID . " request: \n" . json_encode($request->all(),
                JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        $response = $next($request);

        return $response;
    }
}