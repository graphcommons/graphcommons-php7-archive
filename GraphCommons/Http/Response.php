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
 * @object     GraphCommons\Http\Response
 * @uses       GraphCommons\Htt\Client
 * @extends    GraphCommons\Htt\Stream
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Response extends Stream
{
    /**
     * Statuses.
     * @const int
     */
    const STATUS_OK                    = 200,
          STATUS_BAD_REQUEST           = 400,
          STATUS_UNAUTHORIZED          = 401,
          STATUS_FORBIDDEN             = 403,
          STATUS_NOT_FOUND             = 404,
          STATUS_METHOD_NOT_ALLOWED    = 405,
          STATUS_NOT_ACCEPTABLE        = 406,
          STATUS_GONE                  = 410,
          STATUS_TOO_MANY_REQUESTS     = 429,
          STATUS_INTERNAL_SERVER_ERROR = 500,
          STATUS_SERVICE_UNAVAILABLE   = 503;

    /**
     * Status.
     * @var string
     */
    private $status;

    /**
     * Status code.
     * @var int
     */
    private $statusCode;

    /**
     * Status text (reason phrase).
     * @var int
     */
    private $statusText;

    /**
     * Constructor.
     *
     * @param GraphCommons\Http\Client $client
     */
    final public function __construct(Client $client) {
        $this->client = $client;
        $this->setType(self::TYPE_RESPONSE);
        $this->setHttpVersion(self::HTTP_VERSION);
    }

    /**
     * Set status.
     *
     * @param  string $status
     * @return self
     */
    final public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set status code.
     *
     * @param  int $statusCode
     * @return self
     */
    final public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Set status text.
     *
     * @param  string $statusText
     * @return self
     */
    final public function setStatusText(string $statusText): self
    {
        $this->statusText = $statusText;
        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    final public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Get status code.
     *
     * @return int
     */
    final public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get status text.
     *
     * @return string
     */
    final public function getStatusText(): string
    {
        return $this->statusText;
    }

    /**
     * Check status.
     *
     * @return bool
     */
    final public function ok(): bool
    {
        return ($this->statusCode === self::STATUS_OK);
    }

    // @wait
    final function toString(): string
    {}
}
