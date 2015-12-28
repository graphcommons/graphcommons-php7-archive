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
namespace GraphCommons\Util;

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Util
 * @object     GraphCommons\Util\Json
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Json
{
    /**
     * Data hodler.
     * @var mixed
     */
    private $data;

    /**
     * Error code.
     * @var int
     */
    private $errorCode = 0;

    /**
     * Error message.
     * @var string
     */
    private $errorMessage = '';

    /**
     * Error message map.
     * @var array
     */
    private static $errorMessages = array(
        JSON_ERROR_NONE           => '',
        JSON_ERROR_DEPTH          => 'Maximum stack depth exceeded',
        JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
        JSON_ERROR_CTRL_CHAR      => 'Unexpected control character found',
        JSON_ERROR_SYNTAX         => 'Syntax error, malformed JSON',
        JSON_ERROR_UTF8           => 'Malformed UTF-8 characters, possibly incorrectly encoded',
    );

    /**
     * Constructor.
     *
     * @param mixed $data
     */
    final public function __construct($data = null)
    {
        $this->setData($data);
    }

    /**
     * Set data.
     *
     * @param  mixed $data
     * @return self
     */
    final public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data.
     *
     * @return mixed
     */
    final public function getData($data)
    {
        return $this->data;
    }

    /**
     * Encoder.
     *
     * @param  array $args
     * @return string
     */
    final public function encode(...$args): string
    {
        // add data as first arg
        array_unshift($args, $this->data);

        // remove useless second arg if empty
        $args = array_filter($args);

        $return = call_user_func_array('json_encode', $args);
        if ($return === false) {
            $this->setError();
        }

        return $return;
    }

    /**
     * Decoder.
     *
     * @param  array $args
     * @return mixed
     */
    final public function decode(...$args)
    {
        if ($this->data === '') {
            return null;
        }

        // add data as first arg
        array_unshift($args, $this->data);

        // remove useless second arg if empty
        $args = array_filter($args);

        $return = call_user_func_array('json_decode', $args);
        if (json_last_error()) {
            $this->setError();
        }

        return $return;
    }

    /**
     * Check error.
     *
     * @return bool
     */
    final public function hasError(): bool
    {
        return ($this->errorCode > 0);
    }

    /**
     * Set error.
     */
    final private function setError()
    {
        $this->errorCode = json_last_error();
        if ($this->errorCode) {
            $this->errorMessage = array_key_exists($this->errorCode, self::$errorMessages)
                ? self::$errorMessages[$this->errorCode]
                : 'unknown error'; // default
        }
    }

    /**
     * Get error.
     *
     * @return array
     */
    final public function getError(): array
    {
        return array(
            'code' => $this->errorCode,
            'message' => $this->errorMessage,
        );
    }

    /**
     * Get error code.
     *
     * @return int
     */
    final public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * Get error message.
     *
     * @return string
     */
    final public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
