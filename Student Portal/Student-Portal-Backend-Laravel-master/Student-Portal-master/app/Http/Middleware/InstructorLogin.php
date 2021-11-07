<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ModeratorLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('type') === 'admin' || $request->session()->get('type') === 'instructor') {
            if($request->session()->get('status') === 1) {
                return $next($request);
            } else if($request->session()->get('status') === 4) {
                $request->session()->flash('approval', 'Admin needs to approve your instructor account');
                return redirect()->route('home');
            }

        } else {
            return back();
        }
    }
}
