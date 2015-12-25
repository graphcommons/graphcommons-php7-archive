<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\Signal;

class Signals extends Collection
{
    final public function set($key, $value): self
    {
        if (!$value instanceof Signal) {
            throw new \Exception(
                'Entity must be instance of GraphCommons\Graph\Signal'
            );
        }
        if ($key === null) {
            $key = $this->count();
        }
        return parent::set($key, $value);
    }
    final public function get($key)
    {

        return parent::get($key);
    }
}
