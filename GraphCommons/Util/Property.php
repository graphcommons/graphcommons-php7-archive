<?php
namespace GraphCommons\Util;

trait Property
{
    private $_readonly = true;

    public function setReadonly(bool $_readonly)
    {
        $this->_readonly = $_readonly;
    }
    public function getReadonly(): bool
    {
        return $this->_readonly;
    }

    public function __set(string $name, $value)
    {
        if ($this->_readonly) {
            throw new \Exception(sprintf('%s object is readonly!',
                get_class($this)));
        }
        $this->{$name} = $value;
    }
    public function __get(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new \Exception(sprintf('%s property is not exists on %s',
                $name, get_class($this)));
        }
        return $this->{$name};
    }
    public function __isset(string $name): bool
    {
        if (property_exists($this, $name)) {
            return isset($this->{$name});
        }
        return false;
    }
    public function __unset(string $name)
    {
        $this->{$name} = null;
    }
}
