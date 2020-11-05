<?php

namespace App\Http\Middleware;

use Closure;

class PaymentCheck
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
        if (!$request->session()->has('default_address') ||
            !$request->session()->has('send_type')
        ){
            return redirect(route('site.shopping'));
        }
        return $next($request);
    }
}
