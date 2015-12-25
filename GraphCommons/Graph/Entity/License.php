<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class License extends GraphEntity
{
    private $type;
    private $ccBy;
    private $ccSa;
    private $ccNd;
    private $ccNc;

    final public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
    final public function setCcBy(bool $ccBy): self
    {
        $this->ccBy = $ccBy;
        return $this;
    }
    final public function setCcSa(bool $ccSa): self
    {
        $this->ccSa = $ccSa;
        return $this;
    }
    final public function setCcNd(bool $ccNd): self
    {
        $this->ccNd = $ccNd;
        return $this;
    }
    final public function setCcNc(bool $ccNc): self
    {
        $this->ccNc = $ccNc;
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
