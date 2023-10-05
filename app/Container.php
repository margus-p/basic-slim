<?php

declare(strict_types=1);

use DI\Bridge\Slim\Bridge;
use DI\Container;
use DI\ContainerBuilder;

$cb = new ContainerBuilder();

// Enable in production:
// $cb->enableCompilation();
// $cb->writeProxiesToFile(true, "path/to/proxies");

$cb->addDefinitions(__DIR__."/Container.definitions.php");

try {
    $cb->useAutowiring(true);
    $container = $cb->build();

} catch (Exception $e) {
    throw new RuntimeException("Could not build container.", previous: $e);
}

$app = Bridge::create($container);
$app->addBodyParsingMiddleware();

return $app;
