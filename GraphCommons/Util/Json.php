<?php
namespace GraphCommons\Util;

final class Json
{
    private $data;
    private $errorCode = 0;
    private $errorMessage = '';
    private static $errorMessages = array(
        JSON_ERROR_NONE           => '',
        JSON_ERROR_DEPTH          => 'Maximum stack depth exceeded',
        JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
        JSON_ERROR_CTRL_CHAR      => 'Unexpected control character found',
        JSON_ERROR_SYNTAX         => 'Syntax error, malformed JSON',
        JSON_ERROR_UTF8           => 'Malformed UTF-8 characters, possibly incorrectly encoded'
    );

    final public function __construct($data = null)
    {
        $this->setData($data);
    }

    final public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
    final public function getData($data)
    {
        return $this->data;
    }

    final public function encode(...$args)
    {
        // add data as first arg
        array_unshift($args, $this->data);

        // remove useless second arg if empty
        $args = array_filter($args);

        $return = call_user_func_array('json_encode', $args);
        if (json_last_error()) {
            $this->setError();
        }

        return $return;
    }
    final public function decode(...$args)
    {
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


    final public function hasError(): bool
    {
        return ($this->errorCode > 0);
    }
    final private function setError()
    {
        $this->errorCode = json_last_error();
        if ($this->errorCode) {
            $this->errorMessage = array_key_exists($this->errorCode, self::$errorMessages)
                ? self::$errorMessages[$this->errorCode]
                : 'unknown error';
        }
    }
    final public function getError(): array
    {
        return array(
            'code' => $this->errorCode,
            'message' => $this->errorMessage,
        );
    }
    final public function getErrorCode(): int
    {
        return $this->errorCode;
    }
    final public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
