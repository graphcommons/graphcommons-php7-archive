<?php
namespace GraphCommons\Util;

class Collection
    implements \Countable, \IteratorAggregate, \ArrayAccess
{
    protected $data = array();

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    public function __isset($key): bool
    {
        return isset($this->data[$key]);
    }
    public function __unset($key)
    {
        unset($this->data[$key]);
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function get($key)
    {
        return $this->data[$key] ?? null;
    }
    public function getData(): array
    {
        return $this->data;
    }
    public function getDataKeys(): array
    {
        return array_keys($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }

    public function offsetSet($key, $element)
    {
        return $this->set($key, $element);
    }
    public function offsetGet($key)
    {
        return $this->get($key);
    }
    public function offsetUnset($key)
    {
        return $this->__unset($key);
    }
    public function offsetExists($key): bool
    {
        return $this->__isset($key);
    }
}
