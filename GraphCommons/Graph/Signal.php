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
namespace GraphCommons\Graph;

use GraphCommons\Util\SerialTrait as Serial;

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Graph
 * @object     GraphCommons\Graph\Signal
 * @uses       GraphCommons\Util\SerialTrait
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
final class Signal
{
    /**
     * Serial thing.
     * @trait GraphCommons\Util\SerialTrait
     */
    use Serial;

    /**
     * Signal actions.
     * @const int
     */
    const NODE_CREATE     = 1,
          NODE_UPDATE     = 2,
          NODE_DELETE     = 3,
          EDGE_CREATE     = 4,
          EDGE_UPDATE     = 5,
          EDGE_DELETE     = 6,
          NODETYPE_CREATE = 7,
          NODETYPE_UPDATE = 8,
          NODETYPE_DELETE = 9,
          EDGETYPE_CREATE = 10,
          EDGETYPE_UPDATE = 11,
          EDGETYPE_DELETE = 12;

    /**
     * Signal action.
     * @var int
     */
    private $action;

    /**
     * Signal actions.
     * @var array
     */
    private static $actions = array(
        '',
        'node_create',
        'node_update',
        'node_delete',
        'edge_create',
        'edge_update',
        'edge_delete',
        'nodetype_create',
        'nodetype_update',
        'nodetype_delete',
        'edgetype_create',
        'edgetype_update',
        'edgetype_delete',
    );

    /**
     * Signal parameters.
     * @const array
     */
    private $parameters = array();

    /**
     * Constructor.
     *
     * @param int|null $action
     */
    final public function __construct(int $action = null)
    {
        if ($action !== null) {
            $this->setAction($action);
        }
    }

    /**
     * Set ation.
     *
     * @param  int $action
     * @return self
     * @throws \InvalidArgumentException
     */
    final public function setAction(int $action): self
    {
        if (!isset(self::$actions[$action])) {
            throw new \InvalidArgumentException(sprintf(
                'Wrong action type given, accepted actions: %s'
                    , join(',', array_slice(self::$actions, 1))
            ));
        }
        $this->action = self::$actions[$action];

        return $this;
    }

    /**
     * Set parameter.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return self
     */
    final public function setParameter(string $key, $value): self
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * Set parameters.
     *
     * @param  array $parameters
     * @return self
     */
    final public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * Set action.
     *
     * @return string
     */
    final public function getAction(): string
    {
        return (string) $this->action;
    }

    /**
     * Get parameter.
     *
     * @param  string $key
     * @return mixed
     */
    final public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }

    /**
     * Get parameters.
     *
     * @return array
     */
    final public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Create signal overriding self.unserialize().
     *
     * @return array
     */
    final public function unserialize(): array
    {
        $array = array();
        $array['action'] = $this->getAction();
        foreach ($this->getParameters() as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * Detect action.
     *
     * @param  int|string $action
     * @return int
     */
    final public static function detectAction($action): int
    {
        if (is_string($action)) {
            $actions = array_flip(self::$actions);
            if (isset($actions[$action])) {
                $action = $actions[$action];
            }
        }

        return $action;
    }
}
