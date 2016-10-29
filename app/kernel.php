<?php

session_start();

require '../core/helpers.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim',
            'username' => 'root',
            'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
]);


require 'container.php';

$container = $app->getContainer();

// Middleware
$app->add(new \App\Middlewares\FlashMiddleware($container->view->getEnvironment()));
$app->add(new \App\Middlewares\OldMiddleware($container->view->getEnvironment()));
$app->add(new \App\Middlewares\TwigCsrfMiddleware($container->view->getEnvironment(), $container->get('csrf')));
$app->add($container->get('csrf'));