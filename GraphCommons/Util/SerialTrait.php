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
 * @object     GraphCommons\Util\SerialTrait
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
trait SerialTrait
{
    /**
     * Serialize array to JSON string.
     *
     * @param  array $args
     * @return string
     * @throws GraphCommons\Util\JsonException
     */
    public function serialize(...$args): string
    {
        $json = new Json($this->unserialize());
        if ($json->hasError()) {
            $jsonError = $json->getError();
            throw new JsonException(sprintf(
                'JSON error: code(%d) message(%s)',
                $jsonError['code'], $jsonError['message']
            ),  $jsonError['code']);
        }

        return (string) $json->encode($args);
    }

    /**
     * Prepare owner object properties as array.
     *
     * @return array
     */
    public function unserialize(): array
    {
        $array = array();

        foreach (get_object_vars($this) as $key => $value) {
            // pass private vars
            if ($key[0] == '_') {
                continue;
            }
            // pass null values
            if ($value !== null) {
                // check if value has unserialize method
                if (is_object($value) && method_exists($value, 'unserialize')) {
                    $array[$key] = $value->unserialize();
                    continue;
                }
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
