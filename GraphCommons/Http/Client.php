<?php
namespace GraphCommons\Http;

use GraphCommons\Http\Request;
use GraphCommons\Http\Response;

final class Client
{
    private $request;
    private $response;

    final public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
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
