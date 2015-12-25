<?php
namespace GraphCommons\Util;

trait Property
{
    private $__readonly = true;

    public function setReadonly(bool $__readonly)
    {
        $this->__readonly = $__readonly;
    }
    public function getReadonly(): bool
    {
        return $this->__readonly;
    }

    public function __set(string $name, $value) {
        if ($this->__readonly) {
            throw new \Exception(sprintf('%s object is readonly!',
                get_class($this)));
        }
        $this->{$name} = $value;
    }
    public function __get(string $name) {
        if (!property_exists($this, $name)) {
            throw new \Exception(sprintf('%s property is not exists on %s',
                $name, get_class($this)));
        }
        return $this->{$name};
    }
}
