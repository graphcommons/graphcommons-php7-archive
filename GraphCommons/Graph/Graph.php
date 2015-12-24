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
    private $users = array();
    private $nodes = array(),
            $nodeTypes = array();
    private $edges = array(),
            $edgeTypes = array();

    final public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
    final public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    final public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }
    final public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }
    final public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    final public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    final public function setStatus(int $status): self
    {
        $this->status = $status;
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
    final public function setUsers(array $users): self
    {
        $this->users = $users;
        return $this;
    }
    final public function setNodes(array $nodes): self
    {
        $this->nodes = $nodes;
        return $this;
    }
    final public function setNodeTypes(array $nodeTypes): self
    {
        $this->nodeTypes = $nodeTypes;
        return $this;
    }
    final public function setEdges(array $edges): self
    {
        $this->edges = $edges;
        return $this;
    }
    final public function setEdgeTypes(EdgeTypes $edgeTypes): self
    {
        $this->edgeTypes = $edgeTypes;
        return $this;
    }
}
