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
    final public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
    final public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;
        return $this;
    }
    final public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }
    final public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }
    final public function setIsOwner(bool $isOwner): self
    {
        $this->isOwner = $isOwner;
        return $this;
    }
    final public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
    final public function setImgPath(string $imgPath): self
    {
        $this->imgPath = $imgPath;
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
