<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Vimeo;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the Vimeo service provider class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class VimeoServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
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
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
    }

    /**
     * Register the factory class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerFactory(Application $app)
    {
        $app->singleton('vimeo.factory', function () {
            return new Factories\VimeoFactory();
        });
        $app->alias('vimeo.factory', 'Vinkla\Vimeo\Factories\VimeoFactory');
    }

    /**
     * Register the manager class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerManager(Application $app)
    {
        $app->singleton('vimeo', function ($app) {
            $config = $app['config'];
            $factory = $app['vimeo.factory'];

            return new VimeoManager($config, $factory);
        });

        $app->alias('vimeo', 'Vinkla\Vimeo\VimeoManager');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'vimeo',
            'vimeo.factory'
        ];
    }
}
