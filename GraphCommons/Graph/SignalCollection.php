<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Graph\Signal;

class SignalCollection extends Collection
{
    final public function add(Signal $signal): self
    {
        parent::set($this->count(), $signal);

        return $this;
    }
}
