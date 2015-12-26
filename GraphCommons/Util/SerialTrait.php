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

    abstract public function unserialize(...$args): array;
}
