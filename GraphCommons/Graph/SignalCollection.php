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

use GraphCommons\Util\Util;
use GraphCommons\Util\Collection;
use GraphCommons\Util\SerialTrait as Serial;
use GraphCommons\Util\{Json, JsonException};

/**
 * @package    GraphCommons
 * @subpackage GraphCommons\Graph
 * @object     GraphCommons\Graph\SignalCollection
 * @uses       GraphCommons\Util\Util,
 *             GraphCommons\Util\Collection,
 *             GraphCommons\Util\SerialTrait,
 *             GraphCommons\Util\Json, GraphCommons\Util\JsonException
 * @author     Kerem Güneş <qeremy@gmail.com>
 */
class SignalCollection extends Collection
{
    /**
     * Serial thing.
     * @trait GraphCommons\Util\SerialTrait
     */
    use Serial;

    /**
     * Add an element.
     *
     * @param string                    $id
     * @param GraphCommons\Graph\Signal $signal
     */
    final public function add(Signal $signal): self
    {
        parent::set($this->count(), $signal);

        return $this;
    }

    /**
     * Create signals overriding self.unserialize().
     *
     * @return array
     */
    final public function unserialize(): array
    {
        $array = array();
        foreach ($this->data as $data) {
            $array['signals'][] = $data->unserialize();
        }

        return $array;
    }

    /**
     * Create a signal collection from array.
     *
     * @param  array $array
     * @return GraphCommons\Graph\SignalCollection
     * @throws \InvalidArgumentException
     */
    final public static function fromArray(array $array): SignalCollection
    {
        if (empty($array)) {
            throw new \InvalidArgumentException('Empty signals array given!');
        }

        $signals = new SignalCollection();
        foreach ($array as $array) {
            if (!isset($array['action'], $array['parameters'])) {
                throw new \InvalidArgumentException(
                    "Signal 'action' and 'parameters' fields are required!");
            }

            $signal = (new Signal())
                ->setAction($array['action'])
                ->setParameters($array['parameters']);
            $signals->add($signal);
        }

        return $signals;
    }

    /**
     * Create a signal collection from JSON string.
     *
     * @param  string $json
     * @return GraphCommons\Graph\SignalCollection
     * @throws GraphCommons\Util\JsonException, \InvalidArgumentException
     */
    final public static function fromJson(string $json): SignalCollection
    {
        $json = new Json($json);
        if ($json->hasError()) {
            $jsonError = $json->getError();
            throw new JsonException(sprintf(
                'JSON error: code(%d) message(%s)',
                $jsonError['code'], $jsonError['message']
            ),  $jsonError['code']);
        }

        $data = $json->decode(true);
        if (!isset($data['signals'])) {
            throw new \InvalidArgumentException("'signals' field is required!");
        }

        $array = array();
        foreach ($data['signals'] as $i => $signal) {
            if (!isset($signal['action'])) {
                throw new \InvalidArgumentException("Signal 'action' and 'parameters' fields are required!");
            }
            $array[$i]['action'] = Signal::detectAction(Util::arrayPick($signal, 'action'));
            foreach ($signal as $key => $value) {
                $array[$i]['parameters'][$key] = $value;
            }
        }

        return self::fromArray($array);
    }
}
