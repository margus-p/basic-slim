<?php

declare(strict_types=1);

use Slim\App;

require __DIR__."/../app/App.php";

/** @var App $app */
global $app;

$app->run();
