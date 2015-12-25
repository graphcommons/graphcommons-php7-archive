<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\GraphEntity;

class GraphEntityList extends Collection
{
    final public function add(GraphEntity $graphEntity): self
    {
        parent::set($key, $value);

        return $this;
    }
}
