<?php

/**
 *   Copyright 2018 Vimeo
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

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Vimeo\Vimeo;
use Vimeo\Laravel\VimeoFactory;
use Vimeo\Laravel\VimeoManager;

/**
 * This is the Vimeo manager test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class VimeoManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('vimeo.default')->andReturn('vimeo');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Vimeo::class, $return);

        $this->assertArrayHasKey('vimeo', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(VimeoFactory::class);

        $manager = new VimeoManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('vimeo.connections')->andReturn(['vimeo' => $config]);

        $config['name'] = 'vimeo';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Vimeo::class));

        return $manager;
    }
}
