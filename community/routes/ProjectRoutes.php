<?php

use ofernandoavila\Community\Core\BasicViewController;

global $router;

$router->get('/project/view-project', function($data) {
    $controller = new BasicViewController();
    $controller->Render('project/ViewProject');
});

$router->get('/project', function ($data) {
    $controller = new BasicViewController();
    $controller->Render('project/ProjectPage', $data);
});

$router->get('/project/add-new-project', function($data) {
    $controller = new BasicViewController();
    $controller->Render('project/AddNewProject'); 
});

$router->post('/project/add-new-project', function ($data) {
    $_SESSION['msg']['type'] = "success";
    $_SESSION['msg']['text'] = "Project '" . $data['project_name'] . "' created with success!";

    Redirect('/project');
});