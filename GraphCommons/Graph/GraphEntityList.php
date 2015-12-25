<?php
namespace GraphCommons\Graph;

abstract class GraphEntityList
    implements \Countable, \IteratorAggregate, \ArrayAccess
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

    final public function set($id, GraphEntity $entity)
    {
        $this->list[$id] = $entity;
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

    final public function offsetSet($id, $entity)
    {
        return $this->set($id, $entity);
    }
    final public function offsetGet($id)
    {
        return $this->get($id);
    }
    final public function offsetUnset($id)
    {
        return $this->__unset($id);
    }
    final public function offsetExists($id)
    {
        return $this->__isset($id);
    }
}
