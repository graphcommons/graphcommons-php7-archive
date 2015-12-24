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
    private $properties = array();

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
    final public function setDirected(array $directed): self
    {
        $this->directed = $directed;
        return $this;
    }
    final public function setProperties(array $properties): self
    {
        $this->properties = $properties;
        return $this;
    }
}
