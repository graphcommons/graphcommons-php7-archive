<?php
namespace GraphCommons\Util;

trait SerialTrait
{
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

        return (string) $json->encode();
    }

    public function unserialize(...$args): array
    {
        $array = array();
        foreach (get_object_vars($this) as $key => $value) {
            // pass private vars
            if ($key[0] == '_') {
                continue;
            }
            if ($value !== null) {
                if (is_object($value)) {
                    $array[$key] = $value->unserialize();
                    continue;
                }
                $array[$key] = $value;
            }
        }
        return $array;
    }
}
