<?php

use ofernandoavila\Community\Core\BasicController;
use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Template;

global $router;

$router->get('/', function() {
    $controller = new BasicViewController();
    $controller->Render('Home');
});

require_once __DIR__ . '/routes/DashboardRoutes.php';
require_once __DIR__ . '/routes/ProjectRoutes.php';
require_once __DIR__ . '/routes/AccountRoutes.php';
require_once __DIR__ . '/routes/LoginRoutes.php';