<?php

declare(strict_types=1);

use Slim\App;

/** @var App $app */
global $app;

$app->add(\Slim\Views\TwigMiddleware::createFromContainer($app));

// Add Middlewares here
$app->add(\App\Middlewares\Site\LogSiteVisitMiddleware::class);
