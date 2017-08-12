<?php

namespace App\Http\Middleware;

use Closure;

class TeamChooser
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
        if($request->user()->teams->count() == 0){
            return redirect()->route('teams.create')->with('success','You need to be part of a team to play.');
        }
        return $next($request);
    }
}
