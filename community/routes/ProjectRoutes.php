<?php

use ofernandoavila\Community\Controller\ProjectController;
use ofernandoavila\Community\Controller\UserController;
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

$router->get('/projects', function ($data) {
    $controller = new ProjectController();
    $controller->RenderProjects($data);
});

$router->get('/project', function ($data) {
    $controller = new ProjectController();

    if(!isset($data['id'])) Redirect('/projects');

    $controller->RenderProject($data);
});

$router->get('/project/delete', function ($data) {
    try {
        $controller = new ProjectController();
        $userController = new UserController();

        $project = $controller->GetProjectById($data['id']);

        $loggedUser = $userController->GetUserBySessionHash($data['session']->hash);

        if ($project->IsOwner($loggedUser)) {
            $controller->DeleteProject($project);

            $_SESSION['msg']['type'] = 'success';
            $_SESSION['msg']['text'] = 'Project deleted successfully';

            Redirect('/my-account/dashboard');
        } else {
            $_SESSION['msg']['type'] = 'danger';
            $_SESSION['msg']['text'] = 'You need to be the project owner to delete this';

            Redirect('/my-account/dashboard');
        }
    } catch (Exception $e) {
        $_SESSION['msg']['type'] = 'danger';
        $_SESSION['msg']['message'] = $e->getMessage();

        Redirect('/my-account/dashboard');
    }
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