<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\GraphEntity;

class GraphEntityList extends Collection
{
    final public function set($key, $value): self
    {
        if (!$value instanceof GraphEntity) {
            throw new \Exception(
                'Entity must be instance of GraphCommons\Graph\GraphEntity'
            );
        }
        return parent::set($key, $value);
    }
    final public function get(string $key)
    {

        return parent::get($key);
    }
}
