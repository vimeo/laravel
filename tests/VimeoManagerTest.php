<?php

namespace Vinkla\Tests\Vimeo;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Mockery;
use Vinkla\Vimeo\VimeoManager;

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

        $this->assertInstanceOf('Vimeo\Vimeo', $return);

        $this->assertArrayHasKey('vimeo', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock('Illuminate\Contracts\Config\Repository');
        $factory = Mockery::mock('Vinkla\Vimeo\Factories\VimeoFactory');

        $manager = new VimeoManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('vimeo.connections')->andReturn(['vimeo' => $config]);

        $config['name'] = 'vimeo';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock('Vimeo\Vimeo'));

        return $manager;
    }
}
