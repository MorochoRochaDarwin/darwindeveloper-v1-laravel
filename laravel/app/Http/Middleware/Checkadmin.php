<?php

namespace App\Http\Middleware;

use Closure;

class Checkadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->type!='super') {
            abort(403,'Unauthorized action.');
        }

        return $next($request);
    }


}
