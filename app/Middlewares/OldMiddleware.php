<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 28/10/16
 * Time: 16:26
 */

namespace App\Middlewares;


use Slim\Http\Request;
use Slim\Http\Response;

class OldMiddleware implements Middleware
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $this->twig->addGlobal('old', isset($_SESSION['old']) ? $_SESSION['old'] : []);
        if ( isset($_SESSION['old'])) {
            unset($_SESSION['old']);
        }
        $response = $next($request, $response);
        if ($response->getStatusCode() === 400) {
            $_SESSION['old'] = $request->getParams();
        }
        return $response;
    }
}