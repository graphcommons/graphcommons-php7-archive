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

    final public function request(
        string $uri, array $uriParams = null,
        string $body = '', array $headers = null)
    {
        // match for a valid request i.e: HEAD /foo
        preg_match('~^([a-z]+)\s+(/.*)~i', $uri, $match);
        if (!isset($match[1], $match[2])) {
            throw new \Exception('Usage: <REQUEST METHOD> <REQUEST URI>');
        }

        $uri = sprintf('%s/%s/%s',
            $this->graphCommons->apiUrl,
            $this->graphCommons->apiVersion,
            trim($match[2])
        );
        $uri = preg_replace('~(^|[^:])//+~', '\\1/', $uri);

        $this->request
            ->setMethod(strtoupper($match[1]))
            ->setUri($uri, (array) $uriParams);
        if (!empty($headers)) {
            foreach ($headers as $key => $value) {
                $this->request->setHeader(trim($key), trim($value));
            }
        }

        $this->request->setBody($body);

        $this->request->send();
    }
}
