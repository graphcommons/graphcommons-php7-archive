<?php
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

final class GraphCommonsApi
{
    final public function __construct(GraphCommons $graphCommons)
    {
        $this->graphCommons = $graphCommons;
    }

    final public function status()
    {
        $response = $this->graphCommons->client->get('/status');
        if (!$response->ok()) {
            return null;
        }
        return $response->getBodyData();
    }

    final public function getGraph(string $id): Graph
    {
        $response = $this->graphCommons->client->get('/graphs/'. $id);
        $responseData = $response->getBodyData();
        if (!$response->ok()) {
            $exception = Util::getResponseException($response);
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $exception['code'], $exception['message']
            ),  $exception['code']);
        }

        $graph = new Graph();

        if (!empty($responseData)) {
            $g =& $responseData->graph;
            $graph->setId($g->id)
                ->setName($g->name)
                ->setSubtitle($g->subtitle)
                ->setDescription($g->description)
                ->setCreatedAt($g->created_at)
                ->setUpdatedAt($g->updated_at)
                ->setStatus($g->status)
            ;

            $image = (new GraphImage($graph))
                ->setPath($g->image->path)
                ->setRefName($g->image->ref_name)
                ->setRefUrl($g->image->ref_url)
            ; $graph->setImage($image);

            $license = (new GraphLicense($graph))
                ->setType($g->license->type)
                ->setCcBy($g->license->cc_by)
                ->setCcSa($g->license->cc_sa)
                ->setCcNd($g->license->cc_nd)
                ->setCcNc($g->license->cc_nc)
            ; $graph->setLicense($license);

            $layout = (new GraphLayout($graph))
                ->setSpringLength($g->layout->springLength)
                ->setGravity($g->layout->gravity)
                ->setSpringCoeff($g->layout->springCoeff)
                ->setDragCoeff($g->layout->dragCoeff)
                ->setTheta($g->layout->theta)
                ->setAlgorithm($g->layout->algorithm)
                ->setTransform($g->layout->transform)
            ; $graph->setLayout($layout);

            $graph->setUsers(new GraphUsers());
            if (!empty($g->users)) foreach ($g->users as $_) {
                $id = trim($_->id);
                if ($id != '') {
                    $user = (new GraphUser($graph))
                        ->setId($id)
                        ->setUsername($_->username)
                        ->setFullname($_->fullname)
                        ->setFirstName($_->first_name)
                        ->setLastName($_->last_name)
                        ->setIsOwner($_->is_owner)
                        ->setIsAdmin($_->is_admin)
                        ->setImgPath($_->img_path)
                    ; $graph->users->set($id, $user);
                }
            }

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
                        ->setPosXY($_->pos_x, $_->pos_y)
                    ; $graph->nodes->set($id, $node);
                }
            }

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
                        ->setSizeLimit($_->size_limit)
                    ; $graph->nodeTypes->set($id, $nodeType);
                }
            }

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
                        ->setProperties($_->properties)
                    ; $graph->edges->set($id, $edge);
                }
            }

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
                        ->setProperties($_->properties)
                    ; $graph->edgeTypes->set($id, $nodeType);
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

    final public function postGraph($body): Graph
    {
        if ($data instanceof Graph) {
            $body = $data->serialize();
        } else {
            $json = new Json($data);
            if ($json->hasError()) {
                $jsonError = $json->getError();
                throw new JsonException(sprintf(
                    'JSON error: code(%d) message(%s)',
                    $jsonError['code'], $jsonError['message']
                ),  $jsonError['code']);
            }
            $body = (string) $json->encode();
        }

        $response = $this->graphCommons->client->post('/graphs', null, $body);
        if (!$response->ok()) {
            $exception = Util::getResponseException($response);
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $exception['code'], $exception['message']
            ),  $exception['code']);
        }

        $g =& $response->getBodyData('graph');

        $graph = new Graph();
        $graph->setId($g->id)
            ->setName($g->name)
            ->setDescription($g->description)
            ->setSubtitle($g->subtitle)
            ->setStatus($g->status)
            ->setCreatedAt($g->created_at)
        ;

        $array = array();
        if (isset($g->signals)) {
            foreach ($g->signals as $i => $signal) {
                $action = $signal->action;
                unset($signal->action);
                $array[$i]['action'] = Signal::detectAction($action);
                $array[$i]['parameters'] = Util::toArray($signal);
            }
            $graph->setSignals(SignalCollection::fromArray($array));
        }

        return $graph;
    }

    final public function putGraph(string $id, $body): Graph
    {
        if ($data instanceof Graph) {
            $body = $data->serialize();
        } else {
            $json = new Json($data);
            if ($json->hasError()) {
                $jsonError = $json->getError();
                throw new JsonException(sprintf(
                    'JSON error: code(%d) message(%s)',
                    $jsonError['code'], $jsonError['message']
                ),  $jsonError['code']);
            }
            $body = (string) $json->encode();
        }

        $response = $this->graphCommons->client->put('/graphs/'. $id .'/add', null, $body);
        if (!$response->ok()) {
            $exception = Util::getResponseException($response);
            throw new GraphCommonsApiException(sprintf('API error: code(%d) message(%s)',
                $exception['code'], $exception['message']
            ),  $exception['code']);
        }

        $g =& $response->getBodyData('graph');

        $graph = new Graph();
        $graph->setId($g->id)
            ->setName($g->name)
            ->setDescription($g->description)
            ->setSubtitle($g->subtitle)
            ->setStatus($g->status)
            ->setCreatedAt($g->created_at)
        ;

        $array = array();
        if (isset($g->signals)) {
            foreach ($g->signals as $i => $signal) {
                $action = $signal->action;
                unset($signal->action);
                $array[$i]['action'] = Signal::detectAction($action);
                $array[$i]['parameters'] = Util::toArray($signal);
            }
            $graph->setSignals(SignalCollection::fromArray($array));
        }

        return $graph;
    }
}
