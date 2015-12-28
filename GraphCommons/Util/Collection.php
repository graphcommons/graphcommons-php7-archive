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
 * @object     GraphCommons\Util\Collection
 * @implements \Countable, \IteratorAggregate, \ArrayAccess
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
class Collection
    implements \Countable, \IteratorAggregate, \ArrayAccess
{
    /**
     * Data stack.
     * @var array
     */
    protected $data = array();

    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Check an element.
     *
     * @param  int|string $key
     * @return bool
     */
    public function __isset($key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * Remove an element.
     *
     * @param  int|string $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->data[$key]);
    }

    /**
     * Set an element.
     *
     * @param  int|string $key
     * @param  mixed      $value
     * @return self
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * Get an element.
     *
     * @param  int|string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->data[$key] ?? null;
    }

    /**
     * Get all elements.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get all element keys.
     *
     * @return array
     */
    public function getDataKeys(): array
    {
        return array_keys($this->data);
    }

    /**
     * Get all element values.
     *
     * @return array
     */
    public function getDataValues(): array
    {
        return array_values($this->data);
    }

    /**
     * Count elements (comes from \Countable).
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * Iterator method (comes from \IteratorAggregate).
     *
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }

    /**
     * Set an element (comes from \ArrayAccess).
     *
     * @param  int|string $key
     * @param  mixed      $element
     * @return self
     */
    public function offsetSet($key, $element)
    {
        return $this->set($key, $element);
    }

    /**
     * Get an element (comes from \ArrayAccess).
     *
     * @param  int|string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Remove an element (comes from \ArrayAccess)
     * @param  int|string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        return $this->__unset($key);
    }

    /**
     * Check an element (comes from \ArrayAccess)
     * @param  int|string $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->__isset($key);
    }
}
