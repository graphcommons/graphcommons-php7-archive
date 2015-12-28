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
namespace GraphCommons;

use GraphCommons\GraphCommons;
use GraphCommons\GraphCommonsApiException;
use GraphCommons\Util\Util;
use GraphCommons\Util\{Json, JsonException};
use GraphCommons\Graph\Graph;
use GraphCommons\Graph\{Signal, SignalCollection};
use GraphCommons\Graph\Entity\Image as GraphImage;
use GraphCommons\Graph\Entity\License as GraphLicense;
use GraphCommons\Graph\Entity\Layout as GraphLayout;
use GraphCommons\Graph\Entity\{
    User as GraphUser, Users as GraphUsers
};
use GraphCommons\Graph\Entity\{
    Node as GraphNode, Nodes as GraphNodes,
    NodeType as GraphNodeType, NodeTypes as GraphNodeTypes
};
use GraphCommons\Graph\Entity\{
    Edge as GraphEdge, Edges as GraphEdges,
    EdgeType as GraphEdgeType, EdgeTypes as GraphEdgeTypes
};

/**
 * @package GraphCommons
 * @object  GraphCommons\GraphCommonsApi
 * @uses    GraphCommons\GraphCommons,
 *          GraphCommons\GraphCommonsApiException,
 *          GraphCommons\Util\Util,
 *          GraphCommons\Util\Json, GraphCommons\Util\JsonException,
 *          GraphCommons\Graph\Graph,
 *          GraphCommons\Graph\Signal, GraphCommons\Graph\SignalCollection,
 *          GraphCommons\Graph\Entity\Image,
 *          GraphCommons\Graph\Entity\License,
 *          GraphCommons\Graph\Entity\Layout,
 *          GraphCommons\Graph\Entity\User, GraphCommons\Graph\Entity\Users,
 *          GraphCommons\Graph\Entity\Node, GraphCommons\Graph\Entity\Nodes,
 *          GraphCommons\Graph\Entity\NodeType, GraphCommons\Graph\Entity\NodeTypes,
 *          GraphCommons\Graph\Entity\Edge, GraphCommons\Graph\Entity\Edges,
 *          GraphCommons\Graph\Entity\EdgeType, GraphCommons\Graph\Entity\EdgeTypes
 * @author  Kerem Güneş <qeremy@gmail.com>
 */
final class GraphCommonsApi
{
    /**
     * Constructor.
     *
     * @param GraphCommons\GraphCommons $graphCommons
     */
    final public function __construct(GraphCommons $graphCommons)
    {
        $this->graphCommons = $graphCommons;
    }

