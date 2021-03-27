<?php
use App\Controller\Greet2Controller;
use App\Controller\HomeController;

global $app;
$app->get('/', [HomeController::class, 'index']);
$app->get('/greet', [HomeController::class, 'greet']);
$app->get('/greet2/{name}', [Greet2Controller::class, 'greet']);
