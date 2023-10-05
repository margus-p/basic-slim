<?php

declare(strict_types=1);

use Slim\App;

/** @var App $app */
global $app;

$app->get("/", [\App\Controllers\HomeController::class, "home"])->setName("home");
