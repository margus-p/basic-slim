<?php

declare(strict_types=1);

use Slim\App;

date_default_timezone_set("Europe/Tallinn");
const APP_ROOT = __DIR__ . "/..";

require APP_ROOT . '/vendor/autoload.php';
require __DIR__ . '/DotEnv.php';

/** @var App $app */
$app = require __DIR__ . '/Container.php';

require __DIR__ . '/Routes.php';

return $app;
