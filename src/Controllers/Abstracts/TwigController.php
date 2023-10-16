<?php

declare(strict_types=1);

namespace App\Controllers\Abstracts;

use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

abstract class TwigController
{
    protected Twig $view;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get("view");
    }

}
