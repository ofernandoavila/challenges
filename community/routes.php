<?php

use ofernandoavila\Community\Core\BasicController;
use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Template;

global $router;

$router->get('/', function() {
    $controller = new BasicViewController();
    $controller->Render('Home');
});

$router->get('/project', function($data) {
    $controller = new BasicViewController();
    $controller->Render('project/ProjectPage');
});

require_once __DIR__ . '/routes/AccountRoutes.php';
require_once __DIR__ . '/routes/LoginRoutes.php';