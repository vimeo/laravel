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
		// Register 'Vimeo' instance container to our Vimeo object.
		$this->app->bindShared('Vinkla\Vimeo\Contracts\Vimeo', function($app)
		{
			return new Vimeo(
				$app['config']['vimeo::client_id'],
				$app['config']['vimeo::client_secret']
			);
		});
	}
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('vinkla/vimeo');
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