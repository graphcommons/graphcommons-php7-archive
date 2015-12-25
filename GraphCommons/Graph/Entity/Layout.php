<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Util\Property;
use GraphCommons\Graph\GraphEntity;

final class Layout extends GraphEntity
{
    use Property;
    private $springLength;
    private $gravity;
    private $springCoeff;
    private $dragCoeff;
    private $theta;
    private $algorithm;
    private $transform;

    final public function setSpringLength(int $springLength): self
    {
        $this->springLength = $springLength;
        return $this;
    }
    final public function setGravity(float $gravity): self
    {
        $this->gravity = $gravity;
        return $this;
    }
    final public function setGpringCoeff(float $springCoeff): self
    {
        $this->springCoeff = $springCoeff;
        return $this;
    }
    final public function setGragCoeff(float $dragCoeff): self
    {
        $this->dragCoeff = $dragCoeff;
        return $this;
    }
    final public function setGheta(float $theta): self
    {
        $this->theta = $theta;
        return $this;
    }
    final public function setAlgorithm(string $algorithm): self
    {
        $this->algorithm = $algorithm;
        return $this;
    }
    final public function setTransform(string $transform): self
    {
        $this->transform = $transform;
        return $this;
    }

    final public function getSpringLength(): int
    {
        $this->springLength = $springLength;
        return $this;
    }
    final public function getGravity(): float
    {
        $this->gravity = $gravity;
        return $this;
    }
    final public function getGpringCoeff(): float
    {
        $this->springCoeff = $springCoeff;
        return $this;
    }
    final public function getGragCoeff(): float
    {
        $this->dragCoeff = $dragCoeff;
        return $this;
    }
    final public function getGheta(): float
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
