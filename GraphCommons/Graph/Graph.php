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
namespace GraphCommons\Graph;

use GraphCommons\Util\{PropertyTrait as Property, SerialTrait as Serial};
use GraphCommons\Graph\SignalCollection as Signals;
use GraphCommons\Graph\Entity\Image;
use GraphCommons\Graph\Entity\License;
use GraphCommons\Graph\Entity\Layout;
use GraphCommons\Graph\Entity\Users;
use GraphCommons\Graph\Entity\{Nodes, NodeTypes};
use GraphCommons\Graph\Entity\{Edges, EdgeTypes};

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Graph
 * @object     GraphCommons\Graph\Graph
 * @uses       GraphCommons\Util\PropertyTrait, GraphCommons\Util\SerialTrait,
 *             GraphCommons\Graph\Entity\Image, GraphCommons\Graph\Entity\License,
 *             GraphCommons\Graph\Entity\Layout, GraphCommons\Graph\Entity\Users,
 *             GraphCommons\Graph\Entity\Nodes, GraphCommons\Graph\Entity\NodeTypes,
 *             GraphCommons\Graph\Entity\Edges, GraphCommons\Graph\Entity\EdgeTypes
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
class Graph
{
    /**
     * Property thing.
     * @trait GraphCommons\Util\PropertyTrait
     */
    use Property;

    /**
     * Serial thing.
     * @trait GraphCommons\Util\SerialTrait
     */
    use Serial;

    /**
     * Graph statuses.
     * @const int
     */
    const STATUS_DRAFT     = 0,
          STATUS_PUBLISHED = 1,
          STATUS_PRIVATE   = 2;

    /**
     * Graph ID.
     * @var string
     */
    private $id;

    /**
     * Graph name.
     * @var string
     */
    private $name;

    /**
     * Graph subtitle.
     * @var string
     */
    private $subtitle;

    /**
     * Graph description.
     * @var string
     */
    private $description;

    /**
     * Graph create/update dates.
     * @var string, string
     */
    private $createdAt, $updatedAt;

    /**
     * Graph status.
     * @var int
     */
    private $status;

    /**
     * Graph image object.
     * @var GraphCommons\Graph\Entity\Image
     */
    private $image;

    /**
     * Graph license object.
     * @var GraphCommons\Graph\Entity\License
     */
    private $license;

    /**
     * Graph layout object.
     * @var GraphCommons\Graph\Entity\Layout
     */
    private $layout;

    /**
     * Graph users object.
     * @var GraphCommons\Graph\Entity\Users
     */
    private $users;

    /**
     * Graph nodes, node types objects.
     * @var GraphCommons\Graph\Entity\Nodes, GraphCommons\Graph\Entity\NodeTypes
     */
    private $nodes, $nodeTypes;

    /**
     * Graph edges, edge types objects.
     * @var GraphCommons\Graph\Entity\Edges, GraphCommons\Graph\Entity\EdgeTypes
     */
    private $edges, $edgeTypes;

