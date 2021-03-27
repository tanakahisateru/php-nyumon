<?php

use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

function _path_(string $path): string {
    $prefix = dirname(__DIR__) . '/';
    return preg_replace('/^@\//', $prefix, $path);
}

return [
    Twig::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/../resource/templates');
        return new Twig($loader, [
            'cache' => _path_($_ENV['TEMPLATE_CACHE_PATH']),
        ]);
    },
    ResponseFactoryInterface::class => \DI\create(ResponseFactory::class),

    // TwigView::class => \DI\create()->constructor(
    //     \DI\get(Twig::class),
    //     \DI\get(ResponseFactoryInterface::class)
    // ),
    // PHP-DI can provide an ad-hoc created instance with auto wiring!
];
