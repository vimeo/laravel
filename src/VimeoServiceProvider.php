<?php namespace Vinkla\Vimeo;

use Illuminate\Support\ServiceProvider;
use Vimeo\Vimeo;

class VimeoServiceProvider extends ServiceProvider {

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$source = realpath(__DIR__.'/../config/vimeo.php');

		$this->publishes([$source => config_path('vimeo.php')]);

		$this->mergeConfigFrom($source, 'vimeo');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('vimeo', function()
		{
			return new Vimeo(
				config('vimeo.client_id'),
				config('vimeo.client_secret'),
				config('vimeo.access_token')
			);
		});

		$this->app->alias('vimeo', 'Vimeo\Vimeo');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['vimeo'];
	}

}
