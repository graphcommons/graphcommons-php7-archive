<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Graph Commons & contributors.
 *     <http://graphcommons.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace GraphCommons;

use GraphCommons\GraphCommonsApi;
use GraphCommons\Util\PropertyTrait as Property;
use GraphCommons\Util\Util;
use GraphCommons\Http\Client;

/**
 * @package GraphCommons
 * @object  GraphCommons\GraphCommons
 * @uses    GraphCommons\GraphCommonsApi,
 *          GraphCommons\Util\Util,
 *          GraphCommons\Util\PropertyTrait,
 *          GraphCommons\Http\Client
 * @author  Kerem Güneş <qeremy@gmail.com>
 */
final class GraphCommons
{
    /**
     * Property thing.
     * @trait GraphCommons\Util\PropertyTrait
     */
    use Property;

    /**
     * Version holder.
     * @const string
     */
    const VERSION = '1.0.0';

    /**
     * API object.
     * @var GraphCommons\GraphCommonsApi
     */
    private $api;

    /**
     * API link.
     * @var string
     */
    private $apiUrl = 'https://graphcommons.com/api';

    /**
     * API version.
     * @var string
     */
    private $apiVersion = 'v1';

    /**
     * API authorization key.
     * @var string
     */
    private $apiKey;

    /**
     * Client object.
     * @var GraphCommons\Http\Client
     */
    private $client;

    /**
     * Constructor.
     *
     * @param string $apiKey
     * @param array  $config
     */
    final public function __construct(string $apiKey, array $config = [])
    {
        $this->api = new GraphCommonsApi($this);

        // check user config options
        if (isset($config['api_url'])) {
            $this->apiUrl = Util::arrayPick($config, 'api_url');
        }
        if (isset($config['api_version'])) {
            $this->apiVersion = Util::arrayPick($config, 'api_version');
        }

        // prevent typos
        $this->apiKey = trim($apiKey);

        $this->client = new Client($this, $config);
    }

    /**
     * Get API key.
     *
     * @return string.
     */
    final public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get API version.
     *
     * @return string
     */
    final public static function getVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Get client object.
     *
     * @return GraphCommons\Http\Client
     */
    final public function getClient(): Client
    {
        return $this->client;
    }
}
