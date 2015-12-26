<?php
namespace GraphCommons\Http;

use GraphCommons\Http\Client;

final class Request extends Stream
{
    const METHOD_GET    = 'GET',
          METHOD_POST   = 'POST',
          METHOD_PUT    = 'PUT',
          // these methods are not supported yet by GraphCommons API
          METHOD_HEAD   = 'HEAD',
          METHOD_DELETE = 'DELETE';

    private $method;
    private $uri;
    private $uriParams = array();

    final public function __construct(Client $client) {
        $this->client = $client;
        $this->setType(self::TYPE_REQUEST);
        $this->setHttpVersion(self::HTTP_VERSION);
    }

    final public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }
    final public function setUri(string $uri, array $uriParams = []): self
    {
        $this->uri = $uri;
        if (!empty($uriParams)) {
            $this->uri .= trim($this->uri, '?') .'?'. http_build_url($uriParams);
            $this->uriParams = $uriParams;
        }
        return $this;
    }

    final public function getMethod(): string
    {
        return $this->method;
    }
    final public function getUriParam(string $key)
    {
        return $this->uriParams[$key] ?? null;
    }
    final public function getUriParams(): array
    {
        return $this->uriParams;
    }

    final public function toString(): string
    {}

    final public function send()
    {
        $url = parse_url($this->uri);

        $url['query'] = isset($url['query']) ? '?'. $url['query'] : '';

        $sockProt = 'tcp://';
        $sockPort = 80;
        if ($url['scheme'] == 'https') {
            $sockProt = 'ssl://';
            $sockPort = 443;
        }

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

            return $recv;
        }

        return null;
    }
}
