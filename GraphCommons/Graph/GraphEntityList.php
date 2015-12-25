<?php
namespace GraphCommons\Graph;

abstract class GraphEntityList implements \Countable, \IteratorAggregate
{
    protected $list = array();

    final public function __isset(string $id): bool
    {
        return isset($list[$id]);
    }
    final public function __unset(string $id)
    {
        unset($list[$id]);
    }

    final public function set(GraphEntity $entity)
    {
        if ($id = $entity->getId()) {
            $this->list[$id] = $entity;
        }
    }
    final public function get(string $id)
    {
        return $this->list[$id] ?? null;
    }
    final public function getList(): array
    {
        return $this->list;
    }

    final public function count(): int
    {
        return count($this->list);
    }
    final public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->list);
    }
}
