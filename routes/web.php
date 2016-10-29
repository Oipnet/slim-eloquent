<?php

$app->get('/', \App\Controllers\PageController::class.':home')->setName('home');
$app->get('/nous-contacter', \App\Controllers\PageController::class.':getContact')->setName('contact');
$app->post('/nous-contacter', \App\Controllers\PageController::class.':postContact');