<?php

namespace Phase\Config;

use Adbar\Dot;

class Config
{
    public static string $pathToConfig;

    public static function init(string $pathToConfig)
    {
        self::$pathToConfig = $pathToConfig;
    }

    public static function get(string $key): mixed
    {
        if (empty($key)) return NULL;

        $filename = strtok($key, '.');
        $filepath = self::$pathToConfig . $filename . '.php';

        if (! file_exists($filepath)) return NULL;

        // Dot implements dot notation, so this is just a lazy way to do the rest
        $config = include $filepath;
        $dot = new Dot($config);
        $keyWithoutFilename = strtok('');

        if (! $dot->has($keyWithoutFilename)) return NULL;

        return $dot->get($keyWithoutFilename);
    }
}