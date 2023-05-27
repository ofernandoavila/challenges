<?php

use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Helper\EntityManagerCreator;
use ofernandoavila\Community\Model\Project;
use ofernandoavila\Community\Model\Session;
use ofernandoavila\Community\Model\User;

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
    try {
        $em = EntityManagerCreator::createEntityManager();

        $project = new Project();

        $project->name = $data['project_name'];
        $project->description = $data['project_description'];
        $project->filePath = 'teste123';
        $project->isPublic = $data['project_public'] == 'public' ? true : false;

        $user = Session::GetCurrentUser();
        $user = $em->find(User::class, $user->id);

        $project->setOwner($user);
        $user->AddProject($project);

        $em->persist($project);
        $em->flush();

        Redirect('/my-account/dashboard');
    } catch (\Exception $e) {
        $_SESSION['msg']['text'] = $e->getMessage();
        $_SESSION['msg']['type'] = 'danger';

        Redirect('/project/add-new-project');
    }
});