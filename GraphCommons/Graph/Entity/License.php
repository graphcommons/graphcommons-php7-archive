<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class License extends GraphEntity
{
    protected $type;
    protected $ccBy;
    protected $ccSa;
    protected $ccNd;
    protected $ccNc;

    final public function setType(string $type = null): self
    {
        $this->type = (string) $type;
        return $this;
    }
    final public function setCcBy(bool $ccBy = null): self
    {
        $this->ccBy = (bool) $ccBy;
        return $this;
    }
    final public function setCcSa(bool $ccSa = null): self
    {
        $this->ccSa = (bool) $ccSa;
        return $this;
    }
    final public function setCcNd(bool $ccNd = null): self
    {
        $this->ccNd = (bool) $ccNd;
        return $this;
    }
    final public function setCcNc(bool $ccNc = null): self
    {
        $this->ccNc = (bool) $ccNc;
        return $this;
    }

    final public function getType(): string
    {
        return $this->type;
    }
    final public function getCcBy(): bool
    {
        return $this->ccBy;
    }
    final public function getCcSa(): bool
    {
        return $this->ccSa;
    }
    final public function getCcNd(): bool
    {
        return $this->ccNd;
    }
    final public function getCcNc(): bool
    {
        return $this->ccNc;
    }
}
