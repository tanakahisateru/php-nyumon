<?php

namespace App\Controller;

use App\Util\TwigView;
use Psr\Http\Message\ResponseInterface as Response;

class Greet2Controller
{
    public function __construct(
        private readonly TwigView $view,
    ){}

    public function greet(string $name): Response
    {
        return $this->view->renderAsResponse('greet.html.twig', [
            'name' => $name,
        ]);
    }
}
