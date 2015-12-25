<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\GraphEntity;

class GraphEntityList extends Collection
{
    final public function set(string $id, GraphEntity $entity): self
    {
        return parent::set($id, $entity);
    }
    final public function get(string $id)
    {

        return parent::get($id);
    }
}
