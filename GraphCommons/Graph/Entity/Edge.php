<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Edge extends GraphEntity
{
    protected $id;
    protected $name;
    protected $typeId;
    protected $userId;
    protected $from;
    protected $to;
    protected $weight;
    protected $directed;
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
    final public function setTypeId(string $typeId = null): self
    {
        $this->typeId = (string) $typeId;
        return $this;
    }
    final public function setUserId(string $userId = null): self
    {
        $this->userId = (string) $userId;
        return $this;
    }
    final public function setFrom(string $from = null): self
    {
        $this->from = (string) $from;
        return $this;
    }
    final public function setTo(string $to = null): self
    {
        $this->to = (string) $to;
        return $this;
    }
    final public function setWeight(int $weight = null): self
    {
        $this->weight = (int) $weight;
        return $this;
    }
    final public function setDirected(int $directed = null): self
    {
        $this->directed = (int) $directed;
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
