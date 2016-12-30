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

namespace Vinkla\Vimeo;

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
     * @var \Vinkla\Vimeo\VimeoFactory
     */
    private $factory;

    /**
     * Create a new Vimeo manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Vinkla\Vimeo\VimeoFactory $factory
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
     * @return \Vinkla\Vimeo\VimeoFactory
     */
    public function getFactory(): VimeoFactory
    {
        return $this->factory;
    }
}
