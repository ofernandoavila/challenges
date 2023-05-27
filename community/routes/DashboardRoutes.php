<?php

use ofernandoavila\Community\Controller\DashboardController;

global $router;

$router->get('/my-account/dashboard', function ($data) {
    $controller = new DashboardController();

    return $controller->DashboardPage($data);
});