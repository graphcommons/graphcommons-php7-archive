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
 * @object     GraphCommons\Graph\Entity\NodeType
 * @extends    GraphCommons\Graph\GraphEntity
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class NodeType extends GraphEntity
{
    /**
     * ID.
     * @var string
     */
    protected $id;

    /**
     * Name.
     * @var string
     */
    protected $name;

    /**
     * Name alias.
     * @var string
     */
    protected $nameAlias;

    /**
     * Description.
     * @var string
     */
    protected $description;

    /**
     * Image.
     * @var string
     */
    protected $image;

    /**
     * Image as icon.
     * @var bool
     */
    protected $imageAsIcon;

    /**
     * Color.
     * @var string
     */
    protected $color;

    /**
     * Properties.
     * @var \stdClass
     */
    protected $properties;

    /**
     * Hide name.
     * @var bool
     */
    protected $hideName;

    /**
     * Size.
     * @var string
     */
    protected $size;

    /**
     * Size limit.
     * @var int
     */
    protected $sizeLimit;

    /**
     * Set ID.
     *
     * @param  string $id
     * @return self
     */
    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set name.
     *
     * @param  string $name
     * @return self
     */
    final public function setName(string $name = null): self
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Set name alias.
     *
     * @param  string $nameAlias
     * @return self
     */
    final public function setNameAlias(string $nameAlias = null): self
    {
        $this->nameAlias = (string) $nameAlias;
        return $this;
    }

    /**
     * Set description.
     *
     * @param  string $description
     * @return self
     */
    final public function setDescription(string $description = null): self
    {
        $this->description = (string) $description;
        return $this;
    }

    /**
     * Set image.
     *
     * @param  string $image
     * @return self
     */
    final public function setImage(string $image = null): self
    {
        $this->image = (string) $image;
        return $this;
    }

    /**
     * Set image as icon.
     *
     * @param  bool $imageAsIcon
     * @return self
     */
    final public function setImageAsIcon(bool $imageAsIcon = null): self
    {
        $this->imageAsIcon = (bool) $imageAsIcon;
        return $this;
    }

    /**
     * Set color.
     *
     * @param  string $color
     * @return self
     */
    final public function setColor(string $color = null): self
    {
        $this->color = (string) $color;
        return $this;
    }

    /**
     * Set properties.
     *
     * @param  \stdClass $properties
     * @return self
     */
    final public function setProperties(\stdClass $properties = null): self
    {
        $this->properties = (object) $properties;
        return $this;
    }

    /**
     * Set hide name.
     *
     * @param  bool $hideName
     * @return self
     */
    final public function setHideName(bool $hideName = null): self
    {
        $this->hideName = (bool) $hideName;
        return $this;
    }

    /**
     * Set size.
     *
     * @param  string $size
     * @return self
     */
    final public function setSize(string $size = null): self
    {
        $this->size = (string) $size;
        return $this;
    }

    /**
     * Set size limit.
     *
     * @param  string $sizeLimit
     * @return self
     */
    final public function setSizeLimit(int $sizeLimit = null): self
    {
        $this->sizeLimit = (int) $sizeLimit;
        return $this;
    }

    /**
     * Get ID.
     *
     * @return string
     */
    final public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get name.
     *
     * @return string
     */
    final public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get name alias.
     *
     * @return string
     */
    final public function getNameAlias(): string
    {
        return $this->nameAlias;
    }

    /**
     * Get description.
     *
     * @return string
     */
    final public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get image.
     *
     * @return string
     */
    final public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Get image as icon.
     *
     * @return bool
     */
    final public function getImageAsIcon(): bool
    {
        return $this->imageAsIcon;
    }

    /**
     * Get color.
     *
     * @return string
     */
    final public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Get properties.
     *
     * @return \stdClass
     */
    final public function getProperties(): \stdClass
    {
        return $this->properties;
    }

    /**
     * Get hide name.
     *
     * @return bool
     */
    final public function getHideName(): bool
    {
        return $this->hideName;
    }

    /**
     * Get size.
     *
     * @return string
     */
    final public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Get size limit.
     *
     * @return int
     */
    final public function getSizeLimit(): int
    {
        return $this->sizeLimit;
    }
}
