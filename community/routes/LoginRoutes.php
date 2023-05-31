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

    $controller = new UserController();

    $user = new User($data['username'], $data['password']);
    $user->name = $data['name'];

    if ($controller->SaveUser($user)) {

        Redirect('/');
    } else {
        Redirect('/create-account');
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