<?php
namespace Graphcommons\Http;

final class Response extends Stream
{
    const STATUS = array(
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        410 => 'Gone',
        429 => 'Too Many Requests',
        500 => 'Internal Server Error',
        503 => 'Service Unavailable',
    );
    const BAD_REQUEST = 400,
          UNAUTHORIZED = 401,
          FORBIDDEN = 403,
          NOT_FOUND = 404,
          METHOD_NOT_ALLOWED = 405,
          NOT_ACCEPTABLE = 406,
          GONE = 410,
          TOO_MANY_REQUESTS = 429,
          INTERNAL_SERVER_ERROR = 500,
          SERVICE_UNAVAILABLE = 503;
    private $status;
    private $statusCode;
    private $statusText;

    final public function __construct() {
        $this->setType(self::TYPE_RESPONSE);
        $this->setHttpVersion('1.0');
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
