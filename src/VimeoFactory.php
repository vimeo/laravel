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

namespace Vimeo\Laravel;

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
     * @param string[] $config
     *
     * @return \Vimeo\Vimeo
     */
    public function make(array $config): Vimeo
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
     * @return string[]
     */
    protected function getConfig(array $config): array
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
     * @param string[] $auth
     *
     * @return \Vimeo\Vimeo
     */
    protected function getClient(array $auth): Vimeo
    {
        return new Vimeo(
            $auth['client_id'],
            $auth['client_secret'],
            $auth['access_token']
        );
    }
}
