<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Property;

abstract class GraphEntity
{
    use Property;
    protected $graph;

    final public function __construct(Graph $graph = null) {
        $this->graph = $graph;
    }

    final public function setGraph(Graph $graph): self
    {
        $this->graph = $graph;
        return $this;
    }
    final public function getGraph(): Graph
    {
        return $this->graph;
    }
}
