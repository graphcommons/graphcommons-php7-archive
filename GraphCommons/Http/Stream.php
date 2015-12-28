<?php
namespace GraphCommons\Http;

use GraphCommons\GraphCommonsApiException as Exception;
use GraphCommons\Util\Util;

abstract class Stream
{
    const HTTP_VERSION = '1.0';
    const TYPE_REQUEST = 1,
          TYPE_RESPONSE = 2;
    protected $client;
    protected $type;
    protected $httpVersion;
    protected $headers = array();
    protected $body = '';
    protected $bodyLength = 0;
    protected $bodyData;
    protected $failCode = 0;
    protected $failText = '';

    final public function __toString(): string
    {
        return $this->toString();
    }

    final public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }
    final public function setHttpVersion(string $httpVersion): self
    {
        $this->httpVersion = $httpVersion;
        return $this;
    }
    final public function setHeader(string $key, $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }
    final public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }
    final public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }
    final public function setBodyLength(int $bodyLength): self
    {
        $this->bodyLength = $bodyLength;
        return $this;
    }
    final public function setBodyData($bodyData = null): self
    {
        $this->bodyData = $bodyData;
        return $this;
    }
    final public function setFailCode(int $failCode): self
    {
        $this->failCode = $failCode;
        return $this;
    }
    final public function setFailText(string $failText): self
    {
        $this->failText = $failText;
        return $this;
    }

    final public function getType(): int
    {
        return $this->type;
    }
    final public function getHttpVersion(): string
    {
        return $this->httpVersion;
    }
    final public function getHeader(string $key)
    {
        return $this->headers[$key] ?? null;
    }
    final public function getHeaders(): array
    {
        return $this->headers;
    }
    final public function getBody(): string
    {
        return $this->body;
    }
    final public function getBodyLength(): int
    {
        return $this->bodyLength;
    }
    final public function getBodyData(string $key = null, $value = null)
    {
        if ($key === null) {
            return $this->bodyData;
        }
        return Util::arrayDig($this->bodyData, $key, $value);
    }

    final public function getClient(): Client
    {
        return $this->client;
    }

    final public function isFail(): bool
    {
        return !($this->failCode === 0 && $this->failText === '');
    }

    final public function getFail(): array
    {
        $fail = array(
            'code' => Exception::UNKNOWN_ERROR_CODE,
            'message' => Exception::UNKNOWN_ERROR_MESSAGE,
        );

        if ($this->type == self::TYPE_REQUEST) {
            if ($this->isFail()) {
                $fail['code'] = $this->getFailCode();
                $fail['message'] = $this->getFailText();
            }
        } elseif ($this->type == self::TYPE_RESPONSE) {
            $bodyData = Util::toObject((array) $this->bodyData, false);
            // check first body for errors (differs by requests)
            if (isset($bodyData->msg)) {
                $fail['code'] = $this->getStatusCode();
                $fail['message'] = $bodyData->msg;
            } elseif (isset($bodyData->status, $bodyData->error)) {
                $fail['code'] = $bodyData->status;
                $fail['message'] = $bodyData->error;
            }
            // http error?
            elseif ($this->getStatusCode() >= 400) {
                $fail['code'] = $this->getStatusCode();
                $fail['message'] = $this->getStatusText();
            }
        }

        return $fail;
    }

    final public function getFailCode(): int
    {
        return $this->failCode;
    }
    final public function getFailText(): string
    {
        return $this->failText;
    }

    abstract public function ok(): bool;

    abstract public function toString(): string;
}
