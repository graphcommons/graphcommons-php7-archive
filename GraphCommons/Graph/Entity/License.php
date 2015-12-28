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
 * @object     GraphCommons\Graph\Entity\License
 * @extends    GraphCommons\Graph\GraphEntity
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class License extends GraphEntity
{
    /**
     * Type.
     * @var string
     */
    protected $type;

    /**
     * CC BY.
     * @var bool
     */
    protected $ccBy;

    /**
     * CC SA.
     * @var bool
     */
    protected $ccSa;

    /**
     * CC ND.
     * @var bool
     */
    protected $ccNd;

    /**
     * CC NC.
     * @var bool
     */
    protected $ccNc;

    /**
     * Set type.
     *
     * @param  string $type
     * @return self
     */
    final public function setType(string $type = null): self
    {
        $this->type = (string) $type;
        return $this;
    }

    /**
     * Set CC BY.
     *
     * @param  bool $ccBy
     * @return self
     */
    final public function setCcBy(bool $ccBy = null): self
    {
        $this->ccBy = (bool) $ccBy;
        return $this;
    }

    /**
     * Set CC SA.
     *
     * @param  bool $ccSa
     * @return self
     */
    final public function setCcSa(bool $ccSa = null): self
    {
        $this->ccSa = (bool) $ccSa;
        return $this;
    }

    /**
     * Set CC ND.
     *
     * @param  bool $ccNd
     * @return self
     */
    final public function setCcNd(bool $ccNd = null): self
    {
        $this->ccNd = (bool) $ccNd;
        return $this;
    }

    /**
     * Set CC NC.
     *
     * @param  bool $ccNc
     * @return self
     */
    final public function setCcNc(bool $ccNc = null): self
    {
        $this->ccNc = (bool) $ccNc;
        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    final public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get CC BY.
     *
     * @return bool
     */
    final public function getCcBy(): bool
    {
        return $this->ccBy;
    }

    /**
     * Get CC SA.
     *
     * @return bool
     */
    final public function getCcSa(): bool
    {
        return $this->ccSa;
    }

    /**
     * Get CC ND.
     *
     * @return bool
     */
    final public function getCcNd(): bool
    {
        return $this->ccNd;
    }

    /**
     * Get CC NC.
     *
     * @return bool
     */
    final public function getCcNc(): bool
    {
        return $this->ccNc;
    }
}
