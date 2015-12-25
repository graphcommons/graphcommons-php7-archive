<?php
namespace GraphCommons\Http;

use GraphCommons\Http\Client;

final class Response extends Stream
{
    const STATUS_OK = 200,
          STATUS_BAD_REQUEST = 400,
          STATUS_UNAUTHORIZED = 401,
          STATUS_FORBIDDEN = 403,
          STATUS_NOT_FOUND = 404,
          STATUS_METHOD_NOT_ALLOWED = 405,
          STATUS_NOT_ACCEPTABLE = 406,
          STATUS_GONE = 410,
          STATUS_TOO_MANY_REQUESTS = 429,
          STATUS_INTERNAL_SERVER_ERROR = 500,
          STATUS_SERVICE_UNAVAILABLE = 503;
    private $status;
    private $statusCode;
    private $statusText;

    final public function __construct(Client $client) {
        $this->client = $client;
        $this->setType(self::TYPE_RESPONSE);
        $this->setHttpVersion(self::HTTP_VERSION);
    }

    final public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
    final public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    final public function setStatusText(string $statusText): self
    {
        $this->statusText = $statusText;
        return $this;
    }

    final public function getStatus(): string
    {
        return $this->status;
    }
    final public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    final public function getStatusText(): string
    {
        return $this->statusText;
    }

    final function toString(): string
    {}
}
