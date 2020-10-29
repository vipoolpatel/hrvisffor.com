<?php

namespace App\Http\Middleware;
use Auth;
use Cache;
use Carbon\Carbon;
use Closure;

class OnlineUser {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		if (!empty(Auth::guard('company')->user()->id)) {

			$expirtime = Carbon::now()->addMinutes(3);
			Cache::put('OnlineUser' . Auth::guard('company')->user()->id, true, $expirtime);
			
		}

		return $next($request);

	}
}
