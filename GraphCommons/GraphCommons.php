<?php
namespace GraphCommons;

use GraphCommons\Util\Util;
use GraphCommons\Http\Client;

final class GraphCommons
{
    private $apiUrl = 'https://graphcommons.com/api';
    private $apiVersion = 'v1';
    private $apiKey;

    private $client;

    final public function __construct(string $apiKey, array $config = [])
    {
        if (isset($config['api_url'])) {
            $this->apiUrl = Util::arrayPop($config, 'api_url');
        }
        if (isset($config['api_version'])) {
            $this->apiVersion = Util::arrayPop($config, 'api_version');
        }

        $this->client = new Client($this, $config);
        $this->apiKey = trim($apiKey);

        // set authentication header
        $this->client->request->setHeader('Authentication', $this->apiKey);
    }

    final public function getClient(): Client
    {
        return $this->client;
    }
    final public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
