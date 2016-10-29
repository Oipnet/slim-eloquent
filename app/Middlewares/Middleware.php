<?php

namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

interface Middleware
{
    public function __invoke(Request $request, Response $response, $next);
}