    /**
     * Graph signals object.
     * @var GraphCommons\Graph\SignalCollection
     */
    private $signals;

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
     * Set subtitle.
     *
     * @param  string $subtitle
     * @return self
     */
    final public function setSubtitle(string $subtitle = null): self
    {
        $this->subtitle = (string) $subtitle;
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
     * Set create date.
     *
     * @param  string $createdAt
     * @return self
     */
    final public function setCreatedAt(string $createdAt = null): self
    {
        $this->createdAt = (string) $createdAt;
        return $this;
    }

    /**
     * Set update date.
     *
     * @param  string $update
     * @return self
     */
    final public function setUpdatedAt(string $updatedAt = null): self
    {
        $this->updatedAt = (string) $updatedAt;
        return $this;
    }

    /**
     * Set status.
     *
     * @param  int $status
     * @return self
     */
    final public function setStatus(int $status = null): self
    {
        $this->status = (int) $status;
        return $this;
    }

    /**
     * Set image.
     *
     * @param  GraphCommons\Graph\Entity\Image $image
     * @return self
     */
    final public function setImage(Image $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Set license.
     *
     * @param  GraphCommons\Graph\Entity\License $license
     * @return self
     */
    final public function setLicense(License $license): self
    {
        $this->license = $license;
        return $this;
    }

    /**
     * Set layout.
     *
     * @param  GraphCommons\Graph\Entity\Layout $layout
     * @return self
     */
    final public function setLayout(Layout $layout): self
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Set users.
     *
     * @param  GraphCommons\Graph\Entity\Users $users
     * @return self
     */
    final public function setUsers(Users $users): self
    {
        $this->users = $users;
        return $this;
    }

    /**
     * Set nodes.
     *
     * @param  GraphCommons\Graph\Entity\Nodes $nodes
     * @return self
     */
    final public function setNodes(Nodes $nodes): self
    {
        $this->nodes = $nodes;
        return $this;
    }

    /**
     * Set node types.
     *
     * @param  GraphCommons\Graph\Entity\NodeTypes $nodeTypes
     * @return self
     */
    final public function setNodeTypes(NodeTypes $nodeTypes): self
    {
        $this->nodeTypes = $nodeTypes;
        return $this;
    }

    /**
     * Set edges.
     *
     * @param  GraphCommons\Graph\Entity\Edges $edges
     * @return self
     */
    final public function setEdges(Edges $edges): self
    {
        $this->edges = $edges;
        return $this;
    }

    /**
     * Set edge types.
     *
     * @param  GraphCommons\Graph\Entity\EdgeTypes $edgeTypes
     * @return self
     */
    final public function setEdgeTypes(EdgeTypes $edgeTypes): self
    {
        $this->edgeTypes = $edgeTypes;
        return $this;
    }

    /**
     * Set signals.
     *
     * @param  GraphCommons\Graph\SignalCollection $signals
     * @return self
     */
    final public function setSignals(Signals $signals): self
    {
        $this->signals = $signals;
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
     * Get subtitle.
     *
     * @return string
     */
    final public function getSubtitle(): string
    {
        return $this->subtitle;
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
     * Get create date.
     *
     * @return string
     */
    final public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * Get update date.
     *
     * @return string
     */
    final public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * Get status.
     *
     * @return int
     */
    final public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Get image.
     *
     * @return GraphCommons\Graph\Entity\Image
     */
    final public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * Get license.
     *
     * @return GraphCommons\Graph\Entity\License
     */
    final public function getLicense(): License
    {
        return $this->license;
    }

    /**
     * Get layout.
     *
     * @return GraphCommons\Graph\Entity\Layout
     */
    final public function getLayout(): Layout
    {
        return $this->layout;
    }

    /**
     * Get users.
     *
     * @return GraphCommons\Graph\Entity\Users
     */
    final public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * Get nodes.
     *
     * @return GraphCommons\Graph\Entity\Nodes
     */
    final public function getNodes(): Nodes
    {
        return $this->nodes;
    }

    /**
     * Get node types.
     *
     * @return GraphCommons\Graph\Entity\NodeTypes
     */
    final public function getNodeTypes(): NodeTypes
    {
        return $this->nodeTypes;
    }

    /**
     * Get edges.
     *
     * @return GraphCommons\Graph\Entity\EdgeTypes
     */
    final public function getEdges(): Edges
    {
        return $this->edges;
    }

    /**
     * Get edge types.
     *
     * @return GraphCommons\Graph\Entity\EdgeTypes
     */
    final public function getEdgeTypes(): EdgeTypes
    {
        return $this->edgeTypes;
    }

    /**
     * Get signals.
     *
     * @return GraphCommons\Graph\SignalCollection
     */
    final public function getSignals(): Signals
    {
        return $this->signals;
    }
}
