<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\Collection;
use GraphCommons\Util\Util;
use GraphCommons\Util\{Json, JsonException};
use GraphCommons\Util\SerialTrait as Serial;
use GraphCommons\Graph\Signal;


class SignalCollection extends Collection
{
    use Serial;

    final public function add(Signal $signal): self
    {
        parent::set($this->count(), $signal);

        return $this;
    }

    final public function unserialize(): array
    {
        $array = array();
        foreach ($this->data as $key => $value) {
            $array['signals'][$key] = $value->unserialize();
        }
        return $array;
    }

    final public static function fromArray(array $array): SignalCollection
    {
        $signals = new self();
        foreach ($array as $array) {
            if (!isset($array['action'], $array['parameters'])) {
                throw new \Exception("Signal 'action' and 'parameters' fields are required!");
            }
            $signal = new Signal();
            $signal->setAction($array['action']);
            $signal->setParameters($array['parameters']);
            $signals->add($signal);
        }
        return $signals;
    }

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
            throw new \Exception("'signals' field is required!");
        }

        $array = array();
        foreach ($data['signals'] as $i => $signal) {
            if (!isset($signal['action'])) {
                throw new \Exception("Signal 'action' and 'parameters' fields are required!");
            }
            $array[$i]['action'] = Signal::detectAction(Util::arrayPick($signal, 'action'));
            foreach ($signal as $key => $value) {
                $array[$i]['parameters'][$key] = $value;
            }
        }

        return self::fromArray($array);
    }
}
