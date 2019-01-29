<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CandidateServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\Http\Contracts\CandidateContract',
			'App\Http\Services\Candidates'
		);
	}
}
