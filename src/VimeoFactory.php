<?php

/*
 * This file is part of Laravel Vimeo.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Vimeo;

use InvalidArgumentException;
use Vimeo\Vimeo;

/**
 * The is the Vimeo factory class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class VimeoFactory
{
    /**
     * Make a new Vimeo client.
     *
     * @param array $config
     *
     * @return \Vimeo\Vimeo
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['client_id', 'client_secret'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['client_id', 'client_secret', 'access_token']);
    }

    /**
     * Get the Vimeo client.
     *
     * @param array $auth
     *
     * @return \Vimeo\Vimeo
     */
    protected function getClient(array $auth)
    {
        return new Vimeo(
            $auth['client_id'],
            $auth['client_secret'],
            $auth['access_token']
        );
    }
}
