<?php

use ofernandoavila\Community\Controller\LoginController;
use ofernandoavila\Community\Model\User;

global $router;

$router->get('/login', function () {
    $loginController = new LoginController();

    return $loginController->LoginPage();
});

$router->get('/create-account', function () {
    $loginController = new LoginController();

    return $loginController->CreateAccountPage();
});

$router->post('/create-account', function($data) {
    $loginController = new LoginController();

    $user = new User($data['username'], $data['password']);
    $user->name = $data['name'];

    if (User::CreateUser($user)) {
        Redirect('/');
    } else {
        Redirect('/create-account');
    }
});

$router->post('/login', function($data) {
    $loginController = new LoginController();

    $user = new User($data['username'], $data['password']);

    var_dump($_SESSION);
    die;

    if(User::Authenticate($user)) {
        Redirect('/');
    } else {
        Redirect('/login');
    }
});