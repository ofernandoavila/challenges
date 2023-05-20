<?php

use ofernandoavila\Community\Core\BasicController;
use ofernandoavila\Community\Core\Template;

global $router;

$router->get('/', function() {
    $controller = new BasicController();
    $controller->Render('Home');
});

require_once __DIR__ . '/routes/LoginRoutes.php';