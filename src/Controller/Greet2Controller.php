<?php

namespace App\Controller;

use App\Util\TwigView;
use Psr\Http\Message\ResponseInterface as Response;

class Greet2Controller
{
    private TwigView $view;

    public function __construct(TwigView $view)
    {
        $this->view = $view;
    }

    public function greet($name): Response
    {
        return $this->view->renderAsResponse('greet.html.twig', [
            'name' => $name,
        ]);
    }
}
