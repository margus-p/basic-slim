<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

return [

    "view" => DI\factory(function (\Psr\Container\ContainerInterface $c) {
        return \Slim\Views\Twig::create(
            APP_ROOT . $_SERVER["TWIG_TEMPLATES_PATH"],
            [
                'cache' => APP_ROOT . $_SERVER["TWIG_CACHE_PATH"],
                'debug' => $_SERVER["APP_DEV_MODE"],
            ]
        );

    }),

    EntityManager::class => DI\factory(function () {
        // TODO: Add configuration for production use
        $entitiesPaths = [APP_ROOT . $_SERVER["DOCTRINE_METADATA_DIR"]];
        $dbParams = [
            'driver'   => $_SERVER["DOCTRINE_DRIVER"],
            'host'     => $_SERVER["DB_HOST"],
            'port'     => $_SERVER["DB_PORT"],
            'user'     => $_SERVER["DB_USER"],
            'password' => $_SERVER["DB_PASS"],
            'dbname'   => $_SERVER["DB_NAME"],
            'charset'  => $_SERVER["DB_CHARSET"],
        ];

        $config = ORMSetup::createAttributeMetadataConfiguration($entitiesPaths, true);
        $connection = DriverManager::getConnection($dbParams, $config);

        return new EntityManager($connection, $config);

    }),

    /* Repositories */
    \App\Repositories\Contracts\Site\SiteVisitRepositoryInterface::class => \DI\get(\App\Repositories\Implementation\Doctrine\Site\SiteVisitRepository::class),

];
