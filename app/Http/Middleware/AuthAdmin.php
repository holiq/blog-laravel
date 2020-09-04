<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
	public function handle($request, Closure $next)
	{
		if(Auth::guard()->check()){
			$cek = Auth::user()->roles()->pluck('name')->implode(' ');
			if($cek == 'user'){
				return redirect()->route('index');
			}
			return $next($request);
		}else{
			return redirect()->route('admin.login');
		}
	}
}
