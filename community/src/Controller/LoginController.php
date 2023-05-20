<?php

namespace ofernandoavila\Community\Controller;

use ofernandoavila\Community\Core\BasicController;
use ofernandoavila\Community\Model\User;

class LoginController extends BasicController {
    public function LoginPage()
    {
        return $this->Render('LoginPage');
    }

    public function CreateAccountPage() {
        return $this->Render('CreateAccountPage');
    }

    public function MakeLogin(User $user)
    {
    }

    public function SignUp(User $user)
    {
        return User::CreateUser($user);
    }
}