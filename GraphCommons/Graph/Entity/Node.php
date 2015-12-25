<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Node extends GraphEntity
{
    private $id;
    private $type;
    private $typeId;
    private $name;
    private $description;
    private $image;
    private $reference;
    private $properties;
    private $posX, $posY;

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
    final public function setTypeId(string $typeId): self
    {
        $this->typeId = $typeId;
        return $this;
    }
    final public function setName(string $name): self
    {
        $this->name = $name;
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
    final public function setReference(string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }
    final public function setProperties(\stdClass $properties): self
    {
        $this->properties = $properties;
        return $this;
    }
    final public function setPosX(float $posX): self
    {
        $this->posX = $posX;
        return $this;
    }
    final public function setPosY(float $posY): self
    {
        $this->posY = $posY;
        return $this;
    }
    final public function setPosXY(float $posX, float $posY): self
    {
        $this->posX = $posX;
        $this->posY = $posY;
        return $this;
    }

    final public function getId(): string
    {
        return $this->id;
    }
    final public function getType(): string
    {
        return $this->type;
    }
    final public function getTypeId(): string
    {
        return $this->typeId;
    }
    final public function getName(): string
    {
        return $this->name;
    }
    final public function getDescription(): string
    {
        return $this->description;
    }
    final public function getImage(): string
    {
        return $this->image;
    }
    final public function getReference(): string
    {
        return $this->reference;
    }
    final public function getProperties(): \stdClass
    {
        return $this->properties;
    }
    final public function getPosX(): float
    {
        return $this->posX;
    }
    final public function getPosY(): float
    {
        return $this->posY;
    }
    final public function getPosXY(): array
    {
        return array($this->posX, $this->posY);
    }
}
