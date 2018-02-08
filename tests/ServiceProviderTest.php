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

namespace Vimeo\Tests\Laravel;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Vimeo\Laravel\VimeoFactory;
use Vimeo\Laravel\VimeoManager;
use Vimeo\Vimeo;

/**
 * This is the service provider test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testVimeoFactoryIsInjectable()
    {
        $this->assertIsInjectable(VimeoFactory::class);
    }

    public function testVimeoManagerIsInjectable()
    {
        $this->assertIsInjectable(VimeoManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Vimeo::class);

        $original = $this->app['vimeo.connection'];
        $this->app['vimeo']->reconnect();
        $new = $this->app['vimeo.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
