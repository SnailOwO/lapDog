<?php

namespace App\Http\Middleware;

use Closure;

class SetBearerTokenHeader
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
        // $request->headers->set('Accept', 'application/json');
        $request->headers->set('Authorization', 'Bearer ' . $request->get('token'));
        return $next($request);
    }
}
