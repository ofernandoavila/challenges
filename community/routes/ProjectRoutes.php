<?php

use ofernandoavila\Community\Core\BasicViewController;

global $router;

$router->get('/project/view-project', function($data) {
    $controller = new BasicViewController();
    $controller->Render('project/ViewProject');
});

$router->get('/project', function ($data) {
    $controller = new BasicViewController();
    $controller->Render('project/ProjectPage');
});