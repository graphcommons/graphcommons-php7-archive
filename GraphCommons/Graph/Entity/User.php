<?php
namespace GraphCommons\Graph\Entity;

use GraphCommons\Graph\GraphEntity;

final class User extends GraphEntity
{
    private $id;
    private $username;
    private $fullname;
    private $firstName;
    private $lastName;
    private $isOwner;
    private $isAdmin;
    private $imgPath;

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setUsername(string $username = null): self
    {
        $this->username = (string) $username;
        return $this;
    }
    final public function setFullname(string $fullname = null): self
    {
        $this->fullname = (string) $fullname;
        return $this;
    }
    final public function setFirstName(string $firstName = null): self
    {
        $this->firstName = (string) $firstName;
        return $this;
    }
    final public function setLastName(string $lastName = null): self
    {
        $this->lastName = (string) $lastName;
        return $this;
    }
    final public function setIsOwner(bool $isOwner = null): self
    {
        $this->isOwner = (bool) $isOwner;
        return $this;
    }
    final public function setIsAdmin(bool $isAdmin = null): self
    {
        $this->isAdmin = (bool) $isAdmin;
        return $this;
    }
    final public function setImgPath(string $imgPath = null): self
    {
        $this->imgPath = (string) $imgPath;
        return $this;
    }

    final public function getId(): string
    {
        return $this->id;
    }
    final public function getUsername(): string
    {
        return $this->username;
    }
    final public function getFullname(): string
    {
        return $this->fullname;
    }
    final public function getFirstName(): string
    {
        return $this->firstName;
    }
    final public function getLastName(): string
    {
        return $this->lastName;
    }
    final public function getIsOwner(): bool
    {
        return $this->isOwner;
    }
    final public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }
    final public function getImgPath(): string
    {
        return $this->imgPath;
    }
}
