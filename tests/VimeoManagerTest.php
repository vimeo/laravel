<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Tests\Vimeo;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Vimeo\Vimeo;
use Vinkla\Vimeo\VimeoFactory;
use Vinkla\Vimeo\VimeoManager;

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
