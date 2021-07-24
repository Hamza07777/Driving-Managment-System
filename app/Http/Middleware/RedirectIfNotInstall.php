<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\setting;

class RedirectIfNotInstall
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    $setting= setting::first();
	    if (empty($setting)) {
	        return redirect('requirments');
	    }
       
	    return $next($request);
	}
}
