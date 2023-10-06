<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment as Twig;

class HomeController
{
    public function __construct(
        private readonly Twig $twig,
    ){}

    public function index(Response $response): Response
    {
        $response = $response->withHeader('Content-Type', 'text/html');
        $body = $this->twig->render('index.html.twig');
        $response->getBody()->write($body);
        return $response;
    }

    public function greet(Request $request, Response $response): Response
    {
        $name = $request->getQueryParams()['name'] ?? 'Unknown';
        $response = $response->withHeader('Content-Type', 'text/html');
        $body = $this->twig->render('greet.html.twig', [
            'name' => $name,
        ]);
        $response->getBody()->write($body);
        return $response;
    }
}
