<?php

use ofernandoavila\Community\Controller\DisplayView\ProfileDisplayViewController;

global $router;

$router->get('/profile', function($data){
    $controller = new ProfileDisplayViewController();

    $controller->ProfilePage($data);
});

$router->get('/profile/followers', function($data){
    $controller = new ProfileDisplayViewController();

    $controller->ProfileFollowersPage($data);
});

$router->get('/profile/followings', function($data){
    $controller = new ProfileDisplayViewController();

    $controller->ProfileFollowingsPage($data);
});