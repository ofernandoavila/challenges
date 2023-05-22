<?php

use ofernandoavila\Community\Controller\AccountController;
use ofernandoavila\Community\Controller\SessionController;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Model\Session;

global $router;

$router->get('/my-account', function ($data) {
    $controller = new AccountController();

    return $controller->MyAccountPage($data);
});

$router->get('/my-account/edit-account', function ($data) {
    $controller = new AccountController();

    return $controller->EditAccountPage($data);
});

$router->get('/my-account/settings', function ($data) {
    $controller = new AccountController();

    return $controller->SettingsAccountPage($data);
});

$router->get('/my-account/delete-account', function ($data) {
    $userController = new UserController();

    $user = $userController->GetUserBySessionHash($_SESSION['user_session']);

    if($userController->DeleteUser($user)) {
        $sessionController = new SessionController();
        $sessionController->DeleteSessionsByUser($user);

        SessionController::ClearSession();

        Redirect('/');
    } else {
        SessionController::DefineErrorMessage('An error occurred while attempting delete this account, please try again');
        Redirect('/my-account/settings');
    }
});

