<?php

declare(strict_types=1);

namespace App\Core;

use Dotenv\Dotenv;

class Bootstrap
{
    /**
     * @param string $path
     *
     * @return void
     */
    public static function run(string $path): void
    {
        $dotenv = Dotenv::createUnsafeImmutable($path);
        $dotenv->load();
    }
}