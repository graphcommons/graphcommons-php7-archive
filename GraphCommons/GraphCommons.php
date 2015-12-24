<?php
namespace GraphCommons;

use GraphCommons\Http\Client;

final class GraphCommons
{
    private $client;
    private $apiKey;

    final public function __construct(Client $client = null, string $apiKey = '') {
        if ($client == null) {
            $client = new Client();
        }
        $this->setClient($client);
        $this->setApiKey($apiKey);
    }

    final public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }
    final public function setApiKey(string $apiKey): self
    {
        $this->apiKey = trim($apiKey);
        return $this;
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
