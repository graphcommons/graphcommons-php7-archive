<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class EdgeType extends GraphEntity
{
    protected $id;
    protected $name;
    protected $nameAlias;
    protected $description;
    protected $weighted;
    protected $directed;
    protected $durational;
    protected $color;
    protected $properties;

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setName(string $name = null): self
    {
        $this->name = (string) $name;
        return $this;
    }
    final public function setNameAlias(string $nameAlias = null): self
    {
        $this->nameAlias = (string) $nameAlias;
        return $this;
    }
    final public function setDescription(string $description = null): self
    {
        $this->description = (string) $description;
        return $this;
    }
    final public function setWeighted(int $weighted = null): self
    {
        $this->weighted = (int) $weighted;
        return $this;
    }
    final public function setDirected(int $directed = null): self
    {
        $this->directed = (int) $directed;
        return $this;
    }
    final public function setDurational(bool $durational = null): self
    {
        $this->durational = (bool) $durational;
        return $this;
    }
    final public function setColor(string $color = null): self
    {
        $this->color = (string) $color;
        return $this;
    }
    final public function setProperties(\stdClass $properties = null): self
    {
        $this->properties = (object) $properties;
        return $this;
    }

    final public function getId(): string
    {
        return $this->id;
    }
    final public function getName(): string
    {
        return $this->name;
    }
    final public function getNameAlias(): string
    {
        return $this->nameAlias;
    }
    final public function getDescription(): string
    {
        return $this->description;
    }
    final public function getWeighted(): int
    {
        return $this->weighted;
    }
    final public function getDirected(): int
    {
        return $this->directed;
    }
    final public function getDurational(): float
    {
        return $this->durational;
    }
    final public function getColor(): string
    {
        return $this->color;
    }
    final public function getProperties(): \stdClass
    {
        return $this->properties;
    }
}
