<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 27/10/16
 * Time: 14:53
 */

namespace App\Controllers;


use Illuminate\Database\Capsule\Manager;
use Psr\Http\Message\ResponseInterface;

class Controller
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function render (ResponseInterface $response, $file, $params = []) {
        return $this->container->view->render($response, $file, $params);
    }

    protected function mailer () : \Swift_Mailer {
        return $this->container->mailer;
    }

    protected function db () : Manager{
        return $this->container->db;
    }

    protected function redirect(ResponseInterface $response, $name, $status = 302)
    {
        return $response->withStatus($status)->withHeader('Location', $this->container->router->pathFor($name));
    }

    protected function flash ($message, $type = 'success') {
        echo 'flash';
        if (! isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }
        return $_SESSION['flash'][$type] = $message;
    }
}