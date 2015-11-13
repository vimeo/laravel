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
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Vimeo\Vimeo;

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
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = realpath(__DIR__.'/../config/vimeo.php');

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('vimeo.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('vimeo');
        }

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
        $this->registerBindings($this->app);
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
            return new VimeoFactory();
        });

        $app->alias('vimeo.factory', VimeoFactory::class);
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

        $app->alias('vimeo', VimeoManager::class);
    }

    /**
     * Register the bindings.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->bind('vimeo.connection', function ($app) {
            $manager = $app['vimeo'];

            return $manager->connection();
        });

        $app->alias('vimeo.connection', Vimeo::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'vimeo',
            'vimeo.factory',
            'vimeo.connection',
        ];
    }
}
