<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Abstracts\TwigController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends TwigController
{

    public function home(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'hello.twig', [
            'name' => "world",
        ]);

    }

}
