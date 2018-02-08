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

use Vimeo\Laravel\VimeoFactory;
use Vimeo\Vimeo;

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
