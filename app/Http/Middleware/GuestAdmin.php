<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestAdmin
{
    public function handle($request, Closure $next)
    {
        if(Auth::guard()->check()) {
            $cek = Auth::user()->roles()->pluck('name')->implode(' ');
            if($cek == 'user') {
                 return redirect()->route('blog.index');
            }
            return redirect()->route('admin.index');
        }
        return $next($request);
    }
}