    /**
     * Ping API.
     *
     * @return array
     * @throws GraphCommons\GraphCommonsApiException
     */
    final public function status(): array
    {
        $response = $this->graphCommons->client->get('/status');
        if (!$response->ok()) {
            $fail = $response->getFail();
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        return $response->getBodyData();
    }

    /**
     * Get a graph.
     *
     * @param  string $id
     * @return GraphCommons\Graph\Graph
     * @throws GraphCommons\GraphCommonsApiException
     */
    final public function getGraph(string $id): Graph
    {
        $response = $this->graphCommons->client->get('/graphs/'. $id);
        if (!$response->ok()) {
            $fail = $response->getFail();
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        // this part is fully oop way for easy data manipulation
        $graph = new Graph();

        $g = $response->getBodyData('graph');
        if (!empty($g)) {
            // covert json graph to object
            $g = Util::toObject($g);

            // set base properties
            $graph->setId($g->id)
                ->setName($g->name)
                ->setSubtitle($g->subtitle)
                ->setDescription($g->description)
                ->setCreatedAt($g->created_at)
                ->setUpdatedAt($g->updated_at)
                ->setStatus($g->status);

            // set graph image as GraphCommons\Graph\Entity\Image
            $image = (new GraphImage($graph))
                ->setPath($g->image->path)
                ->setRefName($g->image->ref_name)
                ->setRefUrl($g->image->ref_url);
            $graph->setImage($image);

            // set graph license as GraphCommons\Graph\Entity\License
            $license = (new GraphLicense($graph))
                ->setType($g->license->type)
                ->setCcBy($g->license->cc_by)
                ->setCcSa($g->license->cc_sa)
                ->setCcNd($g->license->cc_nd)
                ->setCcNc($g->license->cc_nc);
            $graph->setLicense($license);

            // set graph layout as GraphCommons\Graph\Entity\Layout
            $layout = (new GraphLayout($graph))
                ->setSpringLength($g->layout->springLength)
                ->setGravity($g->layout->gravity)
                ->setSpringCoeff($g->layout->springCoeff)
                ->setDragCoeff($g->layout->dragCoeff)
                ->setTheta($g->layout->theta)
                ->setAlgorithm($g->layout->algorithm)
                ->setTransform($g->layout->transform);
            $graph->setLayout($layout);

            // set graph users as GraphCommons\Graph\Entity\Users
            $graph->setUsers(new GraphUsers());
            if (!empty($g->users)) foreach ($g->users as $_) {
                $id = trim($_->id);
                if ($id != '') {
                    $user = (new GraphUser($graph))
                        ->setId($id)
                        ->setUsername($_->username)
                        ->setFullName($_->fullname)
                        ->setFirstName($_->first_name)
                        ->setLastName($_->last_name)
                        ->setIsOwner($_->is_owner)
                        ->setIsAdmin($_->is_admin)
                        ->setImgPath($_->img_path);
                    $graph->users->set($id, $user);
                }
            }

            // set graph nodes as GraphCommons\Graph\Entity\Nodes
            $graph->setNodes(new GraphNodes());
            if (!empty($g->nodes)) foreach ($g->nodes as $_) {
                $id = trim($_->id);
                if ($id != '') {
                    $node = (new GraphNode($graph))
                        ->setId($id)
                        ->setTypeId($_->type_id)
                        ->setName($_->name)
                        ->setDescription($_->description)
                        ->setImage($_->image)
                        ->setReference($_->reference)
                        ->setProperties($_->properties)
                        ->setPosXY($_->pos_x, $_->pos_y);
                    $graph->nodes->set($id, $node);
                }
            }

            // set graph nodes types as GraphCommons\Graph\Entity\NodeTypes
            $graph->setNodeTypes(new GraphNodeTypes());
            if (!empty($g->nodeTypes)) foreach ($g->nodeTypes as $_) {
                $id = trim($_->id);
                if ($id != '') {
                    $nodeType = (new GraphNodeType($graph))
                        ->setId($id)
                        ->setName($_->name)
                        ->setNameAlias($_->name_alias)
                        ->setDescription($_->description)
                        ->setImage($_->image)
                        ->setImageAsIcon((bool) $_->image_as_icon)
                        ->setColor($_->color)
                        ->setProperties($_->properties)
                        ->setHideName((bool) $_->hide_name)
                        ->setSize($_->size)
                        ->setSizeLimit($_->size_limit);
                    $graph->nodeTypes->set($id, $nodeType);
                }
            }

            // set graph edges as GraphCommons\Graph\Entity\Edges
            $graph->setEdges(new GraphEdges());
            if (!empty($g->edges)) foreach ($g->edges as $_) {
                $id = trim($_->id);
                if ($id != '') {
                    $edge = (new GraphEdge($graph))
                        ->setId($id)
                        ->setName($_->name)
                        ->setUserId($_->user_id)
                        ->setTypeId($_->type_id)
                        ->setFrom($_->from)
                        ->setTo($_->to)
                        ->setWeight($_->weight)
                        ->setDirected($_->directed)
                        ->setProperties($_->properties);
                    $graph->edges->set($id, $edge);
                }
            }

            // set graph edge types as GraphCommons\Graph\Entity\EdgeTypes
            $graph->setEdgeTypes(new GraphEdgeTypes());
            if (!empty($g->edgeTypes)) foreach ($g->edgeTypes as $_) {
                $id = trim($_->id);
                if ($id != '') {
                    $nodeType = (new GraphEdgeType($graph))
                        ->setId($id)
                        ->setName($_->name)
                        ->setNameAlias($_->name_alias)
                        ->setDescription($_->description)
                        ->setWeighted($_->weighted)
                        ->setDirected($_->directed)
                        ->setDurational($_->durational)
                        ->setColor($_->color)
                        ->setProperties($_->properties);
                    $graph->edgeTypes->set($id, $nodeType);
                }
            }
        }

        // set/update each entity's original object
        if (isset($graph->nodes)) foreach ($graph->nodes as $id => $node) {
            // set/update node type
            $nodeType = $graph->nodeTypes->get($node->typeId);
            if (!empty($nodeType)) {
                $node->setType($nodeType);
            }
        }
        if (isset($graph->edges)) foreach ($graph->edges as $id => $edge) {
            // set/update edge type
            $edgeType = $graph->edgeTypes->get($edge->typeId);
            if (!empty($edgeType)) {
                $edge->setType($edgeType);
            }
            // set/update edge type
            $user = $graph->users->get($edge->userId);
            if (!empty($user)) {
                $edge->setUser($user);
            }
            // set/update from node
            $fromNode = $graph->nodes->get($edge->from);
            if (!empty($fromNode)) {
                $edge->setFromNode($fromNode);
            }
            // set/update to node
            $toNode = $graph->nodes->get($edge->to);
            if (!empty($toNode)) {
                $edge->setToNode($toNode);
            }
        }

        return $graph;
    }

    /**
     * Add a new graph.
     *
     * @param  GraphCommons\Graph\Graph|array $body
     * @return GraphCommons\Graph\Graph
     * @throws GraphCommons\GraphCommonsApiException
     */
    final public function addGraph($body): Graph
    {
        $body = $this->serializeBody($body);

        $response = $this->graphCommons->client->post('/graphs', null, $body);
        if (!$response->ok()) {
            $fail = $response->getFail();
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        return $this->fillGraph(new Graph(), $response->getBodyData('graph'));
    }

    /**
     * Add a new graph signal.
     *
     * @param  string $id Graph UUID
     * @param  GraphCommons\Graph\SignalCollection $body
     * @return GraphCommons\Graph\Graph
     * @throws GraphCommons\GraphCommonsApiException
     */
    final public function addGraphSignal(string $id, SignalCollection $body): Graph
    {
        $body = $this->serializeBody($body);

        $response = $this->graphCommons->client->put('/graphs/'. $id .'/add', null, $body);
        if (!$response->ok()) {
            $fail = $response->getFail();
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        return $this->fillGraph(new Graph(), $response->getBodyData('graph'));
    }

    /**
     * Get a graph node.
     *
     * @param  string $id
     * @return GraphCommons\Graph\Entity\Node
     * @throws GraphCommons\GraphCommonsApiException
     */
    final public function getNode(string $id): GraphNode
    {
        $response = $this->graphCommons->client->get('/nodes/'. $id);
        if (!$response->ok()) {
            $fail = $response->getFail();
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        return $this->fillNode(new GraphNode(), $response->getBodyData('node'));
    }

    /**
     * Get graph nodes.
     *
     * @param  array  $query
     * @return GraphCommons\Graph\Entity\Nodes
     * @throws GraphCommons\GraphCommonsApiException
     */
    final public function getNodes(array $query): GraphNodes
    {
        $response = $this->graphCommons->client->get('/nodes/search', $query);
        if (!$response->ok()) {
            $fail = $response->getFail();
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        $nodes = new GraphNodes();

        // fill and add all nodes to node list
        if (!empty($nn = $response->getBodyData('nodes'))) foreach ($nn as $n) {
            $nodes->add($n['id'], $this->fillNode(new GraphNode(), $n));
        }

        return $nodes;
    }

    /**
     * Serialize request body as JSON.
     *
     * @param  GraphCommons\Graph\Graph|array $body
     * @return string
     * @throws GraphCommons\Util\JsonException
     */
    final private function serializeBody($body): string
    {
        // check body if lib's object
        if (is_object($body) && method_exists($body, 'serialize')) {
            return $body->serialize();
        }

        $json = new Json($body);
        if ($json->hasError()) {
            $jsonError = $json->getError();
            throw new JsonException(sprintf(
                'JSON error: code(%d) message(%s)',
                $jsonError['code'], $jsonError['message']
            ),  $jsonError['code']);
        }

        return (string) $json->encode();
    }

    /**
     * Fill a lib's graph object.
     *
     * @param  GraphCommons\Graph\Graph $graph
     * @param  array|object $g
     * @return GraphCommons\Graph\Graph
     */
    final private function fillGraph(Graph $graph, $g): Graph
    {
        // force input being an object
        $g = Util::toObject($g);

        if (isset($g->id)) {
            $graph->setId($g->id)
                ->setName($g->name)
                ->setDescription($g->description)
                ->setSubtitle($g->subtitle)
                ->setStatus($g->status)
                ->setCreatedAt($g->created_at);

            // add signals if exists
            if (isset($g->signals)) {
                $array = array();
                foreach ($g->signals as $i => $signal) {
                    $action = $signal->action;
                    unset($signal->action);
                    $array[$i]['action'] = Signal::detectAction($action);
                    $array[$i]['parameters'] = Util::toArray($signal);
                }
                $graph->setSignals(SignalCollection::fromArray($array));
            }
        }

        return $graph;
    }

    /**
     * Fill a lib's node object.
     *
     * @param  GraphCommons\Graph\Entity\GraphNode $node
     * @param  array|object $g
     * @return GraphCommons\Graph\Entity\GraphNode
     */
    final public function fillNode(GraphNode $node, $n): GraphNode
    {
        // force input being an object
        $n = Util::toObject($n);

        if (isset($n->id)) {
            $node->setId($n->id)
                ->setName($n->name)
                ->setDescription($n->description);

            // add suspected (nullable) properties
            if (isset($n->image)) {
                $node->setImage($n->image);
            }
            if (isset($n->created_at)) {
                $node->setCreatedAt($n->created_at);
            }
            if (isset($n->updated_at)) {
                $node->setUpdatedAt($n->updated_at);
            }
            if (isset($n->properties)) {
                $node->setProperties($n->properties);
            }
            if (isset($n->hubs, $n->users, $n->graphs, $n->graphs_count)) {
                $node->setHubs((array) $n->hubs)
                    ->setUsers((array) $n->users)
                    ->setGraphs((array) $n->graphs)
                    ->setGraphsCount($n->graphs_count);
            }

            // add node type as GraphCommons\Graph\Entity\NodeType
            $nodeType = new GraphNodeType();
            if (isset($n->nodetype)) {
                $nodeType->setId($n->nodetype->id)
                    ->setName($n->nodetype->name)
                    ->setColor($n->nodetype->color);
                $node->setTypeId($n->nodetype->id);
            } elseif (isset($n->type, $n->type_id)) {
                $nodeType->setId($n->type_id)
                    ->setName($n->type);
                $node->setTypeId($n->type_id);
            }
            $node->setType($nodeType);
        }

        return $node;
    }
}
