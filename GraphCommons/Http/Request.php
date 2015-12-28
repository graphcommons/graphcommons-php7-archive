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

use GraphCommons\Http\Client;

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Http
 * @object     GraphCommons\Http\Request
 * @uses       GraphCommons\Htt\Client
 * @extends    GraphCommons\Htt\Stream
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Request extends Stream
{
    /**
     * Methods.
     * @const string
     */
    const METHOD_GET    = 'GET',
          METHOD_POST   = 'POST',
          METHOD_PUT    = 'PUT',
          // these methods are not supported yet by API
          METHOD_HEAD   = 'HEAD',
          METHOD_DELETE = 'DELETE';

    /**
     * Method.
     * @var string
     */
    private $method;

    /**
     * URI.
     * @var string
     */
    private $uri;

    /**
     * URI params.
     * @var array
     */
    private $uriParams = array();

    /**
     * Constructor.
     *
     * @param GraphCommons\Http\Client $client
     */
    final public function __construct(Client $client) {
        $this->client = $client;
        $this->setType(self::TYPE_REQUEST);
        $this->setHttpVersion(self::HTTP_VERSION);
    }

    /**
     * Set method.
     *
     * @param  string $method
     * @return self
     */
    final public function setMethod(string $method): self
    {
        $this->method = strtoupper($method);
        return $this;
    }

    /**
     * Set URI.
     *
     * @param  string $uri
     * @return self
     */
    final public function setUri(string $uri, array $uriParams = []): self
    {
        $this->uri = $uri;
        if (!empty($uriParams)) {
            $this->uri = trim($this->uri, '?') .'?'. http_build_query($uriParams);
            $this->setUriParams($uriParams);
        }

        return $this;
    }

    /**
     * Set URI param.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return self
     */
    final public function setUriParam(string $key, $value): self
    {
        $this->uriParams[$key] = $value;
        return $this;
    }

    /**
     * Set URI params.
     *
     * @param  string $uri
     * @return self
     */
    final public function setUriParams(array $uriParams = []): self
    {
        $this->uriParams = $uriParams;
        return $this;
    }

    /**
     * Get method.
     *
     * @return string
     */
    final public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get URI param.
     *
     * @param  string $key
     * @return mixed
     */
    final public function getUriParam(string $key)
    {
        return $this->uriParams[$key] ?? null;
    }

    /**
     * Get URI params.
     *
     * @return array
     */
    final public function getUriParams(): array
    {
        return $this->uriParams;
    }

    /**
     * Check status.
     *
     * @return bool
     */
    final public function ok(): bool
    {
        return !$this->isFail();
    }

    // @wait
    final public function toString(): string
    {}

    /**
     * Send!
     *
     * @return string|null
     */
    final public function send()
    {
        $url = parse_url($this->uri);

        // fix query
        $url['query'] = isset($url['query']) ? '?'. $url['query'] : '';

        // decide what protocol will be used
        $sockProt = 'tcp://';
        $sockPort = 80;
        if ($url['scheme'] == 'https') {
            $sockProt = 'ssl://';
            $sockPort = 443;
        }

        // easy boy..
        $sock =@ fsockopen(
            $sockProt . $url['host'],
            $sockPort,
            $this->failCode,
            $this->failText,
            $this->client->config['timeout_connection']
        );

        if (is_resource($sock)) {
            $headers = array();
            $headers['Host'] = $url['host'];
            $headers['Connection'] = 'close';
            foreach ($this->headers as $key => $value) {
                // actually remove header command
                if ($value !== null) {
                    $headers[$key] = $value;
                }
            }

            $send = '';
            $recv = '';

            $send .= sprintf("%s %s%s HTTP/%s\r\n",
                $this->method, $url['path'], $url['query'], $this->httpVersion);
            foreach ($headers as $key => $value) {
                $send .= sprintf("%s: %s\r\n", $key, $value);
            }
            $send .= "\r\n";
            $send .= $this->body;
            fwrite($sock, $send);

            // print whole send stream if debug open
            if ($this->client->config['debug']) {
                printf("%s\n", $send);
            }

            // apply timeout and blocking options
            stream_set_timeout($sock, $this->client->config['timeout_read']);
            stream_set_blocking($sock, $this->client->config['blocking']);
            $meta = stream_get_meta_data($sock);

            while (!feof($sock)) {
                // check timeout
                if ($meta['timed_out']) {
                    $this->failText = 'Timed out!';
                    break;
                }

                $recv .= fread($sock, 1024);

                // get meta again
                $meta = stream_get_meta_data($sock);
            }

            fclose($sock);

            // print whole recv stream if debug open
            if ($this->client->config['debug']) {
                printf("%s\n", $recv);
            }

            return $recv;
        }

        // error..
        return null;
    }
}
