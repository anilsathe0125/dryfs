<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $data)
    {
        if (Auth::guard('admin')->check()) {

            if (Auth::guard('admin')->user()->id == 1) {
                return $next($request);
            }

            if (Auth::guard('admin')->user()->role_id == 0) {
                return redirect()->route('backend.dashboard')->withInput('success', "You don't have access to that section");
            }
            Auth::guard('admin')->user()->sectionCheck($data);
            if (Auth::guard('admin')->user()->sectionCheck($data)) {
                return $next($request);
            }
        }

        return redirect()->route('backend.dashboard')->with('success',"You don't have access to that section");
    }
}
