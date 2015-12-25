<?php
namespace GraphCommons\Util;

abstract class Util
{
    final public static function arrayDig(array $array, $key, $value = null)
    {
        return $array[$key] ?? $value;
    }
    final public static function arrayPop(array $array, $key, $value = null)
    {
        if (isset($array[$key])) {
            $value = $array[$key];
            unset($array[$key]);
        }
        return $value;
    }
}
