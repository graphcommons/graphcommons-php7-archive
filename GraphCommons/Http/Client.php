<?php
namespace GraphCommons\Http;

use GraphCommons\Http\Request;
use GraphCommons\Http\Response;

final class Client
{
    private $request;
    private $response;

    private $config = array(
        'blocking' => true,
        'timeout_read' => 5,
        'timeout_connection' => 5,
    );

    final public function __construct(array $config = []) {
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
