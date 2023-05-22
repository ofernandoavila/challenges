<?php

use ofernandoavila\Community\Controller\AccountController;

global $router;

$router->get('/my-account', function ($data) {
    $controller = new AccountController();

    return $controller->MyAccountPage($data);
});

$router->get('/my-account/edit-account', function ($data) {
    $controller = new AccountController();

    return $controller->EditAccountPage($data);
});