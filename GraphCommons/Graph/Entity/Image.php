<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Image extends GraphEntity
{
    protected $path;
    protected $refName;
    protected $refUrl;

    final public function setPath(string $path = null): self
    {
        $this->path = (string) $path;
        return $this;
    }
    final public function setRefName(string $refName = null): self
    {
        $this->refName = (string) $refName;
        return $this;
    }
    final public function setRefUrl(string $refUrl = null): self
    {
        $this->refUrl = (string) $refUrl;
        return $this;
    }

    final public function getPath()
    {
        return $this->path;
    }
    final public function getRefName()
    {
        return $this->refName;
    }
    final public function getRefUrl()
    {
        return $this->refUrl;
    }
}
