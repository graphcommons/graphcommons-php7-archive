<?php
namespace GraphCommons;

use GraphCommons\GraphCommons;
use GraphCommons\GraphCommonsApiException;
use GraphCommons\Util\Util;
use GraphCommons\Graph\Graph;
use GraphCommons\Graph\Entity\Image as GraphImage;
use GraphCommons\Graph\Entity\License as GraphLicense;
use GraphCommons\Graph\Entity\Layout as GraphLayout;
use GraphCommons\Graph\Entity\{User as GraphUser, Users as GraphUsers};

final class GraphCommonsApi
{
    final public function __construct(GraphCommons $graphCommons)
    {
        $this->graphCommons = $graphCommons;
    }

    final public function status()
    {
        $response = $this->graphCommons->client->get('/status');
        if ($response->ok()) {
            return $response->getBodyData();
        }
        return null;
    }

    final public function graph(string $id): Graph
    {
        $response = $this->graphCommons->client->get('/graphs/'. $id);
        if (!$response->ok()) {
            $exception = Util::getResponseException($response);
            throw new GraphCommonsApiException(
                $exception['message'],
                $exception['code']
            );
        }
        $graph = new Graph();
        $graph->setReadonly(false);
        if (!empty($responseData = $response->getBodyData())) {
            $g =& $responseData['graph'];
            $graph->id = $g['id'];
            $graph->name = $g['name'];
            $graph->subtitle = $g['subtitle'];
            $graph->description = $g['description'];
            $graph->createdAt = $g['created_at'];
            $graph->updatedAt = $g['updated_at'];
            $graph->status = $g['status'];

            $image = new GraphImage($graph);
            $image->setPath($g['image']['path']);
            $image->setRefName($g['image']['ref_name']);
            $image->setRefUrl($g['image']['ref_url']);
            $graph->setImage($image);

            $license = new GraphLicense($graph);
            $license->setType($g['license']['type']);
            $license->setCcBy($g['license']['cc_by']);
            $license->setCcSa($g['license']['cc_sa']);
            $license->setCcNd($g['license']['cc_nd']);
            $license->setCcNc($g['license']['cc_nc']);
            $graph->setLicense($license);

            $layout = new GraphLayout($graph);
            $layout->setSpringLength($g['layout']['springLength']);
            $layout->setGravity($g['layout']['gravity']);
            $layout->setSpringCoeff($g['layout']['springCoeff']);
            $layout->setDragCoeff($g['layout']['dragCoeff']);
            $layout->setTheta($g['layout']['theta']);
            $layout->setAlgorithm($g['layout']['algorithm']);
            $layout->setTransform($g['layout']['transform']);
            $graph->setLayout($layout);

            $users = new GraphUsers();
            foreach ($g['users'] as $gu) {
                $user = new GraphUser();
                $user->setId($gu['id']);
                $user->setUsername($gu['username']);
                $user->setFullname($gu['fullname']);
                $user->setFirstName($gu['first_name']);
                $user->setLastName($gu['last_name']);
                $user->setIsOwner($gu['is_owner']);
                $user->setIsAdmin($gu['is_admin']);
                $user->setImgPath($gu['img_path']);
                $users->set($user);
            }
            $graph->setUsers($users);
        }
        // var_dump($graph); die();

        return $graph;
    }
}
