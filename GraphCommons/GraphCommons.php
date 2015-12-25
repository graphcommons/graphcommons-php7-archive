<?php
namespace GraphCommons;

use GraphCommons\GraphCommonsApi;
use GraphCommons\Util\Util;
use GraphCommons\Util\Property;
use GraphCommons\Http\Client;

final class GraphCommons
{
    use Property;

    const VERSION = '1.0.0';

    private $api;
    private $apiUrl = 'https://graphcommons.com/api';
    private $apiVersion = 'v1';
    private $apiKey;

    private $client;

    final public function __construct(string $apiKey, array $config = [])
    {
        $this->api = new GraphCommonsApi();

        if (isset($config['api_url'])) {
            $this->apiUrl = Util::arrayPop($config, 'api_url');
        }
        if (isset($config['api_version'])) {
            $this->apiVersion = Util::arrayPop($config, 'api_version');
        }

        $this->apiKey = trim($apiKey);
        $this->client = new Client($this, $config);
    }

    final public function getClient(): Client
    {
        return $this->client;
    }
    final public function getApiKey(): string
    {
        return $this->apiKey;
    }
    final public static function getVersion(): string
    {
        return self::VERSION;
    }
}
