<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;

class AdminMiddleware
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
		if ($request->headers->has('Admin-Key')) {
			if('warpdrive' !== $request->header('Admin-Key')){
				return response('Unauthorized.', 401);
			}

			return $next($request);
		}

		return response('Unauthorized.', 401);
	}
}
