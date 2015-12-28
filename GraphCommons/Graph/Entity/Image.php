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
 * @object     GraphCommons\Graph\Entity\Image
 * @extends    GraphCommons\Graph\GraphEntity
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Image extends GraphEntity
{
    /**
     * Path.
     * @var string
     */
    protected $path;

    /**
     * Ref name.
     * @var string
     */
    protected $refName;

    /**
     * Ref URL.
     * @var string
     */
    protected $refUrl;

    /**
     * Set path.
     *
     * @param string $path
     */
    final public function setPath(string $path = null): self
    {
        $this->path = (string) $path;
        return $this;
    }

    /**
     * Set ref name.
     *
     * @param string $refName
     */
    final public function setRefName(string $refName = null): self
    {
        $this->refName = (string) $refName;
        return $this;
    }

    /**
     * Set ref URL.
     *
     * @param string $refUrl
     */
    final public function setRefUrl(string $refUrl = null): self
    {
        $this->refUrl = (string) $refUrl;
        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    final public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get ref name.
     *
     * @return string
     */
    final public function getRefName(): string
    {
        return $this->refName;
    }

    /**
     * Get ref URL.
     *
     * @return string
     */
    final public function getRefUrl(): string
    {
        return $this->refUrl;
    }
}
