<?php

use ofernandoavila\Community\Controller\ProfileController;

global $router;

$router->get('/profile', function($data){
    $controller = new ProfileController();

    $controller->ProfilePage($data);
});