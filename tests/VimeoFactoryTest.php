<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Vimeo;

use Vimeo\Vimeo;
use Vinkla\Vimeo\VimeoFactory;

/**
 * This is the Vimeo factory test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class VimeoFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getVimeoFactory();

        $return = $factory->make([
            'client_id' => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'access_token' => null,
        ]);

        $this->assertInstanceOf(Vimeo::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientId()
    {
        $factory = $this->getVimeoFactory();

        $factory->make([
            'client_secret' => 'your-client-secret',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutClientSecret()
    {
        $factory = $this->getVimeoFactory();

        $factory->make([
            'client_id' => 'your-client-id',
        ]);
    }

    protected function getVimeoFactory()
    {
        return new VimeoFactory();
    }
}
