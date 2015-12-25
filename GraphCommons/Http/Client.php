<?php
namespace GraphCommons\Http;

use GraphCommons\GraphCommons;
use GraphCommons\Util\Property;
use GraphCommons\Http\Request;
use GraphCommons\Http\Response;

final class Client
{
    use Property;

    private $graphCommons;
    private $request;
    private $response;

    private $config = array(
        'blocking' => true,
        'timeout_read' => 5,
        'timeout_connection' => 5,
    );

    final public function __construct(GraphCommons $graphCommons, array $config = []) {
        $this->graphCommons = $graphCommons;
        $this->request = new Request();
        $this->response = new Response();
        $this->config = array_merge($this->config, $config);
    }

    final public function getRequest(): Request
    {
        return $this->request;
    }
    final public function getResponse(): Response
    {
        return $this->response;
    }
}
