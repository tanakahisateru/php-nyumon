<?php
use App\Controller\HomeController;
use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Factory\AppFactory;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment as Twig;

// require __DIR__ . '/../vendor/autoload.php';
// (new Dotenv())->loadEnv(__DIR__.'/../.env');
require __DIR__ . '/../config/bootstrap.php';

// $app = AppFactory::create();
// $app->get('/', function(Request $request, Response $response) {
//     $response = $response->withHeader('Content-Type', 'text/plain');
//     $response->getBody()->write("Hello World");
//     return $response;
// });

// $app = AppFactory::create();
// $app->get('/', function(Request $request, Response $response) {
//     $response = $response->withHeader('Content-Type', 'application/json');
//     $response->getBody()->write(json_encode([
//         'message' => "Hello World",
//     ]));
//     return $response;
// });

// $app = AppFactory::create();
// $app->get('/', function(Request $request, Response $response, $args) {
//     $response = $response->withHeader('Content-Type', 'text/html');

//     ob_start();
//     require __DIR__ . '/../resource/templates/index.html.php';
//     $body = ob_get_clean();

//     $response->getBody()->write($body);
//     return $response;
// });

// $app = Bridge::create();
// $app->get('/', function(Response $response) {
//     $response = $response->withHeader('Content-Type', 'text/plain');
//     $response->getBody()->write("Hello World");
//     return $response;
// });

$builder = new ContainerBuilder();
$builder->addDefinitions(require __DIR__ . '/../config/config.php');
$app = Bridge::create($builder->build());

// $app->get('/', function(Response $response, Twig $twig) {
//     $response = $response->withHeader('Content-Type', 'text/html');
//     $body = $twig->render('index.html.twig');
//     $response->getBody()->write($body);
//     return $response;
// });

// $app->get('/', [Home::class, 'index']);
// $app->get('/greet', [Home::class, 'greet']);
// $app->get('/greet2/{name}', [Home::class, 'greet2']);

require __DIR__ . '/../config/routes.php';

$app->addErrorMiddleware($_ENV['APP_ENV'] === 'dev', true, true);
$app->run();
