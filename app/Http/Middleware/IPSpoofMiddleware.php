<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;
use App\IP;

class IPSpoofMiddleware
{

	private $ip;

	public function __construct(IP $ip)
	{
		$this->ip = $ip;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(isset($_SERVER['REMOTE_ADDR'])){
			$ipaddress = $_SERVER['REMOTE_ADDR'];
			$ip = $this->ip->where('ip', $ipaddress)->first();

			if(is_null($ip)){
				$this->ip->ip = $ipaddress;
				$this->ip->save();
				return $next($request);
			}

			$time = date('Y-m-d H:i:s');
			$from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ip->updated_at);
			$to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

			$diff = $to->diffInMinutes($from);

			if(60 > $diff){
				return response()->json('User has voted within the hour', 403);
			}

			$this->ip->updated_at = $time;
			$this->ip->save();
			return $next($request);

		}else{
			return response()->json('Could not ascertain client IP address', 403);
		}
	}
}
