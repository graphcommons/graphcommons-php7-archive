<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class NodeType extends GraphEntity
{
    private $id;
    private $name;
    private $nameAlias;
    private $description;
    private $image;
    private $imageAsIcon;
    private $color;
    private $properties;
    private $hideName;
    private $size;
    private $sizeLimit;

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    final public function setNameAlias(string $nameAlias): self
    {
        $this->nameAlias = $nameAlias;
        return $this;
    }
    final public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    final public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }
    final public function setImageAsIcon(bool $imageAsIcon): self
    {
        $this->imageAsIcon = $imageAsIcon;
        return $this;
    }
    final public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }
    final public function setProperties(array $properties): self
    {
        $this->properties = $properties;
        return $this;
    }
    final public function setHideName(string $hideName): self
    {
        $this->hideName = $hideName;
        return $this;
    }
    final public function setSize(string $size): self
    {
        $this->size = $size;
        return $this;
    }
    final public function setSizeLimit(int $sizeLimit): self
    {
        $this->sizeLimit = $sizeLimit;
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
    final public function getProperties(): array
    {
        return $this->properties;
    }
    final public function getHideName(): string
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
