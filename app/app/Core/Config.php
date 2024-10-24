<?php

declare(strict_types=1);

namespace App\Core;

class Config
{
    /**
     * @param string $filename
     *
     * @return array
     */
    public static function getConfig(string $filename): array
    {
        $result = [];
        $fullNameConfigFile = self::getFullPath($filename);

        if (file_exists($fullNameConfigFile)) {
            $result = require $fullNameConfigFile;
        }

        return $result;
    }

    /**
     * @param string $filename
     *
     * @return string
     */
    protected static function getFullPath(string $filename): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/../config/' . $filename . '.php';
    }
}