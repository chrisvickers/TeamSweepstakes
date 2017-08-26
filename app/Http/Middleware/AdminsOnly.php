<?php

namespace App\Http\Middleware;

use Closure;

class AdminsOnly
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
        if($request->user() == null){
            return redirect('login');
        }


        if($request->user()->hasRole('admin')){
            return $next($request);
        }

        abort(404);
    }
}
