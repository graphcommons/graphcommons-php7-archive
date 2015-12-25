<?php
namespace GraphCommons;

use GraphCommons\GraphCommons;

final class GraphCommonsApi
{
    final public function __construct(GraphCommons $graphCommons)
    {
        $this->graphCommons = $graphCommons;
    }
}
