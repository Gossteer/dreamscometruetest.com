<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        if (\App\Customer::where('users_id',(\Auth::user()->id))->first() === null)
            return redirect()->route('typeuserfalse');

        return $next($request);
    }
}
