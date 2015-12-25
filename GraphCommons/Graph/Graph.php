<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Property;
use GraphCommons\Graph\Entity\Image;
use GraphCommons\Graph\Entity\License;
use GraphCommons\Graph\Entity\Layout;
use GraphCommons\Graph\Entity\Users;
use GraphCommons\Graph\Entity\{Nodes, NodeTypes};
use GraphCommons\Graph\Entity\{Edges, EdgeTypes};

class Graph
{
    use Property;
    private $id;
    private $name;
    private $subtitle;
    private $description;
    private $createdAt, $updatedAt;
    private $status;
    private $image;
    private $license;
    private $layout;
    private $users;
    private $nodes, $nodeTypes;
    private $edges, $edgeTypes;

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setName(string $name = null): self
    {
        $this->name = (string) $name;
        return $this;
    }
    final public function setSubtitle(string $subtitle = null): self
    {
        $this->subtitle = (string) $subtitle;
        return $this;
    }
    final public function setDescription(string $description = null): self
    {
        $this->description = (string) $description;
        return $this;
    }
    final public function setCreatedAt(string $createdAt = null): self
    {
        $this->createdAt = (string) $createdAt;
        return $this;
    }
    final public function setUpdatedAt(string $updatedAt = null): self
    {
        $this->updatedAt = (string) $updatedAt;
        return $this;
    }
    final public function setStatus(int $status = null): self
    {
        $this->status = (int) $status;
        return $this;
    }
    final public function setImage(Image $image): self
    {
        $this->image = $image;
        return $this;
    }
    final public function setLicense(License $license): self
    {
        $this->license = $license;
        return $this;
    }
    final public function setLayout(Layout $layout): self
    {
        $this->layout = $layout;
        return $this;
    }
    final public function setUsers(Users $users): self
    {
        $this->users = $users;
        return $this;
    }
    final public function setNodes(Nodes $nodes): self
    {
        $this->nodes = $nodes;
        return $this;
    }
    final public function setNodeTypes(NodeTypes $nodeTypes): self
    {
        $this->nodeTypes = $nodeTypes;
        return $this;
    }
    final public function setEdges(Edges $edges): self
    {
        $this->edges = $edges;
        return $this;
    }
    final public function setEdgeTypes(EdgeTypes $edgeTypes): self
    {
        $this->edgeTypes = $edgeTypes;
        return $this;
    }

    final public function getId(): string
    {
        return $this->id;
    }
    final public function getName(): string
    {
        return $this->name;
    }
    final public function getSubtitle(): string
    {
        return $this->subtitle;
    }
    final public function getDescription(): string
    {
        return $this->description;
    }
    final public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    final public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }
    final public function getStatus(): int
    {
        return $this->status;
    }
    final public function getImage(): Image
    {
        return $this->image;
    }
    final public function getLicense(): License
    {
        return $this->license;
    }
    final public function getLayout(): Layout
    {
        return $this->layout;
    }
    final public function getUsers(): Users
    {
        return $this->users;
    }
    final public function getNodes(): Nodes
    {
        return $this->nodes;
    }
    final public function getNodeTypes(): NodeTypes
    {
        return $this->nodeTypes;
    }
    final public function getEdges(): Edges
    {
        return $this->edges;
    }
    final public function getEdgeTypes(): EdgeTypes
    {
        return $this->edgeTypes;
    }
}
