<?php

namespace App\Http\Middleware;

use Closure;

class CheckTypeUser
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
        if (\Auth::user()->Type_User != 1)
            return redirect()->route('typeuserfalse');

        return $next($request);
    }
}
