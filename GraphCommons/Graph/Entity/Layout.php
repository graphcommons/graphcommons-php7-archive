<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class Layout extends GraphEntity
{
    private $gravity;
    private $dragCoeff;
    private $springCoeff;
    private $springLength;
    private $theta;
    private $algorithm;
    private $transform;

    final public function setGravity(float $gravity = null): self
    {
        $this->gravity = (float) $gravity;
        return $this;
    }
    final public function setDragCoeff(float $dragCoeff = null): self
    {
        $this->dragCoeff = (float) $dragCoeff;
        return $this;
    }
    final public function setSpringCoeff(float $springCoeff = null): self
    {
        $this->springCoeff = (float) $springCoeff;
        return $this;
    }
    final public function setSpringLength(int $springLength = null): self
    {
        $this->springLength = (int) $springLength;
        return $this;
    }
    final public function setTheta(float $theta = null): self
    {
        $this->theta = (float) $theta;
        return $this;
    }
    final public function setAlgorithm(string $algorithm = null): self
    {
        $this->algorithm = (string) $algorithm;
        return $this;
    }
    final public function setTransform(string $transform = null): self
    {
        $this->transform = (string) $transform;
        return $this;
    }

    final public function getGravity(): float
    {
        $this->gravity = $gravity;
        return $this;
    }
    final public function getDragCoeff(): float
    {
        $this->dragCoeff = $dragCoeff;
        return $this;
    }
    final public function getSpringCoeff(): float
    {
        $this->springCoeff = $springCoeff;
        return $this;
    }
    final public function getSpringLength(): int
    {
        $this->springLength = $springLength;
        return $this;
    }
    final public function getTheta(): float
    {
        $this->theta = $theta;
        return $this;
    }
    final public function getAlgorithm(): string
    {
        $this->algorithm = $algorithm;
        return $this;
    }
    final public function getTransform(): string
    {
        $this->transform = $transform;
        return $this;
    }
}
