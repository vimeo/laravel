<?php namespace Vinkla\Vimeo;

use Illuminate\Support\ServiceProvider;

class VimeoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$source = sprintf('%s/../../config/config.php', __DIR__);
		$destination = config_path('vimeo.php');

		$this->publishes([$source => $destination]);

		$this->app->singleton('Vinkla\Vimeo\Contracts\Vimeo', function()
		{
			return new Vimeo(
				config('vimeo.client_id'),
				config('vimeo.client_secret'),
				config('vimeo.access_token')
			);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['Vinkla\Vimeo\Contracts\Vimeo'];
	}

}
