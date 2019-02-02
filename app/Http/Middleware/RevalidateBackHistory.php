<?php

namespace App\Http\Middleware;

use Closure;

class RevalidateBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        return $response->header('Cache-Control','no-cache no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Fri, 01 Feb 1900 00:00:00 GMT');
    }
}
