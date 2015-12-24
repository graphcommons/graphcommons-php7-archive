<?php
namespace Graphcommons\Http;

final class Request extends Stream
{
    const METHOD_GET    = 'GET',
          METHOD_POST   = 'POST',
          METHOD_PUT    = 'PUT',
          // these methods are not supported yet by Graphcommons
          METHOD_HEAD   = 'HEAD',
          METHOD_DELETE = 'DELETE';

    private $method;
    private $uri, $uriParams = array();

    final public function __construct() {
        $this->setType(self::TYPE_REQUEST);
        $this->setHttpVersion('1.0');
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
            $this->uri .= http_build_url($uriParams);
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

    final public function send(): self
    {}
}
