<?php

declare(strict_types=1);

$baseDir = APP_ROOT . '/';
$dotenv = Dotenv\Dotenv::createImmutable($baseDir);
if (file_exists($baseDir . '.env')) {
    $dotenv->load();
}

$dotenv->required([
    "APP_DEV_MODE",

])->isBoolean();