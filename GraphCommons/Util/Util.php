<?php
namespace GraphCommons\Util;

use GraphCommons\GraphCommonsApiException;
use GraphCommons\Http\Response;

abstract class Util
{
    final public static function arrayDig(array $array, $key, $value = null)
    {
        return $array[$key] ?? $value;
    }
    final public static function arrayPop(array $array, $key, $value = null)
    {
        if (isset($array[$key])) {
            $value = $array[$key];
            unset($array[$key]);
        }
        return $value;
    }

    final public static function toObject($input, $deep = true): \stdClass {
        $object = new \stdClass();
        foreach ((array) $input as $key => $value) {
            $valueType = gettype($value);
            if ($deep && ($valueType == 'array' || $valueType == 'object')) {
                $object->{$key} = toObject($value);
            } else {
                $object->{$key} = $value;
            }
        }
        return $object;
    }

    final public static function parseResponseHeaders(string $headers): array
    {
        $return  = array();
        $headers = array_map('trim', (array) explode("\r\n", $headers));
        if (!empty($headers)) {
            $firsLine = array_shift($headers);
            // response: HTTP/1.1 200 OK
            if (preg_match('~HTTP/\d+\.\d+\s+(\d+)\s+(.+)$~', $firsLine, $match)) {
                $return['status'] = $firsLine;
                $return['status_code'] = (int) $match[1];
                $return['status_text'] = trim($match[2]);
            }
            foreach ($headers as $header) {
                @list($key, $value) = explode(':', $header, 2);
                if (isset($key, $value)) {
                    $key = trim($key);
                    $value = trim($value);
                    $return[$key] = $value;
                }
            }
        }
        return $return;
    }

    final public static function getResponseException(Response $response): array
    {
        $responseData = $response->getBodyData();
        if (isset($responseData['msg'])) {
            return array(
                $response->getStatusCode(),
                $responseData['msg'],
            );
        }
        return array(
            GraphCommonsApiException::UNKNOWN_ERROR_CODE,
            GraphCommonsApiException::UNKNOWN_ERROR_MESSAGE,
        );
    }
}
