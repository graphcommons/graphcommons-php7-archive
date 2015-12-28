<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Graph Commons & contributors.
 *     <http://graphcommons.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Graph\Entity
 * @object     GraphCommons\Graph\Entity\Layout
 * @extends    GraphCommons\Graph\GraphEntity
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Layout extends GraphEntity
{
    /**
     * Gravity.
     * @var float
     */
    protected $gravity;

    /**
     * Drag coeff.
     * @var float
     */
    protected $dragCoeff;

    /**
     * Spring coeff.
     * @var float
     */
    protected $springCoeff;

    /**
     * Spring length.
     * @var float
     */
    protected $springLength;

    /**
     * Theta.
     * @var float
     */
    protected $theta;

    /**
     * Algorithm.
     * @var string
     */
    protected $algorithm;

    /**
     * Transform.
     * @var string
     */
    protected $transform;

    /**
     * Set gravity.
     *
     * @param  float $gravity
     * @return self
     */
    final public function setGravity(float $gravity = null): self
    {
        $this->gravity = (float) $gravity;
        return $this;
    }

    /**
     * Set grag coeff.
     *
     * @param  float $dragCoeff
     * @return self
     */
    final public function setDragCoeff(float $dragCoeff = null): self
    {
        $this->dragCoeff = (float) $dragCoeff;
        return $this;
    }

    /**
     * Set spring coeff.
     *
     * @param  float $springCoeff
     * @return self
     */
    final public function setSpringCoeff(float $springCoeff = null): self
    {
        $this->springCoeff = (float) $springCoeff;
        return $this;
    }

    /**
     * Set spring length.
     *
     * @param  int $springLength
     * @return self
     */
    final public function setSpringLength(int $springLength = null): self
    {
        $this->springLength = (int) $springLength;
        return $this;
    }

    /**
     * Set theta.
     *
     * @param  float $theta
     * @return self
     */
    final public function setTheta(float $theta = null): self
    {
        $this->theta = (float) $theta;
        return $this;
    }

    /**
     * Set algorithm.
     *
     * @param  string $algorithm
     * @return self
     */
    final public function setAlgorithm(string $algorithm = null): self
    {
        $this->algorithm = (string) $algorithm;
        return $this;
    }

    /**
     * Set transform.
     *
     * @param  string $transform
     * @return self
     */
    final public function setTransform(string $transform = null): self
    {
        $this->transform = (string) $transform;
        return $this;
    }

    /**
     * Get gravity.
     *
     * @return float
     */
    final public function getGravity(): float
    {
        $this->gravity = $gravity;
        return $this;
    }

    /**
     * Get drag coeff.
     *
     * @return float
     */
    final public function getDragCoeff(): float
    {
        $this->dragCoeff = $dragCoeff;
        return $this;
    }

    /**
     * Get spring coeff.
     *
     * @return float
     */
    final public function getSpringCoeff(): float
    {
        $this->springCoeff = $springCoeff;
        return $this;
    }

    /**
     * Get spring length.
     *
     * @return int
     */
    final public function getSpringLength(): int
    {
        $this->springLength = $springLength;
        return $this;
    }

    /**
     * Get theta.
     *
     * @return float
     */
    final public function getTheta(): float
    {
        $this->theta = $theta;
        return $this;
    }

    /**
     * Get algorithm.
     *
     * @return string
     */
    final public function getAlgorithm(): string
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * Get transform.
     *
     * @return string
     */
    final public function getTransform(): string
    {
        $this->transform = $transform;
        return $this;
    }
}
