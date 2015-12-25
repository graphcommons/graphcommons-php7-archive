<?php
namespace GraphCommons;

use GraphCommons\GraphCommons;

final class GraphCommonsApi
{
    final public function __construct(GraphCommons $graphCommons)
    {
        $this->graphCommons = $graphCommons;
    }

    final public function status()
    {
        $response = $this->graphCommons->client->get('/status');
        if ($response->getBody()) {
            return $response->getBodyData();
        }
        return null;
    }
}
