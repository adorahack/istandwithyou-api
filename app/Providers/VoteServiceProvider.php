<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VoteServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\Http\Contracts\VoteContract',
			'App\Http\Services\Votes'
		);
	}
}
