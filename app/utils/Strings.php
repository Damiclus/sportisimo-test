<?php

namespace utils;

class Strings extends \Nette\Utils\Strings
{
    /**
     * @param string $input
     * @param string|null $ignorePrefix
     * @return string
     */
    public static function camelize(string $input, string $ignorePrefix = null): string
    {
        $input = $ignorePrefix ? str_replace($ignorePrefix, "", $input) : $input;
        return lcfirst(str_replace('_', '', ucwords($input, '_')));
    }
}