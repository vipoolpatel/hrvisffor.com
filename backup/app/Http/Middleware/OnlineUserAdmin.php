<?php

namespace App\Http\Middleware;
use Auth;
use Cache;
use Carbon\Carbon;
use Closure;

class OnlineUserAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		if (!empty(Auth::user()->id)) {
			$expirtime = Carbon::now()->addMinutes(3);
			Cache::put('OnlineUserAdmin' . Auth::user()->id, true, $expirtime);			
		}

		return $next($request);

	}
}
