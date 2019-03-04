<?php

/**
 *   Copyright 2018 Vimeo.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */
declare(strict_types=1);

namespace Vimeo\Laravel;

use Illuminate\Contracts\Container\Container;
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

        if (!$source) {
            throw new \UnexpectedValueException('Could not locate config');
        }

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('vimeo.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('vimeo');
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
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('vimeo.factory', function () : VimeoFactory {
            return new VimeoFactory();
        });

        $this->app->alias('vimeo.factory', VimeoFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('vimeo', function (Container $app) : VimeoManager {
            /** @var \Illuminate\Contracts\Config\Repository */
            $config = $app['config'];
            /** @var \Vimeo\Laravel\VimeoFactory */
            $factory = $app['vimeo.factory'];

            return new VimeoManager($config, $factory);
        });

        $this->app->alias('vimeo', VimeoManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('vimeo.connection', function (Container $app) : Vimeo {
            /** @var VimeoManager */
            $manager = $app['vimeo'];

            /** @var Vimeo */
            return $manager->connection();
        });

        $this->app->alias('vimeo.connection', Vimeo::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'vimeo',
            'vimeo.factory',
            'vimeo.connection',
        ];
    }
}
