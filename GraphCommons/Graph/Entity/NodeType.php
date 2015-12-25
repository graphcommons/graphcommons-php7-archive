<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class NodeType extends GraphEntity
{
    protected $id;
    protected $name;
    protected $nameAlias;
    protected $description;
    protected $image;
    protected $imageAsIcon;
    protected $color;
    protected $properties;
    protected $hideName;
    protected $size;
    protected $sizeLimit;

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
    final public function setImage(string $image = null): self
    {
        $this->image = (string) $image;
        return $this;
    }
    final public function setImageAsIcon(bool $imageAsIcon = null): self
    {
        $this->imageAsIcon = (bool) $imageAsIcon;
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
    final public function setHideName(bool $hideName = null): self
    {
        $this->hideName = (bool) $hideName;
        return $this;
    }
    final public function setSize(string $size = null): self
    {
        $this->size = (string) $size;
        return $this;
    }
    final public function setSizeLimit(int $sizeLimit = null): self
    {
        $this->sizeLimit = (int) $sizeLimit;
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
    final public function getImage(): string
    {
        return $this->image;
    }
    final public function getImageAsIcon(): bool
    {
        return $this->imageAsIcon;
    }
    final public function getColor(): string
    {
        return $this->color;
    }
    final public function getProperties(): \stdClass
    {
        return $this->properties;
    }
    final public function getHideName(): bool
    {
        return $this->hideName;
    }
    final public function getSize(): string
    {
        return $this->size;
    }
    final public function getSizeLimit(): int
    {
        return $this->sizeLimit;
    }
}
