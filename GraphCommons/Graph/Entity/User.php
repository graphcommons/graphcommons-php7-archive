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
 * @object     GraphCommons\Graph\Entity\User
 * @extends    GraphCommons\Graph\GraphEntity
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class User extends GraphEntity
{
    /**
     * ID.
     * @var string
     */
    protected $id;

    /**
     * Username.
     * @var string
     */
    protected $username;

    /**
     * Full name.
     * @var string
     */
    protected $fullName;

    /**
     * First name.
     * @var string
     */
    protected $firstName;

    /**
     * Last name.
     * @var string
     */
    protected $lastName;

    /**
     * Is owner.
     * @var bool
     */
    protected $isOwner;

    /**
     * Is admin.
     * @var bool
     */
    protected $isAdmin;

    /**
     * Image path.
     * @var bool
     */
    protected $imgPath;

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
     * Set username.
     *
     * @param  string $username
     * @return self
     */
    final public function setUsername(string $username = null): self
    {
        $this->username = (string) $username;
        return $this;
    }

    /**
     * Set full name.
     *
     * @param  string $fullName
     * @return self
     */
    final public function setFullName(string $fullName = null): self
    {
        $this->fullName = (string) $fullName;
        return $this;
    }

    /**
     * Set first name.
     *
     * @param  string $firstName
     * @return self
     */
    final public function setFirstName(string $firstName = null): self
    {
        $this->firstName = (string) $firstName;
        return $this;
    }

    /**
     * Set last name.
     *
     * @param  string $lastName
     * @return self
     */
    final public function setLastName(string $lastName = null): self
    {
        $this->lastName = (string) $lastName;
        return $this;
    }

    /**
     * Set is owner.
     *
     * @param  bool $isOwner
     * @return self
     */
    final public function setIsOwner(bool $isOwner = null): self
    {
        $this->isOwner = (bool) $isOwner;
        return $this;
    }

    /**
     * Set is admin.
     *
     * @param  bool $isAdmin
     * @return self
     */
    final public function setIsAdmin(bool $isAdmin = null): self
    {
        $this->isAdmin = (bool) $isAdmin;
        return $this;
    }

    /**
     * Set image path.
     *
     * @param  string $imgPath
     * @return self
     */
    final public function setImgPath(string $imgPath = null): self
    {
        $this->imgPath = (string) $imgPath;
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
     * Get username.
     *
     * @return string
     */
    final public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get full name.
     *
     * @return string
     */
    final public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * Get first name.
     *
     * @return string
     */
    final public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Get last name.
     *
     * @return string
     */
    final public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Get is owner.
     *
     * @return bool
     */
    final public function getIsOwner(): bool
    {
        return $this->isOwner;
    }

    /**
     * Get is admin.
     *
     * @return bool
     */
    final public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * Get image path.
     *
     * @return string
     */
    final public function getImgPath(): string
    {
        return $this->imgPath;
    }
}
