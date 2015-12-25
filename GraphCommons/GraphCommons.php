<?php
namespace GraphCommons;

use GraphCommons\Http\Client;

final class GraphCommons
{
    private $apiUrl = 'https://graphcommons.com/api';
    private $apiVersion = 'v1';
    private $apiKey;

    private $client;

    final public function __construct(string $apiKey, array $config = []) {
        $this->client = new Client();
        $this->apiKey = trim($apiKey);
        // set authentication
        $this->client->getRequest()->setHeader('Authentication', $apiKey);
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
