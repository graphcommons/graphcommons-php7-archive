<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Image extends GraphEntity
{
    private $path;
    private $refName;
    private $refUrl;

    final public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }
    final public function setRefName(string $refName): self
    {
        $this->refName = $refName;
        return $this;
    }
    final public function setRefUrl(string $refUrl): self
    {
        $this->refUrl = $refUrl;
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
