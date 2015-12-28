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
namespace GraphCommons\Http;

use GraphCommons\GraphCommons;
use GraphCommons\Util\Util;
use GraphCommons\Util\PropertyTrait as Property;
use GraphCommons\Util\{Json, JsonException};
use GraphCommons\Http\{Request, Exception\Request as RequestException};
use GraphCommons\Http\{Response, Exception\Response as ResponseException};

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Http
 * @object     GraphCommons\Http\Client
 * @uses       GraphCommons\GraphCommons,
 *             GraphCommons\Util\Util,
 *             GraphCommons\Util\PropertyTrait,
 *             GraphCommons\Util\Json, GraphCommons\Util\JsonException,
 *             GraphCommons\Http\Request, GraphCommons\Http\Exception\Request,
 *             GraphCommons\Http\Response, GraphCommons\Http\Exception\Response
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Client
{
    /**
     * Property thing.
     * @trait GraphCommons\Util\PropertyTrait
     */
    use Property;

    /**
     * GraphCommons object.
     * @var GraphCommons\GraphCommons
     */
    private $graphCommons;

    /**
     * Request/response objects.
     * @var GraphCommons\Http\Request, GraphCommons\Http\Response
     */
    private $request, $response;

    /**
     * Default config options.
     * @var array
     */
    private $config = array(
        'debug' => false,
        'blocking' => true,
        'timeout_read' => 5,
        'timeout_connection' => 5,
    );

    /**
     * Constructor.
     *
     * @param GraphCommons\GraphCommons $graphCommons
     * @param array                     $config
     */
    final public function __construct(GraphCommons $graphCommons, array $config = []) {
        $this->graphCommons = $graphCommons;

        // overwrite user config options on defaults
        $this->config = array_merge($this->config, $config);

        $this->request = new Request($this);
        $this->response = new Response($this);

        // set initial headers
        $this->request->setHeader('Accept', 'application/json');
        $this->request->setHeader('User-Agent', sprintf(
            'GraphCommons-PHP/v%s (+https://github.com/qeremy/graphcommons-php)'
            , $this->graphCommons->getVersion()
        ));
        // set auth header
        $this->request->setHeader('Authentication', $this->graphCommons->getApiKey());
    }

    /**
     * Get request object.
     *
     * @return GraphCommons\Http\Request
     */
    final public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Get response object.
     *
     * @return GraphCommons\Http\Response
     */
    final public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * Perform a request.
     *
     * @param  string $uri
     * @param  array  $uriParams
     * @param  string $body
     * @param  array  $headers
     * @return GraphCommons\Http\Response
     * @throws \InvalidArgumentException,
     *         GraphCommons\Http\Exception\Request, GraphCommons\Util\JsonException
     */
    final public function request(
        string $uri, array $uriParams = null,
        string $body = '', array $headers = null): Response
    {
        // match for a valid request i.e: GET /foo
        preg_match('~^([a-z]+)\s+(/.*)~i', $uri, $match);
        if (!isset($match[1], $match[2])) {
            throw new \InvalidArgumentException('Usage: <REQUEST METHOD> <REQUEST URI>');
        }

        $uri = sprintf('%s/%s/%s',
            $this->graphCommons->apiUrl,
            $this->graphCommons->apiVersion,
            trim($match[2])
        );
        $uri = preg_replace('~(^|[^:])//+~', '\\1/', trim($uri, '/'));

        $this->request
            ->setMethod($match[1])
            ->setUri($uri, (array) $uriParams);

        if (!empty($headers)) {
            foreach ($headers as $key => $value) {
                $this->request->setHeader(trim($key), $value);
            }
        }

        $requestMethod = $this->request->getMethod();
        if ($requestMethod == Request::METHOD_POST ||
            $requestMethod == Request::METHOD_PUT
        ) {
            // set body stuff
            $body = trim($body);
            $bodyLength = strlen($body);
            $this->request->setBody($body);
            $this->request->setBodyLength($bodyLength);

            // set content headers stuff
            $this->request->setHeader('Content-Type', 'application/json');
            $this->request->setHeader('Content-Length', (string) $bodyLength);
        }

        $result = $this->request->send();
        if ($result === null) {
            $fail = $this->request->getFail();
            throw new RequestException(sprintf('HTTP error: code(%d) message(%s)',
                $fail['code'], $fail['message']
            ),  $fail['code']);
        }

        unset($headers, $body);

        // split headers/body pairs
        @ list($headers, $body) = explode("\r\n\r\n", $result, 2);
        if (!isset($headers)) {
            throw new ResponseException('No headers received from server!');
        }
        if (!isset($body)) {
            throw new ResponseException('No body received from server!');
        }

        // parse response headers
        $headers = Util::parseResponseHeaders($headers);
        if (isset($headers['status'])) {
            $this->response->setStatus($headers['status']);
            $this->response->setStatusCode($headers['status_code']);
            $this->response->setStatusText($headers['status_text']);
        }

        $this->response->setHeaders($headers);
        $this->response->setBody($body);

        $json = new Json($body);

        // render response body
        $bodyData = $json->decode(true);

        if ($json->hasError()) {
            $jsonError = $json->getError();
            throw new JsonException(sprintf(
                'JSON error: code(%d) message(%s)',
                $jsonError['code'], $jsonError['message']
            ),  $jsonError['code']);
        }

        $this->response->setBodyData($bodyData);

        return $this->response;
    }

    /**
     * Perform a GET request.
     *
     * @param  string $uri
     * @param  array  $uriParams
     * @param  array  headers
     * @return self.request()
     */
    final public function get($uri, array $uriParams = null, array $headers = null): Response
    {
        return $this->request(Request::METHOD_GET .' /'. $uri, $uriParams, '', $headers);
    }

    /**
     * Perform a POST request.
     *
     * @param  string $uri
     * @param  array  $uriParams
     * @param  string $body
     * @param  array  $headers
     * @return self.request()
     */
    final public function post($uri, array $uriParams = null, $body = '', array $headers = null): Response
    {
        return $this->request(Request::METHOD_POST .' /'. $uri, $uriParams, $body, $headers);
    }

    /**
     * Perform a PUT request.
     *
     * @param  string $uri
     * @param  array  $uriParams
     * @param  string $body
     * @param  array  $headers
     * @return self.request()
     */
    final public function put($uri, array $uriParams = null, $body = '', array $headers = null): Response
    {
        return $this->request(Request::METHOD_PUT .' /'. $uri, $uriParams, $body, $headers);
    }

    /**
     * @notimplemented
     */
    final public function head($uri, array $uriParams = null, array $headers = null): Response
    {
        throw new \RuntimeException('HEAD method not implemented yet on API side!');
    }

    /**
     * @notimplemented
     */
    final public function delete($uri, array $uriParams = null, array $headers = null): Response
    {
        throw new \RuntimeException('DELETE method not implemented yet on API side!');
    }
}
