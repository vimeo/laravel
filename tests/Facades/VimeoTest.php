<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Tests\Vimeo\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Vinkla\Tests\Vimeo\AbstractTestCase;

/**
 * This is the Vimeo facade test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class VimeoTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'vimeo';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return 'Vinkla\Vimeo\Facades\Vimeo';
    }

    /**
     * Get the facade route.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return 'Vinkla\Vimeo\VimeoManager';
    }
}
