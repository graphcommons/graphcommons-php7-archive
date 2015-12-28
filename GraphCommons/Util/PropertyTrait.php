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
 * @object     GraphCommons\Util\PropertyTrait
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
trait PropertyTrait
{
    /**
     * Readonly flag.
     * @var bool
     */
    private $_readonly = true;

    /**
     * Check readonly.
     *
     * @return bool
     */
    final public function isReadonly(): bool
    {
        return ($this->_readonly === true);
    }

    /**
     * Set readonly.
     *
     * @param  bool $_readonly
     * @return self
     */
    final public function setReadonly(bool $_readonly): self
    {
        $this->_readonly = $_readonly;

        return $this;
    }

    /**
     * Get readonly.
     *
     * @return bool
     */
    final public function getReadonly(): bool
    {
        return $this->_readonly;
    }

    /**
     * Setter.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Exception
     */
    public function __set(string $name, $value)
    {
        if ($this->_readonly) {
            throw new \Exception(sprintf('%s object is readonly!',
                get_class($this)));
        }

        $this->{$name} = $value;
    }

    /**
     * Getter.
     *
     * @param  string $name
     * @return mixed
     * @throws \Exception
     */
    public function __get(string $name)
    {
        if (!property_exists($this, $name)) {
            throw new \Exception(sprintf('%s property is not exists on %s',
                $name, get_class($this)));
        }

        return $this->{$name};
    }

    /**
     * Checker.
     *
     * @param  string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        if (property_exists($this, $name)) {
            return isset($this->{$name});
        }

        return false;
    }

    /**
     * Remover (resets to null).
     *
     * @param  string $name
     * @return void
     */
    public function __unset(string $name)
    {
        $this->{$name} = null;
    }
}
