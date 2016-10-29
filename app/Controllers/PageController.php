<?php

namespace App\Controllers;

use App\Models\Post;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;

class PageController extends Controller {
    public function home(RequestInterface $request, ResponseInterface $response) {
        var_dump($this->db()->table('posts')->get());die();
        $posts = Post::all();
        var_dump($posts);die();
        $this->render($response, 'pages/home.twig');
    }
    public function getContact(RequestInterface $request, ResponseInterface $response) {
        return $this->render($response, 'pages/contact.twig');
    }

    public function postContact(RequestInterface $request, ResponseInterface $response) {
        $errors = [];
        Validator::email()->validate($request->getParam('email')) || $errors['email'] = 'Votre email n\'est pas valide';
        Validator::notEmpty()->validate($request->getParam('name')) || $errors['name'] = 'Vous devez entrer votre nom';
        Validator::notEmpty()->validate($request->getParam('content')) || $errors['content'] = 'Vous devez entrer votre contenu';
        if (! empty($errors)) {
            $this->flash('Certains champs n\'ont pas été rempli correctement', 'error');
            $this->flash($errors, 'errors');
            return $this->redirect($response, 'contact', 400);
        }

        $message = \Swift_Message::newInstance('Message de contact')
            ->setFrom([$request->getParam('email') => $request->getParam('name')])
            ->setTo('contact@localhost.fr')
            ->setBody('Un email vous a été envoyé : '.$request->getParam('content'));

        $this->mailer()->send($message);

        $this->flash('Votre message a bien été envoyé');

        return $this->redirect($response, 'contact');
    }
}