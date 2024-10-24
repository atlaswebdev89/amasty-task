<?php

declare(strict_types=1);

require_once "../vendor/autoload.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__.'/../logs/project.log');
date_default_timezone_set("Europe/Minsk");

use App\Core\Bootstrap;
use App\Router\Router;

try {
    Bootstrap::run(__DIR__.'/../');
    $router = new Router();
    $router->start();
}catch (\Throwable $exception){
    error_log($exception->getMessage());
}
