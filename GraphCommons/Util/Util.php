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
 * @object     GraphCommons\Util\Util
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
abstract class Util
{
    /**
     * Array digger with . notation support.
     *
     * @param  array      $array
     * @param  int|string $key
     * @param  mixed|null $valueDefault
     * @return mixed|null
     */
    final public static function arrayDig(array $array, $key, $valueDefault = null)
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

    /**
     * Array picker.
     *
     * @param  array      $array
     * @param  int|string $key
     * @param  mixed|null $valueDefault
     * @return mixed|null
     */
    final public static function arrayPick(array &$array, $key, $valueDefault = null)
    {
        if (isset($array[$key])) {
            $value = $array[$key];
            // remove used element
            unset($array[$key]);
        }

        return ($value !== null) ? $value : $valueDefault;
    }

    /**
     * Convert an object to array with deep option.
     *
     * @param  \stdClass $input
     * @param  bool      $deep
     * @return array
     */
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

    /**
     * Convert an array to object with deep option.
     * @param  array  $input
     * @param  bool   $deep
     * @return \stdClass
     */
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

    /**
     * Parse response headers.
     *
     * @param  string $headers
     * @return array
     */
    final public static function parseResponseHeaders(string $headers): array
    {
        $return  = array();
        $headers = array_map('trim', (array) explode("\r\n", $headers));
        if (!empty($headers)) {
            $status = array_shift($headers);
            // add status info
            if (preg_match('~HTTP/\d+\.\d+\s+(\d+)\s+(.+)$~', $status, $match)) {
                $return['status'] = $status;
                $return['status_code'] = (int) $match[1];
                $return['status_text'] = trim($match[2]);
            }

            // add regular headers
            foreach ($headers as $header) {
                @ list($key, $value) = explode(':', $header, 2);
                if (isset($key, $value)) {
                    $key = trim($key);
                    $value = trim($value);
                    $return[$key] = $value;
                }
            }
        }

        return $return;
    }
}
