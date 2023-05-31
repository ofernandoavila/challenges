<?php

use ofernandoavila\Community\Controller\DisplayView\DashboardDisplayViewController;

global $router;

$router->get('/my-account/dashboard', function ($data) {
    $controller = new DashboardDisplayViewController();

    return $controller->DashboardPage($data);
});