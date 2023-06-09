<?php

use ofernandoavila\Community\Controller\DisplayView\LoginDisplayViewController;
use ofernandoavila\Community\Controller\SessionController;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Model\User;

global $router;

$router->get('/login', function ($data) {
    $loginController = new LoginDisplayViewController();

    return $loginController->LoginPage($data);
});

$router->get('/logoff', function ($data) {
    $loginController = new LoginDisplayViewController();

    return $loginController->Logoff();
});

$router->get('/create-account', function ($data) {
    $loginController = new LoginDisplayViewController();

    return $loginController->CreateAccountPage($data);
});

$router->post('/create-account', function($data) {

    try {
        $controller = new UserController();
        
        if ($controller->SaveUser($data['name'], $data['username'], $data['email'], $data['password'])) {

            $createdUser = $controller->GetUserByUsername($data['username']);
            
            if($controller->CreateDirectoryStructure($createdUser->userHash)) {
                Redirect('/');
            } else {
                throw new \Exception('Could not create directory structure');
            }

        } else {
            Redirect('/create-account');
        }
    } catch (Exception $e) {
        throw $e;
    }
});

$router->post('/login', function($data) {
    $sessionController = new SessionController();
    $userController = new UserController();

    $user = new User($data['username'], $data['password']);

    if(User::Authenticate($user)) {
        $user = $userController->GetUserByUsername($user->username);

        $sessionController->SaveSession($user);

        $_SESSION['msg']['type'] = "success";
        $_SESSION['msg']['text'] = "Logged with success!";

        Redirect('/');
    } else {
        Redirect('/login');
    }
});