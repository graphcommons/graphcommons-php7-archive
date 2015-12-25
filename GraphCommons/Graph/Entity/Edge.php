<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Edge extends GraphEntity
{
    private $id;
    private $name;
    private $typeId;
    private $userId;
    private $from;
    private $to;
    private $weight;
    private $directed;
    private $properties;

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
    final public function setTypeId(string $typeId): self
    {
        $this->typeId = $typeId;
        return $this;
    }
    final public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }
    final public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }
    final public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }
    final public function setWeight(int $weight): self
    {
        $this->weight = $weight;
        return $this;
    }
    final public function setDirected(int $directed): self
    {
        $this->directed = $directed;
        return $this;
    }
    final public function setProperties(\stdClass $properties): self
    {
        $this->properties = $properties;
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
    final public function getTypeId(): string
    {
        return $this->typeId;
    }
    final public function getUserId(): string
    {
        return $this->userId;
    }
    final public function getFrom(): string
    {
        return $this->from;
    }
    final public function getTo(): string
    {
        return $this->to;
    }
    final public function getWeight(): int
    {
        return $this->weight;
    }
    final public function getDirected(): int
    {
        return $this->directed;
    }
    final public function getProperties(): \stdClass
    {
        return $this->properties;
    }
}
