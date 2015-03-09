<?php

namespace Vinkla\Tests\Vimeo\Facades;

use GrahamCampbell\TestBench\Traits\FacadeTestCaseTrait;
use Vinkla\Tests\Vimeo\AbstractTestCase;

class VimeoTest extends AbstractTestCase
{
    use FacadeTestCaseTrait;

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
