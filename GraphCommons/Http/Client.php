<?php
namespace GraphCommons\Http;

use GraphCommons\GraphCommons;
use GraphCommons\Util\Util;
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
        $this->config = array_merge($this->config, $config);
        $this->request = new Request($this);
        $this->response = new Response($this);
        // set accept, user-agent header
        $this->request->setHeader('Accept', 'application/json');
        $this->request->setHeader('User-Agent', sprintf(
            'GraphCommons/v%s (+https://github.com/qeremy/graphcommons-php)'
            , $this->graphCommons->getVersion()
        ));
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
        string $body = '', array $headers = null): Response
    {
        // match for a valid request i.e: GET /foo
        preg_match('~^([a-z]+)\s+(/.*)~i', $uri, $match);
        if (!isset($match[1], $match[2])) {
            throw new \Exception('Usage: <REQUEST METHOD> <REQUEST URI>');
        }

        $uri = sprintf('%s/%s/%s',
            $this->graphCommons->apiUrl,
            $this->graphCommons->apiVersion,
            trim($match[2])
        );
        $uri = preg_replace('~(^|[^:])//+~', '\\1/', trim($uri, '/'));

        $this->request
            ->setMethod(strtoupper($match[1]))
            ->setUri($uri, (array) $uriParams);

        if (!empty($headers)) {
            foreach ($headers as $key => $value) {
                $this->request->setHeader(trim($key), trim($value));
            }
        }

        $this->request->setBody($body);

        $result = $this->request->send();
        if ($result === null) {
            throw new \Exception('HTTP error: code(%s) text(%s)',
                $this->request->getFailCode(),
                $this->request->getFailText()
            );
        }

        @list($headers, $body) = explode("\r\n\r\n", $result, 2);
        if (!isset($headers)) {
            throw new \Exception('No headers received from server!');
        }
        if (!isset($body)) {
            throw new \Exception('No body received from server!');
        }

        $headers = Util::parseResponseHeaders($headers);

        $this->response->setHeaders($headers);
        $this->response->setBody($body);

        return $this->response;
    }

    final public function get($uri, array $uriParams = null, array $headers = null) {
        return $this->request(Request::METHOD_GET .' /'. $uri, $uriParams, null, $headers);
    }
    final public function post($uri, array $uriParams = null, $body = null, array $headers = null) {
        return $this->request(Request::METHOD_POST .' /'. $uri, $uriParams, $body, $headers);
    }
    final public function put($uri, array $uriParams = null, $body = null, array $headers = null) {
        return $this->request(Request::METHOD_PUT .' /'. $uri, $uriParams, $body, $headers);
    }
}
