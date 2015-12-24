<?php
namespace GraphCommons\Util;

trait Property
{
    private $readOnly = true;

    final public function __set(string $name, $value) {
        if ($this->readOnly) {
            throw new \Exception(sprintf('%s object is readonly!',
                get_class($this)));
        }
        $this->{$name} = $value;
    }
    final public function __get(string $name) {
        if (!property_exists($this, $name)) {
            throw new \Exception(sprintf('%s property is not exists on %s',
                $name, get_class($this)));
        }
        return $this->{$name};
    }
}
