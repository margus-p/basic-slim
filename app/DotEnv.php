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

$dotenv->required([
    "DB_HOST", "DB_PORT", "DB_USER", "DB_PASS", "DB_NAME", "DB_CHARSET",
    "DOCTRINE_DRIVER", "DOCTRINE_METADATA_DIR",
]);
