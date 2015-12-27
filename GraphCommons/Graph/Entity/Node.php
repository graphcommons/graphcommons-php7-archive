<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Node extends GraphEntity
{
    protected $id;
    protected $type;
    protected $typeId;
    protected $name;
    protected $description;
    protected $image;
    protected $reference;
    protected $properties;
    protected $posX, $posY;
    protected $createdAt, $updatedAt;
    protected $hubs = array();
    protected $users = array();
    protected $graphs = array();
    protected $graphsCount = 0;
    protected $status;

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setType(NodeType $type = null): self
    {
        $this->type = $type;
        return $this;
    }
    final public function setTypeId(string $typeId = null): self
    {
        $this->typeId = (string) $typeId;
        return $this;
    }
    final public function setName(string $name = null): self
    {
        $this->name = (string) $name;
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
    final public function setReference(string $reference = null): self
    {
        $this->reference = (string) $reference;
        return $this;
    }
    final public function setProperties(\stdClass $properties = null): self
    {
        $this->properties = (object) $properties;
        return $this;
    }
    final public function setPosX(float $posX = null): self
    {
        $this->posX = (float) $posX;
        return $this;
    }
    final public function setPosY(float $posY = null): self
    {
        $this->posY = (float) $posY;
        return $this;
    }
    final public function setPosXY(float $posX = null, float $posY = null): self
    {
        $this->posX = (float) $posX;
        $this->posY = (float) $posY;
        return $this;
    }
    final public function setCreatedAt(string $createdAt = null): self
    {
        $this->createdAt = (string) $createdAt;
        return $this;
    }
    final public function setUpdatedAt(string $updatedAt = null): self
    {
        $this->updatedAt = (string) $updatedAt;
        return $this;
    }
    final public function setHubs(array $hubs = null): self
    {
        if (!is_null($hubs)) {
            $this->hubs = $hubs;
        }
        return $this;
    }
    final public function setUsers(array $users = null): self
    {
        if (!is_null($users)) {
            $this->users = $users;
        }
        return $this;
    }
    final public function setGraphs(array $graphs = null): self
    {
        if (!is_null($graphs)) {
            $this->graphs = $graphs;
        }
        return $this;
    }
    final public function setGraphsCount(int $graphsCount = null): self
    {
        if (!is_null($graphsCount)) {
            $this->graphsCount = $graphsCount;
        }
        return $this;
    }
    final public function setStatus(int $status = null): self
    {
        $this->status = (int) $status;
        return $this;
    }

    final public function getId(): string
    {
        return $this->id;
    }
    final public function getType(): NodeType
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
    final public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    final public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
    final public function getHubs(): array
    {
        return $this->hubs;
    }
    final public function getUsers(): array
    {
        return $this->users;
    }
    final public function getGraphs(): array
    {
        return $this->graphs;
    }
    final public function getGraphsCount(): int
    {
        return $this->graphsCount;
    }
    final public function setStatus(): int
    {
        return $this->status;
    }
}
