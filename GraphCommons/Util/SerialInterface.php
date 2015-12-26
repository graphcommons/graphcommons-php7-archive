<?php
namespace GraphCommons\Util;

interface SerialInterface
{
    public function serialize(...$args): string;
    public function unserialize(...$args): array;
}
