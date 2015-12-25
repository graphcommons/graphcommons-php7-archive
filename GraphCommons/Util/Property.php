<?php
namespace GraphCommons\Util;

trait Property
{
    private $readonly = true;

    public function setReadonly(bool $readonly)
    {
        $this->readonly = $readonly;
    }
    public function getReadonly(): bool
    {
        return $this->readonly;
    }

    public function __set(string $name, $value) {
        if ($this->readonly) {
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
