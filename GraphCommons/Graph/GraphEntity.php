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

use GraphCommons\Util\PropertyTrait as Property;

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Graph
 * @object     GraphCommons\Graph\GraphEntity
 * @uses       GraphCommons\Util\PropertyTrait
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
abstract class GraphEntity
{
    /**
     * Property thing.
     * @trait GraphCommons\Util\PropertyTrait
     */
    use Property;

    /**
     * Graph object.
     * @var GraphCommons\Graph\Graph
     */
    protected $graph;

    /**
     * Constructor.
     *
     * @param GraphCommons\Graph\Graph|null $graph
     */
    final public function __construct(Graph $graph = null) {
        $this->graph = $graph;
    }

    /**
     * Set graph.
     *
     * @param  GraphCommons\Graph\Graph $graph
     * @return self
     */
    final public function setGraph(Graph $graph): self
    {
        $this->graph = $graph;
        return $this;
    }

    /**
     * Get graph.
     *
     * @return GraphCommons\Graph\Graph
     */
    final public function getGraph(): Graph
    {
        return $this->graph;
    }
}
