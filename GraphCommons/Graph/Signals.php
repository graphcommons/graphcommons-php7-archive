<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\Signal;

class Signals extends Collection
{
    final public function add(Signal $signal)
    {
        return parent::set($this->count(), $signal);
    }
}
