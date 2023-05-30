<?php

use ofernandoavila\Community\Controller\ProjectController;
use ofernandoavila\Community\Core\BasicController;
use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Template;

global $router;

$router->get('/', function($data) {
    $controller = new BasicViewController();
    $projects = new ProjectController();

    $data['games'] = $projects->GetProjects();

    $controller->Render('Home', $data);
});

require_once __DIR__ . '/routes/ProfileRoutes.php';
require_once __DIR__ . '/routes/DashboardRoutes.php';
require_once __DIR__ . '/routes/ProjectRoutes.php';
require_once __DIR__ . '/routes/AccountRoutes.php';
require_once __DIR__ . '/routes/LoginRoutes.php';