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

namespace Vimeo\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use \Vimeo\Vimeo as Connection;

/**
 * This is the Vimeo facade class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 * 
 * @method static Connection connection(string $name = null)
 * @method static Connection reconnect(string $name = null)
 * @method static void disconnect(string $name = null)
 * @method static array getConnectionConfig(string $name = null)
 * @method static string getDefaultConnection()
 * @method static void setDefaultConnection(string $name)
 * @method static void extend(string $name, callable $resolver)
 * @method static array<Connection> getConnections()
 *
 * @method static array request($url, array $params, string $method = 'GET', bool $json_body = true, array $headers)
 * @method static void setCURLOptions(array $curl_opts = array())
 * @method static void setProxy(string $proxy_address, string $proxy_port = null, string $proxy_userpwd = null)
 * @method static array accessToken(string $code, string $redirect_uri)
 * @method static string upload(string $file_path, array $params = [])
 * @method static string replace(string $video_uri, string $file_path, array $params = [])
 * @method static string uploadImage(string $pictures_uri, string $file_path, bool $activate = false)
 * @method static string uploadTexttrack(string $texttracks_uri, string $file_path, string $track_type, string $language)
 */
class Vimeo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'vimeo';
    }
}
