<?php
namespace App\Util;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment as Twig;

class TwigView
{
    public function __construct(
        private readonly Twig $twig,
        private readonly ResponseFactoryInterface $responseFactory,
    ){}

    public function render(string $page, array $context = []): string
    {
        return $this->twig->render($page, $context);
    }

    public function renderAsResponse(string $page, array $context = []): ResponseInterface
    {
        $response = $this->responseFactory
            ->createResponse()
            ->withHeader('Content-Type', 'text/html')
        ;
        $body = $this->render($page, $context);
        $response->getBody()->write($body);
        return $response;
    }
}
