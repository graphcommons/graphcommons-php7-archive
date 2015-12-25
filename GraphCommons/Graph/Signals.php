<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\Signal;

final class Signals extends Collection
{
    final public function set(int $index, Signal $entity): self
    {
        if ($index === null) {
            $index = $this->count();
        }
        return parent::set($index, $entity);
    }
    final public function get(int $index)
    {

        return parent::get($index);
    }
}
