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

namespace Vimeo\Laravel;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Vimeo\Vimeo;

/**
 * This is the Vimeo manager class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class VimeoManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Vimeo\Laravel\VimeoFactory
     */
    private $factory;

    /**
     * Create a new Vimeo manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vimeo\Laravel\VimeoFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, VimeoFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Vimeo\Vimeo
     */
    protected function createConnection(array $config): Vimeo
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'vimeo';
    }

    /**
     * Get the factory instance.
     *
     * @return \Vimeo\Laravel\VimeoFactory
     */
    public function getFactory(): VimeoFactory
    {
        return $this->factory;
    }
}
