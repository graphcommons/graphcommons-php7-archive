<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\GraphEntity;

class GraphEntityCollection extends Collection
{
    final public function add(string $id, GraphEntity $graphEntity): self
    {
        parent::set($id, $graphEntity);

        return $this;
    }
}