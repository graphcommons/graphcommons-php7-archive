<?php
namespace GraphCommons\Util;

use GraphCommons\GraphCommonsApiException as Exception;
use GraphCommons\Http\Request;
use GraphCommons\Http\Response;

abstract class Util
{
    final public static function arrayDig(array $array, $key, $value = null)
    {
        // direct access
        if (isset($array[$key])) {
            $value =& $array[$key];
        }
        // trace element path
        else {
            $value =& $array;
            foreach (explode('.', $key) as $key) {
                $value =& $value[$key];
            }
        }

        return ($value !== null) ? $value : $valueDefault;
    }
    final public static function arrayPick(array &$array, $key, $value = null)
    {
        if (isset($array[$key])) {
            $value = $array[$key];
            unset($array[$key]);
        }
        return $value;
    }

    final public static function toArray(\stdClass $input, $deep = true): array
    {
        $return = array();
        foreach ($input as $key => $value) {
            $valueType = gettype($value);
            if ($deep && ($valueType == 'array' || $valueType == 'object')) {
                $return[$key] = self::toArray((object) $value, $deep);
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }

    final public static function toObject(array $input, $deep = true): \stdClass
    {
        $return = new \stdClass();
        foreach ($input as $key => $value) {
            $valueType = gettype($value);
            if ($deep && ($valueType == 'array' || $valueType == 'object')) {
                $return->{$key} = self::toObject((array) $value, $deep);
            } else {
                $return->{$key} = $value;
            }
        }
        return $return;
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

    final public static function getRequestException(Request $request): array
    {
        if ($request->isFail()) {
            return array(
                'code' => $response->getFailCode(),
                'message' => $response->getFailText(),
            );
        }
        return array(
            'code' => Exception::UNKNOWN_ERROR_CODE,
            'message' => Exception::UNKNOWN_ERROR_MESSAGE,
        );
    }

    final public static function getResponseException(Response $response): array
    {
        $responseData = $response->getBodyData();
        if (isset($responseData->msg)) {
            return array(
                'code' => $response->getStatusCode(),
                'message' => $responseData->msg,
            );
        } elseif (isset($responseData->status, $responseData->error)) {
            return array(
                'code' => $responseData->status,
                'message' => $responseData->error,
            );
        }
        return array(
            'code' => Exception::UNKNOWN_ERROR_CODE,
            'message' => Exception::UNKNOWN_ERROR_MESSAGE,
        );
    }
}
