<?php
namespace App\Util;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigViewTest extends TestCase
{
    private ?TwigView $view;

    protected function setUp(): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../resource/templates');
        // FIXME On-memory template
        $twig = new Environment($loader);

        $responseFactory = new ResponseFactory();

        $this->view = new TwigView($twig, $responseFactory);
    }

    protected function tearDown(): void
    {
        $this->view = null;
    }

    public function testRender()
    {
        $html = $this->view->render('index.html.twig');

        $this->assertStringContainsString("<h1>Hello", $html);
    }

    public function testRenderWithContext()
    {
        $html = $this->view->render('greet.html.twig', [
            'name' => "Test",
        ]);

        $this->assertStringContainsString("Test</h1>", $html);
    }

    public function testRenderAsResponse()
    {
        $response = $this->view->renderAsResponse('index.html.twig');

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertContainsEquals('text/html', $response->getHeader('Content-Type'));
    }
}
