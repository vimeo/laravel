<?php

namespace Vinkla\Tests\Vimeo\Factories;

use Vinkla\Vimeo\Factories\VimeoFactory;
use Vinkla\Tests\Vimeo\AbstractTestCase;

class VimeoFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getVimeoFactory();

        $return = $factory->make([
            'client_id' => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'access_token' => null
        ]);

        $this->assertInstanceOf('Vimeo\Vimeo', $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientId()
    {
        $factory = $this->getVimeoFactory();

        $factory->make([]);
    }

    protected function getVimeoFactory()
    {
        return new VimeoFactory();
    }
}
