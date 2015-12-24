<?php
namespace GraphCommons;

use GraphCommons\Http\Client;

final class GraphCommons
{
    private $client;
    private $apiKey;

    final public function __construct(string $apiKey, array $config = []) {
        $this->client = new Client();
        $this->apiKey = trim($apiKey);
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
